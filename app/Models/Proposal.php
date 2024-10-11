<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'type',
        'area',
        'title',
        'description',
        'background',
        'question',
        'objective',
        'skills',
        'feedback',
        'user_id',
        'student_id',
        'dept_id',
        'ass_teacher_id'
    ];

    // Relationship: One student submits one proposal
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Relationship: One proposal can have an assigned teacher
    public function assignedTeacher()
    {
        return $this->belongsTo(User::class, 'ass_teacher_id');
    }

    // Relationship: One proposal belongs to a department
    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }
}
