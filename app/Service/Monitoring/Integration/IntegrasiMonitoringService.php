<?php

namespace App\Service\Monitoring\Integration;

use App\Http\Requests\Monitoring\Integration\IntegrasiMonitoringRequest;

interface IntegrasiMonitoringService
{
    public function register(IntegrasiMonitoringRequest $request);
}
