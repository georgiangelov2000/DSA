<?php

namespace App\Services;

use App\DAO\PaymentsDao;
use App\Helpers\SessionHelper;

/**
 * Class PaymentService
 * @package App\Services
 */
class PaymentService
{
    /**
     * @var PaymentsDao
     */
    protected $paymentDAO;

    /**
     * PaymentService constructor.
     * @param PaymentsDao $paymentDAO
     */
    public function __construct(PaymentsDao $paymentDAO)
    {
        $this->paymentDAO = $paymentDAO;
    }

    /**
     * Get payments by credit ID.
     *
     * @param string $id
     * @return mixed
     */
    public function getPaymentByCredit(string $id)
    {
        return $this->paymentDAO->findByCredittId($id);
    }

    /**
     * Create a new payment.
     *
     * @param array $data
     * @return bool
     */
    public function createPayment(array $data): bool
    {
        $conn = $this->paymentDAO->database->getConnection();

        try {
            //withdrawOnlyRemainingAmount boolean for showing on session message 
            $withdrawOnlyRemainingAmount = false;

            // Check for data validity
            $this->paymentDAO->validate($data);

            if (!empty($this->paymentDAO->errors)) {
                return false;
            }

            // Start of transaction
            $conn->beginTransaction();

            // Get the remaining length amount for the credit
            $creditId = $data['credit_id'];
            $remainingAmount = $this->paymentDAO->getRemainingAmount($creditId);

            if ($remainingAmount <= 0) {
                SessionHelper::setFlashMessage('message', "Credit has already been fully paid, no need to insert a new payment");
                // Credit has already been fully paid, no need to insert a new payment
                return false;
            }

            // Check if the amount entered exceeds the remaining amount due on the loan
            if ($data['amount'] > $remainingAmount) {
                // If the repayment amount exceeds the remaining amount due on the loan,
                // withdraw only the remaining amount
                $data['amount'] = $remainingAmount;
                $withdrawOnlyRemainingAmount = true;
            }

            // Logic to store the payment
            $inserted = $this->paymentDAO->insert($data);
            
            if (!$inserted) {
                $conn->rollBack();
                return false;
            }

            // Update the remaining outstanding amount for the loan
            $newRemainingAmount = $remainingAmount - $data['amount'];
            $updateRemainingAmountQue = $this->paymentDAO->updateRemainingAmount($data['credit_id'], $newRemainingAmount);

            if(!$updateRemainingAmountQue) {
                $conn->rollBack();
                return false;
            }

            // Transaction completed successfully
            $conn->commit();

            if($withdrawOnlyRemainingAmount) {
                SessionHelper::setFlashMessage('withdraw_remaining_amount_message', "Withdraw only the remaining amount $remainingAmount");
            } else {
                SessionHelper::setFlashMessage('message', "Installment successfully paid");
            }
            return true;
        } catch (\Exception $e) {
            // On error, abort the transaction
            $conn->rollBack();
            return false;
        }
    }
}
