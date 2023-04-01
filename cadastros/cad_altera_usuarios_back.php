<?php
    include "../utils/conexao.php"; 

    $cod_usuario=$_POST["cod_usuario"];
    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $telefone=$_POST['telefone'];
    $cpf=$_POST['cpf'];
        
    $sql="UPDATE users 
            SET nome='$nome',
            email='$email',
            telefone='$telefone',
            cpf='$cpf'
    WHERE cod_usuario = $cod_usuario;";
    
    $resultado=pg_query($conecta,$sql);
    $qtde=pg_affected_rows($resultado);

    if ($qtde > 0)
        echo "<script type='text/javascript'>alert('Gravação OK!')</script>";
    else	
        echo "<script type='text/javascript'>alert('Erro na Gravação!')</script>";

    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cad_pesq_usuarios_front.php'>";

    pg_close($conecta);
?>