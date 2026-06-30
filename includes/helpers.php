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

function renderToast() {
    if (!isset($_SESSION['toast'])) return;
    $toast = $_SESSION['toast'];
    unset($_SESSION['toast']);
    $msg = h($toast['msg']);
    $type = $toast['type'];
    echo "<div class='toast toast-{$type}' id='toast'>{$msg}</div>";
    echo "<script>setTimeout(function(){var t=document.getElementById('toast');if(t)t.classList.add('toast-hide');},3000);setTimeout(function(){var t=document.getElementById('toast');if(t)t.remove();},3500);</script>";
}
