<?php

namespace App\Http\Controllers\User;

use App\Events\HouseProvided;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Indigency;
use App\Models\HouseholdCondition;

class HouseholdConditionController extends Controller
{
    public function create(){
    	$page_title = 'Household Condition Form';
    	$action = 'dashboard_1';
    	$user = Auth::user();
    	$indigent = $user->indigency;
        if (isset($indigent->householdCondition)) {
            return redirect()->back()->with("error", "Record already exists!");
        }
    	return view('user.householdConditions.create', compact('page_title', 'action', 'indigent'));
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'water-main' => 'required',
    		'toilet-facility' => 'required'
    	]);

    	$user = Auth::user();
    	$indigent = $user->indigency;

    	$conditions = new HouseholdCondition;
    	$conditions->indigency_id = $indigent->id;
    	$conditions->main_water_src = $request->input('water-main');
    	$conditions->toilet_facility = $request->input('toilet-facility');
    	$conditions->save();

        HouseProvided::dispatch($conditions);
        
    	return redirect()->route('user.documents.create')->with('success', 'Household Conditions captured!');
    }
}
