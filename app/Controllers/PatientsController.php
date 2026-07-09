<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PatientHospitalizationModel;
use App\Models\PatientModel;
use App\Models\SpecialtyModel;
use App\Models\PatientMovementModel;
use App\Models\PatientObservationModel;
use App\Models\PatientRequestModel;
use App\Models\PatientStatusHistoryModel;
use App\Models\RequestTypeModel;
use App\Services\PatientFlowService;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;

class PatientsController extends BaseController
{
    protected $patientFlowService;

    protected $patientModel;

    protected $patientStatusHistoryModel;

    protected $patientMovementModel;

    protected $patientObservationModel;

    protected $specialtyModel;

    protected $patientRequestModel;

    protected $requestTypeModel;

    protected $patientHospitalizationModel;

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

        $this->patientHospitalizationModel = new PatientHospitalizationModel();
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
        | FILTROS
        |--------------------------------------------------------------------------
        */

        $search = trim($this->request->getGet('search') ?? '');

        $status = $this->request->getGet('status') ?? '';

        $perPage = (int) ($this->request->getGet('perPage') ?? 10);

        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        $firstServiceOrder = $this->request->getGet('first_service_order');

        /*
        |--------------------------------------------------------------------------
        | PATIENTS
        |--------------------------------------------------------------------------
        */

        $builder = $this->patientModel

            ->select('
            patients.*,
            specialties.name as specialty_name
        ')

            ->join(
                'specialties',
                'specialties.id = patients.specialty_id',
                'left'
            )

            ->where(
                'patients.flow_type',
                'PATIENT'
            );

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if (!empty($search)) {

            $builder

                ->groupStart()

                ->like('patients.name', $search)

                ->orLike('patients.medical_record', $search)

                ->orLike('patients.cpf', $search)

                ->orLike('specialties.name', $search)

                ->groupEnd();
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */

        if (!empty($status)) {

            $builder->where(
                'patients.status',
                $status
            );
        }


        if (in_array($firstServiceOrder, ['ASC', 'DESC'])) {

            $builder->orderBy(
                'patients.first_service_date',
                $firstServiceOrder
            );
        } else {

            $builder->orderBy(
                'patients.id',
                'DESC'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $patients = $builder->paginate($perPage);

        $pager = $this->patientModel->pager;

        /*
        |--------------------------------------------------------------------------
        | FOOTER
        |--------------------------------------------------------------------------
        */

        $total = $pager->getTotal();

        $currentPage = $pager->getCurrentPage();

        $inicio = $total
            ? (($currentPage - 1) * $perPage) + 1
            : 0;

        $fim = min(
            $currentPage * $perPage,
            $total
        );

        /*
        |--------------------------------------------------------------------------
        | SPECIALTIES
        |--------------------------------------------------------------------------
        */

        $specialties = $this->specialtyModel

            ->where(
                'status',
                'ACTIVE'
            )

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | CARDS
        |--------------------------------------------------------------------------
        */

        $patientsInAttendance = $this->patientModel

            ->where('flow_type', 'PATIENT')

            ->where('status', 'EM ATENDIMENTO')

            ->countAllResults();

        $hospitalizedPatients = $this->patientModel

            ->where('flow_type', 'PATIENT')

            ->where('status', 'INTERNADO')

            ->countAllResults();

        $finalizedPatients = $this->patientModel

            ->where('flow_type', 'PATIENT')

            ->where('status', 'FINALIZADO')

            ->countAllResults();

        $pendingRequests = $this->patientRequestModel

            ->where('flow_type', 'PATIENT')

            ->where('request_status', 'PENDING')

            ->countAllResults();

        /*
        |--------------------------------------------------------------------------
        | RETURN
        |--------------------------------------------------------------------------
        */

        return view(

            'pages/patients/index',

            [

                'patients' => $patients,

                'pager' => $pager,

                'search' => $search,

                'status' => $status,

                'perPage' => $perPage,

                'inicio' => $inicio,

                'fim' => $fim,

                'total' => $total,

                'specialties' => $specialties,

                'patientsInAttendance' => $patientsInAttendance,

                'hospitalizedPatients' => $hospitalizedPatients,

                'finalizedPatients' => $finalizedPatients,

                'pendingRequests' => $pendingRequests,


            ]

        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store()
    {
        if (!can('patients.create')) {


            return redirect()
                ->back()
                ->with('error', 'Sem permissão.');
        }

        /*
        |--------------------------------------------------------------------------
        | DATA VALIDATION
        |--------------------------------------------------------------------------
        */

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

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Prontuário já cadastrado.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | CPF
        |--------------------------------------------------------------------------
        */

        if (
            !empty($cpf)
            &&
            $this->patientModel
            ->where('cpf', $cpf)
            ->first()
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'CPF já cadastrado.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $acceptedAt = date('Y-m-d');

        $data = [

            'name' => $this->request->getPost('name'),

            'medical_record' => $medicalRecord,

            'cpf' => $cpf,

            'phone' => $this->request->getPost('phone'),

            'specialty_id' => $this->request->getPost('specialty_id'),

            'accepted_at' => $acceptedAt,

            'first_service_date' => $this->request->getPost('first_service_date'),

            'first_consultation_date' => date(

                'Y-m-d',

                strtotime(
                    $acceptedAt . ' +60 days'
                )

            ),

            'has_exams' => $this->request->getPost('has_exams'),

            'state' => $this->request->getPost('state'),

            'city' => $this->request->getPost('city'),

            'status' => 'EM ATENDIMENTO',

            'flow_type' => 'PATIENT',

            'current_sector' => 'PACIENTE',

        ];

        try {

            /*
            |--------------------------------------------------------------------------
            | INSERT
            |--------------------------------------------------------------------------
            */

            $patientId = $this->patientModel
                ->insert($data);

            /*
            |--------------------------------------------------------------------------
            | MOVEMENT
            |--------------------------------------------------------------------------
            */

            $this->patientMovementModel->insert([

                'patient_id' => $patientId,

                'movement_type' => 'CADASTRO REALIZADO',

                'sector' => 'PACIENTE',

                'description' => 'Paciente cadastrado no sistema',

                'created_by' => userId(),

                'flow_type' => 'PATIENT',

            ]);

            /*
            |--------------------------------------------------------------------------
            | STATUS HISTORY
            |--------------------------------------------------------------------------
            */

            $this->patientStatusHistoryModel->insert([

                'patient_id' => $patientId,

                'old_status' => null,

                'new_status' => 'EM ATENDIMENTO',

                'observation' => 'Cadastro inicial do paciente',

                'changed_by' => userId(),

                'flow_type' => 'PATIENT',

            ]);

            /*
            |--------------------------------------------------------------------------
            | SUCCESS
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->to('/patients')
                ->with(
                    'success',
                    'Paciente cadastrado com sucesso.'
                );
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | STORE REQUEST
    |--------------------------------------------------------------------------
    */
    public function storeRequest()
    {
        if (!can('patients.create')) {
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

        $alertOffset = $this->request->getPost('alert_offset_days');

        $alertDate = $this->request->getPost('alert_date');

        $observation = $this->request->getPost('observation');

        /*
        |--------------------------------------------------------------------------
        | CALCULATE ALERT DATE
        |--------------------------------------------------------------------------
        */

        if (!empty($scheduledDate)) {

            $alertDate = date(

                'Y-m-d',

                strtotime(

                    $scheduledDate .

                        ' -' .

                        abs($alertOffset) .

                        ' days'

                )

            );
        } else {

            $alertOffset = 0;
        }

        /*
        |--------------------------------------------------------------------------
        | SAVE REQUEST
        |--------------------------------------------------------------------------
        */

        $this->patientRequestModel->insert([

            'patient_id' => $patientId,

            'request_type_id' => $requestTypeId,

            'request_status' => 'PENDING',

            'requested_at' => date('Y-m-d'),

            'scheduled_date' => $scheduledDate,

            'alert_offset_days' => $alertOffset,

            'alert_date' => $alertDate,

            'observation' => $observation,

            'created_by' => userId(),

            'flow_type' => 'PATIENT',

        ]);

        /*
        |--------------------------------------------------------------------------
        | REQUEST TYPE
        |--------------------------------------------------------------------------
        */

        $requestType = $this->requestTypeModel->find($requestTypeId);

        if (!$requestType) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Tipo de solicitação não encontrado.'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | TIMELINE
        |--------------------------------------------------------------------------
        */

        $this->patientStatusHistoryModel->insert([

            'patient_id' => $patientId,

            'old_status' => null,

            'new_status' => 'SOLICITAÇÃO',

            'observation' =>

            'Solicitação criada: ' .

                $requestType['name'] .

                '. Alerta programado para ' .

                date(
                    'd/m/Y',
                    strtotime($alertDate)
                ),

            'changed_by' => userId(),

            'flow_type' => 'PATIENT',

        ]);

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return $this->response->setJSON([

            'status' => true,

            'message' => 'Solicitação cadastrada com sucesso.'

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update()
    {
        if (!can('patients.update')) {
            return redirect()->back()->with('error', 'Sem permissão.');
        }
        /*
        |--------------------------------------------------------------------------
        | ID
        |--------------------------------------------------------------------------
        */

        $id =
            $this->request
            ->getPost('id');

        /*
        |--------------------------------------------------------------------------
        | PATIENT
        |--------------------------------------------------------------------------
        */

        $patient =
            $this->patientModel
            ->find($id);

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        if (!$patient) {

            return redirect()

                ->back()

                ->with(

                    'error',

                    'Paciente não encontrado.'

                );
        }

        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $data = [

            'name' => $this->request->getPost('name'),

            'medical_record' => $this->request->getPost('medical_record'),

            'cpf' => $this->request->getPost('cpf'),

            'phone' => $this->request->getPost('phone'),

            'specialty_id' => $this->request->getPost('specialty_id'),

            'first_service_date' => $this->request->getPost('first_service_date'),

            // 'first_consultation_date' => $this->request->getPost('first_consultation_date'),

            'has_exams' => $this->request->getPost('has_exams'),

            'state' => $this->request->getPost('state'),

            'city' => $this->request->getPost('city'),

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            'status' => 'EM ATENDIMENTO',

        ];

        /*
        |--------------------------------------------------------------------------
        | ACCEPTED AT
        |--------------------------------------------------------------------------
        */

        if (
            empty($patient['accepted_at'])
        ) {

            $data['accepted_at'] =
                date('Y-m-d');
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $this->patientModel->update($id, $data);

        /*
        |--------------------------------------------------------------------------
        | MOVEMENT
        |--------------------------------------------------------------------------
        */

        $this->patientMovementModel->insert([

            'patient_id' => $id,

            'movement_type' => 'CADASTRO COMPLEMENTADO',

            'sector' => 'PACIENTE',

            'description' => 'Cadastro do paciente complementado',

            'created_by' => userId(),

            'flow_type' => 'PATIENT',
        ]);

        /*
        |--------------------------------------------------------------------------
        | STATUS HISTORY
        |--------------------------------------------------------------------------
        */

        $this->patientStatusHistoryModel->insert([

            'patient_id' => $id,

            'old_status' => 'EM FILA',

            'new_status' => 'EM ATENDIMENTO',

            'observation' => 'Cadastro complementar realizado',

            'changed_by' => userId(),

            'flow_type' => 'PATIENT',

        ]);

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return redirect()

            ->to('/patients')

            ->with(

                'success',

                'Paciente atualizado com sucesso.'

            );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA
    |--------------------------------------------------------------------------
    */
    public function updateData()
    {
        if (!can('patients.update')) {
            return redirect()->back()->with('error', 'Sem permissão.');
        }
        $id = $this->request->getPost('id');

        $patient = $this->patientModel->find($id);

        if (!$patient) {

            return redirect()

                ->back()

                ->with(
                    'error',
                    'Paciente não encontrado.'
                );
        }

        $data = [

            'name' => $this->request->getPost('name'),

            'medical_record' => $this->request->getPost('medical_record'),

            'cpf' => $this->request->getPost('cpf'),

            'phone' => $this->request->getPost('phone'),

            'specialty_id' => $this->request->getPost('specialty_id'),

            'has_exams' => $this->request->getPost('has_exams'),

            'first_service_date' => $this->request->getPost('first_service_date'),

            'state' => $this->request->getPost('state'),

            'city' => $this->request->getPost('city'),

            /*
            |--------------------------------------------------------------------------
            | ACEITE
            |--------------------------------------------------------------------------
            */

            'status' => 'EM ATENDIMENTO',

            'accepted_at' => date('Y-m-d H:i:s'),

            'current_sector' => 'PATIENTS',


        ];

        $this->patientModel->update($id, $data);

        $this->patientStatusHistoryModel->insert([

            'patient_id' => $id,

            'old_status' => 'EM FILA',

            'new_status' => 'EM ATENDIMENTO',

            'description' => 'Paciente aceito pela Central de Pacientes',

            'created_by' => userId(),

        ]);

        $this->patientMovementModel->insert([

            'patient_id' => $id,

            'sector' => 'PACIENTE',

            'movement_type' => 'ACEITE',

            'description' => 'Paciente aceito na Central de Pacientes',

            'created_by' => userId(),

            'flow_type' => 'PATIENT',

        ]);

        return redirect()

            ->back()

            ->with(
                'success',
                'Dados atualizados com sucesso.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE REQUEST
    |--------------------------------------------------------------------------
    */
    public function updateRequest()
    {
        if (!can('patients.update')) {
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

        $alertOffset = $this->request->getPost('alert_offset_days');

        $alertDate = $this->request->getPost('alert_date');

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

                'message' => 'Solicitação não encontrada.'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | REQUEST TYPE
        |--------------------------------------------------------------------------
        */

        $requestType = $this->requestTypeModel->find($requestTypeId);

        if (!$requestType) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Tipo de solicitação não encontrado.'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | CALCULATE ALERT DATE
        |--------------------------------------------------------------------------
        */

        if (!empty($scheduledDate)) {

            $alertDate = date(

                'Y-m-d',

                strtotime(

                    $scheduledDate .

                        ' -' .

                        abs($alertOffset) .

                        ' days'

                )

            );
        } else {

            $alertOffset = 0;
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $this->patientRequestModel->update(

            $id,

            [

                'request_type_id' => $requestTypeId,

                'scheduled_date' => $scheduledDate,

                'alert_offset_days' => $alertOffset,

                'alert_date' => $alertDate,

                'observation' => $observation,

            ]

        );

        /*
        |--------------------------------------------------------------------------
        | TIMELINE
        |--------------------------------------------------------------------------
        */

        $this->patientStatusHistoryModel->insert([

            'patient_id' => $request['patient_id'],

            'old_status' => null,

            'new_status' => 'SOLICITAÇÃO',

            'observation' =>

            'Solicitação atualizada: ' .

                $requestType['name'] .

                '. Alerta programado para ' .

                date(

                    'd/m/Y',

                    strtotime($alertDate)

                ),

            'changed_by' => userId(),

            'flow_type' => 'PATIENT',

        ]);

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return $this->response->setJSON([

            'status' => true,

            'message' => 'Solicitação atualizada com sucesso.'

        ]);
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

                specialties.name
                as specialty_name,

                states.name
                as state_name,

                states.uf
                as state_uf
            ')

            ->join(
                'specialties',
                'specialties.id = patients.specialty_id',
                'left'
            )

            ->join(
                'states',
                'states.id = patients.state',
                'left'
            )

            ->find($id);

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        if (!$patient) {

            return redirect()->to('/patients')->with('error', 'Paciente não encontrado.');
        }

        /*
        |--------------------------------------------------------------------------
        | MOVEMENTS
        |--------------------------------------------------------------------------
        */

        $movements = $this->patientMovementModel

            ->where('patient_id', $id)

            ->where('flow_type', 'PATIENT')

            ->orderBy('created_at', 'DESC')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | OBSERVATIONS
        |--------------------------------------------------------------------------
        */

        $observations = $this->patientObservationModel

            ->where('patient_id', $id)

            ->where('flow_type', 'PATIENT')

            ->orderBy('created_at', 'DESC')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | REQUESTS
        |--------------------------------------------------------------------------
        */

        $requests = $this->patientRequestModel

            ->select('patient_requests.*,request_types.name as request_type_name')

            ->join('request_types', 'request_types.id= patient_requests.request_type_id', 'left')

            ->where('patient_id', $id)

            ->where('patient_requests.flow_type', 'PATIENT')

            ->orderBy('created_at', 'DESC')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | STATUS HISTORY
        |--------------------------------------------------------------------------
        */

        $statusHistory = $this->patientStatusHistoryModel

            ->where('patient_id', $id)

            ->where('flow_type', 'PATIENT')

            ->orderBy('created_at', 'DESC')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | REQUEST TYPES
        |--------------------------------------------------------------------------
        */
        $requestTypes = $this->requestTypeModel

            ->orderBy('name', 'ASC')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | RETURN
        |--------------------------------------------------------------------------
        */

        return view(

            'pages/patients/show',

            [

                'patient' => $patient,

                'movements' => $movements,

                'observations' => $observations,

                'requests' => $requests,

                'statusHistory' => $statusHistory,

                'requestTypes' => $requestTypes,

            ]

        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE OBSERVATION
    |--------------------------------------------------------------------------
    */
    public function storeObservation()
    {
        if (!can('patients.observation')) {
            return redirect()->back()->with('error', 'Sem permissão.');
        }

        $patientId = $this->request->getPost('patient_id');

        $observation = $this->request->getPost('observation');

        /*
        |--------------------------------------------------------------------------
        | SAVE OBSERVATION
        |--------------------------------------------------------------------------
        */

        $this->patientObservationModel->insert([

            'patient_id' => $patientId,

            'observation' => $observation,

            'created_by' => userId(),

            'flow_type' => 'PATIENT',

        ]);

        /*
        |--------------------------------------------------------------------------
        | TIMELINE
        |--------------------------------------------------------------------------
        */

        $this->patientStatusHistoryModel->insert([

            'patient_id' => $patientId,

            'old_status' => null,

            'new_status' => 'OBSERVAÇÃO',

            'observation' => $observation,

            'changed_by' => userId(),

            'flow_type' => 'PATIENT',

        ]);

        return redirect()

            ->back()

            ->with(

                'success',

                'Observação adicionada com sucesso.'

            );
    }

    /*
    |--------------------------------------------------------------------------
    | FINALIZE REQUEST
    |--------------------------------------------------------------------------
    */
    public function finalizeRequest()
    {
        if (!can('patients.request.finalize')) {
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

                'message' => 'Solicitação não encontrada.'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $this->patientRequestModel->update(

            $id,

            [

                'request_status' => 'COMPLETED',

                'completed_at' => date('Y-m-d H:i:s')

            ]

        );

        /*
        |--------------------------------------------------------------------------
        | REQUEST TYPE
        |--------------------------------------------------------------------------
        */

        $requestType =
            $this->requestTypeModel
            ->find($request['request_type_id']);

        /*
        |--------------------------------------------------------------------------
        | TIMELINE
        |--------------------------------------------------------------------------
        */

        $this->patientStatusHistoryModel
            ->insert([

                'patient_id' => $request['patient_id'],

                'old_status' => null,

                'new_status' => 'SOLICITAÇÃO',

                'observation' =>

                'Solicitação finalizada: '

                    . $requestType['name'],

                'changed_by' => userId(),

                'flow_type' => 'PATIENT',

            ]);

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return $this->response->setJSON([

            'status' => true,

            'message' => 'Solicitação finalizada com sucesso.'

        ]);
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

        $id = $this->request->getPost('id');

        /*
        |--------------------------------------------------------------------------
        | REQUEST
        |--------------------------------------------------------------------------
        */

        $request =
            $this->patientRequestModel
            ->find($id);

        if (!$request) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Solicitação não encontrada.'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | REQUEST TYPE
        |--------------------------------------------------------------------------
        */

        $requestType = $this->requestTypeModel->find($request['request_type_id']);

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

        $this->patientStatusHistoryModel->insert([

            'patient_id' => $request['patient_id'],

            'old_status' => null,

            'new_status' => 'SOLICITAÇÃO REMOVIDA',

            'observation' =>

            'Solicitação removida: '

                . $requestType['name'],

            'changed_by' => userId(),

            'flow_type' => 'PATIENT',

        ]);

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return $this->response->setJSON([

            'status' => true,

            'message' => 'Solicitação removida com sucesso.'

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE OBSERVATION
    |--------------------------------------------------------------------------
    */
    public function updateObservation()
    {
        $id = $this->request->getPost('id');

        $observation = $this->patientObservationModel->find($id);

        if (!$observation) {

            return $this->response->setJSON([
                'status' => false,
                'message' => 'Observação não encontrada.'
            ]);
        }

        $this->patientObservationModel->update($id, [

            'observation' => $this->request->getPost('observation')

        ]);

        $this->patientStatusHistoryModel->insert([

            'patient_id' => $observation['patient_id'],

            'old_status' => null,

            'new_status' => 'OBSERVAÇÃO',

            'observation' => 'Observação editada.',

            'changed_by' => userId(),

            'flow_type' => 'PATIENT'

        ]);

        return $this->response->setJSON([

            'status' => true,

            'message' => 'Observação atualizada.'

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DELET OBSERVATION
    |--------------------------------------------------------------------------
    */
    public function deleteObservation()
    {
        $id = $this->request->getPost('id');

        $observation = $this->patientObservationModel->find($id);

        if (!$observation) {

            return $this->response->setJSON([
                'status' => false,
                'message' => 'Observação não encontrada.'
            ]);
        }

        $this->patientObservationModel->delete($id);

        $this->patientStatusHistoryModel->insert([

            'patient_id' => $observation['patient_id'],

            'old_status' => null,

            'new_status' => 'OBSERVAÇÃO',

            'observation' => 'Observação removida.',

            'changed_by' => userId(),

            'flow_type' => 'PATIENT'

        ]);

        return $this->response->setJSON([

            'status' => true,

            'message' => 'Observação removida com sucesso.'

        ]);
    }
    /*
    |--------------------------------------------------------------------------
    | HOSPITALIZE PATIENT
    |--------------------------------------------------------------------------
    */
    public function hospitalize()
    {
        if (!can('patients.hospitalize')) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Sem permissão.'

            ]);
        }
        $patientId = $this->request->getPost('patient_id');

        $observation = $this->request->getPost('observation');

        $patient = $this->patientModel->find($patientId);

        if (!$patient) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Paciente não encontrado.'

            ]);
        }

        if ($patient['status'] == 'INTERNADO') {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Paciente já está internado.'

            ]);
        }
        /*
        |--------------------------------------------------------------------------
        | SAVE HOSPITALIZATION
        |--------------------------------------------------------------------------
        */

        $this->patientHospitalizationModel->insert([

            'patient_id' => $patientId,

            'hospitalized_at' => date('Y-m-d H:i:s'),

            'observation' => $observation,

            'created_by' => userId(),

            'flow_type' => 'PATIENT',

        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE STATUS
        |--------------------------------------------------------------------------
        */

        $this->patientModel->update(

            $patientId,

            [

                'status' => 'INTERNADO'

            ]

        );

        /*
        |--------------------------------------------------------------------------
        | MOVEMENT PACIENTE INTERNADO
        |--------------------------------------------------------------------------
        */
        $this->patientMovementModel->insert([

            'patient_id' => $patientId,

            'sector' => 'INTERNAÇÃO',

            'movement_type' => 'PACIENTE INTERNADO',

            'description' => $observation,

            'created_by' => userId(),

            'flow_type' => 'PATIENT',

        ]);
        /*
        |--------------------------------------------------------------------------
        | TIMELINE
        |--------------------------------------------------------------------------
        */

        $this->patientStatusHistoryModel->insert([

            'patient_id' => $patientId,

            'old_status' => 'EM ATENDIMENTO',

            'new_status' => 'INTERNADO',

            'observation' =>

            'Paciente internado: '

                . $observation,

            'changed_by' => userId(),

            'flow_type' => 'PATIENT',

        ]);

        return $this->response->setJSON([

            'status' => true,

            'message' => 'Paciente internado com sucesso.'

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | RETURN PATIENT
    |--------------------------------------------------------------------------
    */
    public function returnPatient()
    {
        if (!can('patients.hospitalize')) {
            return redirect()->back()->with('error', 'Sem permissão.');
        }
        $patientId = $this->request->getPost('patient_id');

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

                'message' => 'Paciente não encontrado.'

            ]);
        }

        if ($patient['status'] != 'INTERNADO') {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Paciente não está internado.'

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE STATUS
        |--------------------------------------------------------------------------
        */

        $this->patientModel->update(

            $patientId,

            [

                'status' => 'EM ATENDIMENTO'

            ]

        );

        /*
        |--------------------------------------------------------------------------
        | MOVEMENT
        |--------------------------------------------------------------------------
        */

        $this->patientMovementModel->insert([

            'patient_id' => $patientId,

            'sector' => 'PACIENTE',

            'movement_type' => 'RETORNO INTERNAÇÃO',

            'description' => $observation,

            'created_by' => userId(),

            'flow_type' => 'PATIENT',

        ]);

        /*
        |--------------------------------------------------------------------------
        | TIMELINE
        |--------------------------------------------------------------------------
        */

        $this->patientStatusHistoryModel->insert([

            'patient_id' => $patientId,

            'old_status' => 'INTERNADO',

            'new_status' => 'EM ATENDIMENTO',

            'observation' =>

            'Paciente retornou da internação: '

                . $observation,

            'changed_by' => userId(),

            'flow_type' => 'PATIENT',

        ]);

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return $this->response->setJSON([

            'status' => true,

            'message' => 'Paciente retornado para atendimento.'

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | FINALIZE PATIENT
    |--------------------------------------------------------------------------
    */
    public function finalizePatient()
    {
        if (!can('patients.finalize')) {
            return redirect()->back()->with('error', 'Sem permissão.');
        }
        $patientId = $this->request->getPost('patient_id');

        $observation = $this->request->getPost('observation');

        $patient = $this->patientModel->find($patientId);

        if (!$patient) {

            return $this->response
                ->setJSON([

                    'status' => false,

                    'message' => 'Paciente não encontrado.'

                ]);
        }

        if (
            $patient['status']
            == 'INTERNADO'
        ) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Paciente internado não pode ser finalizado.'

            ]);
        }

        $acceptedAt = new DateTime($patient['accepted_at']);

        $finalizedAt = new DateTime();

        $days = $acceptedAt->diff($finalizedAt)->days;

        $d60Status = $days <= 60
            ? 'DENTRO_PRAZO'
            : 'FORA_PRAZO';

        /*
        |--------------------------------------------------------------------------
        | UPDATE PATIENT
        |--------------------------------------------------------------------------
        */

        $this->patientModel->update(

            $patientId,

            [

                'status' => 'FINALIZADO',

                'finalized_at' => date('Y-m-d H:i:s'),

                'treatment_days' => $days,

                'd60_status' => $d60Status

            ]

        );

        /*
        |--------------------------------------------------------------------------
        | MOVEMENT
        |--------------------------------------------------------------------------
        */

        $this->patientMovementModel->insert([

            'patient_id' => $patientId,

            'sector' => 'PACIENTE',

            'movement_type' => 'ATENDIMENTO FINALIZADO',

            'description' => $observation,

            'created_by' => userId(),

            'flow_type' => 'PATIENT',

        ]);

        /*
        |--------------------------------------------------------------------------
        | TIMELINE
        |--------------------------------------------------------------------------
        */

        $this->patientStatusHistoryModel->insert([

            'patient_id' => $patientId,

            'old_status' => $patient['status'],

            'new_status' => 'FINALIZADO',

            'observation' =>

            'Paciente finalizado: '

                . $observation,

            'changed_by' => userId(),

            'flow_type' => 'PATIENT',

        ]);

        return $this->response->setJSON([

            'status' => true,

            'message' => 'Atendimento finalizado com sucesso.'

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | REQUEST PDF
    |--------------------------------------------------------------------------
    */
    public function pdf($id)
    {

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

        if (!$patient) {

            return redirect()

                ->back()

                ->with(

                    'error',

                    'Paciente não encontrado.'

                );
        }

        /*
        |--------------------------------------------------------------------------
        | OBSERVATIONS
        |--------------------------------------------------------------------------
        */

        $observations = $this->patientObservationModel

            ->where('patient_id', $id)

            ->where('flow_type', 'PATIENT')

            ->orderBy('id', 'DESC')

            ->findAll();

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

            ->where('patient_requests.flow_type', 'PATIENT')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | TIMELINE
        |--------------------------------------------------------------------------
        */

        $timeline = $this->patientStatusHistoryModel

            ->where('patient_id', $id)

            ->where('flow_type', 'PATIENT')

            ->orderBy('id', 'DESC')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | HOSPITALIZATIONS
        |--------------------------------------------------------------------------
        */

        $hospitalizations = $this->patientHospitalizationModel

            ->where('patient_id', $id)

            ->where('flow_type', 'PATIENT')

            ->orderBy('hospitalized_at', 'DESC')

            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | D60
        |--------------------------------------------------------------------------
        */

        $deadlineDate = null;

        if (!empty($patient['accepted_at'])) {

            $deadlineDate = date(

                'd/m/Y',

                strtotime(
                    $patient['accepted_at'] . ' +60 days'
                )

            );
        } else {

            $deadlineDate = 'N/A';
        }
        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        $html = view(
            'pdf/patient',
            [
                'patient' => $patient,
                'observations' => $observations,
                'patientRequests' => $patientRequests,
                'timeline' => $timeline,
                'hospitalizations' => $hospitalizations,
                'deadlineDate' => $deadlineDate,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | DOMPDF
        |--------------------------------------------------------------------------
        */

        $options = new Options();

        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        /*
        |--------------------------------------------------------------------------
        | STREAM
        |--------------------------------------------------------------------------
        */

        $dompdf->stream(
            'paciente-' . $patient['id'] . '.pdf',
            [
                'Attachment' => false
            ]
        );

        $pdf = $dompdf->output();

        return $this->response
            ->setStatusCode(200)
            ->setContentType('application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="paciente.pdf"')
            ->setBody($pdf);
    }
}
