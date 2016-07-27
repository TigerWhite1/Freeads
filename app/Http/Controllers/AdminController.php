<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Match;
use DB;
use App\Count;
use App\Match as mat;
use Illuminate\Support\Facades\Input as Input;
use Redirect;
use Auth;

class AdminController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
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
		->select('confirmed', 'rule')
		->where('id', $data)
		->get();
		// dd($result[0]->confirmed);
		if ($result[0]->confirmed == 0) {
			Auth::logout();
			return Redirect::to('/login');
		}
		if ($result[0]->rule == 0) {
			Auth::logout();
			return redirect('/');
		}
	}
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{

		$data = $request->session()->all()['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
		return view('Admin.index');
	}
	public function show() {
		return view('Admin.user');
	}
	public function user() {

		return view('Admin.user');		
	}
	public function hours() {

		return view('Admin.hours');		
	}

	public function jsonuser() {
		$result = DB::table('matchs')->select('counts')->where('user_id', '=', Input::get('id'))->get();
		$tbl = array("Count" => array());
		for ($i=0; $i < count($result) ; $i++) { 
			array_push($tbl["Count"], $result[$i]->counts);
		}
		return json_encode($tbl);
	}
	public function jsonhours() {
		// dd(Input::get('date'));
		$result = DB::table('hours')->select(
	"00",
    "01",
    "02",
    "03",
    "04",
    "05",
    "06",
    "07",
    "08",
    "09",
    "10",
    "11",
    "12",
    "13",
    "14",
    "15",
    "16",
    "17",
    "18",
    "19",
    "20",
    "21",
    "22",
    "23")->where('date', '=', Input::get('date'))->where('genre_id', '=', Input::get('genre'))->get();
		$tbl = array("Count" => array());
		for ($i=0; $i < 24 ; $i++) {
			if ($i <= 9) {
			array_push($tbl["Count"], $result[0]->{'0'.$i});
				
			}
			if ($i >= 10) {
				# code...
				// dd($result[0]);
			array_push($tbl["Count"], $result[0]->{$i});
			}

			// if ($i <= 19) {
			// 	array_push($tbl["Count"], $result[$i]->{1$i});
			// }
			// if ($i <= 23) {
				
			// }
		}
		// dd($tbl);
		// dd($tbl);
		return json_encode($tbl);
	}

	public function json(Request $request) {
		$result = Count::all();
		$result = $result->toArray();
		$tbl = array("Count" => array());
		for ($i=0; $i < count($result) ; $i++) { 
			array_push($tbl["Count"], $result[$i]['counts']);
		}

		return json_encode($tbl);
	}
}
