<?php

namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model
{
    protected $table = 'cities';

    protected $returnType = 'array';

    protected $allowedFields = [

        'state_id',

        'name',

        'ibge_code',

        'status'

    ];
}