<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TR extends Model
{
    use HasFactory;
    protected $table = 'tr';
    public function user()
    {
        return $this->hasMany(User::class);
    }

}