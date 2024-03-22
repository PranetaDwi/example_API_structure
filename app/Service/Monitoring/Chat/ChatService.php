<?php

namespace App\Service\Monitoring\Chat;

// use App\Http\Requests\Monitoring\Integration\IntegrasiMonitoringRequest;
use Illuminate\Http\Request;

interface ChatService
{
    public function getChats($projectProgressId);

    public function postSendChat($projectProgressId, Request $request);
}