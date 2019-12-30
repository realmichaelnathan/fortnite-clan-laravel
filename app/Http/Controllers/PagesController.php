<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Clans;
use App\Votes;
use Auth;

class PagesController extends Controller
{
    //

     public function index() {
          $clans = Clans::where('active', '!=', 0)
          ->where('discord', '!=', NULL)
          ->orWhere('instagram', '!=', NULL)
          ->orWhere('twitter', '!=', NULL)
          ->orWhere('youtube', '!=', NULL)
          ->orderBy('bumped_at', 'desc')
          ->simplePaginate(20);

          return view('newhome', ['clans' => $clans]);
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
          $date = Carbon::today()->subDays(7);
          $clan = Clans::whereUserid(Auth::id())->first();
          $clan->bumped_at = Carbon::parse($clan->bumped_at)->diffForHumans();

          return view('clandashboard', ['clan' => $clan]);
     }
}
