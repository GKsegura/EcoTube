<?php
    session_start();
    // script foi chamado de index.php
    include "../utils/conexao.php"; 

    if($_SESSION['cadastrado']==true)
    {
        $email = $_SESSION['email'];
        $senha = $_SESSION['senha'];
        $_SESSION['cadastrado']=false;
        $_SESSION['email'] = "";
        $_SESSION['senha'] = "";
    }
    else{
        $email = $_POST["email"];
        $senha = MD5($_POST["senha"]);
    }

    $sql = "SELECT * FROM users WHERE email='$email' and senha='$senha';";

    $res = pg_query($conecta, $sql);
    if (pg_num_rows($res) > 0)
    {
        $linha = pg_fetch_array($res);

        $_SESSION["usuariologado"] = $linha;
        $_SESSION["isadm"] = $linha['administrador'];

        echo '<script language="javascript">';
        echo "alert('Olá, ".$linha['nome']."! Seja bem-vindo(a)!')";
        echo '</script>';	

        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../index.php'>";
    }
    else
    {
        echo '<script language="javascript">';
        echo "alert('Usuário ou senha inválidos!')";
        echo '</script>';	
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=login_front.php'>";
    }
?>