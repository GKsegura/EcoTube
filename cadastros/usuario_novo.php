<?php
session_start();
include "../includes/helpers.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "../includes/conexao.php";

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];

    if ($senha !== $confirma_senha) {
        redirect('As senhas não coincidem!', 'usuario_novo.php');
    }

    $sql = "SELECT COUNT(*) FROM users WHERE cpf=$1 and excluido=false";
    $row = pg_fetch_row(pg_query_params($conecta, $sql, [$cpf]));

    if ($row[0] == 1) {
        pg_close($conecta);
        redirect('CPF duplicado!', 'usuario_novo.php');
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(cod_usuario,nome,email,senha,telefone,cpf)
                VALUES(DEFAULT,$1,$2,$3,$4,$5);";

    $resultado = pg_query_params($conecta, $sql, [$nome, $email, $senha_hash, $telefone, $cpf]);
    $linhas = pg_affected_rows($resultado);
    pg_close($conecta);

    if ($linhas == 0) {
        redirect('Erro na gravação do usuário!', 'usuario_novo.php');
    }

    if (isset($_SESSION['usuariologado'])) {
        redirect('Usuário salvo com sucesso!', '../index.php');
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['senha_hash'] = $senha_hash;
        $_SESSION['cadastrado'] = true;
        redirect('Usuário salvo com sucesso!', '../login/login.php');
    }
}

include "header.php";
?>
    <div class="divmae">
        <div class="login-box">
            <h2>Cadastro</h2>
            <form action="usuario_novo.php" method="post">
                <div class="user-box">
                    <input type="text" name="nome" required autocomplete="off">
                    <label>Nome*</label>
                </div>
                <div class="user-box">
                    <input type="email" name="email" required autocomplete="off">
                    <label>E-mail*</label>
                </div>
                <div class="user-box">
                    <input type="password" name="senha" required autocomplete="off" id="senha"> <a class="ver"
                        onclick="view_password()" id="eye_password"><i class="fa-regular fa-eye"></i></a>
                    <div id="medidor" class="medidor"></div>
                    <div class="barra">
                        <div></div>
                    </div>
                    <label>Senha*</label>
                </div>
                <div class="user-box">
                    <input type="password" name="confirma_senha" required autocomplete="off" id="confirma_senha">
                    <a class="ver" onclick="view_confirm_password()" id="eye_confirm_password"><i
                            class="fa-regular fa-eye"></i></a>
                    <label>Confirme sua senha*</label>
                </div>
                <div class="user-box">
                    <input type="text" name="telefone" maxlength="15" required autocomplete="off" id="telefone">
                    <label>Telefone*</label>
                </div>
                <div class="user-box">
                    <input type="text" name="cpf" maxlength="14" required autocomplete="off" id="cpf">
                    <label>CPF*</label>
                </div>
                <center>
                    <input type="submit" value="Criar cadastro">
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

    var senha = document.getElementById('senha');
    var confirma = document.getElementById('confirma_senha');

    function validatePassword() {
        confirma.setCustomValidity(senha.value !== confirma.value ? 'As senhas não coincidem!' : '');
    }
    senha.onchange = validatePassword;
    confirma.onkeyup = validatePassword;

    senha.oninput = function() {
        var v = senha.value, q = 0;
        if (v.match(/.{6,}/)) q++;
        if (v.match(/[A-Z]/)) q++;
        if (v.match(/[0-9]/)) q++;
        if (v.match(/[!@#$%^&*(),.?":{}|<>]/)) q++;
        var labels = ['', 'Fraca', 'Média', 'Forte', 'Muito forte'];
        var widths = ['0%', '5%', '38%', '71%', '100%'];
        var colors = ['', '#ff0000', '#ff0', '#00ff00', '#055405'];
        var bar = document.querySelector('.barra div');
        bar.style.width = widths[q];
        bar.style.backgroundColor = colors[q] || '';
        document.getElementById('medidor').innerHTML = q > 0 ? '<div id="forca">Força:</div>&nbsp;' + labels[q] : '';
    };
})();

function view_password() {
    var s = document.getElementById('senha');
    s.type = s.type === 'password' ? 'text' : 'password';
    document.getElementById('eye_password').style.color = s.type === 'text' ? '#79d1c3' : '#fff';
}
function view_confirm_password() {
    var s = document.getElementById('confirma_senha');
    s.type = s.type === 'password' ? 'text' : 'password';
    document.getElementById('eye_confirm_password').style.color = s.type === 'text' ? '#79d1c3' : '#fff';
}
</script>
</body>
</html>
