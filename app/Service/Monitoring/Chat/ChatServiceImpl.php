<?php

namespace App\Service\Monitoring\Chat;

use App\Repository\Chat\ChatRepository;
use App\Repository\ProjectProgress\ProjectProgressRepository;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ChatServiceImpl implements ChatService
{

    protected $chatRepository;
    protected $projectProgressRepository;

    public function __construct(ChatRepository $chatRepository, ProjectProgressRepository $projectProgressRepository)
    {
        $this->chatRepository = $chatRepository;
        $this->projectProgressRepository = $projectProgressRepository;

    }

    public function getChats($projectProgressId)
    {
        try{
            $chat = $this->chatRepository->getChats($projectProgressId);
            return $chat;
        } catch (ModelNotFoundException $exception) {
            throw new Exception('Data not found', 404);
        } catch (\Exception $exception){
            throw new Exception('Something went wrong', 500);
        }
    }

    public function postSendChat($projectProgressId, Request $request)
    {
        $validatedData = $request->validate([
            'message' => 'required',
        ]);

        try{

            $message = $request->input('message');
            $validatedData['message'] = $message;
            $dataProject = $this->projectProgressRepository->findById($projectProgressId);
            if (auth()->user()->role == 'user'){
                $receiverColumn = 'developer_id';
            } else {
                $receiverColumn = 'buyer_id';
            }

            $chat = $this->chatRepository->saveChat(
                get_object_vars((object) [
                    'project_progress_id' => $projectProgressId,
                    'sender_id' => auth()->user()->account_id,
                    'receiver_id' => $dataProject->$receiverColumn,
                    'message' => $message,
                    'status' => 'unread',
                ]
            ));

            $data = [
                'chat' => $chat
            ];
    
            return $data;
        } catch (ModelNotFoundException $exception) {
            throw new Exception('Data not found', 404);
        } catch (\Exception $exception){
            throw new Exception('Something went wrong', 500);
        }
    }
}
