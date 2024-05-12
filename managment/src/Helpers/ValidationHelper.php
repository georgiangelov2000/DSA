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
    
    protected function numeric($value): bool
    {
        return is_numeric($value);
    }
}