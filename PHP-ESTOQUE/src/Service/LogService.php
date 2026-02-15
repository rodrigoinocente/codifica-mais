<?php

namespace App\Service;
class LogService {
  public static function registrarErro(\Exception $e): void {
    $diretorio = __DIR__ . '/../../src/logs/erro.log';
    $data = date('Y-m-d H:i:s');
    $usuarioId = $_SESSION['usuario']['id'] ?? 'NULL';
    $rota = $_SERVER['REQUEST_URI'] ?? 'NULL';
    $metodo = $_SERVER['REQUEST_METHOD'] ?? 'NULL';

    $mensagem = <<<LOG
[$data] [CRITICAL_ERROR] [USER: $usuarioId] [METODO: $metodo] [ROTA: $rota]
MESSAGE: {$e->getMessage()}
FILE: {$e->getFile()} (Linha: {$e->getLine()})
--------------------------------------------------------------------------------

LOG;

    file_put_contents($diretorio , $mensagem, FILE_APPEND);
  }
}