<?php

$stringdeconexao = "host=localhost
                    port=5432
                    dbname=ecotube
                    user=postgres
                    password=postgres";

$conecta = pg_connect($stringdeconexao);

if (!$conecta) {
    die('Erro: não foi possível conectar ao banco de dados.');
}
