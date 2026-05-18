<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestTypeModel extends Model
{
    protected $table = 'request_types';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [

        'name',

        'deadline_days',

        'status'

    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
}
