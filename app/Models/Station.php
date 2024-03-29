<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;



    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function details()
    {
        return $this->hasMany(TaskDetails::class);
    }
}
