<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Indigency;

class IndigencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Indigent Form";
        $action = "dashboard_1";
        $user = Auth::user();
        
        if (isset($user->indigency)) {
            return redirect()->back()->with("error", "Indigent already exists!");
        }
        return view('user.indigencies.create', compact('page_title', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'f_name' => 'required',
            'l_name' => 'required',
            'identity' => 'required|digits:13'
        ]);

        $indigent = new Indigency;
        $indigent->user_id = Auth::user()->id;
        $indigent->firstName = $request->input('f_name');
        $indigent->surname = $request->input('l_name');
        $indigent->id_number = $request->input('identity');
        $indigent->save();

        return redirect()->route('user.personalDetails.createPersonalDetails');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = "Edit Indigent";
        $action = "dashboard_1";
        $indigent = Indigency::find($id);
        return view("user.indigencies.edit", compact('page_title', 'action', 'indigent'));
    }

    public function confirm($id){
        $indigent = Indigency::find($id);

        if ( $indigent->status == "Completed" ) {
            $indigent->status = "Confirmed";
            $indigent->save();

            return redirect()->route('user.home')->with("success", "Application submitted!");
        }
        return redirect()->back()->with('error', "You have not completed the form yet.");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "f_name" => "required|string|max:50",
            "l_name" => "required|string|max:50",
            "identity" => "required|digits:13"
        ]);

        $indigent = Indigency::find($id);
        $indigent->firstName = $request->input("f_name");
        $indigent->surname = $request->input("l_name");
        $indigent->id_number = $request->input("identity");
        $indigent->save();

        return redirect()->route('user.home')->with("success", "Indigent record updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
