<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\TeamMembersFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'projectid',
        'name',
        'created_at',
        'updated_at'
    ];

    protected static function newFactory()
    {
        return TeamMembersFactory::new();
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'projectid');
    }
}
