<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table = 'matchs';
     protected $fillable = [
        'user_id', 'genre_id',
     ];
}