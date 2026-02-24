<?php
//ini_set('memory_limit', '1G');
$pastaAtual = __DIR__;
$pastaZipBase = __DIR__ . '/zip-logs';
$tamanhoMaximo = 80;

clearstatcache();

if (!is_dir($pastaZipBase)) {
  mkdir($pastaZipBase, 0775, true);
}

$arquivosLog = glob($pastaAtual . '/*.log');

foreach ($arquivosLog as $arquivo) {
  clearstatcache(true, $arquivo);

  if (filesize($arquivo) < $tamanhoMaximo) {
    continue;
  }

  $conteudo = file_get_contents($arquivo);
  $nomeBase = pathinfo($arquivo, PATHINFO_FILENAME);
  $caminhoZip = $pastaZipBase . '/' . $nomeBase . '.zip';
  $zip = new ZipArchive();

  if ($zip->open($caminhoZip, ZipArchive::CREATE) !== true) {
    continue;
  }

  $nomeInterno = strtoupper($nomeBase) . '-' . date('Y-m-d_H-i-s') . '.log';
  $zip->addFromString($nomeInterno, $conteudo);
  $zip->close();
  file_put_contents($arquivo, '');

  echo "Arquivo {$nomeBase} compactado com sucesso.\n";
}