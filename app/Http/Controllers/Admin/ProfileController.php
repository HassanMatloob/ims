<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Role;
use App\User;

class ProfileController extends Controller
{
    //
    public function index(){
        $page_title = 'Profile';
        $action = 'app_profile';
        $user = Auth::user();
        $details = $user->profile;

        if ( isset(Auth::user()->profile) ) {
            $profile = Auth::user()->profile;
            return view("admin.profiles.index")->with('pro', $details)->with('page_title', $page_title)->with('action', $action)->with('user', $user)->with('profile', $profile);
        } else {
            return redirect()->route("admin.profiles.create");
        }
    }

    public function create(){
    	if ( isset(Auth::user()->profile) ) {
    		# code...
    		return redirect()->back()->with("error", "Profile already exists for this user");
    	}
    	$page_title = 'Profile Create';
    	$action = 'app_profile';
        $user = Auth::user();
        $role = Role::find(Auth::user()->role_id);
    	return view('admin.profiles.create', compact('page_title', 'action', 'role', 'user'));
    }

    public function store(Request $request){
    	$this->validate($request, [
            "fname" => "required|string|max:40",
            "lname" => "required|string|max:40",
            "cell" => "required|string|max:10",
            "gender" => "required|string|max:10",
            "position" => "required|string|max:30",
            "pro_pic" => "image|mimes:png,jpg,jpeg|nullable|max:1999",
            "c_img" => "image|mimes:png,jpg,jpeg|nullable|max:1999"
        ]);

        // Handle profile pic upload
        if ( $request->hasFile('pro_pic') ) {
            $fullProPicName = $request->file('pro_pic')->getClientOriginalName();
            $proPicName = pathinfo($fullProPicName, PATHINFO_FILENAME);
            $proPicExt = $request->file('pro_pic')->getClientOriginalExtension();
            $proPicNameToStore = $proPicName . "_" . time() . "." . $proPicExt;

            $path = $request->file('pro_pic')->storeAs('public/pro_photos', $proPicNameToStore);
        } else {
            $proPicNameToStore = "blank-profile-picture-973460_1280.png";
        }

        // Handle cover image upload
        if ( $request->hasFile('c_img') ) {
            $fullCoverName = $request->file('c_img')->getClientOriginalName();
            $coverName = pathinfo($fullCoverName, PATHINFO_FILENAME);
            $coverExt = $request->file('c_img')->getClientOriginalExtension();
            $coverNameToStore = $coverName . "_" . time() . "." . $coverExt;

            $path = $request->file('c_img')->storeAs('public/pro_photos', $coverNameToStore);
        } else {
            $coverNameToStore = "no_cover.png";
        }

    	$profile = new Profile;
    	$profile->user_id = Auth::user()->id;
    	$profile->fname = $request->input('fname');
    	$profile->lname = $request->input('lname');
        $profile->cell = $request->input('cell');
        $profile->gender = $request->input('gender');
    	$profile->position = $request->input('position');
    	$profile->cover_pic = $coverNameToStore;
    	$profile->pro_pic = $proPicNameToStore;
    	$profile->save();

    	return redirect()->route('admin.profiles.index')->with("success", "Profile created!");
    }

    public function show($id){
    	$profile = Profile::find($id);

    	$page_title = 'Profile';
    	$action = 'app_profiles';

    	return view('admin.profiles.show', compact('profile', 'page_title', 'action'));
    }

    public function edit($id){

    }
}
