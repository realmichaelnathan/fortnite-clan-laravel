<?php

namespace App\Http\Controllers;
use App\Clans;
use App\Votes;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ClansController extends Controller
{
    //
    public function bump(Request $request) {
         $clan = Clans::find($request->clanid);
         $last_bumped = Carbon::parse($clan->bumped_at);
         $time_now = Carbon::now();

         if ($time_now->subHours(24) > $last_bumped) {
              $clan->bumped_at = Carbon::now();
              $clan->bumps++;
              $clan->timestamps = false;
              $clan->save();
              return response()->json([
                   'status' => 'success',
                   'last_bumped' => Carbon::now()->diffForHumans()
              ]);
         } else {
              return response()->json([
                   'status' => 'error',
                   'last_bumped' => $last_bumped->diffForHumans()
              ]);
         }
         
    }

     public function index($name) {
          $clan_name = str_replace('-', ' ', $name);
          $clan = Clans::whereName($clan_name)->first();

          if (!$clan) {
               return redirect('/');
          }
          if ($clan->active === 0) {
               return redirect('/');
          }
          $clan->timestamps = false;
          $clan->views = $clan->views + 1;
          $clan->save();
          $votes = Votes::whereClanid($clan->id)->count();
          if (Auth::id()) {
               $voted = Votes::whereUserid(Auth::id())->count();
               $votedforthisclan = Votes::whereUserid(Auth::id())->whereClanid($clan->id)->count();
          } else {
               $voted = false;
               $votedforthisclan = false;
          }
          
          return view('viewclan', ['clan' => $clan, 'votes' => $votes, 'voted' => $voted, 'votedforthisclan' => $votedforthisclan]);
     }

     public function create() {
          if (Clans::where('userid', Auth::id())->first()) {
               return redirect('/editclan');
          } else {
               return view('addclan');
          }
     }

     public function show() {
          $clan = Clans::where('userid', Auth::id())->first();
          if (!$clan) {
               return redirect('/addclan');
          } else {
               return view('editclan', ['clan' => $clan]);
          }
     }

     public function update(Request $request) {
          $request->validate([
               'name' => 'min:3|max:25|unique:clans,name,'.Auth::id().',userid',
               'description' => 'min:25',
               'discord' => 'nullable|url',
               'instagram' => 'nullable|url',
               'twitter' => 'nullable|url',
               'facebook' => 'nullable|url',
               'website' => 'nullable|url'
          ]);

         $clan = Clans::where('userid', Auth::id())->first();
         $clan->name = str_replace('-', ' ', $request->name);
	    $clan->description = $request->description;
	    $clan->discord = $request->discord;
         $clan->instagram = $request->instagram;
         $clan->twitter = $request->twitter;
         $clan->youtube = $request->youtube;

	    $clan->userid = Auth::id();

	    //Lets handle the image upload here
	    if ($request->hasFile('image')) {

		    $this->validate($request, [
	 		  'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:512',
	 	  ]);

		 //Check to see if an image was uploaded.
		    if (Input::file('image')->isValid()) {
			      $file = Input::file('image');
			      $destination = 'images/';
			      $ext= $file->getClientOriginalExtension();
			      $mainFilename = str_slug($clan->name);
			      $file->move($destination, $mainFilename.".".$ext);

  	 		}
		   $clan->picture = $mainFilename.".".$ext;
	   }
         $clan->save();
         $success = "Clan updated successfully.";
         return redirect ('/editclan')->with(compact('success'));
     }     

     public function store(Request $request) {
          $request->validate([
               'name' => 'min:3|max:25|unique:clans,name',
               'description' => 'min:25',
               'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
               'discord' => 'nullable|url',
               'instagram' => 'nullable|url',
               'twitter' => 'nullable|url',
               'facebook' => 'nullable|url',
               'website' => 'nullable|url'
          ]);

         $clan =new Clans;
         $clan->name = str_replace('-', ' ', $request->name);
         $clan->description = $request->description;
         $clan->discord = $request->discord;
         $clan->instagram = $request->instagram;
         $clan->twitter = $request->twitter;
         $clan->youtube = $request->youtube;
         $clan->userid = Auth::id();

         //Lets handle the image upload here
         if ($request->hasFile('image')) {

              $this->validate($request, [ 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:512',]);

           //Check to see if an image was uploaded.
              if (Input::file('image')->isValid()) {

                     $file = Input::file('image');
                     $destination = 'images/';
                     $ext= $file->getClientOriginalExtension();
                     $mainFilename = str_slug($clan->name);
                     $file->move($destination, $mainFilename.".".$ext);

               }
             $clan->picture = $mainFilename.".".$ext;
          } 
          $clan->save();
          return redirect('/editclan');
     }

     public function destroy() {
          $clan = Clans::where('userid', Auth::id())->first();
          $clan->delete();
          return redirect('/');
     }


}
