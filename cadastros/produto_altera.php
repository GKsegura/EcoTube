<?php
session_start();
include "../includes/helpers.php";
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "../includes/conexao.php";

    $cod_produto = intval($_POST["cod_produto"]);
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $codigovisual = $_POST['codigovisual'];
    $custo = $_POST['custo'];
    $margem_lucro = $_POST['margem_lucro'];
    $icms = $_POST['icms'];
    $campo_imagem = $_POST['campo_imagem'];

    $sql = "UPDATE produtos
            SET nome=$1, descricao=$2, preco=$3, quantidade=$4,
                codigovisual=$5, custo=$6, margem_lucro=$7, icms=$8, campo_imagem=$9
            WHERE cod_produto = $10;";

    $resultado = pg_query_params($conecta, $sql, [$nome, $descricao, $preco, $quantidade, $codigovisual, $custo, $margem_lucro, $icms, $campo_imagem, $cod_produto]);
    $qtde = pg_affected_rows($resultado);
    pg_close($conecta);

    if ($qtde > 0)
        redirect('Gravação OK!', 'produtos.php');
    else
        redirect('Erro na Gravação!', 'produtos.php');
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
            <h2>Alteração de Produtos</h2>
            <form action="produto_altera.php" method="post">
                <div class="metade1">
                    <div class="user-box">
                        <input type="text" name="cod_produto" value="<?php echo h($linha['cod_produto']); ?>" readonly>
                        <label id="lbl_sem_animacao">Código de produto</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="nome" value="<?php echo h($linha['nome']); ?>" required>
                        <label>Nome</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="descricao" value="<?php echo h($linha['descricao']); ?>" required>
                        <label>Descrição</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="preco" value="<?php echo h($linha['preco']); ?>" required>
                        <label>Preço</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="quantidade" value="<?php echo h($linha['quantidade']); ?>" required>
                        <label>Quantidade</label>
                    </div>
                    <center>
                        <a class="btn_exclui" href="produtos.php">Voltar</a>
                    </center>
                </div>
                <div class="metade2">
                    <div class="user-box">
                        <input type="text" name="codigovisual" value="<?php echo h($linha['codigovisual']); ?>" required>
                        <label>Código visual</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="custo" value="<?php echo h($linha['custo']); ?>" required>
                        <label>Custo</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="margem_lucro" value="<?php echo h($linha['margem_lucro']); ?>" required>
                        <label>Margem de lucro</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="icms" value="<?php echo h($linha['icms']); ?>" required>
                        <label>Icms</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="campo_imagem" value="<?php echo h($linha['campo_imagem']); ?>" required>
                        <label>Imagem</label>
                    </div>
                    <center>
                        <input type="submit" value="Salvar">
                    </center>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
