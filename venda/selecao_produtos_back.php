<?php
    include "../utils/conexao.php"; 

    $final=$_GET['tipo'];

    // var_dump($final);

    $sql="SELECT * FROM produtos WHERE excluido=false ORDER BY nome;";
        
    $resultado= pg_query($conecta, $sql);
    $qtde=pg_num_rows($resultado);

    $resultado_lista = null;

    if ($qtde > 0)
    {
        $resultado_lista=pg_fetch_all($resultado);
    }
 
    pg_close($conecta);
?>