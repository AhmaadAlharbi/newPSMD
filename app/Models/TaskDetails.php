<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskDetails extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function engineers()
    {
        return $this->belongsTo(Engineer::class,'eng_id');
    }
    public function station()
    {
        return $this->belongsTo(Station::class,'station_id');
    }
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
    public function tasks()
    {
        return $this->belongsTo(Task::class,'task_id');
    }
}