<?php

namespace App\Models;

use CodeIgniter\Model;

class SpecialtyModel extends Model
{
    protected $table = 'specialties';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [

        'name',

        'description',

        'status'

    ];

    protected $useTimestamps = true;
}
