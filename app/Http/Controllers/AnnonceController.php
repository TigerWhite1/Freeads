<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Annonce;
use App\Http\Requests;
use View;
use RedirectsUsers;
use Validator;
use Illuminate\Support\Facades\Input as Input;
use Redirect;
use Auth;
use DB;

class AnnonceController extends Controller
{
	public function __construct(Request $request) {
		if(!empty($request->session()->all()['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'])) {
			$data = $request->session()->all()['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
			$this->active($data);
		}
		$this->middleware('auth');
	}

	public function check($id) {

		$resp = Annonce::where('id', $id)
		->where('user_id', Auth::id())->exists();
		if(!$resp)
			return false;
		else
			return true;

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

	public function multiple_upload($data = null) {
		if (!empty($data[0])) {
			$files = $data;
			$file_count = count($files);
			$uploadcount = 0;
			$path = null;
			foreach($files as $file) {
				$rules = array('file' => 'required|mimes:png,gif,jpeg');
				$validator = Validator::make(array('file'=> $file), $rules);
				if($validator->passes()){
					$destinationPath = '/var/www/html/freeads/public/images/';
					$time_start = \microtime();
					$filename = $file->getClientOriginalName().$time_start;
					$upload_success = $file->move($destinationPath, $time_start.".jpg");
					$name = $time_start.".jpg";

					$path .= "<img src=\"http://freeads.example.com/images/$name\" class=\"coupon-img img-rounded\">"."<br/>";
					$uploadcount ++;
				}
			}
			if($uploadcount == $file_count){
				return $path;
			} 
			else {
				return null;
			}
		}
	}

	public function index(Request $request) {

		$data = $request->session()->all()['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
		$annonces = Annonce::all();
		return View::make('Annonces.index', compact('annonces'), compact('data'));
	}

	public function create() {

		return View::make('Annonces.create');
	}

	public function store(Request $request) {

		$data = $request->session()->all()['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
		$rules = array(
			'title'  => 'required|max:255',
			'description' => "required",
			'picture' => 'file',
			'price' => 'required|numeric',
			);

		$toto = $this->multiple_upload(Input::file('images'));
		$validator = Validator::make(Input::all(), $rules);
		// dd(intval(Input::get('categorie')));
		if ($validator->fails()) {
			return Redirect::to('annonces/create')
			->withErrors($validator);
		} else {
			Annonce::create([
				'title' => Input::get('title'),
				'description' => Input::get('description'),
				'picture' => $toto,
				'price' => Input::get('price'),
				'user_id' => $data,
				'genre_id' => intval(Input::get('categorie')),
				]);

			return Redirect::to('annonces');
		}
	}


	public function edit($id) {

		if($this->check($id, 'annonces')) {
			$users = Annonce::find($id);
			return View::make('Annonces.edit', compact('users'));
		} else {
			return Redirect::to('annonces');
		}

	}
	public function update(Request $request, $id) {

		if($this->check($id, 'annonces')) {
			$rules = array(
				'title'  => 'required|max:255',
				'description' => "required",
				'picture' => 'file',
				'price' => 'required|numeric'

				);	
			$toto = $this->multiple_upload(Input::file('images'));
			$validator = Validator::make(Input::all(), $rules);
			if ($validator->fails() && $toto === null) {
				return Redirect::to('annonces/' . $id . '/edit')
				->withErrors($validator);
			} else {
				$annonces = Annonce::find($id);
				$annonces->title = Input::get('title');
				$annonces->description = Input::get('description');
				if (!empty($toto)) {
				$annonces->picture = $toto;
				}
				$annonces->price = Input::get('price');
				$annonces->genre_id = intval(Input::get('categorie'));
				$annonces->save();
				return Redirect::to('annonces');
			}
		} else {
			return Redirect::to('annonces');
		}
	}

	public function destroy($id) {
		if($this->check($id, 'annonces')) {
			$this->check($id, 'annonces');
			$user = Annonce::find($id);
			$user->delete();
			return Redirect::to('annonces');
		} else {
			return Redirect::to('annonces');
		}

	}
}
