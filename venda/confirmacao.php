<?php
session_start();
include "../includes/conexao.php";
include "../includes/helpers.php";

if (!isset($_SESSION['usuariologado'])) {
    redirect('Você deve fazer login para continuar!', '../login/login.php');
}

$cod_usuario = intval($_SESSION['usuariologado']['cod_usuario']);

$sql = "SELECT c.*, p.preco, c.qtde * p.preco as subtotal, p.nome, p.campo_imagem, p.quantidade as estoque
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

$_SESSION['produtos'] = $resultado_lista;

include "header.php";
?>
    <div class="divmae">
        <div class="titulo">
            <h2>Resumo da compra</h2>
        </div>
        <div class="carrinho">
            <?php
            $total = 0.0;
            if ($resultado_lista):
                foreach ($resultado_lista as $linha):
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
                        <input type="text" name="qtde" value="<?php echo h($linha['qtde']); ?>" readonly>
                    </div>
                </div>
                <div class='car-preco'>
                    <div>R$ <?php echo h($linha['preco']); ?></div>
                    <br>
                    <div>Subtotal: R$ <?php echo h($linha['subtotal']); ?></div>
                </div>
            </div>
            <?php
                endforeach;
            endif;
            ?>
            <br><h3>Total: R$ <?php echo number_format($total, 2, ',', '.'); ?></h3>

            <br><br>
            <div class="botoes">
                <h3>Deseja confirmar?</h3>
                <br>
                <a class="btn-confirma" href="carrinho.php">Cancelar</a>
                <a class="btn-confirma" href="finalizacao.php">Finalizar</a>
            </div>
        </div>
    </div>
</body>
</html>
