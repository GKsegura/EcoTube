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
    <?php $base = ''; include "./includes/header.php"; ?>
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

        <?php include "./includes/footer.php"; ?>
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