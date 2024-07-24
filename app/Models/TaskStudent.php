<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStudent extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'task_id',
        'file_task',
        'user_id'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function taskEvaluation()
    {
        return $this->hasOne(TaskEvaluation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
