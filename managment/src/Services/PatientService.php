<?php
declare(strict_types=1);

namespace App\Services;
use App\Repository\PatientRepository;

class PatientService
{
  private function getPatientRepository(){
    return new PatientRepository();
  }

  public function getAll(){
    return $this->getPatientRepository()->getAll();
  }

  public function create(array $data)
  {
      // You can add any additional business logic here before creating the patient
      return $this->getPatientRepository()->create($data);
  }

  public function update(array $data)
  {
      // Check if the patient exists
      $patient = $this->getPatientRepository()->findById($data['id']);
      if (!$patient) {
          return false; // Patient not found
      }

      // Update patient information
      return $this->getPatientRepository()->update($data);
  }

  public function delete($id)
  {
      // Check if the patient exists
      $patient = $this->getPatientRepository()->findById($id);
      if (!$patient) {
          return false; // Patient not found
      }

      // Delete the patient
      return $this->getPatientRepository()->delete($id);
  }

}