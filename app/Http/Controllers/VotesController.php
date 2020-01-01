<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Votes;
use Auth;

class VotesController extends Controller
{
    //


    public function store(Request $request) {
        $userid = Auth::id();
        $clan = $request->clanid;

        $votecheck = Votes::whereUserid($userid)->count();

        if (!$votecheck) {
            $newvote = new Votes;
            $newvote->clanid = $clan;
            $newvote->userid = $userid;
            $newvote->ipaddress = $request->ip();
            $newvote->save();

            $newtotalvotes = Votes::whereClanid($clan)->count();
            
            return response()->json([
                'status' => 'success',
                'votes' => $newtotalvotes
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
