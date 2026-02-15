<?php

namespace App\Repositories;

use App\Database\ConnectionDB;
use App\Models\Tamanhos;
use PDO;

class TamanhosRepository
{
  private PDO $db;

  public function __construct()
  {
    $this->db = ConnectionDB::conectar();
  }

  public function existeNomeTamannho($nome, $usuarioId): bool
  {
    $stmt = $this->db->prepare(
      "SELECT 1
              FROM tamanhos
              WHERE LOWER(nome) = LOWER(:nome)
              AND (usuario_id = :usuarioId OR usuario_id IS NULL)
              AND deletado_em IS NULL
              ");

    $stmt->execute([
      "nome" => trim($nome),
      "usuarioId" => $usuarioId
    ]);

    return (bool) $stmt->fetchColumn();
  }

  public function salvar(Tamanhos $tamanho): bool
  {
    $sql = "INSERT INTO tamanhos (usuario_id, nome) VALUES (:usuario_id, :nome)";
    $stmt = $this->db->prepare($sql);

    $stmt->bindValue(":usuario_id", $tamanho->usuario_id);
    $stmt->bindValue(":nome", $tamanho->nome);

    return $stmt->execute([
      ":usuario_id"  => $tamanho->usuario_id,
      ":nome" => $tamanho->nome,
    ]);
  }

  public function buscarTodasPorUsuario(int $usuarioId): array
  {
    $sql = "SELECT id, nome 
            FROM tamanhos 
            WHERE (usuario_id IS NULL OR usuario_id = :usuario_id) 
            AND deletado_em IS NULL 
            ORDER BY nome ASC";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function existeIdTamanho($id, $usuarioId): bool
  {
    $stmt = $this->db->prepare(
    "SELECT 1
            FROM tamanhos
            WHERE id = :id
            AND (usuario_id = :usuarioId OR usuario_id IS NULL)
            LIMIT 1");

    $stmt->execute([
      "id" => trim($id),
      "usuarioId" => $usuarioId
    ]);

    return (bool) $stmt->fetchColumn();
  }

  public function getTodasPorUsuario(int $usuarioId): array
  {
    $sql = "SELECT *
            FROM tamanhos 
            WHERE (usuario_id IS NULL OR usuario_id = :usuario_id) 
            ORDER BY nome ASC";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function excluirTamanho($tamanhoId, $usuarioId)
  {
    $sql = "UPDATE tamanhos 
            SET deletado_em = NOW() 
            WHERE id = :tamanhoId 
            AND usuario_id = :usuarioId";

    $stmt = $this->db->prepare($sql);
    return $stmt->execute([
      'tamanhoId' => $tamanhoId,
      'usuarioId' => $usuarioId
    ]);
  }

  public function recuperarTamanho($tamanhoId, $usuarioId): bool
  {
    $sql = "UPDATE tamanhos 
            SET deletado_em = NULL
            WHERE id = :tamanhoId 
            AND usuario_id = :usuarioId";

    $stmt = $this->db->prepare($sql);
    return $stmt->execute([
      'tamanhoId' => $tamanhoId,
      'usuarioId' => $usuarioId
    ]);
  }

}
