<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientObservationModel extends Model
{
    protected $table = 'patient_observations';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [

        'patient_id',

        'observation',

        'created_by'

    ];

    protected $useTimestamps = true;
}