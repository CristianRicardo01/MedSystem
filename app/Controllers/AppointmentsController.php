<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AppointmentsController extends BaseController
{
    public function index()
    {
        return view('pages/appointments/index');
    }
}
