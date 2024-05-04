<?php
namespace App\Helpers;

class ValidationHelper
{
    protected $rules = [];
    protected $errors = [];

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function validate(array $data): bool
    {
        $errors = [];

        foreach ($this->rules as $field => $rule) {
            if (isset($data[$field])) {
                $value = $data[$field];
                foreach ($rule as $validator => $message) {
                    if (!$this->$validator($value)) {
                        $errors[$field] = $message;
                        break;
                    }
                }
            }
        }
        
        if (!empty($errors)) {
            $this->errors = $errors;
            return false;
        }

        return true;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    protected function required($value): bool
    {
        return !empty($value);
    }

    protected function positiveNumber($value): bool
    {
        return is_numeric($value) && $value > 0;
    }

    protected function termRange($value): bool
    {
        $term = intval($value);
        return $term >= 3 && $term <= 120;
    }

    protected function dateRange($value): bool
    {
        // Преобразуване на датата в обект на DateTime
        $date = \DateTime::createFromFormat('Y-m-d', $value);
        if (!$date) {
            return false; // Грешка във формата на датата
        }

        // Проверка на дали датата е в диапазона 3 до 120 месеца
        $now = new \DateTime();
        $diff = $date->diff($now);
        $months = $diff->m + ($diff->y * 12);
        return $months >= 3 && $months <= 120;
    }
}