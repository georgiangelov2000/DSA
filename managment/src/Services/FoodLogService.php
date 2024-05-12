<?php
declare(strict_types=1);

namespace App\Services;

use App\Repository\FoodLogRepository;

class FoodLogService
{
    private function foodLogRepository()
    {
        return new FoodLogRepository();
    }

    public function create(array $data)
    {
        // Call the repository method to create a new food log
        return $this->foodLogRepository()->create($data);
    }

    // Implement other service methods as needed
}
