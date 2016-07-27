<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\UserModel;
use View;
use RedirectsUsers;
use Validator;
use Illuminate\Support\Facades\Input as Input;
use Redirect;
use DB;
use Auth;

class UserController extends Controller
{
	public function __construct(Request $request)
	{
    if(!empty($request->session()->all()['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'])) {
      $data = $request->session()->all()['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
      $this->active($data);
    }
    $this->middleware('auth');
  }
  public function active($data) {
    $result = DB::table('users')
    ->select('confirmed')
    ->where('id', $data)
    ->get();
    if ($result[0]->confirmed == 0) {
      Auth::logout();
      return Redirect::to('/login');
    }
  }
     /**
   * Display a listing of the resource.
   *
   * @return Response
   */
     public function index(Request $request)
     {

     	$data = $request->session()->all()['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
     	$users = UserModel::find($data);
     	return View::make('Users.index', compact('users'));
     }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(Request $request, $id)
  {
  	$data = $request->session()->all()['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
  	$users = UserModel::find($data);
  	return View::make('Users.edit', compact('users'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
  	$data = $request->session()->all()['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
  	$users = UserModel::find($data);
  	$email = null;
  	if ($users->toArray()['email'] !== Input::get('email'))
  		$email = "|unique:users";

  	$rules = array(
  		'name'  => 'required',
  		'email' => "required|email|max:255".$email,
  		'password' => 'min:6|confirmed',

  		);
  	$validator = Validator::make(Input::all(), $rules);
  	if ($validator->fails()) {
  		return Redirect::to('users/' . $id . '/edit')
  		->withErrors($validator)
  		->withInput(Input::except('password'));
  	} else {
  		$users = UserModel::find($id);
  		$users->name = Input::get('name');
  		$users->email = Input::get('email');
  		if (!empty(Input::get('password')))
  			$users->password = bcrypt(Input::get('password'));
  		$users->save();
  		return Redirect::to('users');
  	}
  }

  /**
   * Remove the specified resource from storage.
   * 
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
  	$data = $request->session()->all()['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
  	$user = UserModel::find($data);
  	$user->delete();
  }
}
