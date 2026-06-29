<?php
session_start();
include "../includes/helpers.php";
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "../includes/conexao.php";

    $cod_produto = intval($_POST['cod_produto']);

    $timezone = new DateTimeZone('America/Sao_Paulo');
    $agora = new DateTime('now', $timezone);
    $data_exclusao = $agora->format('Y-m-d H:i:s');

    $sql = "UPDATE produtos SET excluido=true, data_exclusao=$1 WHERE cod_produto = $2";
    $resultado = pg_query_params($conecta, $sql, [$data_exclusao, $cod_produto]);
    $qtde = pg_affected_rows($resultado);
    pg_close($conecta);

    if ($qtde > 0)
        redirect('Excluído!', 'produtos.php');
    else
        redirect('Erro na exclusão!', 'produtos.php');
}

$cod_produto = intval($_GET["cod_produto"]);
include "../includes/conexao.php";

$sql = "SELECT * FROM produtos WHERE cod_produto = $1;";
$resultado = pg_query_params($conecta, $sql, [$cod_produto]);
$qtde = pg_num_rows($resultado);

if ($qtde == 0) {
    pg_close($conecta);
    redirect('Produto não encontrado!', 'produtos.php');
}

$linha = pg_fetch_array($resultado);
pg_close($conecta);

include "header.php";
?>
    <div class="divmae">
        <div class="produtos-box">
            <h2>Confirmação: Exclusão de Produtos</h2>
            <form action="produto_exclui.php" method="post">
                <div class="metade1">
                    <div class="user-box">
                        <input type="text" name="cod_produto" value="<?php echo h($linha['cod_produto']); ?>" readonly>
                        <label id="lbl_sem_animacao">Código de produto</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="nome" value="<?php echo h($linha['nome']); ?>" readonly>
                        <label id="lbl_sem_animacao">Nome</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="descricao" value="<?php echo h($linha['descricao']); ?>" readonly>
                        <label id="lbl_sem_animacao">Descrição</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="preco" value="<?php echo h($linha['preco']); ?>" readonly>
                        <label id="lbl_sem_animacao">Preço</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="quantidade" value="<?php echo h($linha['quantidade']); ?>" readonly>
                        <label id="lbl_sem_animacao">Quantidade</label>
                    </div>
                    <center>
                        <a class="btn_exclui" href="produtos.php">Voltar</a>
                    </center>
                </div>
                <div class="metade2">
                    <div class="user-box">
                        <input type="text" name="codigovisual" value="<?php echo h($linha['codigovisual']); ?>" readonly>
                        <label id="lbl_sem_animacao">Código visual</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="custo" value="<?php echo h($linha['custo']); ?>" readonly>
                        <label id="lbl_sem_animacao">Custo</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="margem_lucro" value="<?php echo h($linha['margem_lucro']); ?>" readonly>
                        <label id="lbl_sem_animacao">Margem de lucro</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="icms" value="<?php echo h($linha['icms']); ?>" readonly>
                        <label id="lbl_sem_animacao">Icms</label>
                    </div>
                    <center>
                        <input class="btn_exclui" type="button" value="Editar"
                            onclick="location.href='produto_altera.php?cod_produto=<?php echo intval($cod_produto); ?>';">
                        <input type="submit" value="Confirmar">
                    </center>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
