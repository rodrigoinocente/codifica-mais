<?php

namespace App\Database;

use Exception;
use PDO;
use PDOException;

class ConnectionDB
{
    private static $instance = null;

    public static function conectar()
    {
        try {
            $host = "localhost";
            $db   = "sistema_login";
            $usuario = "codifica-mais";
            $senha = "123456";

            self::$instance = new PDO(
                "mysql:host=$host;dbname=$db;charset=utf8mb4",
                $usuario,
                $senha,
                [
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION,
                ]
            );
        } catch (PDOException $e) {
            throw new Exception("Estamos com problemas. Tente mais tarde.");
        }
        return self::$instance;
    }
}
