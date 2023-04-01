<?php
    include "../utils/conexao.php"; 
    
    // Recuperação de dados
    $nome=$_POST['nome'];
    $descricao=$_POST['descricao'];
    $preco=$_POST['preco'];
    $quantidade=$_POST['quantidade'];
    $codigovisual=$_POST['codigovisual'];
    $custo=$_POST['custo'];
    $margem_lucro=$_POST['margem_lucro'];
    $icms=$_POST['icms'];
    $campo_imagem=$_FILES['campo_imagem'];

    move_uploaded_file($campo_imagem['tmp_name'],'/home/projetoscti/www/projetoscti26/img_produto/'.$campo_imagem['name']);
    $imglink = 'http://projetoscti.com.br/projetoscti26/img_produto/'.$campo_imagem['name'];

    $sql="INSERT INTO produtos(cod_produto,nome,descricao,preco,quantidade,codigovisual,custo,margem_lucro,icms,campo_imagem)
          VALUES(DEFAULT,'$nome','$descricao','$preco','$quantidade','$codigovisual','$custo','$margem_lucro','$icms','$imglink');";
    
    // Execução
    $resultado=pg_query($conecta,$sql);

    // recupera a quantidade de linhas 
    // NUM: SELECT
    $linhas=pg_affected_rows($resultado);

    if ($linhas > 0)
    {
        echo '<script language="javascript">';
        echo "alert('Produto salvo com sucesso!')";
        echo '</script>';	

        header("Location: cad_pesq_produtos_front.php");
    }   
    else
    {
        echo '<script language="javascript">';
        echo "alert('Erro na gravação do produto!')";
        echo '</script>';	
    }

    // Fecha a conexão com o PostgreSQL
    pg_close($conecta);
?>