<?php
    include "../utils/conexao.php"; 

    $cod_produto=$_POST["cod_produto"];
    $nome=$_POST['nome'];
    $descricao=$_POST['descricao'];
    $preco=$_POST['preco'];
    $quantidade=$_POST['quantidade'];
    $codigovisual=$_POST['codigovisual'];
    $custo=$_POST['custo'];
    $margem_lucro=$_POST['margem_lucro'];
    $icms=$_POST['icms'];
    $campo_imagem=$_POST['campo_imagem'];
    
    $sql="UPDATE produtos 
            SET nome='$nome',
            descricao='$descricao',
            preco='$preco',
            quantidade='$quantidade',
            codigovisual='$codigovisual',
            custo='$custo',
            margem_lucro='$margem_lucro',
            icms='$icms',
            campo_imagem='$campo_imagem' 
    WHERE cod_produto = $cod_produto;";
    
    $resultado=pg_query($conecta,$sql);
    $qtde=pg_affected_rows($resultado);

    if ($qtde > 0)
        echo "<script type='text/javascript'>alert('Gravação OK!')</script>";
    else	
        echo "<script type='text/javascript'>alert('Erro na Gravação!')</script>";

    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cad_pesq_produtos_front.php'>";

    pg_close($conecta);
?>