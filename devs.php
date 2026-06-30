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




        <?php include "./includes/footer.php"; ?>
    </div>
</body>

</html>