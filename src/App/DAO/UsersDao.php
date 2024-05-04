<?php
declare(strict_types=1);

namespace App\DAO;

use Framework\Model;
use PDO;

/**
 * Class UsersDao
 * @package App\DAO
 */
class UsersDao extends Model
{
    /**
     * @var string $table The database table name.
     */
    protected $table = "users";

    /**
     * Retrieve all users with their maximum credit amount and credit count.
     *
     * @return array Returns an array containing user data with max_amount and credit_count.
     */
    public function findAll(): array
    {
        $pdo = $this->database->getConnection();
    
        $sql = "SELECT 
                    users.id, 
                    users.name, 
                    IFNULL(SUM(credits.amount), 0) AS max_amount, 
                    IFNULL(COUNT(credits.id), 0) AS credit_count,
                    IFNULL(SUM(credits.amount - credits.remaining_amount), 0) AS paid_amount
                FROM 
                    users
                LEFT JOIN 
                    credits ON users.id = credits.user_id
                GROUP BY 
                    users.id, 
                    users.name";
    
        $stmt = $pdo->query($sql);
    
        // Проверяваме броя на записите
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    

    /**
     * Get the total number of users.
     *
     * @return int Returns the total number of users.
     */
    public function getTotal(): int
    {
        $sql = "SELECT COUNT(*) AS total
                FROM {$this->getTable()}";

        $conn = $this->database->getConnection();

        $stmt = $conn->query($sql);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) $row["total"];
    }
}
