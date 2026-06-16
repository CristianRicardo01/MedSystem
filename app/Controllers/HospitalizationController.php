<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PatientModel;
use App\Models\SpecialtyModel;

class HospitalizationController extends BaseController
{
    protected $patientModel;

    protected $specialtyModel;

    public function __construct()
    {
        $this->patientModel = new PatientModel();

        $this->specialtyModel = new SpecialtyModel();
    }
    
    public function index(): string
    {
        /*
        |--------------------------------------------------------------------------
        | PATIENTS
        |--------------------------------------------------------------------------
        */

        $patients = $this->patientModel

            ->select('
                patients.*,
                specialties.name as specialty_name,
                patient_hospitalizations.observation,
                patient_hospitalizations.hospitalized_at
            ')

            ->join(
                'specialties',
                'specialties.id = patients.specialty_id',
                'left'
            )

            ->join(
                'patient_hospitalizations',
                'patient_hospitalizations.patient_id = patients.id',
                'left'
            )

            ->where(
                'patients.status',
                'INTERNADO'
            )

            ->orderBy(
                'patients.id',
                'DESC'
            )

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
        | RETURN
        |--------------------------------------------------------------------------
        */

        return view(
            'pages/hospitalization/index',

            [

                'patients' => $patients,

                'specialties' => $specialties,

            ]
        );
    }
}
