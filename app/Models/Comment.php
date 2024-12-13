<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\CommentsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'taskid',
        'text',
        'created_at',
        'updated_at'
    ];
    
    protected static function newFactory()
    {
        return CommentsFactory::new();
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'taskid');
    }
}
