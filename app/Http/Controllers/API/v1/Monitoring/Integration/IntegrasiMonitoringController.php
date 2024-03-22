<?php

namespace App\Http\Controllers\API\v1\Monitoring\Integration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Monitoring\Integration\IntegrasiMonitoringRequest;
use App\Service\Monitoring\Integration\IntegrasiMonitoringService;

class IntegrasiMonitoringController extends Controller
{
    protected $integrasiMonitoringService;

    public function __construct(IntegrasiMonitoringService $integrasiMonitoringService)
    {
        $this->integrasiMonitoringService = $integrasiMonitoringService;
    }

    public function registerMonitoring(IntegrasiMonitoringRequest $request)
    {
        return $this->integrasiMonitoringService->register($request);
    }

}
