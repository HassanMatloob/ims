<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Approval;
use App\Indigency;
use App\User;
use App\Events\ApplicationApproved;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ApprovalController extends Controller
{
	public function create($id){
		$page_title = 'Dashboard';
        $action = 'app_profile';
		$indigent = Indigency::find($id);

		$user = Auth::user();

        $profile = $user->profile;

		return view('admin.approvals.create', compact('page_title', 'action', 'indigent', 'profile'));
	}
    //
    public function approve(Request $request){

    	$indigent = Indigency::find( $request->input('indigent_id') );

    	if (isset($indigent)) {
    		$approve = new Approval;
	    	$approve->indigency_id = $indigent->id;
	    	$approve->verdict = $request->input("approval");
	    	$approve->comment = $request->input("comment");
	    	$approve->user_id = Auth::user()->id;
	    	$approve->save();

	    	ApplicationApproved::dispatch($approve);

	    	return redirect()->route('admin.indigencies.show', ['id' => $indigent->id])->with("success", "Verdict applied successfully!");
    	}
    	return redirect()->back()->with("error", "No Indigent Record to reference!");
    }
}
