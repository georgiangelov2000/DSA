<?php
declare(strict_types=1);

namespace App\Repository;
use App\Models\FoodItem;
use App\Models\Patient;
use App\Interface\RepositoryInterface;

class FoodItemRepository implements RepositoryInterface
{    
        private function foodItemModel(){
            return new FoodItem();
        }

        public function create(array $data): array
        {
            try {
                // Insert new patient
                return $this->foodItemModel()->create($data);
            } catch (\PDOException $e) {
                // Handle the exception
                throw $e;
            }
        }    

        public function findById($id): bool
        {
            try {    
                // Retrieve patient by ID
                return $this->foodItemModel()->findById($id);
            } catch (\PDOException $e) {
                // Handle the exception
                throw $e;
            }
        }

        public function delete($id): bool
        {
            try {
                // Delete patient
                return $this->foodItemModel()->softDelete($id);
            } catch (\PDOException $e) {
                // Handle the exception
                throw $e;
            }
        }

        public function getAll()
        {
            // Implement logic to get all food items (if needed)
        }

        public function update(array $data): bool
        {
            // Implement update logic for food items (if needed)
        }
    
}