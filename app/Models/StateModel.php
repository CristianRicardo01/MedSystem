<?php

namespace App\Models;

use CodeIgniter\Model;

class StateModel extends Model
{
    protected $table = 'states';

    protected $returnType = 'array';

    protected $allowedFields = [

        'name',

        'uf',

        'ibge_code',

        'status'

    ];
}