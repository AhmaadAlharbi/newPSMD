<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RSTasks extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'rs_tasks';

}
