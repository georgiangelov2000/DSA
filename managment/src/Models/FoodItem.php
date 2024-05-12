<?php
declare(strict_types=1);

namespace App\Models;

use App\System\Model;
use PDO;

class FoodItem extends Model
{
    protected $table = "food_items";
    
    private string $name;
    private int $calories_per_100g;

    public function create(array $data): array
    {
        $conn = $this->getDatabase()->getConnection();
        try {
            // Begin transaction
            $conn->beginTransaction();

            // Insert new food item
            $stmt = $conn->prepare("INSERT INTO {$this->getTable()} (name, calories_per_100g) VALUES (:name, :calories_per_100g)");
            $stmt->execute(['name' => $data['name'], 'calories_per_100g' => $data['calories_per_100g']]);

            // Get the ID of the last inserted patient
            $lastInsertedId = $conn->query("SELECT MAX(id) FROM food_items")->fetchColumn();

            // Commit transaction
            $conn->commit();
            
            // Retrieve the newly created patient by ID
            $stmt = $conn->prepare("SELECT * FROM food_items WHERE id = :id");
            $stmt->execute(['id' => $lastInsertedId]);
            $newFood = $stmt->fetch(PDO::FETCH_ASSOC);

            return $newFood;
        } catch (\PDOException $e) {
            // Rollback transaction on error
            $conn->rollBack();
            throw $e; // Rethrow the exception
        }
    }

    public function softDelete(int $id): bool
    {
        $conn = $this->getDatabase()->getConnection();
        try {
            // Begin transaction
            $conn->beginTransaction();

            // Soft delete the food item
            $stmt = $conn->prepare("UPDATE {$this->getTable()} SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id");
            $result = $stmt->execute(['id' => $id]);

            // Commit transaction
            $conn->commit();

            return $result;
        } catch (\PDOException $e) {
            // Rollback transaction on error
            $conn->rollBack();
            throw $e; // Rethrow the exception
        }
    }

    public function findById($id): bool
    {
        $conn = $this->getDatabase()->getConnection();
        try {
            // Begin transaction
            $conn->beginTransaction();
    
            // Retrieve record by ID
            $stmt = $conn->prepare("SELECT id FROM {$this->getTable()} WHERE id = :id");
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
