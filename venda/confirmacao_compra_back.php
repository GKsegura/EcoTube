<?php
    include "../utils/conexao.php"; 

    /* seleciona todos os itens do carrinho do usuário */
    $sql="SELECT c.*,
        p.preco,
        c.qtde * p.preco as subtotal,
        p.nome,
        p.campo_imagem,
        p.quantidade as estoque
        FROM carrinho c
        inner join produtos p
        on c.cod_produto = p.cod_produto
        WHERE c.cod_usuario = $cod_usuario
        ORDER BY p.nome;";

    $resultado=pg_query($conecta, $sql);
    $qtde=pg_num_rows($resultado);

    $resultado_lista = null;

    if ($qtde > 0)
    {
        $resultado_lista=pg_fetch_all($resultado);
    }

    // Fecha a conexão com o PostgreSQL
    pg_close($conecta);

    session_start();
    $_SESSION['produtos'] = $resultado_lista;
?>