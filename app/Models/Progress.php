<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'progresses';

    protected $fillable = ['project_progress_id', 'brief_description', 'detail_description', 'percentage'];

    public function projectProgress()
    {
        return $this->belongsTo(ProjectProgress::class);
    }

    public function progressPictures()
    {
        return $this->hasMany(ProgressPicture::class);
    }
}
