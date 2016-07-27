<?php 
namespace App;
use Eloquent;
class Email extends Eloquent {

	protected $table = 'users';
    protected $guarded = array('confirmed', 'confirmation_code');

}


?>