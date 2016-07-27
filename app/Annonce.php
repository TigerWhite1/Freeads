<?php

namespace App;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{

	protected $table = 'annonces';
	    protected $fillable = [
        'title', 'description', 'picture', 'price', 'user_id', 'categorie',
    ];
}
