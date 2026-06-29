<?php
session_start();
include "../includes/conexao.php";
include "../includes/helpers.php";
requireAdmin();

$sql = "SELECT * FROM users WHERE excluido=false ORDER BY cod_usuario;";
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
        <?php if ($qtde == 0): ?>
            <center>
            <div class='nao_encontrado'>
                NENHUM USUÁRIO ENCONTRADO
                <a href='usuario_novo.php'>+ Novo Usuário</a>
            </div>
            </center>
        <?php else: ?>
        <div class='table'>
            <div class='btn-novo-cad'>
                <a href='usuario_novo.php'>+ Novo Usuário</a>
            </div>
            <div class='row'>
                <div class='cell cod-produto cellCabeca'>Cód. Usuário</div>
                <div class='cell nome cellCabeca'>Nome</div>
                <div class='cell email cellCabeca'>Email</div>
                <div class='cell quantidade cellCabeca'>Telefone</div>
                <div class='cell quantidade cellCabeca'>CPF</div>
                <div class='cell opcoes cellCabeca'>Alternativas</div>
            </div>
            <?php foreach ($resultado_lista as $linha): ?>
            <div class='row'>
                <div class='cell cod-produto'><?php echo h($linha['cod_usuario']); ?></div>
                <div class='cell nome'><?php echo h($linha['nome']); ?></div>
                <div class='cell email'><?php echo h($linha['email']); ?></div>
                <div class='cell quantidade'><?php echo h($linha['telefone']); ?></div>
                <div class='cell quantidade'><?php echo h($linha['cpf']); ?></div>
                <div class='cell opcoes'>
                    <a href='usuario_altera.php?cod_usuario=<?php echo intval($linha['cod_usuario']); ?>'>Alterar</a>&nbsp;
                    <a href='usuario_exclui.php?cod_usuario=<?php echo intval($linha['cod_usuario']); ?>'>Excluir</a>&nbsp;
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
