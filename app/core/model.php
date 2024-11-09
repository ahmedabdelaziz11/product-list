<?php

namespace App\core;

use PDO;
use PDOException;

abstract class model
{
    protected $db;
    protected $tableName;
    protected $query;
    protected $params = [];

    public function __construct(string $tableName)
    {
        $this->db = $this->connect();
        $this->tableName = $tableName;
    }


    private function connect(): PDO
    {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            return new PDO($dsn, DB_USER, DB_PASSWORD, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            throw new PDOException("Database connection failed: " . $e->getMessage());
        }
    }


    public function select(array $columns = ['*']): self
    {
        $this->query = "SELECT " . implode(', ', $columns) . " FROM {$this->tableName}";
        return $this;
    }

    public function where(string $column, string $operator, $value): self
    {
        $this->query .= (str_contains($this->query, 'WHERE') ? ' AND ' : ' WHERE ') . "{$column} {$operator} :{$column}";
        $this->params[$column] = $value;
        return $this;
    }

    public function delete(string $column, $value): bool
    {
        $this->query = "DELETE FROM {$this->tableName}";
        return $this->where($column, '=', $value)->execute();
    }

    public function insert(array $data): bool
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_map(fn($col) => ":{$col}", array_keys($data)));
        
        $this->query = "INSERT INTO {$this->tableName} ({$columns}) VALUES ({$placeholders})";
        $this->params = $data;
        return $this->execute();
    }

    private function execute(): bool
    {
        try {
            $stmt = $this->db->prepare($this->query);
            $this->bindParams($stmt);
            $success = $stmt->execute();
            $this->resetQuery();
            return $success;
        } catch (PDOException $e) {
            throw new PDOException("Query execution failed: " . $e->getMessage());
        }
    }

    public function get(): array
    {
        $stmt = $this->db->prepare($this->query);
        $this->bindParams($stmt);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $this->resetQuery();
        return $results;
    }

    private function bindParams($stmt): void
    {
        foreach ($this->params as $param => $value) {
            $stmt->bindValue(":{$param}", $value, $this->getPDOType($value));
        }
    }

    private function getPDOType($value): int
    {
        return match (gettype($value)) {
            'boolean' => PDO::PARAM_BOOL,
            'NULL' => PDO::PARAM_NULL,
            'integer' => PDO::PARAM_INT,
            default => PDO::PARAM_STR,
        };
    }

    private function resetQuery(): void
    {
        $this->query = '';
        $this->params = [];
    }
}
