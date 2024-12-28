<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'isAdmin',
        'isSuperAdmin',
        'dept_id',
        'assigned_teacher',
        'official_id', 
        'teacher_initial', 
        'designation',
        'credit_finished',
        'cgpa',
        'batch',
        'semester',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'student_id', 'official_id');
    }

    public function supervisedProposals()
    {
        return $this->hasMany(Proposal::class, 'ass_teacher_id', 'official_id');  // To get all proposals supervised by this user
    }
}
