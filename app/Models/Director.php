<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;

    public function movies(){
        return $this->hasMany('App\Models\Movie','director_id');
    }
}
