<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    use HasFactory;

    // public function conversation()
    // {
    //     return $this->belongsTo(Conversation::class);
    // }

    protected $table = "chats";

    protected $fillable = ['project_progress_id','sender_id', 'receiver_id', 'message', 'status'];

    public function projectProgress()
    {
        return $this->belongsTo(ProjectProgress::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function getDateTimeStrAttribute()
    {
        return date("Y-m-dTH:i", strtotime($this->created_at->toDateTimeString()));
    }
}
