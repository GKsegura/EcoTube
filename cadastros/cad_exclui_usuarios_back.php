<?php
    include "../utils/conexao.php"; 

    //dados enviados do script exclui_prod_chamada_confirma_exclusao_logica.php
    $cod_usuario = $_POST['cod_usuario'];

    //inserida a data de exclusao do produto para histórico
    
    //exclusão lógica
    $sql="UPDATE users SET excluido=true WHERE cod_usuario = $cod_usuario";
    
    //exclusão física
    // $sql="DELETE FROM users WHERE cod_usuario = $cod_usuario";

    $resultado=pg_query($conecta,$sql);
    $qtde=pg_affected_rows($resultado);

    if ($qtde > 0 )
        echo "<script type='text/javascript'>alert('Excluído!')</script>";
    else
        echo "<script type='text/javascript'>alert('Erro na exclusão!')</script>";

    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cad_pesq_usuarios_front.php'>";
?>