<!DOCTYPE html>
<html lang="pt-br">

<?php session_start(); ?>

<head>
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
        <?php
            session_start();
            $cod_usuario = $_SESSION['usuariologado']['cod_usuario'];
            include "confirmacao_compra_back.php";
        ?>

        <div class="titulo">
            <h2>Resumo da compra</h2>
        </div>

        <div class="carrinho">
            <form action="?acao=up" method="post">
                <?php
                $total = 0.0;

                // Criar linhas com os dados dos produtos
                if($resultado_lista)
                foreach ($resultado_lista as $linha)
                { 
                    $cod_prod = $linha['cod_produto'];
                    $total += floatval($linha['subtotal']);
            ?>
                <div class='carrinho-box'>
                    <div class="car-foto">
                        <?php echo "<img id='img-carrinho' src=".$linha['campo_imagem'].">"; ?>
                    </div>
                    <div class='car-info'>
                        <div>
                            <?php echo $linha['nome']; ?>
                        </div>
                        <br>
                        <div class='car-quantidade'>
                            <label>Quantidade:</label>
                            <input type="text" name="qtde" value="<?php echo $linha['qtde']; ?>" readonly>
                        </div>
                    </div>
                    <div class='car-preco'>
                        <div>
                            <?php echo "R$ ".$linha['preco']; ?>
                        </div>
                        <br>
                        <div>
                            <?php echo "Subtotal: R$ ".$linha['subtotal']; ?>
                        </div>
                    </div>
                </div>
                <?php 
                }  
                echo "<br><h3>Total: R$ ".number_format($total, 2, ',', '.');".</h3>";
            ?>

                <br><br>
                <div class="botoes">
                    <h3>Deseja confirmar?</h3>
                    <br>
                    <a class="btn-confirma" href="carrinho_front.php">Cancelar</a>
                    <a class="btn-confirma" href="finalizacao_compra_front.php">Finalizar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>