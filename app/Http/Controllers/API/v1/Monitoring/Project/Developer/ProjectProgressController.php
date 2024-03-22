<?php

namespace App\Http\Controllers\API\v1\Monitoring\Project\Developer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Monitoring\Project\Developer\ProjectProgressRequest;
use App\Http\Responses\ApiResponse;
use App\Service\Monitoring\Project\Developer\ProjectProgressService;
use App\Http\Resources\Monitoring\Project\ProjectProgressListResource;
use App\Http\Resources\Monitoring\Project\Developer\BuyerListResource;

class ProjectProgressController extends Controller
{

    protected $projectProgressService;

    public function __construct(ProjectProgressService $projectProgressService)
    {
        $this->projectProgressService = $projectProgressService;
    }

    public function getProjectProgressLists()
    {
        try {
            $projectProgress= $this->projectProgressService->getProjectProgressLists();;
            return new ApiResponse('success', 'success get data', ProjectProgressListResource::collection($projectProgress), 200);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, $exception->getCode());
        }
    }

    public function getBuyer(){
        try {
            $buyers= $this->projectProgressService->getBuyer();
            return new ApiResponse('success', 'success get data', BuyerListResource::collection($buyers), 200);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, $exception->getCode());
        }
    }

    public function edit($id)
    {
        try {
            $projectProgress= $this->projectProgressService->editSelectedProjectProgress($id);
            return new ApiResponse('success', 'success load data', new ProjectProgressListResource($projectProgress), 201);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, $exception->getCode());
        }
    }

    public function postProjectProgress($userId, ProjectProgressRequest $request)
    {
        try {
            $projectProgress= $this->projectProgressService->postProjectProgress($userId, $request);
            return new ApiResponse('success', 'success store data', $projectProgress, 201);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, $exception->getCode());
        }
    }

    public function updateProjectProgress($id, ProjectProgressRequest $request)
    {
        try {
            $projectProgress= $this->projectProgressService->updateProjectProgress($id, $request);
            return new ApiResponse('success', 'success update data', $projectProgress, 201);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, $exception->getCode());
        }
    }

    public function deleteProjectProgress($id)
    {
        try {
            $projectProgress= $this->projectProgressService->deleteProjectProgress($id);
            return new ApiResponse('success', 'success delete data', $projectProgress, 201);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, $exception->getCode());
        }
    }

}
