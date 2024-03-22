<?php

namespace App\Http\Resources\Monitoring\Chat;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project_progress_id' => $this->project_progress_id,
            'sender' => $this->sender_id,
            'receiver' => $this->receiver_id,
            'message' => $this->message,
            'created_at' => $this->created_at,
            'status' => $this->status,
        ];
    }
}
