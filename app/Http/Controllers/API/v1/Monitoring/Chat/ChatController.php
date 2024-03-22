<?php

namespace App\Http\Controllers\API\v1\Monitoring\Chat;

use App\Http\Controllers\Controller;
use App\Http\Resources\Monitoring\Chat\ChatResource;
use App\Service\Monitoring\Chat\ChatService;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;


class ChatController extends Controller
{
    protected $chatService;

    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    public function getChats($projectProgressId)
    {
        try {
            $chat= $this->chatService->getChats($projectProgressId);
            return new ApiResponse('success', 'success get data', ChatResource::collection($chat), 200);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, $exception->getCode());
        }
    }

    public function postSendChat($projectProgressId, Request $request)
    {
        try {
            $postChat= $this->chatService->postSendChat($projectProgressId, $request);
            return new ApiResponse('success', 'success store data', $postChat, 201);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, $exception->getCode());
        }
    }
}
