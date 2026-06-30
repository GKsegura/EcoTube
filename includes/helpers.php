<?php

function h($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

function requireAdmin() {
    if (!isset($_SESSION['isadm']) || $_SESSION['isadm'] !== 't') {
        header("Location: ../index.php");
        exit;
    }
}

function redirect($msg, $url) {
    $erros = ['erro', 'inválid', 'não', 'duplicado', 'falha'];
    $tipo = 'success';
    foreach ($erros as $palavra) {
        if (stripos($msg, $palavra) !== false) {
            $tipo = 'error';
            break;
        }
    }
    $_SESSION['toast'] = ['msg' => $msg, 'type' => $tipo];
    header("Location: $url");
    exit;
}

function contarItensCarrinho(int $cod_usuario): int {
    include __DIR__ . '/conexao.php';
    $sql = "SELECT COALESCE(SUM(qtde), 0) AS total FROM carrinho WHERE cod_usuario = $1";
    $res = pg_query_params($conecta, $sql, [$cod_usuario]);
    $row = pg_fetch_assoc($res);
    return intval($row['total']);
}

function renderToast() {
    if (!isset($_SESSION['toast'])) return;
    $toast = $_SESSION['toast'];
    unset($_SESSION['toast']);
    $msg = h($toast['msg']);
    $type = $toast['type'];
    echo "<div class='toast toast-{$type}' id='toast'>{$msg}</div>";
    echo "<script>setTimeout(function(){var t=document.getElementById('toast');if(t)t.classList.add('toast-hide');},3000);setTimeout(function(){var t=document.getElementById('toast');if(t)t.remove();},3500);</script>";
}
