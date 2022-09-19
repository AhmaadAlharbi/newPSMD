<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gc_attachments extends Model
{
    use HasFactory;
    protected $table = 'gc_task_attachments';
    protected $guarded = [];
}