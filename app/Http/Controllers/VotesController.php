<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Votes;
use App\Clans;
use Auth;

class VotesController extends Controller
{
    //


    public function store(Request $request) {
        $userid = Auth::id();
        $clan = $request->clanid;

        $votecheck = Votes::whereUserid($userid)->first();
		
        if (is_null($votecheck)) {
          
            $newvote = new Votes;
            $newvote->clanid = $clan;
            $newvote->userid = $userid;
            $newvote->ipaddress = $request->header('X-Forwarded-For');
            $newvote->save();
            
            // Discord Webhook
            // $url = env('DISCORD_WEBHOOK');
            // $data = [
            //     'content' => '**' . Auth::user()->name . '** just voted for ' . '**' . Clans::find($clan)->name . '**.' ,
            // ];
            // $options = array(
            //     'http' => array(
            //             'header'  => "Content-type: application/json",
            //             'method'  => 'POST',
            //             'content' => json_encode($data)
            //     )
            //     );
            // $context  = stream_context_create($options);
            // file_get_contents($url, false, $context);
          // End Discord Webhook
			
            $newtotalvotes = Votes::whereClanid($clan)->count();
            
            return response()->json([
                'status' => 'success',
                'votes' => $newtotalvotes,
               
            ]);
        } else {
            return response()->json([
                'status' => 'fail'
            ]);
        } 
        
       
    }

    public function destroy(Request $request) {
        $userid = Auth::id();
        $clan = $request->clanid;
        $votecheck = Votes::whereUserid($userid)->count();
        if ($votecheck) {
            $vote = Votes::whereUserid($userid);
            $vote->delete();
            $newtotalvotes = Votes::whereClanid($clan)->count();

            // Discord Webhook
            // $url = env('DISCORD_WEBHOOK');
            // $data = [
            //     'content' => '**' . Auth::user()->name . '** just removed their vote for ' . '**' . Clans::find($clan)->name . '**.' ,
            // ];
            // $options = array(
            //     'http' => array(
            //             'header'  => "Content-type: application/json",
            //             'method'  => 'POST',
            //             'content' => json_encode($data)
            //     )
            //     );
            // $context  = stream_context_create($options);
            // file_get_contents($url, false, $context);
            // End Discord Webhook

            return response()->json([
                'status' => 'deleted',
                'votes' => $newtotalvotes
            ]);
        } else {
            return response()->json([
                'status' => 'no votes found for user.'
            ]);
        }
    }
}
