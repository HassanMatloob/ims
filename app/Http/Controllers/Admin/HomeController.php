<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Indigency;
use App\User;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page_title = 'Dashboard';
        $action = 'dashboard_1';

        $user = Auth::user();

        $profile = $user->profile;

        $approved = Indigency::where('status', "Approved")->orderBy('updated_at', 'desc')->get();
        $rejects = Indigency::where('status', "Rejected")->get();
        $pendings = Indigency::where('status', "Confirmed")->get();
        // $user = Auth::user();
        // $indigent = Indigency::where('user_id', $user->id)->get();
        return view('admin.home', compact('page_title', 'action', 'profile', 'approved', 'rejects', 'pendings'));
    }
}