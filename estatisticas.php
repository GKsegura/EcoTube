<!DOCTYPE html>
<html lang="pt-br">

<?php
    session_start();
    include "./includes/helpers.php";
    requireAdmin('index.php');
    include "./includes/parser_estatisticas.php";

    $caixa   = parseCaixa();
    $estoque = parseEstoque();
    $porDia  = agregarFaturamentoEUnidadesPorDia($caixa, $estoque);
    $ranking = array_slice(rankingTiposCanudo($estoque), 0, 10, true);
    $kpis    = calcularKPIs($caixa, $estoque, $porDia);

    $labelsDias        = array_keys($porDia);
    $faturamentoPorDia = array_map(fn($v) => round($v['faturamento'], 2), array_values($porDia));
    $unidadesPorDia    = array_map(fn($v) => $v['unidades'], array_values($porDia));

    $rankingLabels  = array_map('ucwords', array_keys($ranking));
    $rankingValores = array_values($ranking);
?>

<head>
    <meta charset="UTF-8">
    <title>EcoTube</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./imagens/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/cae157d5c6.js" crossorigin="anonymous"></script>
</head>

<body class="corpo">
    <?php include "./includes/theme_toggle.php"; ?>
    <header class="cabecalho">
        <div class="cableft">
            <a class="logo" href="index.php"><img class="logo" src="imagens/logo.svg" alt="logo"></a>
        </div>
        <div class="cabcenter">
            <a class="fixo" href="index.php">Home</a>&nbsp;
            <?php
                if (isset($_SESSION['isadm']) && $_SESSION['isadm'] == 't'){
                    echo "<a class='fixo' href='./cadastros/produtos.php'>Tab. Produtos</a>&nbsp;";
                    echo "<a class='fixo' href='./cadastros/usuarios.php'>Tab. Usuários</a>&nbsp;";
                }
                else{
                    echo "<a class='fixo' href='./venda/selecao.php'>Produtos</a>&nbsp;";
                    echo "<a class='fixo' href='devs.php'>Devs</a>&nbsp;";
                    echo "<a class='fixo' href='estatisticas.php'>Estatísticas</a>&nbsp;";
                }
            ?>
        </div>
        <div class="cabright">
            <?php 
                if (isset($_SESSION['usuariologado']))
                {
                    echo "<p class='usuario_cab'>Olá, ".$_SESSION['usuariologado']['nome']."</p>";
                    echo "<a class='fixo' href='./login/logoff_back.php' title='Sair'><i class='fa-solid fa-right-from-bracket'></i></a>";
                }
                else{
                    echo "<a class='fixo' href='./login/login.php' title='Login'><i
                    class='fa-solid fa-user'></i></a>&nbsp;";
                }
            ?>
            <a class="fixo" href="./venda/carrinho.php" title="Carrinho" id="iconcarrinho"><i
                    class="fa-solid fa-cart-shopping"></i>
                <?php if (isset($_SESSION['usuariologado'])): $qtdeCarrinho = contarItensCarrinho($_SESSION['usuariologado']['cod_usuario']); if ($qtdeCarrinho > 0): ?>
                    <span class="badge-carrinho"><?php echo $qtdeCarrinho; ?></span>
                <?php endif; endif; ?>
            </a>&nbsp;
            <button class="theme-toggle" onclick="toggleTheme()" title="Alternar tema">
                <i class="fa-solid fa-moon icon-dark"></i>
                <i class="fa-solid fa-sun icon-light"></i>
            </button>
        </div>
    </header>
    <div class="divmae">
        <section class="estat-kpis">
            <div class="kpi-card">
                <span class="kpi-valor">R$ <?php echo number_format($kpis['faturamento_total'], 2, ',', '.'); ?></span>
                <span class="kpi-label">Faturamento total</span>
            </div>
            <div class="kpi-card">
                <span class="kpi-valor"><?php echo number_format($kpis['unidades_total'], 0, ',', '.'); ?></span>
                <span class="kpi-label">Unidades vendidas</span>
            </div>
            <div class="kpi-card">
                <span class="kpi-valor">R$ <?php echo number_format($kpis['ticket_medio'], 2, ',', '.'); ?></span>
                <span class="kpi-label">Ticket médio</span>
            </div>
            <div class="kpi-card">
                <span class="kpi-valor"><?php echo $kpis['dias_cobertos']; ?></span>
                <span class="kpi-label">Dias cobertos</span>
            </div>
        </section>

        <section class="estat-graficos">
            <div class="grafico-card">
                <h3>Faturamento x Unidades vendidas por dia</h3>
                <canvas id="graficoFaturamentoUnidades"></canvas>
            </div>
            <div class="grafico-card">
                <h3>Tipos de canudo mais vendidos</h3>
                <canvas id="graficoRanking"></canvas>
            </div>
        </section>

        <p class="estat-link-original">
            <a href="https://docs.google.com/spreadsheets/d/1BOUg4pxNWNq2Br96Bvlh-DyUUfsks2r88XndB4NOTPI/edit?usp=sharing" target="_blank" rel="noopener">Ver planilha original (Caixa)</a>
            &nbsp;&middot;&nbsp;
            <a href="https://docs.google.com/spreadsheets/d/1R4VG5vlFrpCWoQccnOQOr0Q8AekvtdIUx48fZKrqgfU/edit?usp=sharing" target="_blank" rel="noopener">Ver planilha original (Estoque)</a>
        </p>

        <footer>
            <div class=" divfooter">
                <p><b>DESENVOLVEDORES</b></p>
                <p>N°02 - Andreia Ribeiro dos Santos</p>
                <p>N°06 - Bianca Fayad Mainini</p>
                <p>N°16 - Gabriele de Lima</p>
                <p>N°22 - José Antonio Segura Marques da Silva</p>
                <p>N°23 - Julia Rodrigues Iozzi</p>
            </div>
            <div class="divfooter">
                <p><b>PATROCÍNIOS</b></p>
                <a href="https://www.canu.do" target="_blank">
                    <img class="footer-img"
                        src="https://images.tcdn.com.br/img/img_prod/754793/1641989868_canudo_logo_web.jpg">
                </a>
            </div>
            <div class="btn-footer">
                <a class="fixo" href="#" title="Voltar ao topo"><i class="fa-solid fa-arrow-up"></i></a>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    (function() {
        var dadosEstat = {
            labelsDias: <?php echo json_encode($labelsDias); ?>,
            faturamentoPorDia: <?php echo json_encode($faturamentoPorDia); ?>,
            unidadesPorDia: <?php echo json_encode($unidadesPorDia); ?>,
            rankingLabels: <?php echo json_encode($rankingLabels, JSON_UNESCAPED_UNICODE); ?>,
            rankingValores: <?php echo json_encode($rankingValores); ?>
        };

        function lerCorTema() {
            var css = getComputedStyle(document.body);
            return {
                azul: css.getPropertyValue('--azul').trim(),
                verdeClaro: css.getPropertyValue('--verde-claro').trim(),
                texto: css.getPropertyValue('--texto').trim()
            };
        }

        var cores = lerCorTema();
        var graficoCombo, graficoRanking;

        function criarGraficos() {
            var ctx1 = document.getElementById('graficoFaturamentoUnidades');
            graficoCombo = new Chart(ctx1, {
                data: {
                    labels: dadosEstat.labelsDias,
                    datasets: [
                        { type: 'bar',  label: 'Faturamento (R$)',  data: dadosEstat.faturamentoPorDia, backgroundColor: cores.azul, yAxisID: 'y' },
                        { type: 'line', label: 'Unidades vendidas', data: dadosEstat.unidadesPorDia, borderColor: cores.verdeClaro, backgroundColor: cores.verdeClaro, yAxisID: 'y1', tension: 0.3 }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y:  { type: 'linear', position: 'left',  title: { display: true, text: 'R$' } },
                        y1: { type: 'linear', position: 'right', title: { display: true, text: 'Unidades' }, grid: { drawOnChartArea: false } }
                    },
                    plugins: { legend: { labels: { color: cores.texto } } }
                }
            });

            var ctx2 = document.getElementById('graficoRanking');
            graficoRanking = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: dadosEstat.rankingLabels,
                    datasets: [{ label: 'Vendas por tipo', data: dadosEstat.rankingValores, backgroundColor: cores.verdeClaro }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { ticks: { color: cores.texto } },
                        y: { ticks: { color: cores.texto } }
                    }
                }
            });
        }

        function atualizarCoresGraficos() {
            cores = lerCorTema();
            if (!graficoCombo || !graficoRanking) return;
            graficoCombo.data.datasets[0].backgroundColor = cores.azul;
            graficoCombo.data.datasets[1].borderColor = cores.verdeClaro;
            graficoCombo.data.datasets[1].backgroundColor = cores.verdeClaro;
            graficoCombo.options.plugins.legend.labels.color = cores.texto;
            graficoCombo.update();

            graficoRanking.data.datasets[0].backgroundColor = cores.verdeClaro;
            graficoRanking.options.scales.x.ticks.color = cores.texto;
            graficoRanking.options.scales.y.ticks.color = cores.texto;
            graficoRanking.update();
        }

        criarGraficos();
        window.addEventListener('ecotube:themechange', atualizarCoresGraficos);
    })();
    </script>
</body>

</html>