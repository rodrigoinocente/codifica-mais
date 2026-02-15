<?php

namespace App\Repositories;

use App\Database\ConnectionDB;
use App\Models\Generos;
use PDO;

class GenerosRepository
{
  private PDO $db;

  public function __construct()
  {
    $this->db = ConnectionDB::conectar();
  }

  public function existeNomeGenero($nome, $usuarioId): bool
  {
    $stmt = $this->db->prepare(
      "SELECT EXISTS (
              SELECT 1
              FROM generos
              WHERE LOWER(nome) = LOWER(:nome)
              AND (usuario_id = :usuarioId OR usuario_id IS NULL))");

    $stmt->execute([
      "nome" => trim($nome),
      "usuarioId" => $usuarioId
    ]);

    return (bool) $stmt->fetchColumn();
  }

  public function salvar(Generos $genero): bool
  {
    $sql = "INSERT INTO generos (usuario_id, nome) VALUES (:usuario_id, :nome)";
    $stmt = $this->db->prepare($sql);

    $stmt->bindValue(":usuario_id", $genero->usuario_id);
    $stmt->bindValue(":nome", $genero->nome);

    return $stmt->execute([
      ":usuario_id"  => $genero->usuario_id,
      ":nome" => $genero->nome,
    ]);
  }

  public function buscarTodasPorUsuario(int $usuarioId): array
  {
    $sql = "SELECT id, nome 
            FROM generos 
            WHERE (usuario_id IS NULL OR usuario_id = :usuario_id) 
            AND deletado_em IS NULL 
            ORDER BY nome ASC";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function existeIdGenero($id, $usuarioId): bool
  {
    $stmt = $this->db->prepare(
    "SELECT 1
            FROM generos
            WHERE id = :id
            AND (usuario_id = :usuarioId OR usuario_id IS NULL)
            LIMIT 1");

    $stmt->execute([
      "id" => $id,
      "usuarioId" => $usuarioId
    ]);

    return (bool) $stmt->fetchColumn();
  }

  public function getTodasPorUsuario(int $usuarioId): array
  {
    $sql = "SELECT *
            FROM generos 
            WHERE (usuario_id IS NULL OR usuario_id = :usuario_id) 
            ORDER BY nome ASC";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function excluirGenero($generoId, $usuarioId): bool
  {
    $sql = "UPDATE generos 
        SET deletado_em = NOW() 
        WHERE id = :generoId 
        AND usuario_id = :usuarioId";

    $stmt = $this->db->prepare($sql);
    return $stmt->execute([
      'generoId' => $generoId,
      'usuarioId' => $usuarioId
    ]);
  }

  public function recuperarGenero($generoId, $usuarioId): bool
  {
    $sql = "UPDATE generos 
        SET deletado_em = NULL
        WHERE id = :generoId 
        AND usuario_id = :usuarioId";

    $stmt = $this->db->prepare($sql);
    return $stmt->execute([
      'generoId' => $generoId,
      'usuarioId' => $usuarioId
    ]);
  }
}
