<?php

namespace App\Repositories;

use App\Database\ConnectionDB;
use App\Models\Produtos;
use Exception;
use PDO;
use PDOException;

class ProdutosRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = ConnectionDB::conectar();
    }

    // public function existeNomeProduto($nome, $usuarioId): bool
    // {
    //     try {
    //         $stmt = $this->db->prepare("SELECT EXISTS
    //         (SELECT 1
    //         FROM produtos
    //         WHERE LOWER(nome) = LOWER(:nome)
    //         AND usuario_id = :usuarioId
    //         AND deletado_em IS NULL
    //         )");

    //         $stmt->execute([
    //             "nome" => trim($nome),
    //             "usuarioId" => $usuarioId
    //         ]);

    //         return (bool) $stmt->fetchColumn();
    //     } catch (\PDOException $e) {
    //         throw new \Exception("Ocorreu um erro de verificaçao.");
    //     }
    // }

    public function salvar(Produtos $produtos): bool
    {
        try {
            $sql = "INSERT INTO produtos (
            usuario_id, 
            marca_id, 
            cor_id, 
            categoria_id, 
            tamanho_id, 
            genero_id, 
            segmento_id, 
            nome, 
            quantidade, 
            descricao
            ) 
            VALUES (
            :usuario_id, 
            :marca_id, 
            :cor_id, 
            :categoria_id, 
            :tamanho_id, 
            :genero_id, 
            :segmento_id, 
            :nome, 
            :quantidade, 
            :descricao
            )";

            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(":usuario_id", $produtos->usuario_id);
            $stmt->bindValue(":marca_id", $produtos->marca_id);
            $stmt->bindValue(":cor_id", $produtos->cor_id);
            $stmt->bindValue(":categoria_id", $produtos->categoria_id);
            $stmt->bindValue(":tamanho_id", $produtos->tamanho_id);
            $stmt->bindValue(":genero_id", $produtos->genero_id);
            $stmt->bindValue(":segmento_id", $produtos->segmento_id);
            $stmt->bindValue(":nome", $produtos->nome);
            $stmt->bindValue(":quantidade", $produtos->quantidade);
            $stmt->bindValue(":descricao", $produtos->descricao);

            return $stmt->execute([
                ":usuario_id" => $produtos->usuario_id,
                ":marca_id" => $produtos->marca_id,
                ":cor_id" => $produtos->cor_id,
                ":categoria_id" => $produtos->categoria_id,
                ":tamanho_id" => $produtos->tamanho_id,
                ":genero_id" => $produtos->genero_id,
                ":segmento_id" => $produtos->segmento_id,
                ":nome" => $produtos->nome,
                ":quantidade" => $produtos->quantidade,
                ":descricao" => $produtos->descricao,
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Ocorreu um erro ao criar a cor.");
        }
    }

    public function buscarProdutos(int $usuarioId, int $limite = 100, int $offset = 0): array
    {
        try {
            $sql = "SELECT 
                    produtos.id, 
                    produtos.nome AS nome, 
                    produtos.quantidade, 
                    produtos.descricao,
                    marcas.nome AS marca,
                    cores.nome AS cor,
                    categorias.nome AS categoria,
                    tamanhos.nome AS tamanho,
                    generos.nome AS genero,
                    segmentos.nome AS segmento
                    FROM produtos
                    JOIN marcas ON produtos.marca_id = marcas.id
                    JOIN cores ON produtos.cor_id = cores.id
                    JOIN categorias ON produtos.categoria_id = categorias.id
                    JOIN tamanhos ON produtos.tamanho_id = tamanhos.id
                    JOIN generos ON produtos.genero_id = generos.id
                    JOIN segmentos ON produtos.segmento_id = segmentos.id
                    WHERE produtos.usuario_id = :usuario_id 
                    AND produtos.deletado_em IS NULL 
                    ORDER BY produtos.id DESC
                    LIMIT :limite 
                    OFFSET :offset";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
            $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            throw new \Exception("Erro ao buscar produtos paginados.");
        }
    }
    public function buscarPorId(int $produtoId, int $usuarioId)
    {
        try {
            $sql = "SELECT * FROM produtos 
                WHERE id = :produtoId 
                AND usuario_id = :usuarioId 
                AND deletado_em IS NULL";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':usuarioId', $usuarioId, PDO::PARAM_INT);
            $stmt->bindValue(':produtoId', $produtoId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            throw new \Exception("Erro ao buscar produtos paginados.");
        }
    }

    public function atualizar(Produtos $produto): bool
    {
        try {
            $sql = "UPDATE produtos 
                    SET 
                    nome = :nome, 
                    quantidade = :quantidade, 
                    descricao = :descricao, 
                    marca_id = :marca_id, 
                    cor_id = :cor_id, 
                    categoria_id = :categoria_id, 
                    tamanho_id = :tamanho_id, 
                    genero_id = :genero_id, 
                    segmento_id = :segmento_id,
                    atualizado_em = NOW()
                    WHERE id = :id 
                    AND usuario_id = :usuario_id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(':id', $produto->id, \PDO::PARAM_INT);
            $stmt->bindValue(':usuario_id', $produto->usuario_id, \PDO::PARAM_INT);
            $stmt->bindValue(':nome', $produto->nome, \PDO::PARAM_STR);
            $stmt->bindValue(':quantidade', $produto->quantidade, \PDO::PARAM_INT);
            $stmt->bindValue(':descricao', $produto->descricao ?? null, \PDO::PARAM_STR);
            $stmt->bindValue(':marca_id', $produto->marca_id, \PDO::PARAM_INT);
            $stmt->bindValue(':cor_id', $produto->cor_id, \PDO::PARAM_INT);
            $stmt->bindValue(':categoria_id', $produto->categoria_id, \PDO::PARAM_INT);
            $stmt->bindValue(':tamanho_id', $produto->tamanho_id, \PDO::PARAM_INT);
            $stmt->bindValue(':genero_id', $produto->genero_id, \PDO::PARAM_INT);
            $stmt->bindValue(':segmento_id', $produto->segmento_id, \PDO::PARAM_INT);

            return $stmt->execute();
        } catch (\Throwable $e) {
            throw new \Exception("Erro ao atualizar o produto.");
        }
    }

    public function deletar(int $produtoId, int $usuarioId): bool
    {
        try {
            $sql = "UPDATE produtos 
                SET deletado_em = NOW() 
                WHERE id = :produtoId 
                AND usuario_id = :usuarioId";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'produtoId' => $produtoId,
                'usuarioId' => $usuarioId
            ]);

            return $stmt->rowCount() > 0;
        } catch (\PDOException $e) {
            throw new \Exception("Erro ao deletar o produto.");
        }
    }

    public function buscarProdutosExcluidos(int $usuarioId, int $limite = 100, int $offset = 0): array
    {
        try {
            $sql = "SELECT 
                p.id, p.nome, p.quantidade, p.descricao,
                m.nome AS marca,
                c.nome AS cor,
                cat.nome AS categoria,
                t.nome AS tamanho,
                g.nome AS genero,
                s.nome AS segmento
                FROM produtos p
                JOIN marcas m ON p.marca_id = m.id
                JOIN cores c ON p.cor_id = c.id
                JOIN categorias cat ON p.categoria_id = cat.id
                JOIN tamanhos t ON p.tamanho_id = t.id
                JOIN generos g ON p.genero_id = g.id
                JOIN segmentos s ON p.segmento_id = s.id
                WHERE p.usuario_id = :usuario_id 
                AND p.deletado_em IS NOT NULL 
                ORDER BY p.deletado_em DESC
                LIMIT :limite OFFSET :offset";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':usuario_id', $usuarioId, \PDO::PARAM_INT);
            $stmt->bindValue(':limite', $limite, \PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erro ao buscar produtos paginados.");
        }
    }

    public function recuperarProduto(int $produtoId, int $usuarioId): bool
    {
        try {
            $sql = "UPDATE produtos 
                SET deletado_em = NULL 
                WHERE id = :produtoId 
                AND usuario_id = :usuarioId";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'produtoId' => $produtoId,
                'usuarioId' => $usuarioId
            ]);

            return $stmt->rowCount() > 0;
        } catch (\PDOException $e) {
            throw new \Exception("Erro ao recuperar o produto.");
        }
    }
}
