<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Events\PersonalDetailGiven;
use App\Indigency;
use App\PersonalDetail;
use App\User;
use DB;

class PersonalDetailController extends Controller
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
        $page_title = "Personal Details Form";
        $action = 'dashboard_1';
        $user = Auth::user();
        $indigent = $user->indigency;
        if ( !isset($indigent) ) {
            return redirect()->back()->with("error", "No indigent record to reference!");
        }

        $pd = $indigent->personalDetail;
        if (isset($pd)) {
            return redirect()->back()->with("error", "Personal Information already given");
        }
 
        return view('user.personalDetails.create', compact('page_title', 'action', 'indigent'));
    }

    public function createPersonalDetails(Request $request)
    {
        $page_title = "Personal Details Form";
        $action = 'dashboard_1';
        $user = Auth::user();
        $indigent = $user->indigency;
        if ( !isset($indigent) ) {
            return redirect()->back()->with("error", "No indigent record to reference!");
        }

        $pd = $indigent->personalDetail;
        if (isset($pd)) {
            return redirect()->back()->with("error", "Personal Information already given");
        }
 
        $person = $request->session()->get('person');
        return view('user.personalDetails.createPersonalDetails', compact('page_title', 'action', 'indigent', 'person'));
    }

    public function createEmploymentDetails(Request $request)
    {
        $page_title = "Personal Details Form";
        $action = 'dashboard_1';
        $user = Auth::user();
        $indigent = $user->indigency;
        if ( !isset($indigent) ) {
            return redirect()->back()->with("error", "No indigent record to reference!");
        }

        $pd = $indigent->personalDetail;
        if (isset($pd)) {
            return redirect()->back()->with("error", "Personal Information already given");
        }
 
        $person = $request->session()->get('person');
        return view('user.personalDetails.createEmploymentDetails', compact('page_title', 'action', 'indigent', 'person'));
    }

    public function storePersonalDetails(Request $request)
    {
        $validateData = $request->validate([
            'initials' => "required",
            'mname' => "nullable|alpha",
            'acc_no' => "required|digits:8",
            'd_o_b' => "required",
            'res_addr' => "required",
            'res_postal_code' => "required",
            'p_addr' => "required",
            'p_code' => "required",
            'pension' => "required",
            'gender' => "required",
            'ward_no' => "required",
            'emp_status' => "required",
            'meter' => "required",
            'alt_energy' => "nullable",
            'rates' => "nullable",
            'water' => "nullable",
            'toilet' => "nullable",
            'erf' => "required",
            'home_tel' => "nullable",
            'cell' => "required",
            'other_contact' => "nullable",
            'm_status' => "required",
            'deceased' => "required",
        ]);

        $user = Auth::user();
        $indigent = $user->indigency;


        if (empty($request->session()->get('person'))) {
            $person = new PersonalDetail;

            $person->initials = $request->input('initials');
            $person->maiden_name = $request->input('mname');
            $person->account_number = $request->input('acc_no');
            $person->d_o_b = $request->input('d_o_b');
            $person->res_address = $request->input('res_addr');
            $person->res_postal_code = $request->input('res_postal_code');
            $person->postal_address = $request->input('p_addr');
            $person->postal_code = $request->input('p_code');

            
            $person->pensioner = $request->input('pension') == "true" ? true : false;
            
            $person->gender = $request->input('gender');
            $person->ward_number = $request->input('ward_no');
            $person->employment_status = $request->input('emp_status');
            $person->electricity_meter = $request->input('meter');

            $person->alternative_energy = $request->input('alt_energy') == '1' ? true : false;

            $person->rates = $request->input('rates') == "1" ? true : false;

            $person->water = $request->input('water') == "1" ? true : false;

            $person->toilet_facility = $request->input('toilet') == "1" ? true : false;
            
            $person->erf = $request->input('erf');
            $person->marital_status = $request->input('m_status');
            $person->deceased = $request->input('deceased');
            $person->home_tel = $request->input('home_tel');
            $person->cell_number = $request->input('cell');
            $person->other_contact = $request->input('other_contact');
            
            $request->session()->put('person', $person);
        } else {
            $person = $request->session()->get('person');

            $person->initials = $request->input('initials');
            $person->maiden_name = $request->input('mname');
            $person->account_number = $request->input('acc_no');
            $person->d_o_b = $request->input('d_o_b');
            $person->res_address = $request->input('res_addr');
            $person->res_postal_code = $request->input('res_postal_code');
            $person->postal_address = $request->input('p_addr');
            $person->postal_code = $request->input('p_code');

            
            $person->pensioner = $request->input('pension') == "true" ? true : false;
            
            $person->gender = $request->input('gender');
            $person->ward_number = $request->input('ward_no');
            $person->employment_status = $request->input('emp_status');
            $person->electricity_meter = $request->input('meter');

            $person->alternative_energy = $request->input('alt_energy') == '1' ? true : false;

            $person->rates = $request->input('rates') == "1" ? true : false;

            $person->water = $request->input('water') == "1" ? true : false;

            $person->toilet_facility = $request->input('toilet') == "1" ? true : false;
            
            $person->erf = $request->input('erf');
            $person->marital_status = $request->input('m_status');
            $person->deceased = $request->input('deceased');
            $person->home_tel = $request->input('home_tel');
            $person->cell_number = $request->input('cell');
            $person->other_contact = $request->input('other_contact');

            $request->session()->put('person', $person);
        }
        
        if ($request->input('emp_status') == "Unemployed") {
            $person->indigency_id = $indigent->id;
            $person->save();
            event(new PersonalDetailGiven($person));
            return redirect()->route('user.householdIncomes.create')->with('success', 'Personal details captured!');
        } elseif ($request->input('emp_status') == "Employed") {

            return redirect()->route('user.personalDetails.createEmploymentDetails')->with('success', 'Personal details captured!');
        }
        
    }

    public function storeEmploymentDetails(Request $request)
    {
        $validateData = $request->validate([
            'employer' => "nullable",
            'emp_addr' => "nullable",
            'emp_tel' => "nullable",
            'work_tel' => "nullable",
        ]);

        $user = Auth::user();
        $indigent = $user->indigency;
        
        if (empty($request->session()->get('person'))) {
            $person = new PersonalDetail;
            $person->fill($validateData);
            $request->session()->put('person', $person);
        } else {
            $person = $request->session()->get('person');
            $person->fill($validateData);
            $request->session()->put('person', $person);
        }

        event(new PersonalDetailGiven($person));

        return redirect()->route('user.householdIncomes.create')->with('success', 'Personal details captured!');
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
            'initials' => "required",
            'mname' => "nullable",
            'acc_no' => "required",
            'd_o_b' => "required",
            'res_addr' => "required",
            'res_postal_code' => "required",
            'p_addr' => "required",
            'p_code' => "required",
            'pension' => "required",
            'gender' => "required",
            'ward_no' => "required",
            'emp_status' => "required",
            'meter' => "required",
            'alt_energy' => "nullable",
            'rates' => "nullable",
            'water' => "nullable",
            'toilet' => "nullable",
            'erf' => "required",
            'employer' => "nullable",
            'emp_addr' => "nullable",
            'emp_tel' => "nullable",
            'home_tel' => "nullable",
            'cell' => "required",
            'work_tel' => "nullable",
            'other_contact' => "nullable",
            'm_status' => "required",
            'deceased' => "required",
        ]);

        $user = Auth::user();
        $indigent = $user->indigency;
        
        $person = new PersonalDetail;
        $person->indigency_id = $indigent->id;
        $person->initials = $request->input('initials');
        $person->maiden_name = $request->input('mname');
        $person->account_number = $request->input('acc_no');
        $person->d_o_b = $request->input('d_o_b');
        $person->res_address = $request->input('res_addr');
        $person->res_postal_code = $request->input('res_postal_code');
        $person->postal_address = $request->input('p_addr');
        $person->postal_code = $request->input('p_code');

        
        $person->pensioner = $request->input('pension') == "true" ? true : false;
        
        $person->gender = $request->input('gender');
        $person->ward_number = $request->input('ward_no');
        $person->employment_status = $request->input('emp_status');
        $person->electricity_meter = $request->input('meter');

        $person->alternative_energy = $request->input('alt_energy') == '1' ? true : false;

        $person->rates = $request->input('rates') == "1" ? true : false;

        $person->water = $request->input('water') == "1" ? true : false;

        $person->toilet_facility = $request->input('toilet') == "1" ? true : false;
        
        $person->erf = $request->input('erf');
        $person->name_of_employer = $request->input('employer');
        $person->employer_address = $request->input('emp_addr');
        $person->employer_tel = $request->input('emp_tel');
        $person->marital_status = $request->input('m_status');
        $person->deceased = $request->input('deceased');
        $person->home_tel = $request->input('home_tel');
        $person->cell_number = $request->input('cell');
        $person->work_tel = $request->input('work_tel');
        $person->other_contact = $request->input('other_contact');
        $person->save();

        event(new PersonalDetailGiven($person));

        return redirect()->route('user.householdIncomes.create')->with('success', 'Personal details captured!');
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
        $page_title = "Edit Personal Details";
        $action = "dashboard_1";
        $indigent = Indigency::find($id);
        return view("user.personalDetails.edit", compact('page_title', 'action', 'indigent'));
    }

    public function editPD($id)
    {

        $page_title = "Edit Personal Details";
        $action = "dashboard_1";
        $indigent = Indigency::find($id);
        $pd = $indigent->personalDetail;

        if (isset($pd)) {
            return view("user.personalDetails.editPD", compact('page_title', 'action', 'indigent', 'pd'));
        }
        return redirect()->back()->with("error", "No Personal Details to edit");
    }


    public function editED($id)
    {
        $page_title = "Edit Personal Details";
        $action = "dashboard_1";
        $indigent = Indigency::find($id);
        $person = $request->session()->get('person');
        return view("user.personalDetails.editED", compact('page_title', 'action', 'indigent'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePD(Request $request, $id)
    {
        $this->validate($request, [
            'initials' => "required",
            'mname' => "nullable",
            'acc_no' => "required",
            'd_o_b' => "required",
            'res_addr' => "required",
            'res_postal_code' => "required",
            'p_addr' => "required",
            'p_code' => "required",
            'pension' => "required",
            'gender' => "required",
            'ward_no' => "required",
            'emp_status' => "required",
            'meter' => "required",
            'alt_energy' => "nullable",
            'rates' => "nullable",
            'water' => "nullable",
            'toilet' => "nullable",
            'erf' => "required",
            'home_tel' => "nullable",
            'cell' => "required",
            'other_contact' => "nullable",
            'm_status' => "required",
            'deceased' => "required",
        ]);

        $person = PersonalDetail::find($id);
        return $person;
        
        $person->initials = $request->input('initials');
        $person->maiden_name = $request->input('mname');
        $person->account_number = $request->input('acc_no');
        $person->d_o_b = $request->input('d_o_b');
        $person->res_address = $request->input('res_addr');
        $person->res_postal_code = $request->input('res_postal_code');
        $person->postal_address = $request->input('p_addr');
        $person->postal_code = $request->input('p_code');

        
        $person->pensioner = $request->input('pension') == "true" ? true : false;
        
        $person->gender = $request->input('gender');
        $person->ward_number = $request->input('ward_no');
        $person->employment_status = $request->input('emp_status');
        $person->electricity_meter = $request->input('meter');

        $person->alternative_energy = $request->input('alt_energy') == '1' ? true : false;

        $person->rates = $request->input('rates') == "1" ? true : false;

        $person->water = $request->input('water') == "1" ? true : false;

        $person->toilet_facility = $request->input('toilet') == "1" ? true : false;
        
        $person->erf = $request->input('erf');
        $person->marital_status = $request->input('m_status');
        $person->deceased = $request->input('deceased');
        $person->home_tel = $request->input('home_tel');
        $person->cell_number = $request->input('cell');
        $person->other_contact = $request->input('other_contact');
        
        if ($request->input('emp_status') == "Unemployed") {
            $person->name_of_employer = null;
            $person->employer_address = null;
            $person->employer_tel = null;
            $person->work_tel = null;
            
            $person->save();
            return redirect()->route('user.home')->with('success', 'Personal details updated!');
        } elseif ($request->input('emp_status') == "Employed") {
            $person->save();
            return redirect()->route('user.personalDetails.editED', ['id' => $person->id]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateED(Request $request, $id)
    {
        $validateData = $request->validate([
            'employer' => "nullable",
            'emp_addr' => "nullable",
            'emp_tel' => "nullable",
            'work_tel' => "nullable",
        ]);

        $person = PersonalDetail::find($id);
        
        $person->name_of_employer = $request->input('employer');
        $person->employer_address = $request->input('emp_addr');
        $person->employer_tel = $request->input('emp_tel');
        $person->work_tel = $request->input('work_tel');

        $person->save();

        return redirect()->route('user.home')->with('success', 'Personal details updated!');
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
