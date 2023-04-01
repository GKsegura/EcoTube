<!DOCTYPE html>
<html lang="pt-br">

<?php session_start(); ?>

<head>
    <meta charset="utf-8" />
    <meta charset="UTF-8">
    <title>EcoTube</title>
    <link rel="stylesheet" href="../css/tabela.css">
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
                    echo "<a class='fixo' href='../cadastros/cad_pesq_produtos_front.php''>Tab. Produtos</a>&nbsp;";
                    echo "<a class='fixo' href='../cadastros/cad_pesq_usuarios_front.php''>Tab. Usuários</a>&nbsp;";
                }
                else{
                    echo "<a class='fixo' href='selecao_produtos_front.php'>Produtos</a>&nbsp;";
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
            <a class="fixo" href="carrinho_front.php" title="Carrinho" id="iconcarrinho"><i
                    class="fa-solid fa-cart-shopping"></i></a>&nbsp;
        </div>
    </header>
    <div class="divmae">
        <div class="selecao-box">
            <?php
                $cod_produto = $_GET["id"];
                include "../cadastros/cad_getinfo_produto_back.php"; 
            ?>

            <h1><?php echo $linha['nome']; ?></h1>
            <br>
            <?php echo "<img src=".$linha['campo_imagem']." class='img-detalhes'>"; ?>
            <br><br>
            <!-- Código do produto: <?php echo $linha['cod_produto']; ?>
            <br><br> -->
            Descrição: <?php echo $linha['descricao']; ?>
            <br><br>
            Quantidade em estoque: <?php echo $linha['quantidade']; ?>
            <br><br>
            Preço: R$ <?php echo number_format($linha['preco'], 2, ',', '.'); ?>
            <br><br>
            <center>
                <?php
                if ($linha['quantidade']>0){
                    echo "<a class='btn_exclui' href='carrinho_front.php?acao=add&cod_produto=".$linha['cod_produto']."'>Comprar</a>&nbsp;&nbsp;";
                }
                ?>
                <a class="btn_exclui" href="selecao_produtos_front.php">Voltar</a>
            </center>
        </div>
    </div>

</body>

</html>