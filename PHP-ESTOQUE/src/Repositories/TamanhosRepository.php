<?php

namespace App\Repositories;

use App\Database\ConnectionDB;
use App\Models\Tamanhos;
use Exception;
use PDO;
use PDOException;

class TamanhosRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = ConnectionDB::conectar();
    }

    public function existeNomeTamannho($nome, $usuarioId): bool
    {
        try {
            $stmt = $this->db->prepare("SELECT EXISTS
            (SELECT 1
            FROM tamanhos
            WHERE LOWER(nome) = LOWER(:nome)
            AND (usuario_id = :usuarioId OR usuario_id IS NULL)
            AND deletado_em IS NULL
            )");

            $stmt->execute([
                "nome" => trim($nome),
                "usuarioId" => $usuarioId
            ]);

            return (bool) $stmt->fetchColumn();
        } catch (\PDOException $e) {
            throw new \Exception("Ocorreu um erro de verificaçao.");
        }
    }

    public function salvar(Tamanhos $tamanho): bool
    {
        try {
            $sql = "INSERT INTO tamanhos (usuario_id, nome) VALUES (:usuario_id, :nome)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(":usuario_id", $tamanho->usuario_id);
            $stmt->bindValue(":nome", $tamanho->nome);

            return $stmt->execute([
                ":usuario_id"  => $tamanho->usuario_id,
                ":nome" => $tamanho->nome,
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Ocorreu um erro ao criar o tamanho.");
        }
    }

    public function buscarTodasPorUsuario(int $usuarioId): array
    {
        try {
            $sql = "SELECT id, nome 
            FROM tamanhos 
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

    public function existeIdTamanho($id, $usuarioId): bool
    {
        try {
            $stmt = $this->db->prepare("SELECT EXISTS
            (SELECT 1
            FROM tamanhos
            WHERE id = :id
            AND (usuario_id = :usuarioId OR usuario_id IS NULL)
            AND deletado_em IS NULL
            )");

            $stmt->execute([
                "id" => trim($id),
                "usuarioId" => $usuarioId
            ]);

            return (bool) $stmt->fetchColumn();
        } catch (\PDOException $e) {
            dd($e->getMessage());
            throw new \Exception("Ocorreu um erro de verificaçao.");
        }
    }

    public function buscaCompletaPorUsuario(int $usuarioId): array
    {
        try {
            $sql = "SELECT *
            FROM tamanhos 
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

    public function excluirTamanho($tamanhoId, $usuarioId)
    {
        try {
            $sql = "UPDATE tamanhos 
                SET deletado_em = NOW() 
                WHERE id = :tamanhoId 
                AND usuario_id = :usuarioId";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'tamanhoId' => $tamanhoId,
                'usuarioId' => $usuarioId
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Ocorreu um erro ao excluir o tamanho");
        }
    }

    public function recuperarTamanho($tamanhoId, $usuarioId)
    {
        try {
            $sql = "UPDATE tamanhos 
                SET deletado_em = NULL
                WHERE id = :tamanhoId 
                AND usuario_id = :usuarioId";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'tamanhoId' => $tamanhoId,
                'usuarioId' => $usuarioId
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Ocorreu um erro ao excluir o tamanho");
        }
    }

}
