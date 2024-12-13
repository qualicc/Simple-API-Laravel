<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\ProjectsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'deadline',
        'created_at',
        'updated_at'
    ];
    
    protected static function newFactory()
    {
        return ProjectsFactory::new();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'projectid');
    }

    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class, 'projectid');
    }
}
