<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientRequestModel extends Model
{
    protected $table = 'patient_requests';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [

        'patient_id',

        'request_type_id',

        'request_status',

        'requested_at',

        'scheduled_date',

        'completed_at',

        'deadline_date',

        'alert_offset_days',

        'alert_date',

        'observation',

        'created_by'

    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
