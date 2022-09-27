<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Verification;
use App\User;
use App\Indigency;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{

    //
    public function store(Request $request){

        $indigent = Indigency::find( $request->input('indigent_id') );

        if (isset($indigent)) {
            $verification = new Verification;
            $verification->indigency_id = $indigent->id;
            $verification->verification_status = $request->input("verdict");
            $verification->comments = $request->input("comment");
            $verification->user_id = Auth::user()->id;
            $verification->save();

            $indigent->status = "Verified";
            $indigent->save();

            // ApplicationApproved::dispatch($approve);

            return redirect()->route('admin.indigencies.show', ['id' => $indigent->id])->with("success", "Verdict applied successfully!");
        }
        return redirect()->back()->with("error", "No Indigent Record to reference!");
    }


    public function choose($id){
    	$page_title = 'Choose Verification Method';
        $action = 'app_profile';
        $profile = Auth::user()->profile;
        $indigent = Indigency::find($id);
    	return view('admin.verifications.chooseMethod', compact('page_title', 'action', 'profile', 'indigent'));
    }

    public function chosen(Request $request){
    	// return $request->input('indigent_id');
    	if ($request->input('verification_method') == 'autoVer') {
    		return redirect( '/admin/verification/autoVerification/'.$request->input('indigent_id') );
    		$this->autoVerification($request->input('indigent_id'));
    	}
    	return redirect( '/admin/verification/manualVerification/'.$request->input('indigent_id') );
    	$this->manualVerification($request->input('indigent_id'));
    }

    public function manualVerification($id){
    	$page_title = 'MANUAL VERIFICATION';
        $action = 'app_profile';
        $profile = Auth::user()->profile;

        $indigent = Indigency::find($id);
    	return view('admin.verifications.manualVerification', compact('page_title', 'action', 'profile', 'indigent'));
    }

    public function autoVerification($id){
    	$page_title = 'AUTO VERIFICATION';
        $action = 'app_profile';
        $profile = Auth::user()->profile;

        $indigent = Indigency::find($id);
        return view('admin.verifications.autoVerification', compact('page_title', 'action', 'profile', 'indigent'));
    }

    public function bidderVetting(){
    	$page_title = 'EMPLOYEE CIPC INFORMATION';
        $action = 'app_profile';
        //$profile = Auth::user()->profile;
        //dd($profile);
        //$indigent = Indigency::find($id);
        return view('admin.bidderVetting.cipc_info', compact('page_title', 'action'));
    }
}
