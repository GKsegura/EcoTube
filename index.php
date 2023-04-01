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
        <div class="slider">
            <div class="slides">
                <input type="radio" name="radio-btn" onclick="function1()" id="radio1">
                <input type="radio" name="radio-btn" onclick="function2()" id="radio2">
                <input type="radio" name="radio-btn" onclick="function3()" id="radio3">
                <input type="radio" name="radio-btn" onclick="function4()" id="radio4">
                <div class="slide first">
                    <img src="imagens/slider/pag1.jpg" alt="Imagem 1">
                </div>
                <div class="slide">
                    <img src="imagens/slider/pag2.png" alt="Imagem 2">
                </div>
                <div class="slide">
                    <img src="imagens/slider/pag3.png" alt="Imagem 3">
                </div>
                <div class="slide">
                    <img src="imagens/slider/pag4.png" alt="Imagem 4">
                </div>
                <div class="navigation-auto">
                    <div class="auto-btn1"></div>
                    <div class="auto-btn2"></div>
                    <div class="auto-btn3"></div>
                    <div class="auto-btn4"></div>
                </div>
            </div>
            <div class="manual-navigation">
                <label for="radio1" class="manual-btn"></label>
                <label for="radio2" class="manual-btn"></label>
                <label for="radio3" class="manual-btn"></label>
                <label for="radio4" class="manual-btn"></label>
            </div>
        </div>

        <script src="utils/script.js"></script>

        <div class="texto-grande">
            <p> A Ecotube é uma empresa de segmento de canudos de vidro. Com o objetivo de incentivar
                a utilização de produtos
                reutilizáveis e econômicos. Nascida de uma reinterpretação dos famosos canudos de metal, juntamente
                com
                a
                escova
                de higienização, assim são os produtos da Ecotube!
            </p>
        </div>

        <div class="grid">
            <div class="col1">
                <div id="img_grid">
                    <img src="imagens/grid/img1.png">
                </div>
                <div class="divtextgrid">
                    <p>Estimulando bons hábitos de ecologia!</p>
                </div>
            </div>

            <div class="col1">
                <div id="img_grid">
                    <img src="imagens/grid/img2.png">
                </div>
                <div class="divtextgrid">
                    <p>Fazendo a diferença para preservar o nosso planeta!</p>
                </div>
            </div>

            <div class="col1">
                <div id="img_grid1">
                    <img src="imagens/grid/img3.png">
                </div>
                <div class="divtextgrid">
                    <p>Reduzindo os gastos e poluição desnecessários!</p>
                </div>
            </div>

            <div class="col1">
                <div id="img_grid">
                    <img src="imagens/grid/img4.png">
                </div>
                <div class="divtextgrid">
                    <p>Ajudando a cuidar do planeta sem deixar o bom e velho canudo! </p>
                </div>
            </div>
        </div>

        <div class="divsprods">
            <div class="divprod">
                <img class="img-media" src="imagens/canudocurvo.jpg">
                <br><br>
                <div class="divtext">
                    <p>O canudo de vidro curvado é o ideal para tomar drinks, assim você se refresca e ajuda o meio
                        ambiente!
                    </p>
                </div><br>
                <a class="btn-comprar" href="./venda/selecao_produtos_front.php">Comprar</a>
            </div>
            <div class="divprod">
                <img class="img-media" src="imagens/canudoreto.jpg">
                <br><br>
                <div class="divtext">
                    <p>Leve seu canudo de vidro reto ao cinema, e tome seu refrigerante enquanto ajuda o planeta e se
                        diverte!
                    </p>
                </div><br>
                <a class="btn-comprar" href="./venda/selecao_produtos_front.php">Comprar</a>
            </div>
            <div class="divprod">
                <img class="img-media" src="imagens/kitcanudo.jpg">
                <br><br>
                <div class="divtext">
                    <p>Monte seu kit de canudos de vidro retos e curvos para a família toda, e para diversas bebidas.
                    </p>
                </div><br>
                <a class="btn-comprar" href="./venda/selecao_produtos_front.php">Comprar</a>
            </div>
        </div>

        <div class="local-video">
            <div class="video">
                <iframe width="900" height="500" src="https://www.youtube.com/embed/vVNGUAqTOgw"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
            <div class="local-videotxt">
                <div class="texto-video">
                    <p>Apresentamos no vídeo ao lado, uma ilustração e demonstração de nossos canudos. Ressaltando sua
                        importância e seus materiais!
                        <br><br>Procuramos melhorar a condição do nosso planeta e da experiência de beber líquidos com
                        qualidade
                        e
                        conforto sem preocupações!
                    </p>
                </div>
                <div class="imgs-video">
                    <img class="img-pequena" src="imagens/copinho.svg">
                    <img class="img-pequena" src="imagens/patinha.svg">
                    <img class="img-pequena" src="imagens/tartaruga_contornopreto.svg">
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