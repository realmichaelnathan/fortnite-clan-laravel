<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use DB;
use Carbon\Carbon;
use App\Clans;
use App\User;
use App\Votes;
use App\Settings;
use Auth;


class StatsController extends Controller
{
    //

    public function stats() {

        $date = Carbon::today()->subDays(7);
        $userstats = User::selectRaw('COUNT(*) as count, DAY(created_at) day')
        ->whereDate('created_at', '>', $date)
        ->where('email_verified_at','!=', NULL)
        ->groupBy('day')
        ->limit(7)
        ->get();

        $clanstats = Clans::selectRaw('COUNT(*) as count, DAY(created_at) day')
        ->whereDate('created_at', '>', $date)
        ->groupBy('day')
        ->limit(7)
        ->get();

        $clanViews = Clans::select('name', 'views')
        ->orderBy('views', 'desc')
        ->limit(6)
        ->get();
        
        foreach ($userstats as $user) {
             $user->clancount = 0;
             foreach($clanstats as $clan) {
                  if ($clan->day == $user->day) {
                       $user->clancount = $clan->count;
                  }
             }
        }

        $socials = $this->socials();
        
        return view('stats', ['userstats' => $userstats, 'clanViews' => $clanViews, 'socials' => $socials]);
  }

    public function socials() {
        $settings = Settings::find(1);
        $instagram = $settings->instagram_followers();
        $discord = $settings->discord_members();
        $twitter = $settings->twitter_followers();

        return ['instagram' => $instagram, 'discord' => $discord, 'twitter' => $twitter];
    }
}
