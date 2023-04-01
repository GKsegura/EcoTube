<?php
    // faz a conexão bonitona com o banco de dados
    include "../utils/conexao.php"; 

    // monta o script bonitão para consultar os dados
    $sql="SELECT * FROM users WHERE excluido=false ORDER BY cod_usuario;";

    // executa o script bonitão
    $resultado= pg_query($conecta, $sql);

    // recupera a quantidade de linhas 
    $qtde=pg_num_rows($resultado);

    $resultado_lista = null;

    // se existir linhas, carrego elas na variavel $resultado_lista
    if ($qtde > 0)
    {
        $resultado_lista=pg_fetch_all($resultado);
    }
 
    pg_close($conecta);
?>