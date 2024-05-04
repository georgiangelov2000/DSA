<?php

namespace App\Services;

use App\DAO\CreditsDao;
use App\Helpers\SessionHelper;
/**
 * Class CreditService
 * @package App\Services
 */
class CreditService
{
    private CreditsDao $creditDAO;

    /**
     * CreditService constructor.
     * @param CreditsDao $creditDAO
     */
    public function __construct(CreditsDao $creditDAO)
    {
        $this->creditDAO = $creditDAO;
    }

    /**
     * Create a new credit.
     *
     * @param array $data The data for creating the credit.
     * @return bool Returns true on success, false otherwise.
     */
    public function createCredit(array $data): bool
    {
        // Calculate the monthly installment
        $amount = floatval($data['amount']);
        $term = intval($data['term']);
        $monthlyInstallment = $this->calculateMonthlyInstallment($data['amount'], $data['term']);

        // Check if the user has exceeded the credit limit
        $limitData = $this->hasExceededCreditLimit($data['user_id'], $amount);
        
        if ($limitData['exceeded_limit']) {
            $totalCreditFormatted = number_format($limitData['total_credit_amount'], 2);
            $newTotalCreditFormatted = number_format($limitData['new_total_credit_amount'], 2);
            SessionHelper::setFlashMessage('message', "The user cannot exceed the credit limit. Total credit amount: {$totalCreditFormatted}, New total credit amount: {$newTotalCreditFormatted}");
            return false;
        }
        // Calculate the end term date of the credit
        $startTermDate = date('Y-m-d');
        $endTermDate = date('Y-m-d', strtotime("+$term months", strtotime($startTermDate)));    

        $data['monthly_installment'] = $monthlyInstallment;
        $data['end_term_date'] = $endTermDate;
        var_dump(1);

        // Call DAO to insert the credit
        return $this->creditDAO->insert($data);
    }

    /**
     * Get the details of a credit.
     *
     * @param int|string $id The ID of the credit.
     * @return array Returns an array containing the credit details.
     */
    public function getCreditDetails(int|string $id): array
    {
        return $this->creditDAO->find($id);
    }

    /**
     * Get the total number of credits.
     *
     * @param int|null $id Optional ID of a credit.
     * @return int Returns the total number of credits.
     */
    public function total($id = null):int{
        return $this->creditDAO->getTotal($id);
    }

    /**
     * Get all credits or credits of a specific user.
     *
     * @param int|null $id Optional ID of a user.
     * @return mixed Returns all credits or credits of a specific user.
     */
    public function getCredits($id = null){
        return $this->creditDAO->findAll($id);
    }

    /**
     * Calculate the monthly installment for a credit.
     *
     * @param float $amount The amount of the credit.
     * @param int $term The term of the credit in months.
     * @return float Returns the calculated monthly installment.
     */
    private function calculateMonthlyInstallment(float $amount, int $term): float
    {
        // Annual interest rate in percentage
        $annualInterestRate = 7.9 / 100;

        // Number of payments (months)
        $numberOfPayments = $term;

        // Monthly interest rate
        $monthlyInterestRate = $annualInterestRate / 12;

        // Formula to calculate the monthly installment (annuity method)
        $monthlyPayment = $amount * ($monthlyInterestRate * pow(1 + $monthlyInterestRate, $numberOfPayments)) / (pow(1 + $monthlyInterestRate, $numberOfPayments) - 1);

        // Round the monthly payment to two decimal places
        return round($monthlyPayment, 2);
    }

    /**
     * Check if a user has exceeded the credit limit.
     *
     * @param int $userId The ID of the user.
     * @param float $amount The amount of the credit.
     * @return bool Returns true if the user has exceeded the credit limit, false otherwise.
     */
    private function hasExceededCreditLimit(int $userId, float $amount): array
    {
        // Get the current total amount of credits for the given user
        $totalCreditAmount = $this->creditDAO->getTotalAmount($userId);
        
        // Calculate the new total credit amount including the new credit
        $newTotalCreditAmount = $totalCreditAmount + $amount;
    
        // Check if the total amount of credits, including the new credit, exceeds the limit of 80000
        $exceededLimit = $newTotalCreditAmount > 80000;
    
        // Return an array with relevant data
        return [
            'total_credit_amount' => $totalCreditAmount,
            'new_total_credit_amount' => $newTotalCreditAmount,
            'exceeded_limit' => $exceededLimit
        ];
    }
    
    /**
     * Delete a credit.
     *
     * @param string $id The ID of the credit.
     * @return bool Returns true if the credit is successfully deleted, false otherwise.
     */
    public function deleteCredit(string $id): bool
    {
        // Delete the credit with the given ID from the database
        $deleted = $this->creditDAO->delete($id);
        if(!$deleted) {
            SessionHelper::setFlashMessage('message', "Credit cannot be deleted");
        }
        SessionHelper::setFlashMessage('message', "The credit with id {$id} and all payments to it are deleted");
        return $deleted;
    }

}
