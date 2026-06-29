<?php
session_start();
include "../includes/conexao.php";
include "../includes/helpers.php";
requireAdmin();

$sql = "SELECT * FROM produtos WHERE excluido=false ORDER BY cod_produto;";
$resultado = pg_query($conecta, $sql);
$qtde = pg_num_rows($resultado);
$resultado_lista = null;
if ($qtde > 0) {
    $resultado_lista = pg_fetch_all($resultado);
}
pg_close($conecta);

include "header.php";
?>
    <div class="divmae">
        <?php if ($qtde == 0): ?>
            <div class='nao_encontrado'>
                Nenhum produto encontrado!<br><br>
                <a class='btn-confirma' href='produto_novo.php'>+ Novo Produto</a>
            </div>
        <?php else: ?>
        <div class='table'>
            <div class='btn-novo-cad'>
                <a href='produto_novo.php'>+ Novo Produto</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href='../venda/selecao.php'>Produtos</a>
            </div>
            <div class='row'>
                <div class='cell cod-produto cellCabeca'>Cód. Produto</div>
                <div class='cell nome cellCabeca'>Nome</div>
                <div class='cell descricao cellCabeca'>Descrição</div>
                <div class='cell preco cellCabeca'>Preço</div>
                <div class='cell quantidade cellCabeca'>Quantidade</div>
                <div class='cell cod-visual cellCabeca'>Cód. Visual</div>
                <div class='cell custo cellCabeca'>Custo</div>
                <div class='cell margem-lucro cellCabeca'>Margem de lucro</div>
                <div class='cell icms cellCabeca'>Icms</div>
                <div class='cell opcoes cellCabeca'>Alternativas</div>
            </div>
            <?php foreach ($resultado_lista as $linha): ?>
            <div class='row'>
                <div class='cell cod-produto'><?php echo h($linha['cod_produto']); ?></div>
                <div class='cell nome'><?php echo h($linha['nome']); ?></div>
                <div class='cell descricao'><?php echo h($linha['descricao']); ?></div>
                <div class='cell preco'><?php echo h($linha['preco']); ?></div>
                <div class='cell quantidade'><?php echo h($linha['quantidade']); ?></div>
                <div class='cell cod-visual'><?php echo h($linha['codigovisual']); ?></div>
                <div class='cell custo'><?php echo h($linha['custo']); ?></div>
                <div class='cell margem-lucro'><?php echo h($linha['margem_lucro']); ?></div>
                <div class='cell icms'><?php echo h($linha['icms']); ?></div>
                <div class='cell opcoes'>
                    <a href='produto_altera.php?cod_produto=<?php echo intval($linha['cod_produto']); ?>'>Alterar</a>&nbsp;
                    <a href='produto_exclui.php?cod_produto=<?php echo intval($linha['cod_produto']); ?>'>Excluir</a>&nbsp;
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
