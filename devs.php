<!DOCTYPE html>
<html lang="pt-br">

<?php
    session_start();
?>

<head>
    <meta charset="UTF-8">
    <title>EcoTube</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./imagens/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/cae157d5c6.js" crossorigin="anonymous"></script>
</head>

<body class="corpo">
    <header class="cabecalho">
        <div class="cableft">
            <a class="logo" href="index.php"><img class="logo" src="imagens/logo.svg" alt="logo"></a>
        </div>
        <div class="cabcenter">
            <a class="fixo" href="index.php">Home</a>&nbsp;
            <?php
                if (isset($_SESSION['isadm']) && $_SESSION['isadm'] == 't'){
                    echo "<a class='fixo' href='./cadastros/cad_pesq_produtos_front.php''>Tab. Produtos</a>&nbsp;";
                    echo "<a class='fixo' href='./cadastros/cad_pesq_usuarios_front.php''>Tab. Usuários</a>&nbsp;";
                }
                else{
                    echo "<a class='fixo' href='./venda/selecao_produtos_front.php'>Produtos</a>&nbsp;";
                    echo "<a class='fixo' href='devs.php'>Devs</a>&nbsp;";
                    echo "<a class='fixo' href='estatisticas.php'>Estatísticas</a>&nbsp;";
                }
            ?>
        </div>
        <div class="cabright">
            <?php 
                if (isset($_SESSION['usuariologado']))
                {
                    echo "<p class='usuario_cab'>Olá, ".$_SESSION['usuariologado']['nome']."</p>";
                    echo "<a class='fixo' href='./login/logoff_back.php' title='Sair'><i class='fa-solid fa-right-from-bracket'></i></a>";
                }
                else{
                    echo "<a class='fixo' href='./login/login_front.php' title='Login'><i
                    class='fa-solid fa-user'></i></a>&nbsp;";
                }
            ?>
            <a class="fixo" href="./venda/carrinho_front.php" title="Carrinho" id="iconcarrinho"><i
                    class="fa-solid fa-cart-shopping"></i></a>&nbsp;
        </div>
    </header>
    <div class="divmae">

        <div class="todos-devs">

            <div class="dev">
                <div>
                    <img class="foto-dev" src="./imagens/devs/andreia.jpg">
                </div>
                <div class="info-dev">
                    <p>02 - Andreia Ribeiro dos Santos</p>
                    <p>andreia.r.santos@unesp.br</p>
                </div>
            </div>

            <div class="dev">
                <div>
                    <img class="foto-dev" src="./imagens/devs/bianca.jpg">
                </div>
                <div class="info-dev">
                    <p>06 - Bianca Fayad Mainini</p>
                    <p>bianca.mainini@unesp.br</p>
                </div>
            </div>

            <div class="dev">
                <div>
                    <img class="foto-dev" src="./imagens/devs/gabi.jpg">
                </div>
                <div class="info-dev">
                    <p>16 - Gabriele de Lima</p>
                    <p>gabriele.lima@unesp.br</p>
                </div>
            </div>

            <div class="dev">
                <div>
                    <img class="foto-dev" src="./imagens/devs/jose.jpg">
                </div>
                <div class="info-dev">
                    <p>22 - José Antonio Segura Marques da Silva</p>
                    <p>jose.segura@unesp.br</p>
                </div>
            </div>

            <div class="dev">
                <div>
                    <img class="foto-dev" src="./imagens/devs/julia.jpg">
                </div>
                <div class="info-dev">
                    <p>23 - Julia Rodrigues Iozzi</p>
                    <p>julia.iozzi@unesp.br</p>
                </div>
            </div>
        </div>







        <footer>
            <div class="divfooter">
                <p><b>DESENVOLVEDORES</b></p><br>
                <p>N°02 - Andreia Ribeiro dos Santos</p>
                <p>N°06 - Bianca Fayad Mainini</p>
                <p>N°16 - Gabriele de Lima</p>
                <p>N°22 - José Antonio Segura Marques da Silva</p>
                <p>N°23 - Julia Rodrigues Iozzi</p>
            </div>
            <div class="divfooter">
                <p><b>PATROCÍNIOS</b></p><br><br>
                <a href=" https://www.canu.do" target="_blank">
                    <img class="footer-img"
                        src="https://images.tcdn.com.br/img/img_prod/754793/1641989868_canudo_logo_web.jpg">
                </a>
            </div>
            <div class="btn-footer">
                <a class="fixo" href="#" title="Voltar ao topo"><i class="fa-solid fa-arrow-up"></i></a>
            </div>
        </footer>
    </div>
</body>

</html>