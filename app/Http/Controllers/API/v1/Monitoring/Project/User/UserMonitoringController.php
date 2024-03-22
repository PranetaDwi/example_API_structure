<?php

namespace App\Http\Controllers\API\v1\Monitoring\Project\User;

use App\Http\Resources\Monitoring\Project\ProgressPageResource;
use App\Http\Resources\Monitoring\Project\ProjectProgressListResource;
use App\Http\Resources\Monitoring\Project\User\DetailProgressResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Monitoring\Project\User\UserMonitoringService;
use App\Http\Responses\ApiResponse;

class UserMonitoringController extends Controller
{
    protected $userMonitoringService;

    public function __construct(UserMonitoringService $userMonitoringService)
    {
        $this->userMonitoringService = $userMonitoringService;

    }

    public function getProjectProgressLists()
    {
        try {
            $projectProgress= $this->userMonitoringService->getProjectProgressLists();
            return new ApiResponse('success', 'success get data', ProjectProgressListResource::collection($projectProgress), 200);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, $exception->getCode());
        }
    }

    public function getProgressPage($projectProgressId)
    {
        try {
            $projectProgress= $this->userMonitoringService->getProgressPage($projectProgressId);
            return new ApiResponse('success', 'success get data', new ProgressPageResource($projectProgress), 200);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, $exception->getCode());
        }
    }

    public function getDetailProgress($progressId)
    {
        try {
            $progress= $this->userMonitoringService->getDetailProgress($progressId);
            return new ApiResponse('success', 'success get data', new DetailProgressResource($progress), 200);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, $exception->getCode());
        }
    }
}
