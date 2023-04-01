<?php
    include "../utils/conexao.php"; 

    $compraFinalizada = FALSE;

    function validarProdutos($resultado_lista)
    {
        // ESSE CODIGO ESTÁ INCOMPLETO!!!

        // Realizar as validações com os produtos aqui
        foreach($resultado_lista as $linha)
        {
            //$sql = "SELECT QTDE FROM PROD.... ";
            // $res = pg_query($conecta,$sql);
            // if ///
            //   return false;
        }

        return true;
    }

    function atualizarEstoque($codproduto, $qtdeVendida)
    {
        $sql = "UPDATE produtos
                "
    }

    session_start();
    $resultado_lista = $_SESSION['produtos'];

    // (ainda precisa programar)
    validarProdutos($resultado_lista);

    $sql = "INSERT INTO venda (cod_venda, cod_usuario, datavenda, excluido) VALUES (DEFAULT, $codusuario, NOW(),'f');";
    $res = pg_query($conecta, $sql);
    $qtdLinhas = pg_affected_rows($res);

    if ($qtdLinhas == 0)
        echo "<h1>Erro ao Finalizar a Compra!!!</h1>";

    foreach($resultado_lista as $linha)
    { 
        $preco = $linha['preco'];
        $qtde = $linha['qtde'];
        $codproduto = $linha['cod_produto'];

        $sql = "INSERT INTO itemvenda (cod_venda, cod_produto, qtde, preco) VALUES (CURRVAL('venda_codvenda_seq'),".$codproduto.",".$qtde.",".$preco.");";
        $res = pg_query($conecta, $sql);

        // Atualizar qtde estoque 
        // (ainda precisa programar)
        atualizarEstoque($codproduto, $qtde);
    }  

    // Limpar carrinho
    $sql=" DELETE FROM carrinho
            where cod_usuario = $codusuario";

    pg_query($conecta,$sql);

    // Fecha a conexão com o PostgreSQL
    pg_close($conecta);


?>