<?php

namespace App\Controllers;

use App\Models\PatientModel;
use App\Models\PatientMovementModel;
use App\Models\PatientObservationModel;
use App\Models\PatientRequestModel;
use App\Models\PatientStatusHistoryModel;
use App\Models\RequestTypeModel;
use App\Services\PatientFlowService;
use App\Models\SpecialtyModel;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;

class TriageController extends BaseController
{
    protected $patientFlowService;

    protected $patientModel;

    protected $patientStatusHistoryModel;

    protected $patientMovementModel;

    protected $patientObservationModel;

    protected $specialtyModel;

    protected $patientRequestModel;

    protected $requestTypeModel;

    public function __construct()
    {
        $this->patientFlowService = new PatientFlowService();

        $this->patientModel = new PatientModel();

        $this->patientStatusHistoryModel = new PatientStatusHistoryModel();

        $this->patientMovementModel = new PatientMovementModel();

        $this->patientObservationModel = new PatientObservationModel();

        $this->specialtyModel = new SpecialtyModel();

        $this->patientRequestModel = new PatientRequestModel();

        $this->requestTypeModel = new RequestTypeModel();
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | PATIENTS
        |--------------------------------------------------------------------------
        */

        $patients = $this->patientModel

            ->select('patients.*, specialties.name as specialty_name')

            ->join(
                'specialties',
                'specialties.id = patients.specialty_id',
                'left'
            )

            ->where('flow_type', 'TRIAGE')

            ->orderBy('patients.id', 'DESC')

            ->findAll();
        /*
        |--------------------------------------------------------------------------
        | SPECIALTIES
        |--------------------------------------------------------------------------
        */

        $specialties = $this->specialtyModel

            ->where('status', 'ACTIVE')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | CARDS
        |--------------------------------------------------------------------------
        */

        $triageCount = 0;

        $finishedCount = 0;

        $warningCount = 0;

        $criticalCount = 0;

        foreach ($patients as $patient) {

            /*
            |--------------------------------------------------------------------------
            | TRIAGEM
            |--------------------------------------------------------------------------
            */

            $triageCount++;

            /*
            |--------------------------------------------------------------------------
            | FINALIZADOS HOJE
            |--------------------------------------------------------------------------
            */

            if (

                $patient['status'] == 'NEGADO' ||

                $patient['status'] == 'FINALIZADO'

            ) {

                if (!empty($patient['finalized_at'])) {

                    $finalizedDate = date(
                        'Y-m-d',
                        strtotime($patient['finalized_at'])
                    );

                    $todayDate = date('Y-m-d');

                    if ($finalizedDate == $todayDate) {

                        $finishedCount++;
                    }
                }
            }

            /*
            |--------------------------------------------------------------------------
            | SLA
            |--------------------------------------------------------------------------
            */

            $today = new DateTime(date('Y-m-d'));

            $consultation = new DateTime(
                $patient['first_consultation_date']
            );

            $diff = $today->diff($consultation);

            $days = $diff->days;

            $isLate = $diff->invert;

            /*
            |--------------------------------------------------------------------------
            | CRITICOS
            |--------------------------------------------------------------------------
            */

            if ($isLate) {

                $criticalCount++;
            } elseif ($days <= 20) {

                /*
            |--------------------------------------------------------------------------
            | PROXIMOS PRAZO
            |--------------------------------------------------------------------------
            */

                $warningCount++;
            }
        }

        return view('pages/triage/index', [

            'patients' => $patients,

            'triageCount' => $triageCount,

            'finishedCount' => $finishedCount,

            'warningCount' => $warningCount,

            'criticalCount' => $criticalCount,

            'specialties' => $specialties,

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store()
    {
        if (!can('triage.create')) {
            return redirect()->back()->with('error', 'Sem permissão.');
        }
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $rules = [

            'name' => 'required|min_length[3]',

            'medical_record' => 'required',

            'specialty_id' => 'required',

            'has_exams' => 'required',

            'first_service_date' => 'required',

            'first_consultation_date' => 'required',

        ];

        /*
        |--------------------------------------------------------------------------
        | VALIDATE
        |--------------------------------------------------------------------------
        */

        if (!$this->validate($rules)) {

            return $this->response->setJSON([

                'status' => false,

                'message' => strip_tags(
                    $this->validator->listErrors()
                )

            ]);
        }

        try {
            $medicalRecord = trim(
                $this->request->getPost('medical_record')
            );

            $cpf = trim(
                $this->request->getPost('cpf') ?? ''
            );

            /*
            |--------------------------------------------------------------------------
            | PRONTUÁRIO
            |--------------------------------------------------------------------------
            */

            if (
                $this->patientModel
                ->where('medical_record', $medicalRecord)
                ->first()
            ) {

                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Prontuário já cadastrado.'
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | CPF
            |--------------------------------------------------------------------------
            */

            if (
                !empty($cpf) &&
                $this->patientModel
                ->where('cpf', $cpf)
                ->first()
            ) {

                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'CPF já cadastrado.'
                ]);
            }

            $patientId = $this->patientFlowService
                ->createTriagePatient(

                    $this->request->getPost()

                );

            return $this->response->setJSON([

                'status' => true,

                'message' => 'Paciente criado com sucesso',

                'patient_id' => $patientId,

            ]);
        } catch (\Exception $e) {

            return $this->response->setJSON([

                'status' => false,

                'message' => $e->getMessage()

            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        /*
        |--------------------------------------------------------------------------
        | PATIENT
        |--------------------------------------------------------------------------
        */

        $patient = $this->patientModel

            ->select('
            patients.*,
            specialties.name as specialty_name
        ')

            ->join(
                'specialties',
                'specialties.id = patients.specialty_id',
                'left'
            )

            ->where('patients.id', $id)

            ->first();

        /*
        |--------------------------------------------------------------------------
        | NOT FOUND
        |--------------------------------------------------------------------------
        */

        if (!$patient) {

            throw \CodeIgniter\Exceptions\PageNotFoundException
                ::forPageNotFound();
        }

        /*
        |--------------------------------------------------------------------------
        | TIMELINE
        |--------------------------------------------------------------------------
        */


        $timeline = $this->patientStatusHistoryModel

            ->where('patient_id', $id)

            ->where('flow_type', 'TRIAGE')

            ->orderBy('id', 'DESC')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | MOVEMENTS
        |--------------------------------------------------------------------------
        */

        $movements = $this->patientMovementModel

            ->where('patient_id', $id)

            ->where('flow_type', 'TRIAGE')

            ->orderBy('id', 'DESC')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | OBSERVATIONS
        |--------------------------------------------------------------------------
        */

        $observations = $this->patientObservationModel

            ->where('patient_id', $id)

            ->where('flow_type', 'TRIAGE')

            ->orderBy('id', 'DESC')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | PATIENT REQUESTS
        |--------------------------------------------------------------------------
        */

        $patientRequests = $this->patientRequestModel

            ->select('
                patient_requests.*,

                request_types.name as request_name,

                request_types.deadline_days,

                request_types.is_external,

                specialties.name as specialty_name
            ')

            /*
            |--------------------------------------------------------------------------
            | PATIENT
            |--------------------------------------------------------------------------
            */

            ->join(
                'patients',
                'patients.id = patient_requests.patient_id',
                'left'
            )

            /*
            |--------------------------------------------------------------------------
            | REQUEST TYPES
            |--------------------------------------------------------------------------
            */

            ->join(
                'request_types',
                'request_types.id = patient_requests.request_type_id',
                'left'
            )

            /*
            |--------------------------------------------------------------------------
            | SPECIALTIES
            |--------------------------------------------------------------------------
            */

            ->join(
                'specialties',
                'specialties.id = patients.specialty_id',
                'left'
            )

            ->where('patient_requests.patient_id', $id)

            ->where('patient_requests.flow_type', 'TRIAGE')

            ->orderBy('patient_requests.id', 'DESC')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | REQUEST TYPES
        |--------------------------------------------------------------------------
        */

        $requestTypes = $this->requestTypeModel

            ->where('status', 'ACTIVE')

            ->where('flow_type', 'TRIAGE')

            ->orderBy('name', 'ASC')

            ->findAll();


        /*
        |--------------------------------------------------------------------------
        | SPECIALTIES
        |--------------------------------------------------------------------------
        */

        $specialties = $this->specialtyModel

            ->where('status', 'ACTIVE')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view('pages/triage/show', [

            'patient' => $patient,

            'timeline' => $timeline,

            'movements' => $movements,

            'observations' => $observations,

            'patientRequests' => $patientRequests,

            'requestTypes' => $requestTypes,

            'specialties' => $specialties,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PATIENT
    |--------------------------------------------------------------------------
    */

    public function updatePatient()
    {
        if (!can('triage.update')) {
            return redirect()->back()->with('error', 'Sem permissão.');
        }
        $id = $this->request
            ->getPost('id');

        try {

            $this->patientModel
                ->update($id, [

                    'name' => $this->request->getPost('name'),

                    'medical_record' => $this->request->getPost('medical_record'),

                    'cpf' => $this->request->getPost('cpf'),

                    'phone' => $this->request->getPost('phone'),

                    'specialty_id' => $this->request->getPost('specialty_id'),

                    'has_exams' => $this->request->getPost('has_exams'),

                    'first_service_date' => $this->request->getPost('first_service_date'),

                    'first_consultation_date' => $this->request->getPost('first_consultation_date'),

                    'observations' => $this->request->getPost('observations'),

                ]);

            /*
            |--------------------------------------------------------------------------
            | TIMELINE
            |--------------------------------------------------------------------------
            */

            $this->patientFlowService
                ->createTimeline(

                    $id,

                    null,

                    'PACIENTE_EDITADO',

                    'Dados do paciente atualizados'

                );

            return $this->response->setJSON([

                'status' => true,

                'message' =>
                'Paciente atualizado com sucesso'

            ]);
        } catch (\Exception $e) {

            return $this->response->setJSON([

                'status' => false,

                'message' =>
                $e->getMessage()

            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | STORE OBSERVATION
    |--------------------------------------------------------------------------
    */
    public function storeObservation()
    {
        if (!can('triage.observation')) {
            return redirect()->back()->with('error', 'Sem permissão.');
        }
        try {

            $patientId = $this->request->getPost('patient_id');

            $observation = $this->request->getPost('observation');

            /*
            |--------------------------------------------------------------------------
            | SAVE
            |--------------------------------------------------------------------------
            */

            $this->patientFlowService->createObservation(

                $patientId,

                $observation

            );

            return $this->response->setJSON([

                'status' => true,

                'message' => 'Observação adicionada'

            ]);
        } catch (\Exception $e) {

            return $this->response->setJSON([

                'status' => false,

                'message' => $e->getMessage()

            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | STORE REQUEST
    |--------------------------------------------------------------------------
    */
    public function storeRequest()
    {
        if (!can('triage.requests.create')) {
            return redirect()->back()->with('error', 'Sem permissão.');
        }
        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $patientId = $this->request->getPost('patient_id');

        $requestTypeId = $this->request->getPost('request_type_id');

        $scheduledDate = $this->request->getPost('scheduled_date');

        $alertOffsetDays = (int) $this->request->getPost('alert_offset_days');

        $observation = $this->request->getPost('observation');

        /*
        |--------------------------------------------------------------------------
        | PATIENT
        |--------------------------------------------------------------------------
        */

        $patient = $this->patientModel->find($patientId);

        if (!$patient) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Paciente não encontrado'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATE CONSULTATION DATE
        |--------------------------------------------------------------------------
        */

        if (

            strtotime($scheduledDate)

            >

            strtotime(
                $patient['first_consultation_date']
            )

        ) {

            return $this->response->setJSON([

                'status' => false,

                'message' =>
                'O exame não pode ultrapassar a data da consulta'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | DEADLINE DATE
        |--------------------------------------------------------------------------
        */

        $deadlineDate =
            $patient['first_consultation_date'];

        /*
        |--------------------------------------------------------------------------
        | ALERT DATE
        |--------------------------------------------------------------------------
        */

        $alertDate = date(

            'Y-m-d',

            strtotime(

                $deadlineDate .

                    ' ' .

                    $alertOffsetDays .

                    ' days'

            )

        );

        try {

            /*
            |--------------------------------------------------------------------------
            | INSERT
            |--------------------------------------------------------------------------
            */

            $requestId = $this->patientRequestModel
                ->insert([

                    'patient_id' => $patientId,

                    'request_type_id' => $requestTypeId,

                    'request_status' => 'PENDING',

                    'requested_at' => date('Y-m-d'),

                    'scheduled_date' => $scheduledDate,

                    'deadline_date' => $deadlineDate,

                    'alert_offset_days' => $alertOffsetDays,

                    'alert_date' => $alertDate,

                    'observation' => $observation,

                    'created_by' => userId(),

                    'flow_type' => 'TRIAGE',
                ]);

            /*
            |--------------------------------------------------------------------------
            | REQUEST TYPE
            |--------------------------------------------------------------------------
            */

            $requestType = $this->requestTypeModel
                ->find($requestTypeId);

            /*
            |--------------------------------------------------------------------------
            | TIMELINE
            |--------------------------------------------------------------------------
            */

            $this->patientFlowService
                ->createTimeline(

                    $patientId,

                    null,

                    'SOLICITAÇÃO',

                    'Solicitação de ' .
                        $requestType['name']
                );

            /*
            |--------------------------------------------------------------------------
            | SUCCESS
            |--------------------------------------------------------------------------
            */

            return $this->response->setJSON([

                'status' => true,

                'message' =>
                'Solicitação criada com sucesso',

                'request_id' => $requestId

            ]);
        } catch (\Exception $e) {

            /*
            |--------------------------------------------------------------------------
            | ERROR
            |--------------------------------------------------------------------------
            */

            return $this->response->setJSON([

                'status' => false,

                'message' => $e->getMessage()

            ]);
        }
    }
    /*
    |--------------------------------------------------------------------------
    | UPDATE REQUEST
    |--------------------------------------------------------------------------
    */

    public function updateRequest()
    {
        if (!can('triage.requests.update')) {
            return redirect()->back()->with('error', 'Sem permissão.');
        }

        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $id = $this->request->getPost('id');

        $requestTypeId = $this->request->getPost('request_type_id');

        $scheduledDate = $this->request->getPost('scheduled_date');

        $alertOffsetDays = (int) $this->request->getPost('alert_offset_days');

        $requestStatus = $this->request->getPost('request_status');

        $observation = $this->request->getPost('observation');

        /*
        |--------------------------------------------------------------------------
        | REQUEST
        |--------------------------------------------------------------------------
        */

        $request = $this->patientRequestModel->find($id);

        if (!$request) {

            return $this->response->setJSON([

                'status' => false,

                'message' =>
                'Solicitação não encontrada'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | PATIENT
        |--------------------------------------------------------------------------
        */

        $patient = $this->patientModel->find($request['patient_id']);

        /*
        |--------------------------------------------------------------------------
        | VALIDATE CONSULTATION
        |--------------------------------------------------------------------------
        */

        if (strtotime($scheduledDate) > strtotime($patient['first_consultation_date'])) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'O exame não pode ultrapassar a consulta'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | ALERT DATE
        |--------------------------------------------------------------------------
        */

        $alertDate = date('Y-m-d', strtotime($patient['first_consultation_date'] . ' ' . $alertOffsetDays . ' days'));

        try {

            /*
            |--------------------------------------------------------------------------
            | UPDATE
            |--------------------------------------------------------------------------
            */

            $this->patientRequestModel
                ->update($id, [

                    'request_type_id' => $requestTypeId,

                    'scheduled_date' => $scheduledDate,

                    'alert_offset_days' => $alertOffsetDays,

                    'alert_date' => $alertDate,

                    'request_status' => $requestStatus,

                    'observation' => $observation,

                ]);

            /*
            |--------------------------------------------------------------------------
            | TIMELINE
            |--------------------------------------------------------------------------
            */

            $this->patientFlowService->createTimeline($request['patient_id'], null, 'SOLICITAÇÃO EDITADA', 'Solicitação atualizada');

            /*
            |--------------------------------------------------------------------------
            | SUCCESS
            |--------------------------------------------------------------------------
            */

            return $this->response->setJSON([

                'status' => true,

                'message' =>
                'Solicitação atualizada com sucesso'

            ]);
        } catch (\Exception $e) {

            return $this->response->setJSON([

                'status' => false,

                'message' => $e->getMessage()

            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE REQUEST
    |--------------------------------------------------------------------------
    */

    public function deleteRequest()
    {
        if (!can('triage.requests.delete')) {
            return redirect()->back()->with('error', 'Sem permissão.');
        }
        /*
        |--------------------------------------------------------------------------
        | ID
        |--------------------------------------------------------------------------
        */

        $id = $this->request
            ->getPost('id');

        /*
        |--------------------------------------------------------------------------
        | REQUEST
        |--------------------------------------------------------------------------
        */

        $request = $this->patientRequestModel
            ->find($id);

        if (!$request) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Solicitação não encontrada'

            ]);
        }

        try {

            /*
            |--------------------------------------------------------------------------
            | DELETE
            |--------------------------------------------------------------------------
            */

            $this->patientRequestModel->delete($id);

            /*
            |--------------------------------------------------------------------------
            | TIMELINE
            |--------------------------------------------------------------------------
            */

            $this->patientFlowService->createTimeline(

                $request['patient_id'],

                null,

                'SOLICITACAO REMOVIDA',

                'Solicitação removida'

            );

            /*
            |--------------------------------------------------------------------------
            | SUCCESS
            |--------------------------------------------------------------------------
            */

            return $this->response->setJSON([

                'status' => true,

                'message' => 'Solicitação removida com sucesso'

            ]);
        } catch (\Exception $e) {

            return $this->response->setJSON([

                'status' => false,

                'message' => $e->getMessage()

            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | FINALIZE REQUEST
    |--------------------------------------------------------------------------
    */

    public function finalizeRequest()
    {
        if (!can('triage.request.finalize')) {
            return redirect()->back()->with('error', 'Sem permissão.');
        }
        /*
        |--------------------------------------------------------------------------
        | ID
        |--------------------------------------------------------------------------
        */

        $id = $this->request->getPost('id');

        /*
        |--------------------------------------------------------------------------
        | REQUEST
        |--------------------------------------------------------------------------
        */

        $request = $this->patientRequestModel->find($id);

        if (!$request) {

            return $this->response->setJSON([

                'status' => false,

                'message' =>
                'Solicitação não encontrada'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | ALREADY COMPLETED
        |--------------------------------------------------------------------------
        */

        if (

            $request['request_status']

            ==

            'COMPLETED'

        ) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Solicitação já finalizada'

            ]);
        }

        try {

            /*
            |--------------------------------------------------------------------------
            | UPDATE
            |--------------------------------------------------------------------------
            */

            $this->patientRequestModel->update($id, [

                'request_status' => 'COMPLETED',

                'completed_at' => date('Y-m-d')

            ]);

            /*
            |--------------------------------------------------------------------------
            | REQUEST TYPE
            |--------------------------------------------------------------------------
            */

            $requestType = $this->requestTypeModel
                ->find(

                    $request['request_type_id']

                );

            /*
            |--------------------------------------------------------------------------
            | TIMELINE
            |--------------------------------------------------------------------------
            */

            $this->patientFlowService->createTimeline(

                $request['patient_id'],

                null,

                'EXAME FINALIZADO',

                'Exame ' .

                    $requestType['name'] .

                    ' finalizado'

            );

            /*
            |--------------------------------------------------------------------------
            | SUCCESS
            |--------------------------------------------------------------------------
            */

            return $this->response->setJSON([

                'status' => true,

                'message' => 'Exame finalizado com sucesso'

            ]);
        } catch (\Exception $e) {

            return $this->response->setJSON([

                'status' => false,

                'message' => $e->getMessage()

            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | TRANSFER PATIENT
    |--------------------------------------------------------------------------
    */

    public function transferPatient()
    {
        if (!can('triage.transfer')) {
            return redirect()->back()->with('error', 'Sem permissão.');
        }
        /*
        |--------------------------------------------------------------------------
        | PATIENT
        |--------------------------------------------------------------------------
        */

        $patientId = $this->request->getPost('patient_id');

        /*
        |--------------------------------------------------------------------------
        | PATIENT
        |--------------------------------------------------------------------------
        */

        $patient = $this->patientModel->find($patientId);

        if (!$patient) {

            return $this->response->setJSON([

                'status' => false,

                'message' =>
                'Paciente não encontrado'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | PENDING REQUESTS
        |--------------------------------------------------------------------------
        */

        $pendingRequests = $this->patientRequestModel

            ->where('patient_id', $patientId)

            ->where('request_status', 'PENDING')

            ->where('flow_type', 'TRIAGE')

            ->where('request_status', 'PENDING')

            ->countAllResults();

        /*
        |--------------------------------------------------------------------------
        | BLOCK TRANSFER
        |--------------------------------------------------------------------------
        */

        if ($pendingRequests > 0) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Existem exames pendentes para este paciente'

            ]);
        }

        try {

            /*
            |--------------------------------------------------------------------------
            | TRANSFER
            |--------------------------------------------------------------------------
            */

            $this->patientModel->update($patientId, [

                'flow_type' => 'PATIENT',

                'status' => 'EM FILA',

                'current_sector' => 'CENTRAL PACIENTE',

            ]);

            /*
            |--------------------------------------------------------------------------
            | TIMELINE
            |--------------------------------------------------------------------------
            */

            $this->patientFlowService->createTimeline(

                $patientId,

                null,

                'TRANSFERENCIA',

                'Paciente transferido para fila principal'

            );

            /*
            |--------------------------------------------------------------------------
            | SUCCESS
            |--------------------------------------------------------------------------
            */

            return $this->response->setJSON([

                'status' => true,

                'message' => 'Paciente transferido com sucesso'

            ]);
        } catch (\Exception $e) {

            return $this->response->setJSON([

                'status' => false,

                'message' => $e->getMessage()

            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | REQUEST PDF
    |--------------------------------------------------------------------------
    */
    public function pdf($id)
    {
        if (!can('triage.pdf')) {
            return redirect()->back()->with('error', 'Sem permissão.');
        }
        $patient = $this->patientModel->find($id);


        $patientRequests = $this->patientRequestModel

            ->select('
                patient_requests.*,
                request_types.name AS request_type_name,
                request_types.deadline_days
            ')

            ->join(
                'request_types',
                'request_types.id = patient_requests.request_type_id',
                'left'
            )

            ->where(
                'patient_requests.patient_id',
                $id
            )

            ->findAll();

        return view('pdf/patient', [

            'patient' => $patient,

            'patientRequests' => $patientRequests

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | GENERATE PDF
    |--------------------------------------------------------------------------
    */

    public function generatePdf($id)
    {
        /*
        |--------------------------------------------------------------------------
        | PATIENT
        |--------------------------------------------------------------------------
        */

        $patient = $this->patientModel

            ->select('
            patients.*,

            specialties.name as specialty_name
        ')

            ->join(
                'specialties',
                'specialties.id = patients.specialty_id',
                'left'
            )

            ->find($id);
        // dd($patient);

        /*
        |--------------------------------------------------------------------------
        | OBSERVATIONS
        |--------------------------------------------------------------------------
        */

        $observations = $this->patientObservationModel

            ->where('patient_id', $id)

            ->where('flow_type', 'TRIAGE')

            ->orderBy('id', 'DESC')

            ->findAll();

        // dd($observations);

        /*
        |--------------------------------------------------------------------------
        | REQUESTS
        |--------------------------------------------------------------------------
        */

        $patientRequests = $this->patientRequestModel

            ->select('
            patient_requests.*,
            request_types.name as request_type_name,
            request_types.deadline_days
            ')

            ->join(
                'request_types',
                'request_types.id = patient_requests.request_type_id',
                'left'
            )

            ->where('patient_requests.patient_id', $id)

            ->where('patient_requests.flow_type', 'TRIAGE')

            ->findAll();

        // dd($patientRequests);
        /*
        |--------------------------------------------------------------------------
        | TIMELINE
        |--------------------------------------------------------------------------
        */

        $timeline = $this->patientStatusHistoryModel

            ->where('patient_id', $id)

            ->where('flow_type', 'TRIAGE')

            ->orderBy('id', 'DESC')

            ->findAll();

        // dd($timeline);
        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        $html = view(

            'pdf/triage',

            [

                'patient' => $patient,

                'observations' => $observations,

                'patientRequests' => $patientRequests,

                'timeline' => $timeline,

            ]

        );

        // dd($html);

        /*
        |--------------------------------------------------------------------------
        | DOMPDF
        |--------------------------------------------------------------------------
        */

        $options = new Options();

        $options->set('isRemoteEnabled', true);

        // dd($options);

        $dompdf = new Dompdf($options);

        // dd($dompdf);

        $dompdf->loadHtml($html);

        // dd('HTML carregado');

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        // dd('PDF renderizado');

        /*
        |--------------------------------------------------------------------------
        | STREAM
        |--------------------------------------------------------------------------
        */

        // $dompdf->stream(

        //     'paciente-' . $patient['id'],

        //     [

        //         'Attachment' => false

        //     ]

        // );
        $pdf = $dompdf->output();

        // dd(substr($pdf, 0, 30));

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setBody($pdf);
    }
}
