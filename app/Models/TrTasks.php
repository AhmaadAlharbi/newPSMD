<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrTasks extends Model
{
    use HasFactory;
    protected $table = 'tr_tasks';
    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}