<?php

namespace App\Repositories;

use App\Database\ConnectionDB;
use App\Models\Cores;
use Exception;
use PDO;
use PDOException;

class CoresRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = ConnectionDB::conectar();
    }

    public function ExisteNomeCor($nome, $usuarioId): bool
    {
      $stmt = $this->db->prepare(
        "SELECT 1
                FROM cores
                WHERE LOWER(nome) = LOWER(:nome)
                AND (usuario_id = :usuarioId OR usuario_id IS NULL)
                ");

      $stmt->execute([
        "nome" => trim($nome),
        "usuarioId" => $usuarioId
      ]);

      return (bool) $stmt->fetchColumn();
    }

    public function salvar(Cores $cor): bool
    {
      $sql = "INSERT INTO cores (usuario_id, nome) VALUES (:usuario_id, :nome)";
      $stmt = $this->db->prepare($sql);

      $stmt->bindValue(":usuario_id", $cor->usuario_id);
      $stmt->bindValue(":nome", $cor->nome);

      return $stmt->execute([
          ":usuario_id"  => $cor->usuario_id,
          ":nome" => $cor->nome,
      ]);
    }

    public function buscarTodasPorUsuario(int $usuarioId): array
    {
        try {
            $sql = "SELECT id, nome
            FROM cores 
            WHERE (usuario_id IS NULL OR usuario_id = :usuario_id) 
            AND deletado_em IS NULL 
            ORDER BY nome ASC";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            throw new \Exception("Ocorreu um erro ao pesquisar as cores");
        }
    }

    public function existeIdCor($id, $usuarioId): bool
    {
        $stmt = $this->db->prepare(
        "SELECT 1
                FROM cores
                WHERE id = :id
                AND (usuario_id = :usuarioId OR usuario_id IS NULL)
                LIMIT 1");

        $stmt->execute([
          "id" => $id,
          "usuarioId" => $usuarioId
        ]);

        return (bool) $stmt->fetchColumn();
    }

    public function buscaCompletaPorUsuario(int $usuarioId): array
    {
        try {
            $sql = "SELECT *
            FROM cores 
            WHERE (usuario_id IS NULL OR usuario_id = :usuario_id) 
            ORDER BY nome ASC";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            throw new \Exception("Ocorreu um erro ao pesquisar as cores");
        }
    }

    public function excluirCor($corId, $usuarioId): bool
    {
      $sql = "UPDATE cores 
          SET deletado_em = NOW() 
          WHERE id = :corId 
          AND usuario_id = :usuarioId";

      $stmt = $this->db->prepare($sql);
      return $stmt->execute([
        'corId' => $corId,
        'usuarioId' => $usuarioId
      ]);
    }

    public function recuperarCor($corId, $usuarioId)
    {
      $sql = "UPDATE cores 
          SET deletado_em = NULL
          WHERE id = :corId 
          AND usuario_id = :usuarioId";

      $stmt = $this->db->prepare($sql);
      return $stmt->execute([
        'corId' => $corId,
        'usuarioId' => $usuarioId
      ]);
  }
}
