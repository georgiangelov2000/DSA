<?php
declare(strict_types=1);

namespace App\Repository;
use App\Models\Patient;
use App\Models\FoodItem;
use App\Interface\RepositoryInterface;

class PatientRepository implements RepositoryInterface
{

        private function patientModel(){
            return new Patient();
        }

        public function getAll(){
            return $this->patientModel()->fetchAll();
        }
    
        public function create(array $data): array
        {
            try {
                // Insert new patient
                return $this->patientModel()->create($data);
            } catch (\PDOException $e) {
                // Handle the exception
                throw $e;
            }
        }
    
        public function findById($id):bool
        {
            try {    
                // Retrieve patient by ID
                return $this->patientModel()->findById($id);
            } catch (\PDOException $e) {
                // Handle the exception
                throw $e;
            }
        }
    
        public function update(array $data): bool
        {
            try {
                // Update patient information
                return $this->patientModel()->update($data);
            } catch (\PDOException $e) {
                // Handle the exception
                throw $e;
            }
        }
    
        public function delete($id): bool
        {
            try {
                // Delete patient
                return $this->patientModel()->delete($id);
            } catch (\PDOException $e) {
                // Handle the exception
                throw $e;
            }
        }
}