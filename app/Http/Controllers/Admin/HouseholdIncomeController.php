<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Indigency;
use App\HouseholdIncome;

class HouseholdIncomeController extends Controller
{
    public function create($id) {
        $user = Auth::user();

        $profile = $user->profile;

    	$page_title = 'Household Incomes Form';
        $action = 'dashboard_1';
        $indigent = Indigency::find($id);
        if (isset($indigent)) {
            return view( 'admin.householdIncomes.create', compact('page_title', 'action', 'indigent', 'profile') );
        }
    	return redirect()->back()->with("error", "No Indigent to reference!");
    }

    public function store(Request $request) {
    	$this->validate($request, [
    		'f_name' => 'required',
    		'relation' => 'required',
    		'gender' => 'required',
    		'd_o_b' => 'required',
    		'emp_income' => 'nullable',
    		'old_age_pension' => 'nullable',
    		'dis_pension' => 'nullable',
    		'child_support_grant' => 'nullable',
    		'cash_from_relatives' => 'nullable'
    	]);

    	$totalIncome = 0;

    	if ( $request->input('emp_income') !== null ) {
    		$totalIncome += $request->input('emp_income');
    	}

    	if ( $request->input('old_age_pension') !== null ) {
    		$totalIncome += $request->input('old_age_pension');
    	}

    	if ( $request->input('dis_pension') !== null ) {
    		$totalIncome += $request->input('dis_pension');
    	}

    	if ( $request->input('child_support_grant') !== null ) {
    		$totalIncome += $request->input('child_support_grant');
    	}

    	if ( $request->input('cash_from_relatives') !== null ) {
    		$totalIncome += $request->input('cash_from_relatives');
    	}

    	$indigent = Indigency::find($request->input('indigent_id'));

    	$householdIncome = new HouseholdIncome;

    	$householdIncome->indigency_id = $indigent->id;
    	$householdIncome->full_name = $request->input('f_name');
    	$householdIncome->relationship = $request->input('relation');
    	$householdIncome->gender = $request->input('gender');
    	$householdIncome->date_of_birth = $request->input('d_o_b');
    	$householdIncome->income_from_employment = $request->input('emp_income');
    	$householdIncome->old_age_pension = $request->input('old_age_pension');
    	$householdIncome->dis_pension = $request->input('dis_pension');
    	$householdIncome->child_support_grant = $request->input('child_support_grant');
    	$householdIncome->cash_from_relatives = $request->input('cash_from_relatives');
    	$householdIncome->total_income = $totalIncome;
    	$householdIncome->save();

    	return redirect()->route('admin.householdIncomes.create', ['id' => $request->input('indigent_id')])->with('success', 'Household incomes captured!');
    }
}
