<?php
// Dados brutos transcritos das planilhas historicas (outubro/2022).
// Formato: DATA|HISTORICO|ENTRADA|SAIDA  (um registro por linha, campos separados por "|")
// Datas no formato D/M (ano fixo 2022, mes 10). Valores com virgula decimal BR ou vazio.
// Quebras de linha DENTRO de uma celula (combo de itens, na planilha de estoque) sao
// representadas pelo marcador literal de 2 caracteres \n (NAO uma quebra de linha real)
// -- ver includes/parser_estatisticas.php.

const CAIXA_RAW = <<<'TXT'
24/10|Integralizacao para troco|20,00|0,00
25/10|Jose Segura|9,00|0,00
25/10|Andreia Ribeiro|9,00|0,00
25/10|Carlos Vitor|3,00|0,00
25/10|Bianca Mainini|24,00|0,00
25/10|Cristiane Aragao|18,00|0,00
25/10|Julia Iozzi|24,00|0,00
25/10|Lua Romani|6,00|0,00
25/10|Vitoria Vieira|6,00|0,00
25/10|Breno Bizelli|6,00|0,00
25/10|Beatriz Soche|3,00|0,00
25/10|Eduarda Garbullio|9,00|0,00
25/10|Evellyn Carvalho|3,00|0,00
25/10|Luana|9,00|0,00
25/10|Marina Paladini|3,00|0,00
25/10|Lorena Caricatti|3,00|0,00
25/10|Joao Pedro|6,00|0,00
25/10|Guilherme Diorio|6,00|0,00
25/10|Deolindo|3,00|0,00
25/10|Ana Julia|6,00|0,00
25/10|Arthur Pupolim|9,00|0,00
25/10|Joao Carlos|6,00|0,00
25/10|Debora|3,00|0,00
25/10|Joao Fava|6,00|0,00
25/10|Laura Russo|3,00|0,00
25/10|Emanule Lima|9,00|0,00
25/10|Rosa Lima|15,00|0,00
25/10|Nica Diorio|9,00|0,00
25/10|Gustavo Marsola|9,00|0,00
25/10|Julia Tano|6,00|0,00
25/10|Daniel Ferraz|12,00|0,00
25/10|Isaac Levi|9,00|0,00
25/10|Helena Gutierrez|9,00|0,00
25/10|Diogo Salmen|3,00|0,00
25/10|Danilo Salmen|3,00|0,00
25/10|Matheus Eberle|3,00|0,00
25/10|Lucas Betetto|9,00|0,00
25/10|Carol Ninim|9,00|0,00
25/10|Gabriel Gato|3,00|0,00
25/10|Heloise Cezario|3,00|0,00
25/10|Ana Oliver|3,00|0,00
25/10|Ian Banone|6,00|0,00
25/10|Rosa Lima|12,00|0,00
25/10|Maria Eid|6,00|0,00
25/10|Ariane|3,00|0,00
25/10|Ezequiel Bertinotti|6,00|0,00
25/10|Sergio Luis|3,00|0,00
25/10|Castro|18,00|0,00
25/10|Nicolas Magri|3,00|0,00
26/10|Carlos Vitor|9,00|0,00
26/10|Murilo Vieira|3,00|0,00
26/10|Cabello|3,00|0,00
26/10|Enrico|9,00|0,00
26/10|Rafaella|3,00|0,00
26/10|Louise|3,00|0,00
26/10|Luiza Stangherlim|3,00|0,00
26/10|CTI|36,00|0,00
26/10|Maria de Lurdes|3,00|0,00
26/10|Ana Julia|3,00|0,00
26/10|Joao Oliveira|3,00|0,00
26/10|Gabriele de Lima|3,00|0,00
26/10|Maria Eduarda|3,00|0,00
26/10|Matheus|3,00|0,00
26/10|Isabela|3,00|0,00
26/10|Beatriz|12,00|0,00
26/10|Theo|3,00|0,00
26/10|Ivy|3,00|0,00
26/10|Guilherme Messa|3,00|0,00
26/10|Vitinho|6,00|0,00
26/10|Guilherme Diorio|6,00|0,00
26/10|Leopoldo Sormani|6,00|0,00
26/10|Flash|6,00|0,00
26/10|Aline Carvalho|6,00|0,00
26/10|Isadora|9,00|0,00
26/10|Bruna|9,00|0,00
26/10|Joao Vitor|6,00|0,00
26/10|Gabriel|6,00|0,00
26/10|Ellen|6,00|0,00
26/10|Lillian Mainini|9,00|0,00
26/10|Orientadora Priscila|18,00|0,00
26/10|Laura Russo|6,00|0,00
26/10|Gustavo Marsola|6,00|0,00
26/10|Diego Rodrigues|6,00|0,00
26/10|Felipe Akira|9,00|0,00
26/10|Vitor Melo|6,00|0,00
26/10|Fatima Vieira|9,00|0,00
26/10|Jose Segura|6,00|0,00
26/10|Luis Barros|5,00|0,00
26/10|Maria Julia Santana|7,00|0,00
26/10|Vitoria Yonamine|15,00|0,00
26/10|Felipe Bogalho|5,00|0,00
26/10|Isadora Oliveira|5,00|0,00
26/10|Angela Russo|7,00|0,00
26/10|Deolindo|10,00|0,00
26/10|Eliane|7,50|0,00
26/10|Miguel Torres|7,00|0,00
27/10|Renan Moreira|6,00|0,00
27/10|Comin|6,00|0,00
27/10|Sara Brandao|10,00|0,00
27/10|Esther|4,00|0,00
27/10|Ana Bonalume|6,00|0,00
27/10|Giovani Moreto|6,00|0,00
27/10|Beatriz Lopes|6,00|0,00
27/10|Naydow|6,00|0,00
27/10|Bruno Henrique|4,00|0,00
27/10|Castro|9,00|0,00
27/10|Jovita|9,00|0,00
27/10|Juliana|8,00|0,00
27/10|Bruno|4,00|0,00
27/10|Vitor|4,00|0,00
27/10|Lismaria|8,00|0,00
27/10|Matheus Eberle|4,00|0,00
27/10|Mateus|4,00|0,00
27/10|Luigi Panice|6,00|0,00
27/10|Rosa Lima|40,00|0,00
27/10|Willian|9,00|0,00
27/10|Carlos|4,00|0,00
27/10|Nayane|9,00|0,00
27/10|Matheus Trentini|9,00|0,00
27/10|Samuel Goldflus|4,00|0,00
27/10|Paula|9,00|0,00
27/10|Galassi|4,00|0,00
27/10|Caio|6,00|0,00
27/10|Lucas|9,00|0,00
27/10|Nicolim|9,00|0,00
27/10|Mariana Aguiar|4,00|0,00
27/10|Alexia|4,00|0,00
27/10|Jorge Pedro|4,00|0,00
27/10|Jorge|4,00|0,00
27/10|Fabio|4,00|0,00
27/10|Leandro|4,00|0,00
27/10|Lucas Durso|4,00|0,00
27/10|Ana Clara Godoi|4,00|0,00
27/10|Zeze|4,00|0,00
27/10|Carol|4,00|0,00
27/10|Cornelia|4,00|0,00
27/10|Bianca Mainini|4,00|0,00
27/10|Porcel|4,00|0,00
27/10|Wagner|4,00|0,00
27/10|Carol Secretaria|4,00|0,00
27/10|Mariana|4,00|0,00
27/10|Beatriz|4,00|0,00
27/10|Davi|4,00|0,00
27/10|Ana|4,00|0,00
27/10|Dani|4,00|0,00
TXT;

const ESTOQUE_RAW = <<<'TXT'
25/10|Estoque Inicial|200|
25/10|1x grosso reto incolor\n1x fino curvo incolor||2
25/10|3x fino curvo incolor||3
25/10|1x fino curvo incolor||1
25/10|2x grosso reto incolor\n1x fino curvo incolor\n1x fino curvo cinza||4
25/10|2x fino curvo cinza||2
25/10|1x grosso reto incolor\n1x fino curvo cinza\n1x grosso curvo laranja||3
25/10|2x fino curvo incolor||2
25/10|1x grosso reto incolor||1
25/10|1x grosso reto incolor||1
25/10|1x fino curvo incolor||1
25/10|1x grosso curvo laranja||1
25/10|1x fino curvo incolor||1
25/10|1x grosso curvo laranja||1
25/10|1x fino curvo incolor||1
25/10|1x fino curvo incolor||1
25/10|2x fino curvo incolor||2
25/10|1x grosso reto incolor||1
25/10|1x fino curvo incolor||1
25/10|1x grosso reto incolor||1
25/10|1x fino curvo cinza||1
25/10|1x grosso reto incolor||1
25/10|1x fino curvo incolor||1
25/10|1x grosso reto incolor||1
25/10|1x fino curvo incolor||1
25/10|1x grosso reto incolor\n1x fino curvo incolor||2
25/10|1x grosso reto incolor\n3x fino curvo incolor||4
25/10|3x fino curvo incolor||3
25/10|1x fino curvo cinza||1
25/10|1x grosso reto incolor||1
25/10|1x grosso curvo laranja\n1x fino curvo incolor||2
25/10|1x fino curvo cinza||1
25/10|1x grosso reto incolor\n1x fino curvo incolor||2
25/10|1x fino curvo incolor||1
25/10|1x fino curvo incolor||1
25/10|1x fino curvo incolor||1
25/10|1x fino curvo cinza||1
25/10|1x grosso reto laranja||1
25/10|1x fino curvo incolor||1
25/10|1x fino curvo incolor||1
25/10|1x fino curvo incolor||1
25/10|1x grosso reto incolor||1
25/10|1x grosso reto incolor||1
25/10|1x grosso reto incolor||1
25/10|1x grosso reto incolor||1
25/10|1x fino curvo incolor||1
25/10|2x fino curvo incolor||2
25/10|1x fino curvo incolor||1
25/10|2x grosso reto laranja||2
25/10|1x fino curvo incolor||1
26/10|1x fino curvo incolor\n1x grosso reto incolor||2
26/10|1x fino curvo incolor||1
26/10|1x fino curvo incolor||1
26/10|1x grosso reto incolor\n1x fino curvo incolor||2
26/10|1x fino curvo incolor||1
26/10|1x fino curvo incolor||1
26/10|1x fino curvo incolor||1
26/10|1x fino curvo incolor\n1x grosso reto incolor\n1x fino curvo cinza\n1x fino reto cinza\n1x grosso reto laranja||5
26/10|1x fino curvo incolor||1
26/10|1x fino curvo incolor||1
26/10|1x fino curvo incolor||1
26/10|1x fino curvo incolor||1
26/10|1x fino curvo incolor||1
26/10|1x grosso reto incolor||1
26/10|1x fino curvo incolor||1
26/10|2x grosso reto incolor||2
26/10|1x fino curvo incolor||1
26/10|1x fino curvo incolor||1
26/10|1x fino curvo incolor||1
26/10|1x grosso reto incolor||1
26/10|1x grosso reto incolor||1
26/10|1x grosso reto incolor||1
26/10|1x grosso reto incolor||1
26/10|1x grosso reto incolor||1
26/10|1x fino curvo cinza||1
26/10|1x fino curvo cinza||1
26/10|1x grosso reto incolor||1
26/10|1x grosso reto incolor||1
26/10|1x grosso reto incolor||1
26/10|1x fino curvo cinza||1
26/10|2x fino curvo incolor\n2x grosso reto incolor||4
26/10|1x grosso reto incolor||1
26/10|1x grosso reto incolor||1
26/10|1x grosso reto incolor||1
26/10|1x fino curvo cinza||1
26/10|1x grosso reto incolor||1
26/10|1x fino curvo cinza||1
26/10|1x grosso reto incolor||1
26/10|1x grosso reto incolor||1
26/10|1x fino curvo cinza||1
26/10|3x grosso reto incolor||3
26/10|1x grosso reto incolor||1
26/10|1x grosso reto incolor||1
26/10|1x fino curvo cinza||1
26/10|2x grosso reto incolor||2
26/10|1x fino curvo cinza||1
26/10|1x fino reto cinza||1
27/10|1x fino reto cinza||1
27/10|1x fino reto cinza||1
27/10|1x fino reto cinza\n1x grosso reto incolor||2
27/10|1x grosso reto incolor||1
27/10|1x fino reto cinza||1
27/10|1x fino reto cinza||1
27/10|1x fino reto cinza||1
27/10|1x fino reto cinza||1
27/10|1x grosso reto incolor||1
27/10|1x fino reto cinza\n1x grosso reto incolor||2
27/10|1x fino reto cinza\n1x grosso reto incolor||2
27/10|2x grosso reto incolor||2
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
27/10|2x grosso reto incolor||2
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
27/10|1x fino reto cinza||1
27/10|10x grosso reto incolor||10
27/10|1x fino reto cinza\n1x grosso reto incolor||2
27/10|1x grosso reto incolor||1
27/10|1x fino reto cinza\n1x grosso reto incolor||2
27/10|1x fino reto cinza\n1x grosso reto incolor||2
27/10|1x grosso reto incolor||1
27/10|1x fino reto cinza\n1x grosso reto incolor||2
27/10|1x grosso reto incolor||1
27/10|1x fino reto cinza||1
27/10|1x fino reto cinza\n1x grosso reto incolor||2
27/10|1x fino reto cinza\n1x grosso reto incolor||2
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
27/10|2x grosso reto incolor||2
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
27/10|1x grosso reto incolor||1
TXT;
