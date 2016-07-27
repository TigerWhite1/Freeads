<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;
use RedirectsUsers;
use Validator;
use Illuminate\Support\Facades\Input as Input;
use Redirect;
use Auth;
use DB;
use App\Message;

class MessageController extends Controller
{
	public function __construct(Request $request) {
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
	public function check($id) {

		$resp = Message::where('id', $id)
		->where('user_id_dest', Auth::id())->exists();
		if(!$resp)
			return false;
		else
			return true;

	}
	public function read($id) {
		if ($this->check($id)) {
			$annonces = Message::find($id);
			$annonces->email_read = 0;
			$annonces->save();
			return Redirect::to('message');
		} else {
			return Redirect::to('message');
		}
		
	}
	public function edit(Request $request, $id) {
		if ($request->header('referer') === null) {
			return Redirect::to('message');
		} else {
			$data = $request->session()->all()['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
			return View::make('Message.index', compact('id'));
		}
	}
	public function update(Request $request, $id) {
		if ($request->header('referer') === null) {
			return Redirect::to('message');
		} else {
			$data = $request->session()->all()['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
			$rules = array(
				'objet'  => 'required|max:255',
				'content' => "required|max:1000",
				);
			$validator = Validator::make(Input::all(), $rules);
			if ($validator->fails()) {
				return Redirect::to("message/$id/edit")
				->withErrors($validator);
			} else {
				Message::create([
					'objet' => Input::get('objet'),
					'content' => Input::get('content'),
					'user_id_exp' => $data,
					'user_id_dest' => $id,
					]);
				return Redirect::to('message');
			}
		}
	}
	public function index(Request $request) {
		$data = $request->session()->all()['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
		$messages = DB::table('emails')
		->select('emails.id as email_id', 'emails.objet', 'emails.content', 'emails.user_id_exp','emails.email_read' , 'emails.user_id_dest', 'emails.created_at', 'users.name')
		->join('users', 'emails.user_id_exp', '=', 'users.id')
		->where('user_id_dest', $data)->orderBy('created_at', 'desc')->get();
		return View::make('Message.read', compact('messages'));
	}
	public function destroy($id) {
		if($this->check($id)) {
			$this->check($id);
			$message = Message::find($id);
			$message->delete();
			return Redirect::to('message');
		} else {
			return Redirect::to('message');
		}

	}
}
