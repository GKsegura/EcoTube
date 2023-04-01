<?php
    include "../utils/conexao.php";

    session_start();

    function validarProdutos($resultado_lista, $conecta)
    {
        foreach($resultado_lista as $linha)
        {
            $sql="SELECT nome, quantidade FROM produtos WHERE cod_produto = ".$linha['cod_produto'].";";

            $res=pg_query($conecta,$sql);

            $resulta=pg_fetch_array($res);

            if($linha['qtde'] > $resulta['quantidade'] || $resulta['quantidade'] <= 0){
                echo '<script type="text/javascript">';
                echo "alert('Não possuímos a quantidade desejada de ".$resulta['nome']." em estoque! A quandidade máxima é de ".$resulta['quantidade']." unidades. Retorne ao carrinho!')";
                echo '</script>';
                return FALSE;
            }
        }
        return TRUE;
    }

    function atualizarEstoque($conecta, $cod_produto, $qtde)
    {
        $sql="UPDATE produtos
                SET quantidade = quantidade - $qtde 
                WHERE cod_produto = $cod_produto;";

        $res=pg_query($conecta,$sql);
    }

    $resultado_lista = $_SESSION['produtos'];

    $sql = "INSERT INTO venda(cod_usuario, datahoravenda) VALUES($cod_usuario, current_timestamp);";

    $res=pg_query($conecta,$sql);
    $qtdeLinhas=pg_affected_rows($res);

    if($qtdeLinhas == 0)
        echo "<h1>Erro ao finalizar a compra!</h1>";

    $val = TRUE;

    foreach($resultado_lista as $linha)
    {
        $preco = $linha['preco'];
        $qtde = $linha['qtde'];
        $cod_produto = $linha['cod_produto'];
        $valortotal += floatval($linha['subtotal']);

        $sql="INSERT INTO itensvenda(cod_venda, cod_produto, qtde, valorunitario, valortotal)
                VALUES(currval('venda_cod_venda_seq'),$cod_produto,$qtde,$preco,$valortotal);";
        
        $res=pg_query($conecta, $sql);

        $val = $val && validarProdutos($resultado_lista, $conecta);
    }

    if(!$val)
    {
        echo "<center>";
        echo "<a class='btn-confirma' href='carrinho_front.php'>Voltar ao carrinho</a>";
        echo "</center>";
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=carrinho_front.php'>";
        exit;
    }
    else{
        foreach($resultado_lista as $linha)
        {
            $cod_produto = $linha['cod_produto'];
            $qtde = $linha['qtde'];
            atualizarEstoque($conecta, $cod_produto, $qtde);
        }

        $sql="DELETE FROM carrinho
                WHERE cod_usuario = $cod_usuario";
        
        pg_query($conecta, $sql);
        include "enviaking.php";
    }

    pg_close($conecta);
?>