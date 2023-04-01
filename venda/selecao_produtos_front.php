<!DOCTYPE html>
<html lang="pt-br">

<?php session_start(); ?>

<head>
    <meta charset="UTF-8">
    <title>EcoTube</title>
    <link rel="stylesheet" href="../css/tabela.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/cae157d5c6.js" crossorigin="anonymous"></script>
</head>

<body class="corpo">
    <header class="cabecalho">
        <div class="cableft">
            <a class="logo" href="../index.php"><img class="logo" src="../imagens/logo.svg" alt="logo"></a>
        </div>
        <div class="cabcenter">
            <a class="fixo" href="../index.php">Home</a>&nbsp;
            <?php
                if (isset($_SESSION['isadm']) && $_SESSION['isadm'] == 't'){
                    echo "<a class='fixo' href='../cadastros/cad_pesq_produtos_front.php''>Tab. Produtos</a>&nbsp;";
                    echo "<a class='fixo' href='../cadastros/cad_pesq_usuarios_front.php''>Tab. Usuários</a>&nbsp;";
                }
                else{
                    echo "<a class='fixo' href='selecao_produtos_front.php'>Produtos</a>&nbsp;";
                    echo "<a class='fixo' href='../devs.php'>Devs</a>&nbsp;";
                    echo "<a class='fixo' href='../estatisticas.php'>Estatísticas</a>&nbsp;";
                }
            ?>
        </div>
        <div class="cabright">
            <?php 
                if (isset($_SESSION['usuariologado']))
                {
                    echo "<p class='usuario_cab'>Olá, ".$_SESSION['usuariologado']['nome']."</p>";
                    echo "<a class='fixo' href='../login/logoff_back.php' title='Sair'><i class='fa-solid fa-right-from-bracket'></i></a>";
                }
                else{
                    echo "<a class='fixo' href='../login/login_front.php' title='Login'><i
                    class='fa-solid fa-user'></i></a>&nbsp;";
                }
            ?>
            <a class="fixo" href="carrinho_front.php" title="Carrinho" id="iconcarrinho"><i
                    class="fa-solid fa-cart-shopping"></i></a>&nbsp;
        </div>
    </header>

    <div class="divmae">

        <?php 
            include "selecao_produtos_back.php";

            echo "<script src='../utils/script.js'></script>";
            
            echo "<div class='pesquisa'>
                    <div class='input'>
                        <label for='tipo'>Tipo de canudos:&nbsp;</label>
                        <select id='tipo' onchange='opt()' name='tipo'>";
            echo "          <option value='todos'";if($final=='todos'){echo "selected";}echo">Todos</option>";
            echo "          <option value='colorido=false'";if($final=='colorido=false'){echo "selected";}echo">Incolor</option>";
            echo "          <option value='colorido=true'";if($final=='colorido=true'){echo "selected";}echo">Colorido</option>";
            echo "          <option value='reto=true'";if($final=='reto=true'){echo "selected";}echo">Reto</option>";
            echo "          <option value='reto=false'";if($final=='reto=false'){echo "selected";}echo">Curvo</option>";
            echo "          <option value='fino=true'";if($final=='fino=true'){echo "selected";}echo">Fino</option>";
            echo "          <option value='fino=false'";if($final=='fino=false'){echo "selected";}echo">Grosso</option>";
            echo "      </select>
                    </div>
                </div>";
                
            if ($qtde == 0) {
                echo "<div class='titulo'><h2>Nenhum produto em estoque</h2></div>";
                return;
            }

            echo "<div class='box'>";

            // Criar linhas com os dados dos produtos
            foreach ($resultado_lista as $linha)
            {
                if($final=='colorido=false' && $linha['colorido']=='f'){
                        $preco= number_format($linha['preco'], 2, ',', '.');

                        echo "
                        <div class='prod-box'>
                                <div>
                                    <br>
                                    <div class='selecaoprod'><p>".$linha['nome']."</p></div>
                                    <div>
                                    <br>
                                    <a href='selecao_detalhes_front.php?id=".$linha['cod_produto']."'> 
                                    <img src=".$linha['campo_imagem']." class='img-selecao'/>
                                    </a>
                                </div>
                                    <div class='selecaoprod'>R$ ".$preco."</div>";

                                    if ($linha['quantidade']<=0)
                                    {
                                        echo "
                                        <div><span>Produto esgotado</span></div>";
                                    }
                                    else
                                    {
                                        echo "
                                        <div class='selecaoprod'>".$linha['quantidade']." em estoque</div>";
                                    }
                                    if($linha['quantidade']>0)
                                    {
                                    echo "<br><a id='btncomprar' href='carrinho_front.php?acao=add&cod_produto=".$linha['cod_produto']."'>Comprar</a>";
                                    }
                            echo "</div><br>";
                        echo "</div>";
                }else if($final=='colorido=true' && $linha['colorido']=='t'){
                    $preco= number_format($linha['preco'], 2, ',', '.');

                    echo "
                    <div class='prod-box'>
                            <div>
                                <br>
                                <div class='selecaoprod'><p>".$linha['nome']."</p></div>
                                <div>
                                <br>
                                <a href='selecao_detalhes_front.php?id=".$linha['cod_produto']."'> 
                                <img src=".$linha['campo_imagem']." class='img-selecao'/>
                                </a>
                            </div>
                                <div class='selecaoprod'>R$ ".$preco."</div>";

                                if ($linha['quantidade']<=0)
                                {
                                    echo "
                                    <div><span>Produto esgotado</span></div>";
                                }
                                else
                                {
                                    echo "
                                    <div class='selecaoprod'>".$linha['quantidade']." em estoque</div>";
                                }
                                if($linha['quantidade']>0)
                                {
                                echo "<br><a id='btncomprar' href='carrinho_front.php?acao=add&cod_produto=".$linha['cod_produto']."'>Comprar</a>";
                                }
                        echo "</div><br>";
                    echo "</div>";
                }else if($final=='reto=true' && $linha['reto']=='t'){
                    $preco= number_format($linha['preco'], 2, ',', '.');

                    echo "
                    <div class='prod-box'>
                            <div>
                                <br>
                                <div class='selecaoprod'><p>".$linha['nome']."</p></div>
                                <div>
                                <br>
                                <a href='selecao_detalhes_front.php?id=".$linha['cod_produto']."'> 
                                <img src=".$linha['campo_imagem']." class='img-selecao'/>
                                </a>
                            </div>
                                <div class='selecaoprod'>R$ ".$preco."</div>";

                                if ($linha['quantidade']<=0)
                                {
                                    echo "
                                    <div><span>Produto esgotado</span></div>";
                                }
                                else
                                {
                                    echo "
                                    <div class='selecaoprod'>".$linha['quantidade']." em estoque</div>";
                                }
                                if($linha['quantidade']>0)
                                {
                                echo "<br><a id='btncomprar' href='carrinho_front.php?acao=add&cod_produto=".$linha['cod_produto']."'>Comprar</a>";
                                }
                        echo "</div><br>";
                    echo "</div>";
                }else if($final=='reto=false' && $linha['reto']=='f'){
                    $preco= number_format($linha['preco'], 2, ',', '.');

                    echo "
                    <div class='prod-box'>
                            <div>
                                <br>
                                <div class='selecaoprod'><p>".$linha['nome']."</p></div>
                                <div>
                                <br>
                                <a href='selecao_detalhes_front.php?id=".$linha['cod_produto']."'> 
                                <img src=".$linha['campo_imagem']." class='img-selecao'/>
                                </a>
                            </div>
                                <div class='selecaoprod'>R$ ".$preco."</div>";

                                if ($linha['quantidade']<=0)
                                {
                                    echo "
                                    <div><span>Produto esgotado</span></div>";
                                }
                                else
                                {
                                    echo "
                                    <div class='selecaoprod'>".$linha['quantidade']." em estoque</div>";
                                }
                                if($linha['quantidade']>0)
                                {
                                echo "<br><a id='btncomprar' href='carrinho_front.php?acao=add&cod_produto=".$linha['cod_produto']."'>Comprar</a>";
                                }
                        echo "</div><br>";
                    echo "</div>";
                }else if($final=='fino=true' && $linha['fino']=='t'){
                    $preco= number_format($linha['preco'], 2, ',', '.');

                    echo "
                    <div class='prod-box'>
                            <div>
                                <br>
                                <div class='selecaoprod'><p>".$linha['nome']."</p></div>
                                <div>
                                <br>
                                <a href='selecao_detalhes_front.php?id=".$linha['cod_produto']."'> 
                                <img src=".$linha['campo_imagem']." class='img-selecao'/>
                                </a>
                            </div>
                                <div class='selecaoprod'>R$ ".$preco."</div>";

                                if ($linha['quantidade']<=0)
                                {
                                    echo "
                                    <div><span>Produto esgotado</span></div>";
                                }
                                else
                                {
                                    echo "
                                    <div class='selecaoprod'>".$linha['quantidade']." em estoque</div>";
                                }
                                if($linha['quantidade']>0)
                                {
                                echo "<br><a id='btncomprar' href='carrinho_front.php?acao=add&cod_produto=".$linha['cod_produto']."'>Comprar</a>";
                                }
                        echo "</div><br>";
                    echo "</div>";
                }else if($final=='fino=false' && $linha['fino']=='f'){
                    $preco= number_format($linha['preco'], 2, ',', '.');

                    echo "
                    <div class='prod-box'>
                            <div>
                                <br>
                                <div class='selecaoprod'><p>".$linha['nome']."</p></div>
                                <div>
                                <br>
                                <a href='selecao_detalhes_front.php?id=".$linha['cod_produto']."'> 
                                <img src=".$linha['campo_imagem']." class='img-selecao'/>
                                </a>
                            </div>
                                <div class='selecaoprod'>R$ ".$preco."</div>";

                                if ($linha['quantidade']<=0)
                                {
                                    echo "
                                    <div><span>Produto esgotado</span></div>";
                                }
                                else
                                {
                                    echo "
                                    <div class='selecaoprod'>".$linha['quantidade']." em estoque</div>";
                                }
                                if($linha['quantidade']>0)
                                {
                                echo "<br><a id='btncomprar' href='carrinho_front.php?acao=add&cod_produto=".$linha['cod_produto']."'>Comprar</a>";
                                }
                        echo "</div><br>";
                    echo "</div>";
                }else if($final=='todos' || $final==NULL){
                    $preco= number_format($linha['preco'], 2, ',', '.');

                    echo "
                    <div class='prod-box'>
                            <div>
                                <br>
                                <div class='selecaoprod'><p>".$linha['nome']."</p></div>
                                <div>
                                <br>
                                <a href='selecao_detalhes_front.php?id=".$linha['cod_produto']."'> 
                                <img src=".$linha['campo_imagem']." class='img-selecao'/>
                                </a>
                            </div>
                                <div class='selecaoprod'>R$ ".$preco."</div>";

                                if ($linha['quantidade']<=0)
                                {
                                    echo "
                                    <div><span>Produto esgotado</span></div>";
                                }
                                else
                                {
                                    echo "
                                    <div class='selecaoprod'>".$linha['quantidade']." em estoque</div>";
                                }
                                if($linha['quantidade']>0)
                                {
                                echo "<br><a id='btncomprar' href='carrinho_front.php?acao=add&cod_produto=".$linha['cod_produto']."'>Comprar</a>";
                                }
                        echo "</div><br>";
                    echo "</div>";
                }
            }

            echo "</div>";

        ?>
    </div>

</body>

</html>