<?php
    include "../utils/conexao.php";
    session_start();


    // Recuperação de dados
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];

    $sql = "SELECT COUNT(*) FROM users WHERE cpf='$cpf' and excluido=false";
    $row = pg_fetch_row(pg_query($conecta,$sql));

    if($row[0]==1)
    {
        $_SESSION['cpf'] = true;
        header("Location: cad_novo_usuarios_front.php");
        exit;
    }

    $senha = md5($senha);

    // Inserção
    $sql = "INSERT INTO users(cod_usuario,nome,email,senha,telefone,cpf)
                VALUES(DEFAULT,'$nome','$email','$senha','$telefone','$cpf');";

    // Execução
    pg_send_query($conecta, $sql);    

    $resultado = pg_get_result($conecta);
    
    $linhas = pg_affected_rows($resultado);

    if ($linhas == 0)
    {
        echo '<script language="javascript">';
        echo "alert('Erro na gravação do usuário!')"; 
        echo '</script>';
    }
    else 
    {
        echo '<script language="javascript">';
        echo "alert('Usuário salvo com sucesso!')";
        echo '</script>';

        if (isset($_SESSION['usuariologado']))
        {  
            header("Location: ../index.php");
        }
        else{
            $_SESSION['email']=$email;
            $_SESSION['senha']=$senha;
            $_SESSION['cadastrado']=true;
            header("Location: ../login/login_back.php");
        }
    }
    
    // Fecha a conexão com o PostgreSQL
    pg_close($conecta);
?>