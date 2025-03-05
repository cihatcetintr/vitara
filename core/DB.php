<?php

namespace Core;

class DB
{
    private static ?\PDO $instance = null;
    
    public static function getInstance(): \PDO
    {
        if (self::$instance === null) {
            $dsn = sprintf(
                "mysql:host=%s;dbname=%s;charset=utf8mb4",
                $_ENV['DB_HOST'] ?? 'localhost',
                $_ENV['DB_NAME'] ?? 'test'
            );
            
            self::$instance = new \PDO(
                $dsn,
                $_ENV['DB_USER'] ?? 'root',
                $_ENV['DB_PASS'] ?? '',
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
            );
        }
        
        return self::$instance;
    }
    
    public static function query(string $sql, array $params = []): \PDOStatement
    {
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
} 