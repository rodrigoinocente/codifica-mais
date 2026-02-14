<?php

namespace App\Models;

use Exception;

class Cores
{
    public int $usuario_id;
    public string $nome;
    public ?int $id;
    public ?string $criado_em;
    public ?string $deletado_em;

    public function __construct(
        string $usuario_id,
        string $nome,
        ?int $id = null,
        ?string $criado_em = null,
        ?string $deletado_em = null,
    ) {
        $this->usuario_id = $usuario_id;
        $this->nome = trim($nome);
        $this->id = $id;
        $this->criado_em = $criado_em;
        $this->deletado_em = $deletado_em;
    }

    public function ehvalido(): array
    {
      if (empty($this->nome) || mb_strlen($this->nome) < 3) {
        return ['erro' => true, 'mensagem' => 'Campo nome deve ter menos que 3 caracteres'];
      }
      return ['erro' => false, 'mensagem' => null];
    }
}
