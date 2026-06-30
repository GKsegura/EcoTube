<?php
session_start();
include "../includes/conexao.php";
include "../includes/helpers.php";

if (!isset($_SESSION['usuariologado'])) {
    redirect('Você deve fazer login para continuar!', '../login/login.php');
}

$cod_usuario = intval($_SESSION['usuariologado']['cod_usuario']);
$resultado_lista = $_SESSION['produtos'] ?? null;

if (!$resultado_lista) {
    redirect('Nenhum produto no carrinho!', 'carrinho.php');
}

$erro = false;

foreach ($resultado_lista as $linha) {
    $sql = "SELECT nome, quantidade FROM produtos WHERE cod_produto = $1;";
    $res = pg_query_params($conecta, $sql, [intval($linha['cod_produto'])]);
    $produto = pg_fetch_array($res);

    if ($linha['qtde'] > $produto['quantidade'] || $produto['quantidade'] <= 0) {
        $erro = true;
        $msg_erro = 'Não possuímos a quantidade desejada de ' . $produto['nome'] . ' em estoque! Máximo: ' . intval($produto['quantidade']) . ' unidades.';
    }
}

if ($erro) {
    pg_close($conecta);
    redirect($msg_erro, 'carrinho.php');
}

$sql = "INSERT INTO venda(cod_usuario, datahoravenda) VALUES($1, current_timestamp);";
$res = pg_query_params($conecta, $sql, [$cod_usuario]);

if (pg_affected_rows($res) == 0) {
    pg_close($conecta);
    redirect('Erro ao finalizar a compra!', 'carrinho.php');
}

$valortotal = 0.0;
foreach ($resultado_lista as $linha) {
    $preco = $linha['preco'];
    $qtde = intval($linha['qtde']);
    $cod_produto = intval($linha['cod_produto']);
    $valortotal += floatval($linha['subtotal']);

    $sql = "INSERT INTO itensvenda(cod_venda, cod_produto, qtde, valorunitario, valortotal)
            VALUES(currval('venda_cod_venda_seq'), $1, $2, $3, $4);";
    pg_query_params($conecta, $sql, [$cod_produto, $qtde, $preco, $valortotal]);

    $sql = "UPDATE produtos SET quantidade = quantidade - $1 WHERE cod_produto = $2;";
    pg_query_params($conecta, $sql, [$qtde, $cod_produto]);
}

$sql = "DELETE FROM carrinho WHERE cod_usuario = $1";
pg_query_params($conecta, $sql, [$cod_usuario]);

pg_close($conecta);
unset($_SESSION['produtos']);

include "header.php";
?>
    <div class="divmae">
        <div class="finalizacao-compra">
            <center>
                <h1>Compra finalizada com sucesso!</h1>
                <img src='../imagens/obg_pela_compra.png'>
            </center>
            <center>
                <a class="btn-confirma" href="selecao.php">Voltar</a>
            </center>
        </div>
    </div>
</body>
</html>
