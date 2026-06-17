<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\AlertService;

class AlertsController extends BaseController
{
    public function index()
    {
        $service = new AlertService();

        return $this->response->setJSON(
            $service->getAlerts()
        );
    }
}
