<?php
declare(strict_types=1);

namespace App\Services;
use App\Repository\FoodItemRepository;

class FoodItemService
{
    private function foodItemRepository()
    {
        return new FoodItemRepository();
    }

    public function create(array $data)
    {
        // Call the repository method to create a new food item
        return $this->foodItemRepository()->create($data);
    }

    public function delete($id)
    {
        // Check if the food exists
        $food = $this->foodItemRepository()->findById($id);

        if (!$food) {
            return false; // food not found
        }
        
        // Delete the food
        return $this->foodItemRepository()->delete($id);
    }
  
}
