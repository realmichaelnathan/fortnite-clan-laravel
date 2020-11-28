<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Clans;
use App\Votes;
use App\User;
use Auth;

class PagesController extends Controller
{
    //

     public function index() {
          // $news = json_decode(file_get_contents("https://fortnite-api.com/v2/news/br"));

          $clans = Clans::where('active', 1)
          ->orderBy('bumped_at', 'desc')
          ->paginate(24);

          $newest_clans = Clans::where('active', 1)
          ->orderBy('created_at', 'desc')
          ->take(4)->get();

          $votes = Votes::selectRaw('count(*) as votes, clanid')->groupBy('clanid')->orderBy('votes', 'desc')->take(10);
          $top_voted_clans = Clans::joinSub($votes, 'votes', function ($join) {
                    $join->on('clans.id', '=', 'votes.clanid');
               })->whereActive(1)->take(4)->get();

          return view('newhome', [
               // 'news' => $news,
               'clans' => $clans,
               'top_voted_clans' => $top_voted_clans,
               'newest_clans' => $newest_clans
               ]);
     }

     public function leaderboard(Request $request) {
          $votes = Votes::selectRaw('count(*) as votes, clanid')->groupBy('clanid')->orderBy('votes', 'desc');
          $clans = Clans::joinSub($votes, 'votes', function ($join) {
                    $join->on('clans.id', '=', 'votes.clanid');
               })->whereActive(1)->paginate(20);
               if ($request->page && $request->page > 1) {
                    $rank = ($request->page - 1) * 20;
               } else {
                    $rank = 0;
               }
          
               foreach ($clans as $clan) {
                    $clan->rank = $rank + 1;
                    $rank++;
               }
          return view('leaderboard', ['clans' => $clans]);
    }

     public function clan_dashboard() {
          $clan = Clans::whereUserid(Auth::id())->first();
          $clan->bumped_at = Carbon::parse($clan->bumped_at)->diffForHumans();

          return view('clandashboard', ['clan' => $clan]);
     }

     public function viewuser($id, $name) {
          $user = User::find($id);
          return view('viewuser', compact('user'));
      }
}
