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
                    echo "<a class='fixo' href='./cadastros/produtos.php'>Tab. Produtos</a>&nbsp;";
                    echo "<a class='fixo' href='./cadastros/usuarios.php'>Tab. Usuários</a>&nbsp;";
                }
                else{
                    echo "<a class='fixo' href='./venda/selecao.php'>Produtos</a>&nbsp;";
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
                    echo "<a class='fixo' href='./login/login.php' title='Login'><i
                    class='fa-solid fa-user'></i></a>&nbsp;";
                }
            ?>
            <a class="fixo" href="./venda/carrinho.php" title="Carrinho" id="iconcarrinho"><i
                    class="fa-solid fa-cart-shopping"></i></a>&nbsp;
        </div>
    </header>
    <div class="divmae">
        <section class="hero">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1>EcoTube</h1>
                <p>Canudos de vidro reutilizáveis para um planeta mais limpo.
                   Nascida de uma reinterpretação dos famosos canudos de metal,
                   a Ecotube une sustentabilidade, economia e qualidade.</p>
                <a class="hero-btn" href="./venda/selecao.php">Ver Produtos</a>
            </div>
        </section>

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
                <div class="divtext">
                    <p>O canudo de vidro curvado é o ideal para tomar drinks, assim você se refresca e ajuda o meio
                        ambiente!</p>
                </div>
                <a class="btn-comprar" href="./venda/selecao.php">Comprar</a>
            </div>
            <div class="divprod">
                <img class="img-media" src="imagens/canudoreto.jpg">
                <div class="divtext">
                    <p>Leve seu canudo de vidro reto ao cinema, e tome seu refrigerante enquanto ajuda o planeta e se
                        diverte!</p>
                </div>
                <a class="btn-comprar" href="./venda/selecao.php">Comprar</a>
            </div>
            <div class="divprod">
                <img class="img-media" src="imagens/kitcanudo.jpg">
                <div class="divtext">
                    <p>Monte seu kit de canudos de vidro retos e curvos para a família toda, e para diversas bebidas.</p>
                </div>
                <a class="btn-comprar" href="./venda/selecao.php">Comprar</a>
            </div>
        </div>

        <div class="local-video">
            <div class="video">
                <div class="video-wrapper">
                    <iframe src="https://www.youtube.com/embed/vVNGUAqTOgw"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
            <div class="local-videotxt">
                <div class="texto-video">
                    <p>Apresentamos no vídeo ao lado, uma ilustração e demonstração de nossos canudos. Ressaltando sua
                        importância e seus materiais!
                        <br>Procuramos melhorar a condição do nosso planeta e da experiência de beber líquidos com
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
                <p><b>DESENVOLVEDORES</b></p>
                <p>N°02 - Andreia Ribeiro dos Santos</p>
                <p>N°06 - Bianca Fayad Mainini</p>
                <p>N°16 - Gabriele de Lima</p>
                <p>N°22 - José Antonio Segura Marques da Silva</p>
                <p>N°23 - Julia Rodrigues Iozzi</p>
            </div>
            <div class="divfooter">
                <p><b>PATROCÍNIOS</b></p>
                <a href="https://www.canu.do" target="_blank">
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