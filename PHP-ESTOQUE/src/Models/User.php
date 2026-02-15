<?php

namespace App\Models;

class User
{
  public ?int $id;
  public string $nome;
  public string $email;
  public ?string $senha;
  public ?string $deletado_em;

  public function __construct(
    $nome,
    $email,
    $senha,
    ?int $id = null,
    ?string $criado_em = null,
    ?string $deletado_em = null
  ) {
    $this->nome = trim($nome);
    $this->email = trim($email);
    $this->senha = $senha;
    $this->id = $id;
    $this->criado_em = $criado_em;
    $this->deletado_em = $deletado_em;
  }

  public function ehvalido(): array
  {
    if (empty($this->nome) || mb_strlen($this->nome) < 3) {
      return ['erro' => true, 'mensagem' => 'Campo nome deve ter menos que 3 caracteres.'];
    }
    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      return ['erro' => true, 'mensagem' => 'E-mail inválido.'];
    }

    return ['erro' => false, 'mensagem' => null];
  }
}
