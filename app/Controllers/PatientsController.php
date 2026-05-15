<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PatientsController extends BaseController
{
    public function index()
    {
        return view('pages/patients/index');
    }
    public function show()
    {
        return view('pages/patients/show');
    }
}
