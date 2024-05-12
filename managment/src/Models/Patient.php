<?php
declare(strict_types=1);

namespace App\Models;
use App\System\Model;
use PDO;

class Patient extends Model
{
    protected $table = "patients";
    
    public function fetchAll(): array
    {
        $conn = $this->getDatabase()->getConnection();

        try {
            // Begin transaction
            $conn->beginTransaction();

            // Retrieve all patients
            $stmt = $conn->query("SELECT * FROM patients");
            $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Commit transaction
            $conn->commit();

            return $patients;
        } catch (\PDOException $e) {
            // Rollback transaction on error
            $conn->rollBack();
            throw $e; // Rethrow the exception
        }
    }

    public function findById($id): ?Patient
    {
        $conn = $this->getDatabase()->getConnection();
        try {
            // Begin transaction
            $conn->beginTransaction();

            // Retrieve patient by ID
            $stmt = $conn->prepare("SELECT * FROM patients WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $patient = $stmt->fetch(PDO::FETCH_ASSOC);

            // Commit transaction
            $conn->commit();

            if (!$patient) {
                return null;
            }

            return new Patient($patient['id'], $patient['first_name'], $patient['last_name']);
        } catch (\PDOException $e) {
            // Rollback transaction on error
            $conn->rollBack();
            throw $e; // Rethrow the exception
        }
    }

    public function create(array $data): array
    {
        $conn = $this->getDatabase()->getConnection();
        try {
            // Begin transaction
            $conn->beginTransaction();

            // Insert new patient
            $stmt = $conn->prepare("INSERT INTO patients (first_name, last_name) VALUES (:first_name, :last_name)");
            $result = $stmt->execute(['first_name' => $data['first_name'], 'last_name' => $data['last_name']]);

            // Get the ID of the last inserted patient
            $lastInsertedId = $conn->query("SELECT MAX(id) FROM patients")->fetchColumn();

            // Commit transaction
            $conn->commit();
            
            // Retrieve the newly created patient by ID
            $stmt = $conn->prepare("SELECT * FROM patients WHERE id = :id");
            $stmt->execute(['id' => $lastInsertedId]);
            $newPatient = $stmt->fetch(PDO::FETCH_ASSOC);

            return $newPatient;
        } catch (\PDOException $e) {
            // Rollback transaction on error
            $conn->rollBack();
            throw $e; // Rethrow the exception
        }
    }

    public function update(array $data): bool
    {
        $conn = $this->getDatabase()->getConnection();
        try {
            // Begin transaction
            $conn->beginTransaction();

            // Update patient information
            $stmt = $conn->prepare("UPDATE patients SET first_name = :first_name, last_name = :last_name WHERE id = :id");
            $result = $stmt->execute(['id' => $data['id'], 'first_name' => $data['first_name'], 'last_name' => $data['last_name']]);

            // Commit transaction
            $conn->commit();

            return $result;
        } catch (\PDOException $e) {
            // Rollback transaction on error
            $conn->rollBack();
            throw $e; // Rethrow the exception
        }
    }

    public function delete($id): bool
    {
        $conn = $this->getDatabase()->getConnection();
        try {
            // Begin transaction
            $conn->beginTransaction();

            // Delete patient
            $stmt = $conn->prepare("DELETE FROM patients WHERE id = :id");
            $result = $stmt->execute(['id' => $id]);

            // Commit transaction
            $conn->commit();

            return $result;
        } catch (\PDOException $e) {
            // Rollback transaction on error
            $conn->rollBack();
            throw $e; // Rethrow the exception
        }
    }
}