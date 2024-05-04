<?php
declare(strict_types=1);

namespace App\DAO;

use Framework\Model;
use PDO;

class PaymentsDao extends Model
{
    protected $table = "payments";

    /**
     * Validate the given data.
     *
     * @param array $data The data to validate.
     * @return void
     */
    public function validate(array $data): void
    {
        $amount = floatval($data['amount']);
        if (!$amount) {
            $this->addError("amount", "Сумата трябва да бъде положително число.");
        }

        // Валидация на датата за плащане
        $date = $data['date'];
        if (!$date) {
            $this->addError("date", "Моля, въведете валидна дата за плащане.");
        } elseif (!strtotime($date)) {
            $this->addError("date", "Моля, въведете валиден формат за дата (гггг-мм-дд).");
        }

    }

    /**
     * Find payments by product ID.
     *
     * @param int $id The product ID.
     * @return array Returns an array of payments.
     */
    public function findByCredittId($id){
        $conn = $this->database->getConnection();

        $sql = "SELECT *
                FROM {$this->getTable()}
                WHERE credit_id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // /**
    //  * Insert a new payment record.
    //  *
    //  * @param array $data The data to insert.
    //  * @return bool|array Returns true on success or false on failure.
    //  */
    // public function insert(array $data): bool|array
    // {
    //     try {
    //         // Начало на транзакция
    //         $conn = $this->database->getConnection();
    //         $conn->beginTransaction();

    //         // Проверка за валидност на данните
    //         $this->validate($data);

    //         if (!empty($this->errors)) {
    //             return false;
    //         }

    //         // Вземане на оставащата дължима сума за кредита
    //         $creditId = $data['credit_id'];
    //         $remainingAmount = $this->getRemainingAmount($creditId);

    //         if ($remainingAmount <= 0) {
    //             // Credit has already been fully paid, no need to insert a new payment
    //             return false;
    //         }

    //         // Проверка дали въведената сума надвишава оставащата дължима сума за кредита
    //         if ($data['amount'] > $remainingAmount) {
    //             // Ако сумата за погасяване надвишава оставащата дължима сума за кредита,
    //             // изтегляме само оставащата сума
    //             $data['amount'] = $remainingAmount;
    
    //             // Известяване на потребителя за изтеглената сума
    //             // Може да използвате тук някакъв механизъм за уведомяване, като например използване на клас за уведомления
    //             // или просто извеждане на съобщение
    //             echo "Сумата за погасяване надвишава оставащата дължима сума за кредита. Изтеглено е само оставащото.";
    
    //             // Можете да добавите и други действия, като например логиране на събитието
    //         }
            
    //         // Логика за съхранение на плащането
    //         $sql = "INSERT INTO {$this->getTable()} (credit_id, amount, repayment_date) 
    //                 VALUES (:credit_id, :amount, :repayment_date)";

    //         $stmt = $conn->prepare($sql);

    //         $stmt->bindValue(':credit_id', $data['credit_id'], PDO::PARAM_INT);
    //         $stmt->bindValue(':amount', $data['amount'], PDO::PARAM_STR);
    //         $stmt->bindValue(':repayment_date', $data['date'], PDO::PARAM_STR);

    //         $stmt->execute();

    //         // Актуализация на оставащата дължима сума за кредита
    //         $newRemainingAmount = $remainingAmount - $data['amount'];
    //         $this->updateRemainingAmount($creditId, $newRemainingAmount);

    //         // Успешно завършване на транзакцията
    //         $conn->commit();

    //         return true;
    //     } catch (\Exception $e) {
    //         // При грешка, отмяна на транзакцията
    //         $conn->rollBack();
    //         return false;
    //     }
    // }

    /**
     * Insert a new payment record.
     *
     * @param array $data The data to insert.
     * @return bool|array Returns true on success or false on failure.
     */
    public function insert(array $data): bool
    {
        try {
            $conn = $this->database->getConnection();
    
            $sql = "INSERT INTO {$this->getTable()} (credit_id, amount, repayment_date) 
                    VALUES (:credit_id, :amount, :repayment_date)";
    
            $stmt = $conn->prepare($sql);
    
            $stmt->bindValue(':credit_id', $data['credit_id'], PDO::PARAM_INT);
            $stmt->bindValue(':amount', $data['amount'], PDO::PARAM_STR);
            $stmt->bindValue(':repayment_date', $data['date'], PDO::PARAM_STR);
    
            // Execute the statement
            $stmt->execute();
    
            return true; // Successfully inserted
        } catch (\Exception $e) {
            // Handle the exception
            return false; // Failed to insert
        }
    }

    /**
     * Get the remaining amount for a given credit ID.
     *
     * @param int $creditId The ID of the credit.
     * @return float The remaining amount.
     */
    public function getRemainingAmount(int $creditId): float
    {
        $conn = $this->database->getConnection();

        $sql = "SELECT remaining_amount FROM credits WHERE id = :credit_id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':credit_id', $creditId, PDO::PARAM_INT);
        $stmt->execute();

        $credit = $stmt->fetch(PDO::FETCH_ASSOC);

        return (float) $credit['remaining_amount'];
    }

    /**
     * Update the remaining amount for a given credit ID.
     *
     * @param int $creditId The ID of the credit.
     * @param float $newRemainingAmount The new remaining amount.
     * @return void
     */
    public function updateRemainingAmount(int $creditId, float $newRemainingAmount): bool
    {
        try {
            $conn = $this->database->getConnection();
    
            $sql = "UPDATE credits SET remaining_amount = :amount WHERE id = :credit_id";
    
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':amount', $newRemainingAmount, PDO::PARAM_STR);
            $stmt->bindValue(':credit_id', $creditId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (\Exception $e) {
            // Handle the exception
            return false; // Failed to insert
        }
    }
    
}
