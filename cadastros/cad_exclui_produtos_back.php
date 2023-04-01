
<?php
    include "../utils/conexao.php"; 

    $cod_produto = $_POST['cod_produto'];
    
    $timezone = new DateTimeZone('America/Sao_Paulo');
	$agora = new DateTime('now', $timezone);
	$data_exclusao = $agora->format('Y-m-d H:i:s');

    $sql="UPDATE produtos SET excluido=true, data_exclusao='$data_exclusao' WHERE cod_produto = $cod_produto";

    $resultado=pg_query($conecta,$sql);
    $qtde=pg_affected_rows($resultado);

    if ($qtde > 0 )
        echo "<script type='text/javascript'>alert('Excluído!')</script>";
    else
        echo "<script type='text/javascript'>alert('Erro na exclusão!')</script>";

    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cad_pesq_produtos_front.php'>";
?>
