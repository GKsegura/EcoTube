<!DOCTYPE html>
<html lang="pt-br">

<?php
    session_start();

    if (isset($_SESSION['usuariologado']))
    {  
        $acao = $_GET['acao'] ?? '';
        $cod_produto = $_GET['cod_produto'] ?? 0;
        $cod_usuario = $_SESSION['usuariologado']['cod_usuario'];

        if ($acao=='up') {
            if (is_array($_POST['prod']))
                $prods = $_POST['prod'];
            else
                $prods = array();
        }

        include "carrinho_back.php";
    }
    else{
        echo '<script language="javascript">';
        echo "alert('Você deve fazer para login continuar!')";
        echo '</script>';	
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../login/login_front.php'>";
    }   
?>

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
        <div class="titulo">
            <h2>Carrinho</h2>
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
                            <?php
                                
                                    if($linha['qtde']>1){
                                        echo "<a class='btn-mais-menos' href='?acao=del1&cod_produto=".$cod_prod."'>&nbsp;-&nbsp;</a>";
                                    }
                                    else
                                        echo "&nbsp;&nbsp;&nbsp;";
                                ?>
                            <?php echo $linha['qtde']; ?>
                            <?php
                                    if($linha['qtde'] < $linha['estoque']){
                                        echo "<a class='btn-mais-menos' href='?acao=add1&cod_produto=".$cod_prod."'>&nbsp;+&nbsp;</a>";
                                    }
                                ?>
                        </div>

                    </div>
                    <div class='car-preco'>
                        <div>
                            <?php echo "R$".$linha['preco']; ?>
                        </div>
                        <br>
                        <div>
                            <a class="btn-mais-menos"
                                href='?acao=del&cod_produto=<?php echo $cod_prod; ?>'>&nbsp;Excluir&nbsp;</a>
                        </div>
                    </div>
                </div>
                <div class="subtotal">
                    <?php echo "<h3 class='subtotal'>Subtotal: R$".number_format($linha['subtotal'], 2, ',', '.');"</h3><br>"; ?>
                </div>
                <?php
                }
                    echo "<h3>Total da compra: R$".number_format($total, 2, ',', '.');".</h3>";
                ?>
                <div class="botoes">
                    <a class="btn-confirma" href="selecao_produtos_front.php">Continuar Comprando</a>&nbsp;&nbsp;
                    <?php 
                        if($resultado_lista)
                            echo "<a class='btn-confirma' href='confirmacao_compra_front.php'>Finalizar Compra</a>";
                    ?>
                </div>
            </form>
        </div>
</body>

</html>