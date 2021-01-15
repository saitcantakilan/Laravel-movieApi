<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $primaryKey = 'movie_id';
    public function director(){
        return $this->belongsTo('App\Models\Director','director_id');
    }

}
