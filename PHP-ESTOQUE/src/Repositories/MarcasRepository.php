<?php

namespace App\Repositories;

use App\Database\ConnectionDB;
use App\Models\Marcas;
use Exception;
use PDO;
use PDOException;

class MarcasRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = ConnectionDB::conectar();
    }

    public function existeNomeMarca($nome, $usuarioId): bool
    {
      $stmt = $this->db->prepare(
        "SELECT 1
                FROM marcas
                WHERE LOWER(nome) = LOWER(:nome)
                AND usuario_id = :usuarioId 
                ");

      $stmt->execute([
          "nome" => trim($nome),
          "usuarioId" => $usuarioId
      ]);

      return (bool) $stmt->fetchColumn();
    }

    public function salvar(Marcas $marca): bool
    {
      $sql = "INSERT INTO marcas (usuario_id, nome) VALUES (:usuario_id, :nome)";
      $stmt = $this->db->prepare($sql);

      $stmt->bindValue(":usuario_id", $marca->usuario_id);
      $stmt->bindValue(":nome", $marca->nome);

      return $stmt->execute([
        ":usuario_id"  => $marca->usuario_id,
        ":nome" => $marca->nome,
      ]);
    }

    public function buscarTodasPorUsuario(int $usuarioId): array
    {
      $sql = "SELECT id, nome 
      FROM marcas 
      WHERE (usuario_id IS NULL OR usuario_id = :usuario_id) 
      AND deletado_em IS NULL 
      ORDER BY nome ASC";

      $stmt = $this->db->prepare($sql);
      $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function existeIdMarca($id, $usuarioId): bool
    {
      $stmt = $this->db->prepare(
      "SELECT 1
              FROM marcas
              WHERE id = :id
              AND usuario_id = :usuarioId 
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
              FROM marcas 
              WHERE (usuario_id IS NULL OR usuario_id = :usuario_id) 
              ORDER BY nome ASC";

      $stmt = $this->db->prepare($sql);
      $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     public function excluirMarca($marcaId, $usuarioId): bool
     {
      $sql = "UPDATE marcas 
          SET deletado_em = NOW() 
          WHERE id = :marcaId 
          AND usuario_id = :usuarioId";

      $stmt = $this->db->prepare($sql);
      return $stmt->execute([
        'marcaId' => $marcaId,
        'usuarioId' => $usuarioId
      ]);
    }

    public function recuperarMarca($marcaId, $usuarioId): bool
    {
      $sql = "UPDATE marcas 
          SET deletado_em = NULL
          WHERE id = :marcaId 
          AND usuario_id = :usuarioId";

      $stmt = $this->db->prepare($sql);
      return $stmt->execute([
          'marcaId' => $marcaId,
          'usuarioId' => $usuarioId
      ]);
    }
}