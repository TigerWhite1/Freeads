<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Match;
use DB;
use Auth;
use Redirect;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function match($request) {
        $data = $request;
        $users = DB::table('matchs')->select('user_id')->where('user_id', '=', $data)->get();
        if (count($users) == 0) {
            Match::create([
                'user_id' => $data,
                'genre_id' => 1, 
                ]);
            Match::create([
                'user_id' => $data,
                'genre_id' => 2, 
                ]);
            Match::create([
                'user_id' => $data,
                'genre_id' => 3, 
                ]);
            Match::create([
                'user_id' => $data,
                'genre_id' => 4, 
                ]);
            Match::create([
                'user_id' => $data,
                'genre_id' => 5, 
                ]);
            Match::create([
                'user_id' => $data,
                'genre_id' => 6, 
                ]);
        }

    }
    public function index(Request $request)
    {
     $data = $request->session()->all()['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
     $this->match($data);
     return view('home');
 }
}
