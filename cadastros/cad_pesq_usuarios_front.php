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

        <?php
        include "cad_pesq_usuarios_back.php";

        if ($qtde == 0) {
            echo "<center>
                <div class='nao_encontrado'>
                    NENHUM USUÁRIO ENCONTRADO<br><br>
                    <a href='cad_novo_usuarios_front.php'>+ Novo Usuário</a>
                <center>";
            return;
        }
        echo "
        <div class='table'>
            <div class='btn-novo-cad'> 
                <a href='cad_novo_usuarios_front.php'>+ Novo Usuário</a>
            </div>
            <div class='row'>
                <div class='cell cod-produto cellCabeca'>
                    Cód. Usuário
                </div>
                <div class='cell nome cellCabeca'>
                    Nome
                </div>
                <div class='cell email cellCabeca'>
                    Email
                </div>
                <div class='cell quantidade cellCabeca'>
                    Telefone
                </div>
                <div class='cell quantidade cellCabeca'>
                    CPF
                </div>
                <div class='cell opcoes cellCabeca'>
                    Alternativas
                </div>
            </div>";

            include "../utils/conexao.php";
            
            foreach ($resultado_lista as $linha)
            {
                echo "
                <div class='row'>
                    <div class='cell cod-produto'>
                        ".$linha['cod_usuario']."
                    </div>
                    <div class='cell nome'>
                        ".$linha['nome']."
                    </div>
                    <div class='cell email'>
                        ".$linha['email']."
                    </div>
                    <div class='cell quantidade'>
                        ".$linha['telefone']."
                    </div>
                    <div class='cell quantidade'>
                        ".$linha['cpf']."
                    </div>
                    <div class='cell opcoes'>
                        <a href='cad_altera_usuarios_front.php?cod_usuario=".$linha['cod_usuario']."'> Alterar</a>&nbsp;
                        <a href='cad_exclui_usuarios_front.php?cod_usuario=".$linha['cod_usuario']."'> Excluir</a>&nbsp;
                    </div>
                </div> "; 
            } 
        echo "</div>";
    ?>
    </div>
</body>

</html>