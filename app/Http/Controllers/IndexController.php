<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Index;

use App\User;
use App\Email;
use App\Http\Controllers\Controller;
use View;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Redirect;
class IndexController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */

    public function showIndex($id = null)
    {
        $data = array('name' => 'Taylor');
        return \View::make('index')->with($data);

    }
    public function confirm($confirmation_code)
    {
        if(!$confirmation_code)
        {
            return Redirect::to('/login');
        }

        
        $user = new Email;
        $user = $user->where('confirmation_code', $confirmation_code)->first();
        

        // // $user = new User;
        if (is_null($user))
        {
            return Redirect::to('/login');

       }
        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        Flash::message('You have successfully verified your account.');

        return Redirect::to('/login');
    }
}



?>