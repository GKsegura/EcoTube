<?php
session_start();
include "../includes/helpers.php";
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "../includes/conexao.php";

    $cod_usuario = intval($_POST['cod_usuario']);

    $sql = "UPDATE users SET excluido=true WHERE cod_usuario = $1";
    $resultado = pg_query_params($conecta, $sql, [$cod_usuario]);
    $qtde = pg_affected_rows($resultado);
    pg_close($conecta);

    if ($qtde > 0)
        redirect('Excluído!', 'usuarios.php');
    else
        redirect('Erro na exclusão!', 'usuarios.php');
}

$cod_usuario = intval($_GET["cod_usuario"]);
include "../includes/conexao.php";

$sql = "SELECT * FROM users WHERE cod_usuario = $1;";
$resultado = pg_query_params($conecta, $sql, [$cod_usuario]);
$qtde = pg_num_rows($resultado);

if ($qtde == 0) {
    pg_close($conecta);
    redirect('Usuário não encontrado!', 'usuarios.php');
}

$linha = pg_fetch_array($resultado);
pg_close($conecta);

include "header.php";
?>
    <div class="divmae">
        <div class="login-box">
            <h2>Exclusão de Usuários</h2>
            <form action="usuario_exclui.php" method="post">
                <div class="user-box">
                    <input type="text" name="cod_usuario" value="<?php echo h($linha['cod_usuario']); ?>" readonly>
                    <label id="lbl_sem_animacao">Código de usuário</label>
                </div>
                <div class="user-box">
                    <input type="text" name="nome" value="<?php echo h($linha['nome']); ?>" readonly>
                    <label id="lbl_sem_animacao">Nome</label>
                </div>
                <div class="user-box">
                    <input type="text" name="email" value="<?php echo h($linha['email']); ?>" readonly>
                    <label id="lbl_sem_animacao">E-mail</label>
                </div>
                <div class="user-box">
                    <input type="text" name="telefone" value="<?php echo h($linha['telefone']); ?>" readonly>
                    <label id="lbl_sem_animacao">Telefone</label>
                </div>
                <div class="user-box">
                    <input type="text" name="cpf" value="<?php echo h($linha['cpf']); ?>" readonly>
                    <label id="lbl_sem_animacao">CPF</label>
                </div>
                <center>
                    <input type="submit" value="Confirmar">
                    <input class="btn_exclui" type="button" value="Editar"
                        onclick="location.href='usuario_altera.php?cod_usuario=<?php echo intval($cod_usuario); ?>';">
                </center>
            </form>
        </div>
    </div>
</body>
</html>
