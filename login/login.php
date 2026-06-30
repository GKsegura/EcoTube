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
    <?php $base = '../'; include "../includes/header.php"; ?>
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
