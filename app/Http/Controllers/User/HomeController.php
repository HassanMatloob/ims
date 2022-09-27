<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Indigency;
use App\PersonalDetail;
use App\HouseholdIncome;
use App\Models\HouseholdCondition;
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
        $action = 'patient_details';
        $user = Auth::user();
        if ($user->is_admin == true) {
            return redirect('admin/home')->with('error', "You are not an applicant user");
        }

        $indigent = $user->indigency;
        // return $indigent;
        if (isset($indigent)) {
            $pd = $indigent->personalDetail;
            $houseCash = HouseholdIncome::where('indigency_id', $indigent->id)->get();
            $house = $indigent->householdCondition;
            $docs = $indigent->document;
            return view('user.home', compact('page_title', 'action', 'user', 'indigent', 'pd', 'houseCash', 'house' ,'docs'));
        }
        return view('user.home', compact('page_title', 'action', 'indigent'));
    }
}