<?php
declare(strict_types=1);

namespace App\Interface;
use App\Models\Patient;
use App\Models\FoodItem;
use App\Models\FoodLog;

interface RepositoryInterface {
    public function create(array $data): array;
    public function findById($id): bool;
    public function update(array $data): bool;
    public function delete($id): bool;
    public function getAll();
}

?>
