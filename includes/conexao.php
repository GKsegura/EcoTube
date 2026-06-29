<?php

$stringdeconexao = "host=localhost
                    port=5432
                    dbname=ecotube
                    user=postgres
                    password=postgres";

$conecta = pg_connect($stringdeconexao);

if (!$conecta) {
    echo '<script language="javascript">';
    echo "alert('Não foi possível estabelecer conexão com o banco de dados!')";
    echo '</script>';

    exit;
}
