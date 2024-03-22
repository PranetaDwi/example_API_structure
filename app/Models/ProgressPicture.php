<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgressPicture extends Model
{
    use HasFactory;

    protected $fillable = ['progress_id', "picture_file"];

    public function progress()
    {
        return $this->belongsTo(Progress::class);
    }
}
