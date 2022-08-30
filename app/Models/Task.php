<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Task extends Model
{
    use HasFactory;
    use Notifiable;

    protected $guarded = [];
    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'eng_id');
    }

    public function sections()
    {
        return $this->belongsTo(Section::class, 'fromSection');
    }

    public function toSections()
    {
        return $this->belongsTo(Section::class, 'toSection');
    }
    public function tasksDetail()
    {
        // return $this->belongsTo(Task::class,'task_id');
        // return $this->hasMany(Task::class);
        return $this->belongsTo(TaskDetails::class, 'id');
    }

    public function details()
    {
        return $this->hasMany(TaskDetails::class);
    }
    // public function engineers()
    // {
    //     return $this->belongsTo(Engineer::class,'eng_id');
    // }



}