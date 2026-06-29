<?php
session_start();
include "../includes/helpers.php";
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "../includes/conexao.php";

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $codigovisual = $_POST['codigovisual'];
    $custo = $_POST['custo'];
    $margem_lucro = $_POST['margem_lucro'];
    $icms = $_POST['icms'];
    $campo_imagem = $_FILES['campo_imagem'];
    $reto = isset($_POST['reto']) ? 'true' : 'false';
    $fino = isset($_POST['fino']) ? 'true' : 'false';
    $colorido = isset($_POST['colorido']) ? 'true' : 'false';

    $upload_dir = __DIR__ . '/../img_produto/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    move_uploaded_file($campo_imagem['tmp_name'], $upload_dir . $campo_imagem['name']);
    $imglink = '../img_produto/' . $campo_imagem['name'];

    $sql = "INSERT INTO produtos(cod_produto,nome,descricao,preco,quantidade,codigovisual,custo,margem_lucro,icms,campo_imagem,reto,fino,colorido)
          VALUES(DEFAULT,$1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12);";

    $resultado = pg_query_params($conecta, $sql, [$nome, $descricao, $preco, $quantidade, $codigovisual, $custo, $margem_lucro, $icms, $imglink, $reto, $fino, $colorido]);
    $linhas = pg_affected_rows($resultado);
    pg_close($conecta);

    if ($linhas > 0) {
        redirect('Produto salvo com sucesso!', 'produtos.php');
    } else {
        redirect('Erro na gravação do produto!', 'produto_novo.php');
    }
}

include "header.php";
?>
    <div class="divmae">
        <div class="produtos-box">
            <h2>Novo produto</h2>
            <form action="produto_novo.php" method="post" enctype="multipart/form-data">
                <div class="metade1">
                    <div class="user-box">
                        <input type="text" name="nome" required autocomplete="off">
                        <label>Nome*</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="descricao" required autocomplete="off">
                        <label>Descrição*</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="preco" required autocomplete="off">
                        <label>Preço*</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="quantidade" required autocomplete="off">
                        <label>Quantidade*</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="codigovisual" required autocomplete="off">
                        <label>Código visual*</label>
                    </div>
                </div>
                <div class="metade2">
                    <div class="user-box">
                        <input type="text" name="custo" required autocomplete="off">
                        <label>Custo*</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="margem_lucro" required autocomplete="off">
                        <label>Margem de lucro*</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="icms" required autocomplete="off">
                        <label>Icms*</label>
                    </div>
                    <div class="user-box">
                        <input type="file" name="campo_imagem" accept="image/*">
                        <label>Imagem*</label>
                    </div>
                    <div style="display:flex; gap:16px; margin-bottom:20px; color:#fff; font-size:14px;">
                        <label><input type="checkbox" name="reto" value="1"> Reto</label>
                        <label><input type="checkbox" name="fino" value="1"> Fino</label>
                        <label><input type="checkbox" name="colorido" value="1"> Colorido</label>
                    </div>
                    <center>
                        <input type="submit" value="Salva produto">
                        <br><br>
                        <a class="btn_exclui" href="produtos.php">Voltar</a>
                    </center>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
