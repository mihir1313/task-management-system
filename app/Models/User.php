<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name','designation','email', 'password', 'role','profile_image'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    // Relationship: A user can have many tasks assigned to them
    public function tasksAssigned()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    // Relationship: A user (admin) can create many tasks
    public function tasksCreated()
    {
        return $this->hasMany(Task::class, 'created_by');
    }

    // Helper methods to check user roles
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }
}
