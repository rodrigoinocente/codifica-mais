<?php

namespace App\Repositories;

use App\Database\ConnectionDB;
use App\Models\Segmentos;
use PDO;

class SegmentosRepository
{
  private PDO $db;

  public function __construct()
  {
    $this->db = ConnectionDB::conectar();
  }

  public function existeNomeSegmento($nome, $usuarioId): bool
  {
    $stmt = $this->db->prepare(
    "SELECT 1
            FROM segmentos
            WHERE LOWER(nome) = LOWER(:nome)
            AND (usuario_id = :usuarioId OR usuario_id IS NULL)
            ");

    $stmt->execute([
      "nome" => trim($nome),
      "usuarioId" => $usuarioId
    ]);

    return (bool) $stmt->fetchColumn();
  }

  public function salvar(Segmentos $segmentos): bool
  {
    $sql = "INSERT INTO segmentos (usuario_id, nome) VALUES (:usuario_id, :nome)";
    $stmt = $this->db->prepare($sql);

    $stmt->bindValue(":usuario_id", $segmentos->usuario_id);
    $stmt->bindValue(":nome", $segmentos->nome);

    return $stmt->execute([
      ":usuario_id" => $segmentos->usuario_id,
      ":nome" => $segmentos->nome,
    ]);
  }

  public function buscarTodasPorUsuario(int $usuarioId): array
  {
    $sql = "SELECT id, nome 
            FROM segmentos 
            WHERE (usuario_id IS NULL OR usuario_id = :usuario_id) 
            AND deletado_em IS NULL 
            ORDER BY nome ASC";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function existeIdSegmento($id, $usuarioId): bool
  {
    $stmt = $this->db->prepare(
    "SELECT 1
            FROM segmentos
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
            FROM segmentos 
            WHERE (usuario_id IS NULL OR usuario_id = :usuario_id) 
            ORDER BY nome ASC";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function excluirSegmento($segmentoId, $usuarioId): bool
  {
    $sql = "UPDATE segmentos 
            SET deletado_em = NOW() 
            WHERE id = :segmentoId 
            AND usuario_id = :usuarioId";

    $stmt = $this->db->prepare($sql);
    return $stmt->execute([
      'segmentoId' => $segmentoId,
      'usuarioId' => $usuarioId
    ]);
  }

  public function recuperarSegmento($segmentoId, $usuarioId): bool
  {
    $sql = "UPDATE segmentos 
            SET deletado_em = NULL
            WHERE id = :segmentoId 
            AND usuario_id = :usuarioId";

    $stmt = $this->db->prepare($sql);
    return $stmt->execute([
      'segmentoId' => $segmentoId,
      'usuarioId' => $usuarioId
    ]);
  }
}
