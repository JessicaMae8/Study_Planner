<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Subject;
use App\Models\StudySession;
class StudyTask extends Model
{
    protected $fillable = [
    'user_id',
    'subject_id',
    'title',
    'description',
    'due_date',
    'priority',
    'status',
];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function studySessions()
    {
        return $this->hasMany(StudySession::class);
    }
}
