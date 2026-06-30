<?php
session_start();
include "../includes/helpers.php";

if (isset($_SESSION['cadastrado']) && $_SESSION['cadastrado'] == true) {
    include "../includes/conexao.php";

    $email = $_SESSION['email'];
    $senha_hash = $_SESSION['senha_hash'];
    $_SESSION['cadastrado'] = false;
    $_SESSION['email'] = "";
    $_SESSION['senha_hash'] = "";

    $sql = "SELECT * FROM users WHERE email=$1 AND excluido=false;";
    $res = pg_query_params($conecta, $sql, [$email]);

    if (pg_num_rows($res) > 0) {
        $linha = pg_fetch_array($res);
        if ($linha['senha'] === $senha_hash) {
            $_SESSION["usuariologado"] = $linha;
            $_SESSION["isadm"] = $linha['administrador'];
            pg_close($conecta);
            redirect('Olá, ' . $linha['nome'] . '! Seja bem-vindo(a)!', '../index.php');
        }
    }
    pg_close($conecta);
    redirect('Erro ao fazer login automático!', 'login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "../includes/conexao.php";

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM users WHERE email=$1 AND excluido=false;";
    $res = pg_query_params($conecta, $sql, [$email]);

    if (pg_num_rows($res) > 0) {
        $linha = pg_fetch_array($res);

        if (password_verify($senha, $linha['senha'])) {
            $_SESSION["usuariologado"] = $linha;
            $_SESSION["isadm"] = $linha['administrador'];
            pg_close($conecta);
            redirect('Olá, ' . $linha['nome'] . '! Seja bem-vindo(a)!', '../index.php');
        }
    }

    pg_close($conecta);
    redirect('Usuário ou senha inválidos!', 'login.php');
}

if (isset($_SESSION['usuariologado'])) {
    redirect('Você já está logado!', '../index.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/cae157d5c6.js" crossorigin="anonymous"></script>
</head>

<body class="corpo">
    <?php include "../includes/theme_toggle.php"; ?>
    <header class="cabecalho">
        <div class="cableft">
            <a class="logo" href="../index.php"><img class="logo" src="../imagens/logo.svg" alt="logo"></a>
        </div>
        <div class="cabcenter">
            <a class="fixo" href="../index.php">Home</a>&nbsp;
            <?php
                if (isset($_SESSION['isadm']) && $_SESSION['isadm'] == 't'){
                    echo "<a class='fixo' href='../cadastros/produtos.php'>Tab. Produtos</a>&nbsp;";
                    echo "<a class='fixo' href='../cadastros/usuarios.php'>Tab. Usuários</a>&nbsp;";
                }
                else{
                    echo "<a class='fixo' href='../venda/selecao.php'>Produtos</a>&nbsp;";
                    echo "<a class='fixo' href='../devs.php'>Devs</a>&nbsp;";
                    echo "<a class='fixo' href='../estatisticas.php'>Estatísticas</a>&nbsp;";
                }
            ?>
        </div>
        <div class="cabright">
            <?php
                if (isset($_SESSION['usuariologado']))
                {
                    echo "<p class='usuario_cab'>Olá, " . h($_SESSION['usuariologado']['nome']) . "</p>";
                    echo "<a class='fixo' href='logoff_back.php' title='Sair'><i class='fa-solid fa-right-from-bracket'></i></a>";
                }
                else{
                    echo "<a class='fixo' href='login.php' title='Login'><i
                    class='fa-solid fa-user'></i></a>&nbsp;";
                }
            ?>
            <a class="fixo" href="../venda/carrinho.php" title="Carrinho" id="iconcarrinho"><i
                    class="fa-solid fa-cart-shopping"></i></a>&nbsp;
            <button class="theme-toggle" onclick="toggleTheme()" title="Alternar tema">
                <i class="fa-solid fa-moon icon-dark"></i>
                <i class="fa-solid fa-sun icon-light"></i>
            </button>
        </div>
    </header>
    <?php renderToast(); ?>
    <div class="divmae">
        <div class="box-login">
            <h2>Login</h2>
            <form action="login.php" method="post">
                <div class="user-box">
                    <input type="email" name="email" required autocomplete="off">
                    <label>E-mail</label>
                </div>
                <div class="user-box">
                    <input type="password" name="senha" required autocomplete="off" id="senha"> <a class="ver"
                        onclick="view_password()" id="eye_password"><i class="fa-regular fa-eye"></i></a>
                    <label>Senha*</label>
                </div>
                <div class="espacos">
                    <p>Não é cadastrado? <a class="btn-cadastro"
                            href="../cadastros/usuario_novo.php">Cadastre-se</a></p>
                </div>
                <center>
                    <input type="submit" value="Logar">
                </center>
            </form>
            <script>
            function view_password() {
                var s = document.getElementById('senha');
                s.type = s.type === 'password' ? 'text' : 'password';
                document.getElementById('eye_password').style.color = s.type === 'text' ? '#79d1c3' : '#fff';
            }
            </script>
        </div>
    </div>
</body>
</html>
