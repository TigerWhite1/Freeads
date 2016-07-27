<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
       protected $table = 'emails';
     protected $fillable = [
        'objet', 'content', 'user_id_exp', 'user_id_dest',
     ];
}
