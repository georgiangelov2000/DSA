<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\FoodLog;
use App\Interface\RepositoryInterface;

class FoodLogRepository implements RepositoryInterface
{
    private function foodLogModel()
    {
        return new FoodLog();
    }

    public function create(array $data): array
    {
        try {
            // Insert new patient
            return $this->foodLogModel()->create($data);
        } catch (\PDOException $e) {
            // Handle the exception
            throw $e;
        }
    }

    public function findById($id): bool {}
    public function update(array $data): bool {}
    public function delete($id): bool {}
    public function getAll() {}
}