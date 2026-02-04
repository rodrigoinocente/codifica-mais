<?php

namespace App\Repositories;

use App\Database\ConnectionDB;
use App\Models\Generos;
use Exception;
use PDO;
use PDOException;

class GenerosRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = ConnectionDB::conectar();
    }

    public function existeNomeGenero($nome, $usuarioId): bool
    {
        try {
            $sql = "SELECT EXISTS (
            SELECT 1
            FROM generos
            WHERE LOWER(nome) = LOWER(:nome)
            AND (usuario_id = :usuarioId OR usuario_id IS NULL)
            AND deletado_em IS NULL
        )";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                "nome" => trim($nome),
                "usuarioId" => $usuarioId
            ]);

            return (bool) $stmt->fetchColumn();
        } catch (\PDOException $e) {
            throw new \Exception("Erro na verificação: " . $e->getMessage());
        }
    }

    public function salvar(Generos $genero): bool
    {
        try {
            $sql = "INSERT INTO generos (usuario_id, nome) VALUES (:usuario_id, :nome)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(":usuario_id", $genero->usuario_id);
            $stmt->bindValue(":nome", $genero->nome);

            return $stmt->execute([
                ":usuario_id"  => $genero->usuario_id,
                ":nome" => $genero->nome,
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Ocorreu um erro ao criar o gênero.");
        }
    }

    public function buscarTodasPorUsuario(int $usuarioId): array
    {
        try {
            $sql = "SELECT id, nome 
            FROM generos 
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

    public function existeIdGenero($id, $usuarioId): bool
    {
        try {
            $stmt = $this->db->prepare("SELECT EXISTS
            (SELECT 1
            FROM generos
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
            throw new \Exception("Ocorreu um erro de verificaçao.");
        }
    }

    public function buscaCompletaPorUsuario(int $usuarioId): array
    {
        try {
            $sql = "SELECT *
            FROM generos 
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

    public function excluirGenero($generoId, $usuarioId)
    {
        try {
            $sql = "UPDATE generos 
                SET deletado_em = NOW() 
                WHERE id = :generoId 
                AND usuario_id = :usuarioId";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'generoId' => $generoId,
                'usuarioId' => $usuarioId
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Ocorreu um erro ao excluir o gênero");
        }
    }

    public function repucperarGenero($generoId, $usuarioId)
    {
        try {
            $sql = "UPDATE generos 
                SET deletado_em = NULL
                WHERE id = :generoId 
                AND usuario_id = :usuarioId";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'generoId' => $generoId,
                'usuarioId' => $usuarioId
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Ocorreu um erro ao excluir o gênero");
        }
    }

}
