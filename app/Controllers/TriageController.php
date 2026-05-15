<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TriageController extends BaseController
{
    public function index()
    {
        return view('pages/triage/index');
    }
    public function show($id)
    {
        return view('pages/triage/show');
    }
}
