<?php
    include "../utils/conexao.php"; 

    $sql="SELECT * FROM users WHERE cod_usuario = $cod_usuario;";

    $resultado=pg_query($conecta,$sql);
    $qtde=pg_num_rows($resultado);

    if ( $qtde == 0 )
    {
        echo '<script language="javascript">';
        echo "alert('Usuários não encontrado!')";
        echo '</script>';	
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cad_pesq_usuarios_front.php'>";
        exit;
    }

    $linha = pg_fetch_array($resultado);

    pg_close($conecta);
?>