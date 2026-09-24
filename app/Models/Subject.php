<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\StudyTask;
use App\Models\StudySession;
class Subject extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studyTasks()
    {
        return $this->hasMany(StudyTask::class);
    }

    public function studySessions()
    {
        return $this->hasMany(StudySession::class);
    }
}
