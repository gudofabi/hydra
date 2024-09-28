<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'status', 'priority', 'due_date', 'story_points', 'time_logged', 'user_id'
    ];

    // Add relationships here, for example, a user who owns the task
    public function user()
    {
        return $this->belongsTo(User::class); // Assuming you have a User model
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
