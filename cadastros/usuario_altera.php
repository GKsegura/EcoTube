<?php
session_start();
include "../includes/helpers.php";
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "../includes/conexao.php";

    $cod_usuario = intval($_POST["cod_usuario"]);
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];

    $sql = "UPDATE users SET nome=$1, email=$2, telefone=$3, cpf=$4
            WHERE cod_usuario = $5;";

    $resultado = pg_query_params($conecta, $sql, [$nome, $email, $telefone, $cpf, $cod_usuario]);
    $qtde = pg_affected_rows($resultado);
    pg_close($conecta);

    if ($qtde > 0)
        redirect('Gravação OK!', 'usuarios.php');
    else
        redirect('Erro na Gravação!', 'usuarios.php');
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
            <h2>Alteração de Usuários</h2>
            <form action="usuario_altera.php" method="post">
                <div class="user-box">
                    <input type="text" name="cod_usuario" value="<?php echo h($linha['cod_usuario']); ?>" readonly>
                    <label id="lbl_sem_animacao">Código de usuário</label>
                </div>
                <div class="user-box">
                    <input type="text" name="nome" value="<?php echo h($linha['nome']); ?>" required>
                    <label>Nome</label>
                </div>
                <div class="user-box">
                    <input type="text" name="email" value="<?php echo h($linha['email']); ?>" required>
                    <label>E-mail</label>
                </div>
                <div class="user-box">
                    <input type="text" name="telefone" maxlength="15" value="<?php echo h($linha['telefone']); ?>"
                        id="telefone" required>
                    <label>Telefone</label>
                </div>
                <div class="user-box">
                    <input type="text" name="cpf" maxlength="14" value="<?php echo h($linha['cpf']); ?>" id="cpf" required>
                    <label>CPF</label>
                </div>
                <center>
                    <input type="submit" value="Salvar">
                </center>
            </form>
        </div>
    </div>
<script>
(function() {
    function mask(el, pattern) {
        if (!el) return;
        el.addEventListener('input', function() {
            var v = this.value.replace(/\D/g, ''), r = '', vi = 0;
            for (var i = 0; i < pattern.length && vi < v.length; i++)
                r += pattern[i] === '9' ? v[vi++] : pattern[i];
            this.value = r;
        });
    }
    mask(document.getElementById('telefone'), '(99) 99999-9999');
    mask(document.getElementById('cpf'), '999.999.999-99');
})();
</script>
</body>
</html>
