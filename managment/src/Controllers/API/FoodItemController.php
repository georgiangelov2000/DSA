<?php
declare(strict_types=1);

namespace App\Controllers\API;
use App\Services\FoodItemService;
use App\Helpers\ValidationHelper;

class FoodItemController 
{
    private function getFoodItemService()
    {
        return new FoodItemService();
    }

    public function create()
    {
        // Get data from the request and escape strings
        $data = [
            'name' => isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '',
            'calories_per_100g' => isset($_POST['calories_per_100g']) ? intval($_POST['calories_per_100g']) : 0
        ];

        // Create a validation helper
        $validator = new ValidationHelper([
            "name" => ["required" => "Food item name is required."],
            "calories_per_100g" => ["required" => "Calories per 100g is required.", "numeric" => "Calories per 100g must be a number."]
        ]);

        // Data validation
        if (!$validator->validate($data)) {
            // Validation failed, return errors
            echo json_encode(['status' => 'error', 'errors' => $validator->getErrors()], JSON_PRETTY_PRINT);
            return;
        }

        // Create food item
        $foodItem = $this->getFoodItemService()->create($data);

        // Return JSON response
        echo json_encode(['status' => 'success', 'data' => $foodItem], JSON_PRETTY_PRINT);
    }

    public function delete()
    {
        // Check if the food item ID is provided
        if (!isset($_POST['id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Food item ID is required for deletion.']);
            return;
        }

        // Get the food item ID
        $id = intval($_POST['id']);

        // Delete the food item
        $deleted = $this->getFoodItemService()->delete($id);
        
        if ($deleted) {
            echo json_encode(['status' => 'success', 'message' => 'Food item deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete food item.']);
        }
    }
}