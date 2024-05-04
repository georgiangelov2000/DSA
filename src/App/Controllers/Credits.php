<?php
declare(strict_types=1);

namespace App\Controllers;

use Framework\Controller;
use Framework\Response;
use App\Services\CreditService;
use App\Services\UserService;
use App\Services\PaymentService;
use App\Helpers\SessionHelper;
use App\Helpers\ValidationHelper;
/**
 * Class Credits
 * @package App\Controllers
 */
class Credits extends Controller
{
    private CreditService $creditService;
    private UserService $userService;
    private PaymentService $paymentService;

    /**
     * Credits constructor.
     * @param CreditService $creditService
     * @param UserService $userService
     * @param PaymentService $paymentService
     */
    public function __construct(
        CreditService $creditService,
        UserService $userService,
        PaymentService $paymentService
    )
    {
        $this->creditService = $creditService;
        $this->userService = $userService;
        $this->paymentService = $paymentService;

    }

    /**
     * Display the index page.
     *
     * @return Response
     */
    public function index(): Response
    {
        $users = $this->userService->getUsers();
        $userCount = $this->userService->getUsersCount();

        return $this->view("Credits/index.mvc.php",[
            "users" => $users,
            "total" => $userCount
        ]);
    }

    /**
     * Display the form for creating a new credit.
     *
     * @return Response
     */
    public function new(): Response
    {
        $users = $this->userService->getUsers();
        return $this->view("Credits/new.mvc.php",[
            "users" => $users
        ]);
    }

    /**
     * Create a new credit.
     *
     * @return Response
     */
    public function create(): Response
    {
        // Create an object with the request data
        $data = [
            'user_id' => (int) $this->request->post['user_id'],
            'amount' => $this->request->post['amount'],
            'term' => (int) $this->request->post['term'],
        ];
    
        // Create a validation helper
        $validator = new ValidationHelper([
            "user_id" => ["required" => "Името на кредитополучателя е задължително поле."],
            "amount" => ["positiveNumber" => "Сумата трябва да бъде положително число."],
            "term" => ["termRange" => "Срокът трябва да бъде между 3 и 120 месеца."]
        ]);
        
        // Data validation
        if (!$validator->validate($data)) {
            // If data is not valid, redirect to credit creation form with error messages           
             SessionHelper::setFlashMessage('validation_errors', $validator->getErrors());
            return $this->redirect('/credits/new');
        }
    
        // Create a new credit
        if (!$this->creditService->createCredit($data)) {
            // If the credit creation fails, redirect to the creation form with an error message            
            return $this->redirect('/credits/new');
        }
    
        // Ако всичко е преминало успешно, пренасочване към началната страница със съобщение за успех
        SessionHelper::setFlashMessage('message', "The credit was successfully created.");
        return $this->redirect('/');
    }
    

    /**
     * Display the form for creating a new payment for a credit.
     *
     * @param string $id The ID of the credit.
     * @return Response
     */
    public function new_payment(string $id): Response
    {
        // Get credit details
        $credit = $this->creditService->getCreditDetails($id);

        if (!$credit) {
            return ['success' => false, 'message' => 'Credit not found.'];
        }

        $payments = $this->paymentService->getPaymentByCredit($id);

        return $this->view("Payments/new_payment.mvc.php", [
            "credit" => $credit,
            'payments' => $payments
        ]);
    }

    /**
     * Store a new payment for a credit.
     *
     * @return Response
     */
    public function store_payment(): Response
    {
        // Logic for storing the payment
        $data = [
            'credit_id' => (int) $this->request->post['credit_id'],
            'amount' => floatval($this->request->post['amount']),
            'date' => $this->request->post['date'],
        ];

        // Create a validation helper
        $validator = new ValidationHelper([
            "credit_id" => ["required" => "Кредитът е задължителен."],
            "amount" => ["positiveNumber" => "Сумата трябва да бъде положително число."],
            "date" => ["dateRange" => "Срокът трябва да бъде между 3 и 120 месеца."]
        ]);

        // Data validation
        if (!$validator->validate($data)) {
            // If data is not valid, redirect to payment creation form with error messages           
            SessionHelper::setFlashMessage('validation_errors', $validator->getErrors());
        } else {
            // Create a new payment
            $this->paymentService->createPayment($data);
        }

        // Redirect to the homepage after successfully creating the payment
        return $this->redirect("/credits/{$data['credit_id']}/new_payment");
    }

    /**
     * Show the details of a credit.
     *
     * @param string $id The ID of the credit.
     * @return Response
     */
    public function show(string $id){

        $credits = $this->creditService->getCredits($id);
        $user = $this->userService->getUser($id);
        $total = $this->creditService->total($id);

        return $this->view("Credits/show.mvc.php",[
            "credits" => $credits,
            'user' => $user, 
            "total" => $total
        ]);
    }

    /**
     * Delete a credit.
     *
     * @param string $id The ID of the credit.
     * @return Response
     */
    public function delete(string $id) {
        $credit = $this->creditService->deleteCredit($id);
        return $this->redirect("/");
    }

    
}
