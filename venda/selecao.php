<?php
session_start();
include "../includes/conexao.php";
include "../includes/helpers.php";

$final = $_GET['tipo'] ?? 'todos';

$sql = "SELECT * FROM produtos WHERE excluido=false ORDER BY nome;";
$resultado = pg_query($conecta, $sql);
$qtde = pg_num_rows($resultado);
$resultado_lista = null;
if ($qtde > 0) {
    $resultado_lista = pg_fetch_all($resultado);
}
pg_close($conecta);

include "header.php";
?>
    <div class="divmae">
        <script>
        function opt() {
            var d = document.getElementById('tipo').value;
            window.location.href = './selecao.php?tipo=' + d;
        }
        </script>

        <div class='pesquisa'>
            <div class='input'>
                <label for='tipo'>Tipo de canudos:&nbsp;</label>
                <select id='tipo' onchange='opt()' name='tipo'>
                    <option value='todos' <?php if($final=='todos') echo 'selected'; ?>>Todos</option>
                    <option value='colorido=false' <?php if($final=='colorido=false') echo 'selected'; ?>>Incolor</option>
                    <option value='colorido=true' <?php if($final=='colorido=true') echo 'selected'; ?>>Colorido</option>
                    <option value='reto=true' <?php if($final=='reto=true') echo 'selected'; ?>>Reto</option>
                    <option value='reto=false' <?php if($final=='reto=false') echo 'selected'; ?>>Curvo</option>
                    <option value='fino=true' <?php if($final=='fino=true') echo 'selected'; ?>>Fino</option>
                    <option value='fino=false' <?php if($final=='fino=false') echo 'selected'; ?>>Grosso</option>
                </select>
            </div>
        </div>

        <?php if ($qtde == 0): ?>
            <div class='titulo'><h2>Nenhum produto em estoque</h2></div>
        <?php else: ?>
            <div class='box'>
            <?php
            $filtros = [
                'colorido=false' => ['colorido', 'f'],
                'colorido=true'  => ['colorido', 't'],
                'reto=true'      => ['reto', 't'],
                'reto=false'     => ['reto', 'f'],
                'fino=true'      => ['fino', 't'],
                'fino=false'     => ['fino', 'f'],
            ];

            foreach ($resultado_lista as $linha):
                if ($final !== 'todos' && $final !== null) {
                    if (!isset($filtros[$final])) continue;
                    [$campo, $valor] = $filtros[$final];
                    if ($linha[$campo] !== $valor) continue;
                }

                $preco = number_format($linha['preco'], 2, ',', '.');
                $cod = intval($linha['cod_produto']);
            ?>
                <div class='prod-box'>
                    <div>
                        <br>
                        <div class='selecaoprod'><p><?php echo h($linha['nome']); ?></p></div>
                        <div>
                            <br>
                            <a href='detalhes.php?id=<?php echo $cod; ?>'>
                                <img src='<?php echo h($linha['campo_imagem']); ?>' class='img-selecao'/>
                            </a>
                        </div>
                        <div class='selecaoprod'>R$ <?php echo $preco; ?></div>
                        <?php if ($linha['quantidade'] <= 0): ?>
                            <div><span>Produto esgotado</span></div>
                        <?php else: ?>
                            <div class='selecaoprod'><?php echo h($linha['quantidade']); ?> em estoque</div>
                            <br><a id='btncomprar' href='carrinho.php?acao=add&cod_produto=<?php echo $cod; ?>'>Comprar</a>
                        <?php endif; ?>
                    </div><br>
                </div>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
