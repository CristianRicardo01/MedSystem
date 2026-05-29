<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientStatusHistoryModel extends Model
{
    protected $table = 'patient_status_history';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [

        'patient_id',

        'old_status',

        'new_status',

        'observation',

        'changed_by',
        
        'flow_type',

    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';}
