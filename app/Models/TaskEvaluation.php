<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskEvaluation extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'task_student_id',
        'score',
        'notes'
    ];

    public function taskStudent()
    {
        return $this->belongsTo(TaskStudent::class);
    }
}
