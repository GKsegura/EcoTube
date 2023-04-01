<?php
    include "../utils/conexao.php"; 

    // Verifica se o produto já está no carrinho
    function getQtdeProdutoCarrinho($conecta, $cod_usuario, $cod_produto) {

        /* seleciona o carrinho */
        $sql="SELECT qtde FROM carrinho WHERE cod_usuario = $cod_usuario AND cod_produto = $cod_produto";

        $resultado=pg_query($conecta,$sql);
        $qtde=pg_num_rows($resultado);

        if ( $qtde == 0 )
            return 0;
        
        // retornará a quantidade atual do item já existente no carrinho
        $produto_carrinho = pg_fetch_array($resultado);
        return intval($produto_carrinho['qtde']);
    }

    function addCarrinho($conecta, $cod_usuario, $cod_produto) {

        $qtdeProduto = getQtdeProdutoCarrinho($conecta, $cod_usuario, $cod_produto);

        // Se o produto ainda não existe no carrinho
        if ($qtdeProduto == 0) {
            // Insere o produto
            $sql="INSERT INTO carrinho 
                (cod_produto, cod_usuario, qtde)   VALUES 
                ($cod_produto, $cod_usuario, 1);";
        }
        else {
            $sql="UPDATE carrinho
                     set qtde = ".($qtdeProduto + 1).
                  "where cod_produto = $cod_produto
                     and cod_usuario = $cod_usuario";
        }

        // Execução
        pg_query($conecta,$sql);
    }

    function removeCarrinho($conecta, $cod_usuario, $cod_produto) {
        $sql="DELETE FROM carrinho
               where cod_produto = $cod_produto
                 and cod_usuario = $cod_usuario";

        // Execução
        pg_query($conecta,$sql);
    }

    function updateCarrinho($conecta, $cod_usuario, $prods) {

        //var_dump($prods);

        foreach($prods as $cod_produto => $qtd){
            $sql="UPDATE carrinho
                    set qtde = $qtd
                where cod_produto = $cod_produto
                    and cod_usuario = $cod_usuario";
            
            pg_query($conecta,$sql);
        }
    }
    

    // Início do processamento

    if (!empty($acao))
    {
        if ($acao == 'add') {
            addCarrinho($conecta, $cod_usuario, $cod_produto);
        }
        else if($acao == 'del'){
            removeCarrinho($conecta, $cod_usuario, $cod_produto);
        }
        else if($acao == 'up'){
            updateCarrinho($conecta, $cod_usuario, $prods);
        }

        // Modifica a url para remover qualquer uma das ações: add, del ou up, evita que a ação seja
        // processada novamente caso a página seja recarregada
        header("location:carrinho_front.php");
        return;
    }

    /* seleciona todos os itens do carrinho do usuário */
        $sql="SELECT c.*,
                    p.preco,
                    c.qtde * p.preco as subtotal,
                    p.nome,
                    p.quantidade as estoque
                FROM carrinho c
            inner join produtos p
                on c.cod_produto = p.cod_produto
            WHERE c.cod_usuario = $cod_usuario
            ORDER BY p.nome;";

    $resultado= pg_query($conecta, $sql);
    $qtde=pg_num_rows($resultado);

    $resultado_lista = null;

    if ($qtde > 0)
    {
        $resultado_lista=pg_fetch_all($resultado);
    }

    // Fecha a conexão com o PostgreSQL
    pg_close($conecta);
?>