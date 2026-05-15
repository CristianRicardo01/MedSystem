<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class HospitalizationController extends BaseController
{
    public function index(): string
    {
        return view('pages/hospitalization/index');
    }
}
