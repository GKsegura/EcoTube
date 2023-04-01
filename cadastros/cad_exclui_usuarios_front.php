<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>EcoTube</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/cae157d5c6.js" crossorigin="anonymous"></script>
</head>

<body class="corpo">
    <?php
              $cod_usuario = $_GET["cod_usuario"];
              include "cad_getinfo_usuarios_back.php"; 
              session_start();
       ?>
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
        <div class="login-box">
            <h2>Exclusão de Usuários</h2>
            <form action="cad_exclui_usuarios_back.php" method="post">
                <div class="user-box">
                    <input type="text" name="cod_usuario" value="<?php echo $linha['cod_usuario']; ?>" readonly>
                    <label id="lbl_sem_animacao">Código de usuário</label>
                </div>
                <div class="user-box">
                    <input type="text" name="nome" value="<?php echo $linha['nome']; ?>" readonly>
                    <label id="lbl_sem_animacao">Nome</label>
                </div>
                <div class="user-box">
                    <input type="text" name="email" value="<?php echo $linha['email']; ?>" readonly>
                    <label id="lbl_sem_animacao">E-mail</label>
                </div>
                <div class="user-box">
                    <input type="text" name="telefone" value="<?php echo $linha['telefone']; ?>" readonly>
                    <label id="lbl_sem_animacao">Telefone</label>
                </div>
                <div class="user-box">
                    <input type="text" name="cpf" value="<?php echo $linha['cpf']; ?>" readonly>
                    <label id="lbl_sem_animacao">CPF</label>
                </div>
                <center>
                    <input type="submit" value="Confirmar">
                    <input class="btn_exclui" type="button" value="Editar"
                        onclick="location.href='cad_altera_usuarios_front.php?cod_usuario=<?php echo $cod_usuario ?>';">
                </center>
            </form>
        </div>
    </div>
</body>

</html>