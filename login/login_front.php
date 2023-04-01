<!DOCTYPE html>
<html lang="pt-br">

<?php 
    session_start(); 

    if (isset($_SESSION['usuariologado'])){
        echo '<script language="javascript">';
        echo "alert('Você já está logado!')";
        echo '</script>';	

        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../index.php'>";
    }
?>

<head>
    <meta charset="UTF-8" />
    <title>Login</title>
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
                    echo "<a class='fixo' href='logoff_back.php' title='Sair'><i class='fa-solid fa-right-from-bracket'></i></a>";
                }
                else{
                    echo "<a class='fixo' href='login_front.php' title='Login'><i
                    class='fa-solid fa-user'></i></a>&nbsp;";
                }
            ?>
            <a class="fixo" href="../venda/carrinho_front.php" title="Carrinho" id="iconcarrinho"><i
                    class="fa-solid fa-cart-shopping"></i></a>&nbsp;
        </div>
    </header>
    <div class="divmae">
        <div class="box-login">
            <h2>Login</h2>
            <form action="login_back.php" method="post">
                <div class="user-box">
                    <input type="email" name="email" required autocomplete="off">
                    <label>E-mail</label>
                </div>
                <!-- <div class="user-box">
                    <input type="password" name="senha" required autocomplete="off">
                    <label>Senha</label>
                </div> -->
                <div class="user-box">
                    <input type="password" name="senha" required autocomplete="off" id="senha"> <a class="ver"
                        onclick="view_password()" id="eye_password"><i class="fa-regular fa-eye"></i></a>
                    <label>Senha*</label>
                </div>
                <div class="espacos">
                    <p>Não é cadastrado? <a class="btn-cadastro"
                            href="../cadastros/cad_novo_usuarios_front.php">Cadastre-se</a></p>
                </div>
                <center>
                    <input type="submit" value="Logar">
                </center>
                <script src="../utils/forms.js"></script>
            </form>
        </div>
    </div>
</body>

</html>