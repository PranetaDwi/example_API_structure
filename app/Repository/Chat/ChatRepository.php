<?php
namespace App\Repository\Chat;


interface ChatRepository
{

    public function getChats($projectProgressId);
    
    public function saveChat($data);
}