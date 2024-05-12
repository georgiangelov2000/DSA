<?php
declare(strict_types=1);

namespace App\System;

use PDO;
use App\System\Database;

abstract class Model
{

    protected function getDatabase(){
        return new Database('localhost', 'sports_diary', 'root', '12345678');
    }

    protected $table;

    protected array $errors = [];

    public function getInsertID(): string
    {
        $conn = $this->getDatabase()->getConnection();

        return $conn->lastInsertId();
    }

    protected function addError(string $field, string $message): void
    {
        $this->errors[$field] = $message;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    protected function getTable(): string
    {
        if ($this->table !== null) {

            return $this->table;

        }

        $parts = explode("\\", $this::class);

        return strtolower(array_pop($parts));
    }

    public function findAll(): array
    {
        $pdo = $this->getDatabase()->getConnection();

        $sql = "SELECT *
                FROM {$this->getTable()}";

        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): array|bool
    {
        $conn = $this->getDatabase()->getConnection();

        $sql = "SELECT *
                FROM {$this->getTable()}
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM {$this->getTable()}
                WHERE id = :id";

        $conn = $this->getDatabase()->getConnection();

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function findById($id): bool
    {
        $conn = $this->getDatabase()->getConnection();
        try {
            // Begin transaction
            $conn->beginTransaction();
    
            // Retrieve record by ID
            $stmt = $conn->prepare("SELECT COUNT(*) FROM {$this->getTable()} WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $recordCount = $stmt->fetchColumn();
    
            // Commit transaction
            $conn->commit();
    
            // Return true if record exists, false otherwise
            return $recordCount > 0;
        } catch (\PDOException $e) {
            // Rollback transaction on error
            $conn->rollBack();
            throw $e; // Rethrow the exception
        }
    }
    
    
}