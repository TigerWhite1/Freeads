<?php 
namespace App;
use Eloquent;
class UserModel extends Eloquent {

	protected $table = 'users';
    // protected $guarded = array('confirmed', 'confirmation_code');

}


?>