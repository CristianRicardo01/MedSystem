<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;

class RequestsController extends BaseController
{
    public function index()
    {
        return view('pages/settings/requests/index');
    }
}
