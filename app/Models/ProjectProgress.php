<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;

class ProjectProgress extends Model
{
    use HasFactory;

    protected $table = 'project_progresses';

    protected $guarded = ['id'];

    public function userDeveloper()
    {
        return $this->belongsTo(User::class, 'developer_id', 'account_id');
    }

    public function userBuyer()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'account_id');
    }

    public function progresses()
    {
        return $this->hasMany(Progress::class, 'project_progress_id', 'id');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class,'project_progress_id', 'id');
    }


}
