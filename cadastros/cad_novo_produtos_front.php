<!DOCTYPE html>
<html lang="pt-br">

<?php session_start(); ?>

<head>
    <meta charset="utf-8" />
    <title>Formulário de Cadastro de Produtos - Tabela Produtos CRUD</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/cae157d5c6.js" crossorigin="anonymous"></script>
</head>

<body class="corpo">
    <header class="cabecalho">
        <div class="cableft">
            <a class="logo" href="../index.php"><img class="logo" src="../imagens/logo.svg" alt="logo"></a>
        </div>
        <div class="cabcenter">
            <a class="fixo" href="../index.php">Home</a>&nbsp;
            <?php
                if (isset($_SESSION['isadm']) && $_SESSION['isadm'] == 't'){
                    echo "<a class='fixo' href='cad_pesq_produtos_front.php''>Tab. Produtos</a>&nbsp;";
                    echo "<a class='fixo' href='cad_pesq_usuarios_front.php''>Tab. Usuários</a>&nbsp;";
                }
                else{
                    echo "<a class='fixo' href='../venda/selecao_produtos_front.php'>Produtos</a>&nbsp;";
                    echo "<a class='fixo' href='../devs.php'>Devs</a>&nbsp;";
                    echo "<a class='fixo' href='../estatisticas.php'>Estatísticas</a>&nbsp;";
                }
            ?>
        </div>
        <div class="cabright">
            <?php 
                if (isset($_SESSION['usuariologado']))
                {
                    echo "<p class='usuario_cab'>Olá, ".$_SESSION['usuariologado']['nome']."</p>";
                    echo "<a class='fixo' href='../login/logoff_back.php' title='Sair'><i class='fa-solid fa-right-from-bracket'></i></a>";
                }
                else{
                    echo "<a class='fixo' href='../login/login_front.php' title='Login'><i
                    class='fa-solid fa-user'></i></a>&nbsp;";
                }
            ?>
            <a class="fixo" href="../venda/carrinho_front.php" title="Carrinho" id="iconcarrinho"><i
                    class="fa-solid fa-cart-shopping"></i></a>&nbsp;
        </div>
    </header>
    <div class="divmae">
        <div class="produtos-box">
            <h2>Novo produto</h2>
            <form action="cad_novo_produtos_back.php" method="post" enctype="multipart/form-data">
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
                    <center>
                        <input type="submit" value="Salva produto">
                        <br><br>
                        <a class="btn_exclui" href="cad_pesq_produtos_front.php">Voltar</a>
                    </center>
                </div>
            </form>
        </div>
    </div>
</body>

</html>