<?php
session_start();
include "../includes/conexao.php";
include "../includes/helpers.php";

$cod_produto = intval($_GET["id"]);
$sql = "SELECT * FROM produtos WHERE cod_produto = $1;";
$resultado = pg_query_params($conecta, $sql, [$cod_produto]);

if (pg_num_rows($resultado) == 0) {
    pg_close($conecta);
    redirect('Produto não encontrado!', 'selecao.php');
}

$linha = pg_fetch_array($resultado);
pg_close($conecta);

include "header.php";
?>
    <div class="divmae">
        <div class="selecao-box">
            <h1><?php echo h($linha['nome']); ?></h1>
            <br>
            <img src='<?php echo h($linha['campo_imagem']); ?>' class='img-detalhes'>
            <br><br>
            Descrição: <?php echo h($linha['descricao']); ?>
            <br><br>
            Quantidade em estoque: <?php echo h($linha['quantidade']); ?>
            <br><br>
            Preço: R$ <?php echo number_format($linha['preco'], 2, ',', '.'); ?>
            <br><br>
            <center>
                <?php if ($linha['quantidade'] > 0): ?>
                    <a class='btn_exclui' href='carrinho.php?acao=add&cod_produto=<?php echo intval($linha['cod_produto']); ?>'>Comprar</a>&nbsp;&nbsp;
                <?php endif; ?>
                <a class="btn_exclui" href="selecao.php">Voltar</a>
            </center>
        </div>
    </div>
</body>
</html>
