<?php



namespace App\Http\Controllers;

use App\Clans;

use App\Votes;
use App\Region;
use App\Platform;
use Illuminate\Http\Request;

use Auth;

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

               // Discord Webhook
               $url = \Config::get('services.discord.webhook');
               $data = [
                    'content' => '**' . Auth::user()->name . '** just bumped ' . '**' . $clan->name . '**.' ,
                    'embeds' => [
                         [
                              'title' => $clan->name,
                              'description' => str_limit(strip_tags($clan->description), 155),
                              'url' => 'https://fortniteclan.com/clan/' . $clan->slug,
                              'thumbnail' => [ 'url' => 'https://fortniteclan.com/images/' . $clan->picture]
                         ]
                    ]
               ];
               $options = array(
                    'http' => array(
                         'header'  => "Content-type: application/json",
                         'method'  => 'POST',
                         'content' => json_encode($data)
                    )
                    );
               $context  = stream_context_create($options);
               file_get_contents($url, false, $context);
               // End Discord Webhook

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

          $clan = Clans::whereSlug($name)->first();	

          if (!$clan) {
               return redirect('/');
          }

          if ($clan->active === 0) {
               return redirect('/');
          }


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
          $regions = Region::all();
          $platforms = Platform::all();

          if (!$clan) {

               return redirect('/addclan');

          } else {

               return view('editclan', [
                    'clan' => $clan,
                    'regions' => $regions,
                    'platforms' => $platforms
                    ]);

          }

     }



     public function update(Request $request) {
          $request->validate([

               'name' => 'min:3|max:25|unique:clans,name,'.Auth::id().',userid|regex:/^[\s\w-]*$/',

               'description' => 'min:25',

               'discord' => 'nullable|url',

               'instagram' => 'nullable|url',

               'twitter' => 'nullable|url',

               'youtube' => 'nullable|url'

          ]);



          $clan = Clans::where('userid', Auth::id())->first();

          $clan->name = $request->name;
          $slug = str_slug($clan->name);
          $checkSlug = Clans::whereSlug($slug)->count();
          $clan->region()->sync($request->regions);
          $clan->platform()->sync($request->platforms);
          if($checkSlug > 0) {
               $clan->slug = $slug . '-' . ($checkSlug + 1);
          } else {
               $clan->slug = $slug;
          }

          $clan->slug = str_slug($request->name);

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

			      $file = $request->file('image');

			      $destination = 'images/';

			      $ext= $file->getClientOriginalExtension();

			      $mainFilename = str_slug($clan->name);

			      $file->move($destination, $mainFilename.".".$ext);

		   $clan->picture = $mainFilename.".".$ext;

	   }

         $clan->save();

         $success = "Clan updated successfully.";

         return redirect ('/editclan')->with(compact('success'));

     }     



     public function store(Request $request) {

          $request->validate([

               'name' => 'min:3|max:25|unique:clans,name|regex:/^[\s\w-]*$/',

               'description' => 'min:25',

               'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',

               'discord' => 'nullable|url',

               'instagram' => 'nullable|url',

               'twitter' => 'nullable|url',

			   'youtube' => 'nullable|url'

          ]);



          $clan =new Clans;
          $clan->name = $request->name;
          $slug = str_slug($clan->name);
          $checkSlug = Clans::whereSlug($slug)->count();
          if($checkSlug > 0) {
               $clan->slug = $slug . '-' . ($checkSlug + 1);
          } else {
               $clan->slug = $slug;
          }

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

               $file = $request->file('image');

               $destination = 'images/';

               $ext= $file->getClientOriginalExtension();

               $mainFilename = str_slug($clan->name);

               $file->move($destination, $mainFilename.".".$ext);

               $clan->picture = $mainFilename.".".$ext;
          }    

          $clan->save();
          // Discord Webhook
          $url = \Config::get('services.discord.webhook');
          $data = [
               'content' => '**' . Auth::user()->name . '** just created ' . '**' . $clan->name . '**.' ,
               'embeds' => [
                    [
                         'title' => $clan->name,
                         'description' => str_limit(strip_tags($clan->description), 155),
                         'url' => 'https://fortniteclan.com/clan/' . $clan->slug,
                         'thumbnail' => [ 'url' => 'https://fortniteclan.com/images/' . $clan->picture]
                    ]
               ]
          ];
          $options = array(
               'http' => array(
                    'header'  => "Content-type: application/json",
                    'method'  => 'POST',
                    'content' => json_encode($data)
               )
               );
          $context  = stream_context_create($options);
          file_get_contents($url, false, $context);
          // End Discord Webhook

          return redirect('/editclan');

     }



     public function destroy() {

          $clan = Clans::where('userid', Auth::id())->first();

          $clan->delete();

          return redirect('/');

     }

     public function makeSlugs() {
          $clans = Clans::all();

          foreach($clans as $clan) {
               if (is_null($clan->slug) && !is_null($clan->name)) {
                    $slug = str_slug($clan->name);
                    $checkSlug = Clans::whereSlug($slug)->count();
                    if($checkSlug > 0) {
                         $clan->slug = $slug . '-' . ($checkSlug + 1);
                    } else {
                         $clan->slug = $slug;
                    }
                    $clan->save();
               }
          }
          return redirect('/');
     }




}

