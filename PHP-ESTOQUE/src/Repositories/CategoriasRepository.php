<?php

namespace App\Repositories;

use App\Database\ConnectionDB;
use App\Models\Categorias;
use Exception;
use PDO;
use PDOException;

class CategoriasRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = ConnectionDB::conectar();
    }

    public function exiteNomeCategoria($nome, $usuarioId): bool
    {
        try {
            $stmt = $this->db->prepare("SELECT EXISTS
            (SELECT 1
            FROM categorias
            WHERE LOWER(nome) = LOWER(:nome)
            AND usuario_id = :usuarioId
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

    public function salvar(Categorias $categoria): bool
    {
        try {
            $sql = "INSERT INTO categorias (usuario_id, nome) VALUES (:usuario_id, :nome)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(":usuario_id", $categoria->usuario_id);
            $stmt->bindValue(":nome", $categoria->nome);

            return $stmt->execute([
                ":usuario_id"  => $categoria->usuario_id,
                ":nome" => $categoria->nome,
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Ocorreu um erro ao criar a categoria.");
        }
    }

    public function buscarTodasPorUsuario(int $usuarioId): array
    {
        try {
            $sql = "SELECT id, nome, usuario_id
            FROM categorias 
            WHERE usuario_id IS NULL OR usuario_id = :usuario_id
            AND deletado_em IS NULL 
            ORDER BY nome ASC";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            throw new \Exception("Ocorreu um erro ao pesquisar as categorias.");
        }
    }

    public function existeIdCategoria($id, $usuarioId): bool

    {
        try {
            $stmt = $this->db->prepare("SELECT EXISTS
            (SELECT 1
            FROM categorias
            WHERE id = :id
            AND usuario_id = :usuarioId 
            AND deletado_em IS NULL
            )");

            $stmt->execute([
                "id" => trim($id),
                "usuarioId" => $usuarioId
            ]);

            return (bool) $stmt->fetchColumn();
        } catch (\PDOException $e) {
            throw new \Exception("Ocorreu um erro de verificaçao.");
        }
    }

    public function buscaCompletaPorUsuario(int $usuarioId): array
    {
        try {
            $sql = "SELECT *
            FROM categorias 
            WHERE (usuario_id IS NULL OR usuario_id = :usuario_id) 
            ORDER BY nome ASC";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            throw new \Exception("Ocorreu um erro ao pesquisar as categorias.");
        }
    }

    public function excluirCategoria($categoriaId, $usuarioId)
    {
        try {
            $sql = "UPDATE categorias 
                SET deletado_em = NOW() 
                WHERE id = :categoriaId 
                AND usuario_id = :usuarioId";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'categoriaId' => $categoriaId,
                'usuarioId' => $usuarioId
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Ocorreu um erro ao excluir a categoria");
        }
    }

    public function recuperarCategoria($categoriaId, $usuarioId)
    {
        try {
            $sql = "UPDATE categorias 
                SET deletado_em = NULL
                WHERE id = :categoriaId 
                AND usuario_id = :usuarioId";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'categoriaId' => $categoriaId,
                'usuarioId' => $usuarioId
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Ocorreu um erro ao excluir a categoria");
        }
    }
}
