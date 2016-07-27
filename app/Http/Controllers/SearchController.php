<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Search;
use App\Match;
use App\Hours;
use View;
use RedirectsUsers;
use Validator;
use Illuminate\Support\Facades\Input as Input;
use Redirect;
use Auth;
use DB;
use Request as Req;
use App\Count;
class SearchController extends Controller
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
	public function matchtime($genre, $data) {
		$cat = DB::table('view_categories')->select('counts')->where('genre_id', '=',$genre)->get();
		$users = DB::table('matchs')->select('counts', 'updated_at')->where('genre_id', '=', $genre)->where('user_id', $data)->get();
		$dateFrom = new \DateTime('now');
		$dateNow = new \DateTime($users[0]->updated_at);
		$interval = $dateNow->diff($dateFrom);
		$hours = DB::table('hours')->select(date("H"))->where('date', '=',date("Y-m-d"))->where('genre_id', '=', 0)->get();
		$hours_genre = DB::table('hours')->select(date("H"))->where('date', '=',date("Y-m-d"))->where('genre_id' ,'=', $genre)->get();
		if ($interval->format('%y') >= '0' && $interval->format('%m') >= '0' && $interval->format('%h') >= '0' && $interval->format('%m') >= '0' && $interval->format('%s') > '20') {
			Match::where('genre_id', $genre)->where('user_id', $data)
			->update(['counts' => $users[0]->counts + 1]);
			Count::where('genre_id', $genre)
			->update(['counts' => $cat[0]->counts + 1]);
			Hours::where('date', date("Y-m-d"))->where('genre_id' ,'=', 0)
			->update([date("H") => $hours[0]->{date("H")} + 1]);
			Hours::where('date', date("Y-m-d"))->where('genre_id' ,'=', $genre)
			->update([date("H") => $hours_genre[0]->{date("H")} + 1]);
		}

	}
	public function index(Request $request) {

		if (!empty(Input::get('keywords'))) {
			$data = $request->session()->all()['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
			$annonces = Search::all();
			$allTags = [];
			$tags = $annonces->toArray();
			$req = Input::get('keywords');
			for ($i=0; $i < count($tags) ; $i++) { 
				array_push($allTags, $tags[$i]["title"]);

			}
			$occurence = -1;
			foreach ($allTags as $key) {

				$lev = levenshtein($req, $key);

				if ($lev == 0) {
					$tagss = $key;
					$occurence = 0;
					break;
				}

				if ($lev <= $occurence || $occurence < 0) {
					$tagss  = $key;
					$occurence = $lev;
				}

			}
			
			if (!empty(Input::get('categorie')) && Input::get('categorie') !== 0 && empty(Input::get('recente'))) {
				$result = DB::table('annonces')
				->join('genres', 'annonces.genre_id', '=', 'genres.id')
				->where('genres.id', '=', intval(Input::get('categorie')))
				->where('title', '=', 'range rover evoque')
				->get();
				$this->matchtime(Input::get('categorie'), $data);

			} elseif (!empty(Input::get('categorie')) && Input::get('categorie') !== 0 && !empty(Input::get('recente'))) {
				$result = DB::table('annonces')
				->join('genres', 'annonces.genre_id', '=', 'genres.id')
				->where('genres.id', '=', intval(Input::get('categorie')))
				->where('title', '<>', $tagss)
				->orderBy('annonces.created_at', 'desc')
				->get();
				$this->matchtime(Input::get('categorie'), $data);
			} elseif (!empty(Input::get('recente'))) {
				$result = DB::table('annonces')
				->where('title', $tagss)
				->orderBy('created_at', 'desc')
				->get();
			} else {
				$result = Search::all()
				->where('title', $tagss);

			}
		} elseif (empty(Input::get('keywords')) && Input::get('matching') == 'match') {
			$data = $request->session()->all()['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
			$order = DB::select(DB::raw("select genre_id from matchs where counts = (select max(`counts`) from matchs where user_id = $data)"));
			$result = Search::all()
			->where('genre_id', $order[0]->genre_id);
			$this->matchtime($order[0]->genre_id, $data);

		}

		return View::make('Search.index', compact('result'), compact('data'));
	}
	public function store() {

	}
}
