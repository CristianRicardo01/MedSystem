<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model
{
    protected $table = 'patients';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [

        'name',
        'medical_record',
        'cpf',
        'phone',
        'birth_date',
        'state',
        'city',
        'specialty_id',
        'flow_type',
        'status',
        'current_sector',
        'first_service_date',
        'first_consultation_date',
        'accepted_at',
        'finalized_at',
        'observations',
        'created_by'

    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';
}
