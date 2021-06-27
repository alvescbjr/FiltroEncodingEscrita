<?php
require_once __DIR__ . "/vendor/autoload.php";

use FiltroEncoding\Helpers\FiltroEncodingEscrita;

$numeroCurso = 1;
$meusCursos = fopen("arquivos/MeusCursos.txt", "r");
$cursosCSV = new SplFileObject("arquivos/meusCursos.csv", "w+");

stream_filter_register('encoding.escrita', FiltroEncodingEscrita::class);
stream_filter_append($meusCursos, "encoding.escrita");

while(!feof($meusCursos)) {
    $linha = [$numeroCurso , trim(fgets($meusCursos))];
    //Delimitador ;(ponto e vírgula) é padrão do excel
    $cursosCSV->fputcsv($linha,";");
    $numeroCurso += 1;
}

fclose($meusCursos);