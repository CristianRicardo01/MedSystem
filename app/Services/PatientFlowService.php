<?php

//  O QUE ELE FARÁ
//         Método	       |            Objetivo
// createTriagePatient     |      cria paciente na triagem
// transferPatient         |      move para patients
// finalizePatient	       |      finaliza/nega
// createTimeline	       |      cria histórico
// createMovement	       |      movimentação
// updateStatus	           |      altera status


namespace App\Services;

use App\Models\PatientModel;
use App\Models\PatientMovementModel;
use App\Models\PatientStatusHistoryModel;
use App\Models\PatientObservationModel;

class PatientFlowService
{
    protected $patientModel;

    protected $movementModel;

    protected $statusHistoryModel;

    protected $observationModel;

    public function __construct()
    {
        $this->patientModel = new PatientModel();

        $this->movementModel = new PatientMovementModel();

        $this->statusHistoryModel = new PatientStatusHistoryModel();

        $this->observationModel = new PatientObservationModel();
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE TRIAGE PATIENT
    |--------------------------------------------------------------------------
    */

    public function createTriagePatient(array $data)
    {
        $patientData = [

            'name' => $data['name'] ?? null,

            'medical_record' => $data['medical_record'] ?? null,

            'cpf' => $data['cpf'] ?? null,

            'phone' => $data['phone'] ?? null,

            'birth_date' => $data['birth_date'] ?? null,

            'state' => $data['state'] ?? null,

            'city' => $data['city'] ?? null,

            'specialty_id' => $data['specialty_id'] ?? null,

            'flow_type' => 'TRIAGE',

            'status' => 'TRIAGEM',

            'current_sector' => 'CENTRAL TRIAGEM',

            'first_service_date' => $data['first_service_date'] ?? null,

            'first_consultation_date' => $data['first_consultation_date'] ?? null,

            'created_by' => userId(),

            'has_exams' => $data['has_exams'] ?? 0,

        ];

        /*
        |--------------------------------------------------------------------------
        | INSERT PATIENT
        |--------------------------------------------------------------------------
        */

        $patientId = $this->patientModel->insert($patientData);

        /*
        |--------------------------------------------------------------------------
        | FIRST OBSERVATION
        |--------------------------------------------------------------------------
        */

        // if (!empty($data['observations'])) {

        //     $this->observationModel->insert([

        //         'patient_id' => $patientId,

        //         'observation' => $data['observations'],

        //         'created_by' => userId(),

        //     ]);
        // }

        if (!empty($data['observations'])) {

            $this->createObservation(

                $patientId,

                $data['observations'],

                'TRIAGE'

            );
        }
        /*
        |--------------------------------------------------------------------------
        | TIMELINE
        |--------------------------------------------------------------------------
        */

        $this->createTimeline(

            $patientId,

            null,

            'TRIAGEM',

            'Paciente criado na central de triagem'

        );

        /*
        |--------------------------------------------------------------------------
        | MOVEMENT
        |--------------------------------------------------------------------------
        */

        $this->createMovement(

            $patientId,

            'CENTRAL TRIAGEM',

            'ENTRY',

            'Entrada na central de triagem'

        );

        return $patientId;
    }
    /*
    |--------------------------------------------------------------------------
    | TRANSFER PATIENT
    |--------------------------------------------------------------------------
    */

    public function transferPatient(int $patientId, ?string $observation = null)
    {
        $patient = $this->patientModel->find($patientId);

        if (!$patient) {

            return false;
        }

        $oldStatus = $patient['status'];

        /*
        |--------------------------------------------------------------------------
        | UPDATE PATIENT
        |--------------------------------------------------------------------------
        */

        $this->patientModel->update($patientId, [

            'flow_type' => 'PATIENT',

            'status' => 'ACEITO',

            'current_sector' => 'PATIENTS',

            'accepted_at' => date('Y-m-d H:i:s'),

            'triage_transferred_at' => date('Y-m-d H:i:s')

        ]);

        /*
        |--------------------------------------------------------------------------
        | TIMELINE
        |--------------------------------------------------------------------------
        */

        $this->createTimeline(

            $patientId,

            $oldStatus,

            'ACEITO',

            $observation ?: 'Paciente transferido para fluxo principal'

        );

        /*
        |--------------------------------------------------------------------------
        | MOVEMENT
        |--------------------------------------------------------------------------
        */

        $this->createMovement(

            $patientId,

            'PATIENTS',

            'TRANSFER',

            $observation ?: 'Transferência realizada'

        );

        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | FINALIZE PATIENT
    |--------------------------------------------------------------------------
    */

    public function finalizePatient(int $patientId, ?string $observation = null)
    {
        $patient = $this->patientModel->find($patientId);

        if (!$patient) {

            return false;
        }

        $oldStatus = $patient['status'];

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $this->patientModel->update($patientId, [

            'status' => 'NEGADO',

            'finalized_at' => date('Y-m-d H:i:s')

        ]);

        /*
        |--------------------------------------------------------------------------
        | TIMELINE
        |--------------------------------------------------------------------------
        */

        $this->createTimeline(

            $patientId,

            $oldStatus,

            'NEGADO',

            $observation ?: 'Paciente finalizado na triagem'

        );

        /*
        |--------------------------------------------------------------------------
        | MOVEMENT
        |--------------------------------------------------------------------------
        */

        $this->createMovement(

            $patientId,

            'CENTRAL TRIAGEM',

            'FINALIZED',

            $observation ?: 'Finalização do fluxo'

        );

        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE TIMELINE
    |--------------------------------------------------------------------------
    */

    public function createTimeline(int $patientId, ?string $oldStatus, string $newStatus, ?string $observation = null, string $flowType = 'TRIAGE')
    {
        $this->statusHistoryModel->insert([

            'patient_id' => $patientId,

            'old_status' => $oldStatus,

            'new_status' => $newStatus,

            'observation' => $observation,

            'changed_by' => userId(),

            'flow_type' => $flowType,

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE MOVEMENT
    |--------------------------------------------------------------------------
    */

    public function createMovement(int $patientId, string $sector, string $movementType, ?string $observation = null, string $flowType = 'TRIAGE')
    {
        $this->movementModel->insert([

            'patient_id' => $patientId,

            'sector' => $sector,

            'movement_type' => $movementType,

            'observation' => $observation,

            'created_by' => userId(),

            'flow_type' => $flowType,

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE OBSERVATION
    |--------------------------------------------------------------------------
    */
    public function createObservation(int $patientId, string $observation, string $flowType = 'TRIAGE')
    {

        /*
        |--------------------------------------------------------------------------
        | SAVE OBSERVATION
        |--------------------------------------------------------------------------
        */

        $this->observationModel->insert([

            'patient_id' => $patientId,

            'observation' => $observation,

            'created_by' => userId(),

            'flow_type' => $flowType,

        ]);

        /*
        |--------------------------------------------------------------------------
        | TIMELINE
        |--------------------------------------------------------------------------
        */

        $this->createTimeline($patientId, null, 'OBSERVAÇÃO', $observation);

        return true;
    }
}
