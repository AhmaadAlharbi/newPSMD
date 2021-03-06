<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TR extends Model
{
    use HasFactory;
    protected $table = 'tr';
    protected $guarded = [];

    /**
     * 1 => Mechanical
     * 2 => Chemistry
     * 3 => Electrical
     * 
     */
    public function user()
   {
   return $this->belongsTo('App\Models\User');
   }

}