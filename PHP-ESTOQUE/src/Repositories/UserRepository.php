<?php

namespace App\Repositories;

use App\Database\ConnectionDB;
use App\Models\User;
use Exception;
use PDO;
use PDOException;

class UserRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = ConnectionDB::conectar();
    }

    public function verificarEmail($email): void
    {
        try {
            $stmt = $this->db->prepare("SELECT EXISTS
            (SELECT 1
            FROM usuarios
            WHERE email = :email)");

            $stmt->execute(["email" => $email]);

            if ($stmt->fetchColumn()) {
                throw new \Exception("Email já está cadastrado.");
            }

            return;
        } catch (\PDOException $e) {
            // dd($e->getMessage());
            throw new \Exception("Ocorreu um erro ao criar o usuario.");
        }
    }

    public function salvar(User $user): int
    {
        try {
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(":nome", $user->nome);
            $stmt->bindValue(":email", $user->email);
            $stmt->bindValue(":senha", $user->senha);
            $stmt->execute([
                ":nome"  => $user->nome,
                ":email" => $user->email,
                ":senha" => password_hash($user->senha, PASSWORD_BCRYPT)
            ]);


            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            throw new \Exception("Ocorreu um erro ao criar o usuario.");
        }
    }

    public function buscarUsuarioPorEmail(string $email): User
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
            $stmt->execute(["email" => $email]);

            $dados = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$dados) {
                throw new \Exception("E-mail ou senha inválidos.");
            }

            return new User(
                $dados["nome"],
                $dados["email"],
                $dados["senha"],
                (int)$dados["id"],
                $dados["deletado_em"]
            );
        } catch (\PDOException $e) {
            throw new \Exception("Tivemos um problema ao localizar o usuário nos nossos registros.");
        }
    }
}
