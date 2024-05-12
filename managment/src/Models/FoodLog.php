<?php
declare(strict_types=1);

namespace App\Models;

use App\System\Model;
use PDO;

class FoodLog extends Model
{
    protected $table = "food_logs";

    public function create(array $data): FoodLog
    {
        $conn = $this->getDatabase()->getConnection();
        try {
            // Check if food_item_id exists in food_items table
            $foodItemExists = $this->checkFoodItemExists($data['food_item_id']);
            if (!$foodItemExists) {
                throw new \Exception("Food item with ID {$data['food_item_id']} does not exist.");
            }

            // Begin transaction
            $conn->beginTransaction();

            // Insert new food log
            $stmt = $conn->prepare("INSERT INTO food_logs (patient_id, food_item_id, consumed_at, quantity) 
                                    VALUES (:patient_id, :food_item_id, :consumed_at, :quantity)");
            $result = $stmt->execute([
                'patient_id' => $data['patient_id'],
                'food_item_id' => $data['food_item_id'],
                'consumed_at' => $data['consumed_at'],
                'quantity' => $data['quantity']
            ]);

            // Commit transaction
            $conn->commit();

            // Return the newly created food log
            return new FoodLog($data); // You may need to adjust this based on your constructor logic
        } catch (\PDOException $e) {
            // Rollback transaction on error
            $conn->rollBack();
            throw $e; // Rethrow the exception
        }
    }

    private function checkFoodItemExists(int $foodItemId): bool
    {
        $conn = $this->getDatabase()->getConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) FROM food_items WHERE id = :food_item_id");
        $stmt->execute(['food_item_id' => $foodItemId]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    // Implement other methods like update and delete if necessary
}
?>
