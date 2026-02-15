<?php

namespace App\Database;

use PDO;

class ConnectionDB
{
    private static PDO|null $instance;

    public static function conectar(): PDO
    {
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

        return self::$instance;
      }
}
