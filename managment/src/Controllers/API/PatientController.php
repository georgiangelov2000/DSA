<?php
declare(strict_types=1);

namespace App\Controllers\API;
use App\Helpers\ValidationHelper;
use App\Services\PatientService;

class PatientController
{
    private function getPatientServce(){
        return new PatientService();
    }

    public function index(){
        $patients = $this->getPatientServce()->getAll();
        echo json_encode(['status' => 'success', 'data' => $patients], JSON_PRETTY_PRINT);
    }

    public function create(){

        // Get data from the request and escape strings
        $data = [
            'first_name' => isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : '',
            'last_name' => isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''
        ];

        // Create a validation helper
        $validator = new ValidationHelper([
            "first_name" => ["required" => "First name is required."],
            "last_name" => ["required" => "Last name is required."],
        ]);

        // Data validation
        if (!$validator->validate($data)) {
            // Validation failed, return errors
            echo json_encode(['status' => 'error', 'errors' => $validator->getErrors()]);
            return;
        }

        // Create patient
        $patient = $this->getPatientServce()->create($data);

        // Return JSON response
        echo json_encode(['status' => 'success', 'data' => $patient]);
    }

    public function update()
    {

        // Get data from the request and escape strings
        $data = [
            'id' => isset($_POST['id']) ? intval($_POST['id']) : null,
            'first_name' => isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : '',
            'last_name' => isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''
        ];

        // Validate ID
        if ($data['id'] === null) {
            echo json_encode(['status' => 'error', 'message' => 'Patient ID is required for updating.']);
            return;
        }

        // Validate input fields
        $validator = new ValidationHelper([
            "first_name" => ["required" => "First name is required."],
            "last_name" => ["required" => "Last name is required."],
        ]);

        if (!$validator->validate($data)) {
            // Validation failed, return errors
            echo json_encode(['status' => 'error', 'errors' => $validator->getErrors()]);
            return;
        }

        // Update patient
        $updated = $this->getPatientServce()->update($data);

        if ($updated) {
            echo json_encode(['status' => 'success', 'message' => 'Patient updated successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update patient.']);
        }
    }

    public function delete()
    {

        // Get patient ID from the request
        $id = isset($_POST['id']) ? intval($_POST['id']) : null;

        // Validate ID
        if ($id === null) {
            echo json_encode(['status' => 'error', 'message' => 'Patient ID is required for deletion.']);
            return;
        }

        // Delete patient
        $deleted = $this->getPatientServce()->delete($id);

        if ($deleted) {
            echo json_encode(['status' => 'success', 'message' => 'Patient deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete patient.']);
        }
    }
}