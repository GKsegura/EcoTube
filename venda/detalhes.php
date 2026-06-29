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
            <img src='<?php echo h($linha['campo_imagem']); ?>' class='img-detalhes' style="margin:16px 0;">
            <p style="margin:8px 0;"><strong>Descrição:</strong> <?php echo h($linha['descricao']); ?></p>
            <p style="margin:8px 0;"><strong>Estoque:</strong> <?php echo h($linha['quantidade']); ?> unidades</p>
            <p style="margin:8px 0 20px;"><strong>Preço:</strong> R$ <?php echo number_format($linha['preco'], 2, ',', '.'); ?></p>
            <center>
                <?php if ($linha['quantidade'] > 0): ?>
                    <a class='btn_exclui' href='carrinho.php?acao=add&cod_produto=<?php echo intval($linha['cod_produto']); ?>'>Comprar</a>
                <?php endif; ?>
                <a class="btn_exclui" href="selecao.php">Voltar</a>
            </center>
        </div>
    </div>
</body>
</html>
