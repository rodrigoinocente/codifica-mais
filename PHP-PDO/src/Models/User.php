<?php

namespace App\Models;

use Exception;

class User
{
    public ?int $id;
    public string $nome;
    public string $email;
    public string $senha;
    public ?string $deletado_em;

    public function __construct(
        $nome,
        $email,
        $senha,
        ?int $id = null,
        ?string $deletado_em = null
    ) {
        $this->nome = trim($nome);
        $this->email = trim($email);
        $this->senha = $senha;
        $this->id = $id;
        $this->deletado_em = $deletado_em;
    }

    public function ehvalido()
    {
        if (empty($this->nome) || strlen($this->nome) < 3) {
            throw new Exception("Nome inválido.");
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("E-mail inválido.");
        }
    }
}
