<?php
declare(strict_types=1);

namespace App\DAO;

use Framework\Model;
use PDO;

class CreditsDao extends Model
{
    protected $table = "credits";

    public function findAll($userId = null): array
    {
        $pdo = $this->database->getConnection();

        $sql = "SELECT 
            c.*, 
            COUNT(p.credit_id) AS payment_count,
            (c.amount - c.remaining_amount) AS paid_amount
        FROM 
            {$this->getTable()} c
        LEFT JOIN 
            payments p ON c.id = p.credit_id";

        // Add WHERE clause conditionally if $userId is provided
        if ($userId !== null) {
            $sql .= " WHERE c.user_id = :user_id";
        }

        // Add GROUP BY clause to properly group the results
        $sql .= " GROUP BY c.id";

        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);

        // Bind the parameter if $userId is provided
        if ($userId !== null) {
            $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        }

        // Execute the query
        $stmt->execute();

        // Fetch the results
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotal($userId = null): int
    {
        // Initialize the SQL query
        $sql = "SELECT COUNT(*) AS total FROM credits";
    
        // Add WHERE clause if $userId is provided
        if ($userId !== null) {
            $sql .= " WHERE user_id = :user_id";
        }
    
        // Get a database connection
        $conn = $this->database->getConnection();
    
        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);
    
        // Bind the parameter if $userId is provided
        if ($userId !== null) {
            $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        }
    
        // Execute the query
        $stmt->execute();
    
        // Fetch the result
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Return the total count as an integer
        return (int) $row["total"];
    }
    
    // public function insert(array $data): array
    // {
    //     // Check if the user has exceeded the credit limit
    //     if ($this->hasExceededCreditLimit($data['user_id'])) {
    //         return false;
    //     }
        
    //     try {
    //         $conn = $this->database->getConnection();
    //         $conn->beginTransaction();
    
    //         // Проверка за валидност на данните
    //         $this->validate($data);
    //         if (!empty($this->errors)) {
    //             return false;
    //         }

    //         // Изчисляване на месечната вноска
    //         $amount = floatval($data['amount']);
    //         $term = intval($data['term']);
    //         $monthlyInstallment = $this->calculateMonthlyInstallment($amount, $term);
    
    //         // Калкулиране на крайната дата на срока на кредита
    //         $startTermDate = date('Y-m-d');
    //         $endTermDate = date('Y-m-d', strtotime("+$term months", strtotime($startTermDate)));
    
    //         // Инсертване на кредита в базата данни
    //         $sql = "INSERT INTO {$this->getTable()} (unique_code, user_id, amount, term, monthly_installment, end_term_date, remaining_amount) 
    //                 VALUES (?, ?, ?, ?, ?, ?, ?)";
                   
    //         $stmt = $conn->prepare($sql);
    //         $stmt->bindValue(1, str_pad($this->database->getConnection()->lastInsertId(), 7, '0', STR_PAD_LEFT));
    //         $stmt->bindValue(2, $data['user_id'], PDO::PARAM_INT);
    //         $stmt->bindValue(3, $amount, PDO::PARAM_STR);
    //         $stmt->bindValue(4, $term, PDO::PARAM_INT);
    //         $stmt->bindValue(5, $monthlyInstallment, PDO::PARAM_STR);
    //         $stmt->bindValue(6, $endTermDate);
    //         $stmt->bindValue(7, $amount, PDO::PARAM_STR);
    //         $stmt->execute();
    
    //         $conn->commit();
    //         return ['success' => true, 'message' => 'Кредитът е успешно създаден.'];
    //     } catch (\PDOException $e) {
    //         $conn->rollBack();
    //         return ['success' => false, 'message' => 'Възникна грешка при създаването на кредита.'];
    //     }
    // }

    // private function calculateMonthlyInstallment(float $amount, int $term): float
    // {
    //     // Годишната лихва в проценти
    //     $annualInterestRate = 7.9 / 100;

    //     // Брой плащания (месеци)
    //     $numberOfPayments = $term;

    //     // Месечна лихва
    //     $monthlyInterestRate = $annualInterestRate / 12;

    //     // Формула за изчисляване на месечната вноска (ануитетен метод)
    //     $monthlyPayment = $amount * ($monthlyInterestRate * pow(1 + $monthlyInterestRate, $numberOfPayments)) / (pow(1 + $monthlyInterestRate, $numberOfPayments) - 1);

    //     // Закръгляме месечната вноска до две десетични цифри
    //     return round($monthlyPayment, 2);
    // }

    // private function hasExceededCreditLimit(int $userId): bool
    // {
    //     $sql = "SELECT SUM(amount) AS total_amount
    //             FROM {$this->getTable()}
    //             WHERE user_id = :user_id";

    //     $conn = $this->database->getConnection();
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
    //     $stmt->execute();

    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //     return $row['total_amount'] > 80000;
    // }

    public function insert(array $data): bool
    {
        try {
            $conn = $this->database->getConnection();
            $conn->beginTransaction();

            $sql = "INSERT INTO {$this->getTable()} (user_id, amount, term, monthly_installment, end_term_date, remaining_amount) 
            VALUES (?, ?, ?, ?, ?, ?)";
           
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $data['user_id'], PDO::PARAM_INT);
            $stmt->bindValue(2, $data['amount'], PDO::PARAM_STR);
            $stmt->bindValue(3, $data['term'], PDO::PARAM_INT);
            $stmt->bindValue(4, $data['monthly_installment'], PDO::PARAM_STR);
            $stmt->bindValue(5, $data['end_term_date']);
            $stmt->bindValue(6, $data['amount'], PDO::PARAM_STR);
            $stmt->execute();
    
            $conn->commit();
            return true;
        } catch (\PDOException $e) {
            $conn->rollBack();
            return false;
        }
    }

    public function getTotalAmount(int $userId): ?float
    {
        $sql = "SELECT SUM(amount) AS total_amount
                FROM {$this->getTable()}
                WHERE user_id = :user_id";
    
        $conn = $this->database->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Check if the result is null, return 0 if it is
        $totalAmount = $row['total_amount'] ?? 0;
    
        return $totalAmount !== null ? (float) $totalAmount : null;
    }
    

    public function delete(string $id): bool
    {
        try {
            // Начало на транзакция
            $conn = $this->database->getConnection();
            $conn->beginTransaction();

            // Изтриване на кредита от базата данни
            $sql = "DELETE FROM {$this->getTable()} WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Успешно завършване на транзакцията
            $conn->commit();

            return true;
        } catch (\Exception $e) {
            // При грешка, отмяна на транзакцията
            $conn->rollBack();
            return false;
        }
    }

}
