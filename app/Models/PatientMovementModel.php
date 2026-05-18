<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientMovementModel extends Model
{
    protected $table = 'patient_movements';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [

        'patient_id',

        'sector',

        'movement_type',

        'observation',

        'created_by'

    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
}
