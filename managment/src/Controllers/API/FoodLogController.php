<?php
declare(strict_types=1);

namespace App\Controllers\API;

use App\Services\FoodLogService;
use App\Helpers\ValidationHelper;

class FoodLogController
{
    private function getFoodLogService()
    {
        return new FoodLogService();
    }

    public function create()
    {
        // Get data from the request and escape strings
        $data = [
            'patient_id' => isset($_POST['patient_id']) ? htmlspecialchars($_POST['patient_id']) : '',
            'food_item_id' => isset($_POST['food_item_id']) ? htmlspecialchars($_POST['food_item_id']) : '',
            'date' => isset($_POST['date']) ? htmlspecialchars($_POST['date']) : '',
            'quantity' => isset($_POST['quantity']) ? intval($_POST['quantity']) : 0,
        ];

        // Create a validation helper
        $validator = new ValidationHelper([
            "patient_id" => ["required" => "Patient ID is required."],
            "food_item_id" => ["required" => "Food item ID is required."],
            "log_date" => ["required" => "Date is required."],
            "quantity" => ["required" => "Quantity is required.", "numeric" => "Quantity must be a number."],
        ]);

        // Data validation
        if (!$validator->validate($data)) {
            // Validation failed, return errors
            echo json_encode(['status' => 'error', 'errors' => $validator->getErrors()], JSON_PRETTY_PRINT);
            return;
        }

        // Create food log
        $foodLog = $this->getFoodLogService()->create($data);

        // Return JSON response
        echo json_encode(['status' => 'success', 'data' => $foodLog], JSON_PRETTY_PRINT);
    }

    // Implement other methods for updating, deleting, and retrieving food logs
}
