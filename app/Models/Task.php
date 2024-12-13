<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\TasksFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'projectid',
        'name',
        'piority',
        'deadline',
        'created_at',
        'updated_at'
    ];
    
    protected static function newFactory()
    {
        return TasksFactory::new();
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'projectid');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'taskid');
    }
}
