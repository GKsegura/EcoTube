<?php
if (!function_exists('h')) {
    require __DIR__ . '/helpers.php';
}
$base = $base ?? '';
include __DIR__ . '/theme_toggle.php';
?>
<header class="site-header">
    <div class="header-left">
        <a class="logo" href="<?php echo $base; ?>index.php"><img class="logo" src="<?php echo $base; ?>imagens/logo.svg" alt="logo"></a>
    </div>
    <nav class="header-nav">
        <a class="nav-link" href="<?php echo $base; ?>index.php">Home</a>&nbsp;
        <?php if (isset($_SESSION['isadm']) && $_SESSION['isadm'] == 't'): ?>
            <a class="nav-link" href="<?php echo $base; ?>cadastros/produtos.php">Tab. Produtos</a>&nbsp;
            <a class="nav-link" href="<?php echo $base; ?>cadastros/usuarios.php">Tab. Usuários</a>&nbsp;
            <a class="nav-link" href="<?php echo $base; ?>estatisticas.php">Estatísticas</a>&nbsp;
        <?php else: ?>
            <a class="nav-link" href="<?php echo $base; ?>venda/selecao.php">Produtos</a>&nbsp;
            <a class="nav-link" href="<?php echo $base; ?>devs.php">Devs</a>&nbsp;
        <?php endif; ?>
    </nav>
    <div class="header-actions">
        <?php if (isset($_SESSION['usuariologado'])): ?>
            <p class="user-greeting">Olá, <?php echo h($_SESSION['usuariologado']['nome']); ?></p>
            <a class="nav-link" href="<?php echo $base; ?>login/logoff_back.php" title="Sair"><i class="fa-solid fa-right-from-bracket"></i></a>
        <?php else: ?>
            <a class="nav-link" href="<?php echo $base; ?>login/login.php" title="Login"><i class="fa-solid fa-user"></i></a>&nbsp;
        <?php endif; ?>
        <a class="nav-link cart-icon" href="<?php echo $base; ?>venda/carrinho.php" title="Carrinho">
            <i class="fa-solid fa-cart-shopping"></i>
            <?php if (isset($_SESSION['usuariologado'])): $qtdeCarrinho = contarItensCarrinho($_SESSION['usuariologado']['cod_usuario']); if ($qtdeCarrinho > 0): ?>
                <span class="cart-badge"><?php echo $qtdeCarrinho; ?></span>
            <?php endif; endif; ?>
        </a>&nbsp;
        <button class="theme-toggle" onclick="toggleTheme()" title="Alternar tema">
            <i class="fa-solid fa-moon icon-dark"></i>
            <i class="fa-solid fa-sun icon-light"></i>
        </button>
    </div>
</header>
<?php renderToast(); ?>
