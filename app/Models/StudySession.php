<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Subject;
use App\Models\StudyTask;

class StudySession extends Model
{
    protected $fillable = [
        'user_id',
        'subject_id',
        'study_task_id',
        'started_at',
        'ended_at',
        'notes',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function studyTask()
    {
        return $this->belongsTo(StudyTask::class);
    }
}