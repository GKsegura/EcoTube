<?php
session_start();
include "../includes/helpers.php";

if (!isset($_SESSION['usuariologado'])) {
    redirect('Você deve fazer login para continuar!', '../login/login.php');
}

include "../includes/conexao.php";

$cod_usuario = intval($_SESSION['usuariologado']['cod_usuario']);
$acao = $_GET['acao'] ?? '';
$cod_produto = intval($_GET['cod_produto'] ?? 0);

if ($acao === 'up' && isset($_POST['prod']) && is_array($_POST['prod'])) {
    foreach ($_POST['prod'] as $cp => $qtd) {
        $sql = "UPDATE carrinho SET qtde = $1 WHERE cod_produto = $2 AND cod_usuario = $3";
        pg_query_params($conecta, $sql, [intval($qtd), intval($cp), $cod_usuario]);
    }
    pg_close($conecta);
    header("location:carrinho.php");
    exit;
}

if ($acao === 'add') {
    $sql = "SELECT qtde FROM carrinho WHERE cod_usuario = $1 AND cod_produto = $2";
    $res = pg_query_params($conecta, $sql, [$cod_usuario, $cod_produto]);
    if (pg_num_rows($res) == 0) {
        $sql = "INSERT INTO carrinho (cod_produto, cod_usuario, qtde) VALUES ($1, $2, 1)";
        pg_query_params($conecta, $sql, [$cod_produto, $cod_usuario]);
    } else {
        $sql = "UPDATE carrinho SET qtde = qtde + 1 WHERE cod_produto = $1 AND cod_usuario = $2";
        pg_query_params($conecta, $sql, [$cod_produto, $cod_usuario]);
    }
    pg_close($conecta);
    header("location:carrinho.php");
    exit;
}

if ($acao === 'del') {
    $sql = "DELETE FROM carrinho WHERE cod_produto = $1 AND cod_usuario = $2";
    pg_query_params($conecta, $sql, [$cod_produto, $cod_usuario]);
    pg_close($conecta);
    header("location:carrinho.php");
    exit;
}

if ($acao === 'add1') {
    $sql = "UPDATE carrinho SET qtde = qtde + 1 WHERE cod_produto = $1 AND cod_usuario = $2";
    pg_query_params($conecta, $sql, [$cod_produto, $cod_usuario]);
    pg_close($conecta);
    header("location:carrinho.php");
    exit;
}

if ($acao === 'del1') {
    $sql = "UPDATE carrinho SET qtde = qtde - 1 WHERE cod_produto = $1 AND cod_usuario = $2";
    pg_query_params($conecta, $sql, [$cod_produto, $cod_usuario]);
    pg_close($conecta);
    header("location:carrinho.php");
    exit;
}

$sql = "SELECT c.*, p.preco, c.qtde * p.preco as subtotal, p.nome, p.quantidade as estoque, p.campo_imagem
        FROM carrinho c
        INNER JOIN produtos p ON c.cod_produto = p.cod_produto
        WHERE c.cod_usuario = $1
        ORDER BY p.nome;";
$resultado = pg_query_params($conecta, $sql, [$cod_usuario]);
$qtde = pg_num_rows($resultado);
$resultado_lista = null;
if ($qtde > 0) {
    $resultado_lista = pg_fetch_all($resultado);
}
pg_close($conecta);

include "header.php";
?>
    <div class="divmae">
        <div class="titulo">
            <h2>Carrinho</h2>
        </div>
        <div class="carrinho">
            <form action="?acao=up" method="post">
                <?php
                $total = 0.0;
                if ($resultado_lista):
                    foreach ($resultado_lista as $linha):
                        $cod_prod = intval($linha['cod_produto']);
                        $total += floatval($linha['subtotal']);
                ?>
                <div class='carrinho-box'>
                    <div class="car-foto">
                        <img id='img-carrinho' src='<?php echo h($linha['campo_imagem']); ?>'>
                    </div>
                    <div class='car-info'>
                        <div><?php echo h($linha['nome']); ?></div>
                        <br>
                        <div class='car-quantidade'>
                            <label>Quantidade:</label>
                            <?php if ($linha['qtde'] > 1): ?>
                                <a class='btn-mais-menos' href='?acao=del1&cod_produto=<?php echo $cod_prod; ?>'>&nbsp;-&nbsp;</a>
                            <?php else: ?>
                                &nbsp;&nbsp;&nbsp;
                            <?php endif; ?>
                            <?php echo h($linha['qtde']); ?>
                            <?php if ($linha['qtde'] < $linha['estoque']): ?>
                                <a class='btn-mais-menos' href='?acao=add1&cod_produto=<?php echo $cod_prod; ?>'>&nbsp;+&nbsp;</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class='car-preco'>
                        <div>R$<?php echo h($linha['preco']); ?></div>
                        <br>
                        <div>
                            <a class="btn-mais-menos" href='?acao=del&cod_produto=<?php echo $cod_prod; ?>'>&nbsp;Excluir&nbsp;</a>
                        </div>
                    </div>
                </div>
                <div class="subtotal">
                    <h3 class='subtotal'>Subtotal: R$<?php echo number_format($linha['subtotal'], 2, ',', '.'); ?></h3><br>
                </div>
                <?php
                    endforeach;
                endif;
                ?>
                <h3>Total da compra: R$<?php echo number_format($total, 2, ',', '.'); ?></h3>

                <div class="botoes">
                    <a class="btn-confirma" href="selecao.php">Continuar Comprando</a>&nbsp;&nbsp;
                    <?php if ($resultado_lista): ?>
                        <a class='btn-confirma' href='confirmacao.php'>Finalizar Compra</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
