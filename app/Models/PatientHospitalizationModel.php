<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientHospitalizationModel extends Model
{
    protected $table = 'patient_hospitalizations';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [

        'patient_id',

        'hospitalized_at',

        'observation',

        'created_by',

        'flow_type',

    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';
}