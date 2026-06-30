<?php
require_once __DIR__ . '/dados_estatisticas.php';

// --- Parsing bruto ---

function parseCaixa(): array {
    $linhas = [];
    foreach (explode("\n", trim(CAIXA_RAW)) as $linha) {
        $linha = trim($linha);
        if ($linha === '') continue;
        [$data, $historico, $entrada, $saida] = explode('|', $linha);
        $linhas[] = [
            'data'      => normalizarData($data),
            'historico' => trim($historico),
            'entrada'   => parseValorBr($entrada),
            'saida'     => parseValorBr($saida),
        ];
    }
    return $linhas;
}

function parseEstoque(): array {
    $linhas = [];
    foreach (explode("\n", trim(ESTOQUE_RAW)) as $linha) {
        $linha = trim($linha);
        if ($linha === '') continue;
        [$data, $historico, $entrada, $saida] = explode('|', $linha);
        $linhas[] = [
            'data'    => normalizarData($data),
            'itens'   => explode('\n', trim($historico)),
            'entrada' => $entrada === '' ? 0 : intval($entrada),
            'saida'   => $saida === '' ? 0 : intval($saida),
        ];
    }
    return $linhas;
}

// --- Normalizacao ---

function normalizarData(string $dm): string {
    [$dia, $mes] = explode('/', trim($dm));
    return sprintf('2022-%02d-%02d', intval($mes), intval($dia));
}

function parseValorBr(string $valor): float {
    $valor = trim(str_replace(['R$', ' '], '', $valor));
    if ($valor === '') return 0.0;
    $valor = str_replace('.', '', $valor);
    $valor = str_replace(',', '.', $valor);
    return floatval($valor);
}

// --- Agregacao ---

function agregarFaturamentoEUnidadesPorDia(array $caixa, array $estoque): array {
    $porDia = [];

    foreach ($caixa as $linha) {
        if (stripos($linha['historico'], 'integraliz') !== false) continue;
        $d = $linha['data'];
        $porDia[$d]['faturamento'] = ($porDia[$d]['faturamento'] ?? 0) + $linha['entrada'];
    }

    foreach ($estoque as $linha) {
        if (stripos(implode(' ', $linha['itens']), 'Estoque Inicial') !== false) continue;
        $d = $linha['data'];
        $porDia[$d]['unidades'] = ($porDia[$d]['unidades'] ?? 0) + $linha['saida'];
    }

    ksort($porDia);
    foreach ($porDia as &$v) {
        $v['faturamento'] = $v['faturamento'] ?? 0.0;
        $v['unidades']    = $v['unidades'] ?? 0;
    }
    unset($v);
    return $porDia;
}

function rankingTiposCanudo(array $estoque): array {
    $contagem = [];
    foreach ($estoque as $linha) {
        foreach ($linha['itens'] as $item) {
            $item = trim($item);
            if ($item === '' || stripos($item, 'Estoque Inicial') !== false) continue;
            if (!preg_match('/^(\d+)\s*x\s*(.+)$/i', $item, $m)) continue;
            $qtde = intval($m[1]);
            $tipo = mb_strtolower(trim($m[2]));
            if ($tipo === '') continue;
            $contagem[$tipo] = ($contagem[$tipo] ?? 0) + $qtde;
        }
    }
    arsort($contagem);
    return $contagem;
}

function calcularKPIs(array $caixa, array $estoque, array $porDia): array {
    $faturamentoTotal = 0.0;
    $transacoes = 0;
    foreach ($caixa as $linha) {
        if (stripos($linha['historico'], 'integraliz') !== false) continue;
        $faturamentoTotal += $linha['entrada'];
        $transacoes++;
    }

    $unidadesTotal = 0;
    foreach ($estoque as $linha) {
        if (stripos(implode(' ', $linha['itens']), 'Estoque Inicial') !== false) continue;
        $unidadesTotal += $linha['saida'];
    }

    $ticketMedio = $transacoes > 0 ? $faturamentoTotal / $transacoes : 0.0;
    $diasCobertos = count($porDia);

    return [
        'faturamento_total' => $faturamentoTotal,
        'unidades_total'    => $unidadesTotal,
        'ticket_medio'      => $ticketMedio,
        'dias_cobertos'     => $diasCobertos,
    ];
}
