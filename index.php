<!DOCTYPE html>
<html lang="pt-br">

<?php
    session_start();
    include "./includes/helpers.php";
?>

<head>
    <meta charset="UTF-8">
    <title>EcoTube</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./imagens/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/cae157d5c6.js" crossorigin="anonymous"></script>
</head>

<body class="corpo">
    <?php $base = ''; include "./includes/header.php"; ?>
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

        <?php include "./includes/footer.php"; ?>
    </div>
</body>

</html>