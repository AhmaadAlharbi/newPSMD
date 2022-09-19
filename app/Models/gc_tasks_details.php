<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gc_tasks_details extends Model
{
    use HasFactory;
    protected $table = 'gc_task_details';
    protected $guarded = [];
    public function users()
    {
        return $this->belongsTo(User::class, 'eng_id');
    }
    public function task()
    {
        return $this->belongsTo(gc_tasks::class, 'task_id');
    }
}