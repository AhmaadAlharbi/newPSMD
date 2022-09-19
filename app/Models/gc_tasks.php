<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gc_tasks extends Model
{
    use HasFactory;
    protected $table = 'gc_tasks';
    protected $guarded = [];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}