<?php

namespace App\Http\Controllers\API\v1\Monitoring\Project\Developer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Monitoring\Project\Developer\Progress\ProgressService;
use App\Http\Resources\Monitoring\Project\ProgressPageResource;
use App\Http\Responses\ApiResponse;

class ProgressController extends Controller
{

    protected $progressService;

    public function __construct(ProgressService $progressService)
    {
        $this->progressService = $progressService;
    }

    public function index($projectProgressId)
    {
        try {
            $myProgress = $this->progressService->getMyprogress($projectProgressId);
            return new ApiResponse('success', 'success load data', new ProgressPageResource($myProgress), 200);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, $exception->getCode());
        }
    }

    public function store($projectProgressId, Request $request)
    {
        try {
            $progress= $this->progressService->postProgress($projectProgressId, $request);
            return new ApiResponse('success', 'success store data', $progress, 201);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, $exception->getCode());
        }
    }

    public function edit($id)
    {
        try {
            $progress= $this->progressService->editProgress($id);
            return new ApiResponse('success', 'success load data', $progress, 201);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, $exception->getCode());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $progress= $this->progressService->updateProgress($id, $request);
            return new ApiResponse('success', 'success update data', $progress, 201);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, $exception->getCode());
        }
    }

    public function deletePicture($id)
    {
        try {
            $progress= $this->progressService->deletePicture($id);
            return new ApiResponse('success', 'success delete data', $progress, 201);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, $exception->getCode());
        }
    }

    public function destroy(string $id)
    {
        try {
            $progress= $this->progressService->deleteProgress($id);
            return new ApiResponse('success', 'success delete data', $progress, 201);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, $exception->getCode());
        }
    }
}
