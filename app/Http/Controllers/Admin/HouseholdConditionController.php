<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\HouseProvided;
use App\Http\Controllers\Controller;
use App\Indigency;
use App\PersonalDetail;
use App\Models\HouseholdCondition;

class HouseholdConditionController extends Controller
{
    public function create($id){
        $user = Auth::user();

        $profile = $user->profile;

    	$page_title = 'Household Condition Form';
    	$action = 'dashboard_1';
        $indigent = Indigency::find($id);
        // $pdCheck = HouseholdCondition::where("indigency_id", $id)->get();
        $house = $indigent->householdCondition;

        if (isset($house)) {
            return redirect()->back()->with("error", "Record already exists!");
        }

    	return view('admin.householdConditions.create', compact('page_title', 'action', 'indigent', 'profile'));
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'water-main' => 'required',
    		'toilet-facility' => 'required',
            'indigent_id' => 'required'
    	]);

    	$conditions = new HouseholdCondition;
    	$conditions->indigency_id = $request->input('indigent_id');
    	$conditions->main_water_src = $request->input('water-main');
    	$conditions->toilet_facility = $request->input('toilet-facility');
    	$conditions->save();

        HouseProvided::dispatch($conditions);
        
    	return redirect()->route('admin.documents.create', ['id' => $request->input('indigent_id')])->with('success', 'Household Conditions captured!');
    }
}
