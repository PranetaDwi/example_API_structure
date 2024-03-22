<?php
namespace App\Repository\Chat;

use App\Models\Chat;

class ChatRepositoryImpl implements ChatRepository
{

    public function getChats($projectProgressId)
    {
        return Chat::where('project_progress_id', $projectProgressId)->get();
    }

    public function saveChat($data)
    {
        return Chat::create($data);
    }

}