<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientExamModel extends Model
{
    protected $table = 'patient_exams';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [

        'patient_id',

        'exam_name',

        'exam_status',

        'requested_at',

        'completed_at',

        'report_released_at',

        'observation'

    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';}
