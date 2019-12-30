<?php

namespace App\Http\Controllers;
use App\User;
Use Auth;
use Illuminate\Support\Facades\Input;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit() {
        $user = Auth::user();
        return view('myaccount', ['user' => $user]);
    }

    public function update(Request $request) {
        $request->validate([
            'name' => 'required|min:3|max:25|unique:users,name,'.Auth::id().',id',
            'email' => 'required|email|unique:users,email,'.Auth::id().',id',
        ]);
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
	    $user->aboutme = $request->aboutme;
	    $user->discord = $request->discord;
        $user->instagram = $request->instagram;
        $user->twitter = $request->twitter;
        $user->youtube = $request->youtube;
        //Lets handle the image upload here
	    if ($request->hasFile('image')) {

            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);

            //Check to see if an image was uploaded.
		    if (Input::file('image')->isValid()) {
                $file = Input::file('image');
                $destination = 'images/users/';
                $ext= $file->getClientOriginalExtension();
                $mainFilename = $user->id;
                $file->move($destination, $mainFilename.".".$ext);

  	 		}
		    $user->profilepic = $mainFilename.".".$ext;
	    }
        $user->save();
        $success = "Account updated successfully.";
        return view('myaccount', ['user' => $user, 'success' => $success]);
    }

    public function destroy() {
        $user = Auth::user();
        $image_path = "/images/user/$user->profilepic"; 
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        $user->delete();
        return redirect('/');
     }
}
