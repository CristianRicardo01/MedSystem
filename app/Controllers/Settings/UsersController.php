<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UsersController extends BaseController
{
    public function index()
    {
        return view('pages/settings/users/index');
    }
}
