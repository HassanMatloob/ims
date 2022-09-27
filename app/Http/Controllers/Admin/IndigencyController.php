<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\VerificationController;
use App\Models\Approval;
use App\Models\HouseholdCondition;
use App\Models\Profile;
use App\HouseholdIncome;
use App\Indigency;
use App\PersonalDetail;
use App\User;
use App\Events\NewApplication;
use App\Events\ApplicationConfirmed;

class IndigencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $profile = $user->profile;

        $page_title = "Indigent Records";
        $action = "patient_list";
        $indigents = Indigency::join('users', 'indigencies.user_id', '=', 'users.id')->join('profiles', 'users.id', '=', 'profiles.user_id')->get(['indigencies.id', 'indigencies.firstName', 'indigencies.surname', 'indigencies.status', 'indigencies.pro_pic', 'indigencies.id_number', 'indigencies.created_at', 'users.email', 'users.is_admin', 'profiles.fname', 'profiles.lname']);

        return view('admin.indigencies.index', compact('page_title', 'action', 'indigents', 'profile'));
    }

    public function viewApproved()
    {
        $user = Auth::user();

        $profile = $user->profile;

        $page_title = "Indigent Records";
        $action = "patient_list";
        $indigents = Indigency::leftJoin('users', 'users.id', '=', 'indigencies.user_id')->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')->where('status', 'Approved')->get(['indigencies.id', 'indigencies.firstName', 'indigencies.surname', 'indigencies.status', 'indigencies.pro_pic', 'indigencies.id_number', 'indigencies.created_at', 'users.email', 'users.is_admin', 'profiles.fname', 'profiles.lname']);

        
        return view('admin.indigencies.approved', compact('page_title', 'action', 'indigents', 'profile'));
    }

    public function viewRejected()
    {
        $user = Auth::user();

        $profile = $user->profile;

        $page_title = "Indigent Records";
        $action = "patient_list";
        $indigents = Indigency::leftJoin('users', 'users.id', '=', 'indigencies.user_id')->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')->where('status', 'Rejected')->get(['indigencies.id', 'indigencies.firstName', 'indigencies.surname', 'indigencies.status', 'indigencies.pro_pic', 'indigencies.id_number', 'indigencies.created_at', 'users.email', 'users.is_admin', 'profiles.fname', 'profiles.lname']);
        
        return view('admin.indigencies.rejected', compact('page_title', 'action', 'indigents', 'profile'));
    }

    public function viewPending()
    {
        $user = Auth::user();

        $profile = $user->profile;

        $page_title = "Indigent Records";
        $action = "patient_list";
        $indigents = Indigency::leftJoin('users', 'users.id', '=', 'indigencies.user_id')->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')->where('status', 'Confirmed')->get(['indigencies.id', 'indigencies.firstName', 'indigencies.surname', 'indigencies.status', 'indigencies.pro_pic', 'indigencies.id_number', 'indigencies.created_at', 'users.email', 'users.is_admin', 'profiles.fname', 'profiles.lname']);
        
        return view('admin.indigencies.pending', compact('page_title', 'action', 'indigents', 'profile'));
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

        $profile = $user->profile;

        return view('admin.indigencies.create', compact('page_title', 'action', 'profile'));
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
            'f_name' => 'required|string|max:30',
            'l_name' => 'required|string|max:30',
            'id_no' => 'required|string|max:13',
        ]);

        $southAfrican = $this->validateIdNum($request->input('id_no'));

        if ($southAfrican == true) {
            $indigent = new Indigency;
            $indigent->user_id = Auth::user()->id;
            $indigent->firstName = $request->input('f_name');
            $indigent->surname = $request->input('l_name');
            $indigent->id_number = $request->input('id_no');
            $indigent->save();
            
            NewApplication::dispatch($indigent);

            return redirect()->route('admin.personalDetails.createPersonalDetails', ['id' => $indigent->id]);
        } else {
            return redirect()->back()->with('error', 'This I.D number is not a valid South African I.D number!' );
        }

        
    }

    /*
    * Validate South African ID number
    *
    * @param $id_number
    */

    public function validateIdNum($id_number, $return_details = false) {

        $validated = false;
        $res = array();

        if (is_numeric($id_number) && strlen($id_number) === 13) {

            $errors = false;

            $num_array = str_split($id_number);


            // Validate the day and month

            $id_month = $num_array[2] . $num_array[3];

            $id_day = $num_array[4] . $num_array[5];


            if ( $id_month < 1 || $id_month > 12) {
                $errors = true;
            }

            if ( $id_day < 1 || $id_day > 31) {
                $errors = true;
            }
            

            // Validate gender

            $id_gender = $num_array[6] >= 5 ? 'male' : 'female';


            // Validate citizenship

            // citizenship as per id number
            $id_foreigner = $num_array[10];


            /**********************************
                Check Digit Verification
            **********************************/

            // Declare the arrays
            $even_digits = array();
            $odd_digits = array();

            // Loop through modified $num_array, storing the keys and their values in the above arrays
            foreach ( $num_array as $index => $digit) {

                if ($index === 0 || $index % 2 === 0) {

                    $odd_digits[] = $digit;
                   
                }

                else {

                    $even_digits[] = $digit;

                }

            }

            // use array pop to remove the last digit from $odd_digits and store it in $check_digit
            $check_digit = array_pop($odd_digits);

            //All digits in odd positions (excluding the check digit) must be added together.
            $added_odds = array_sum($odd_digits);

            //All digits in even positions must be concatenated to form a 6 digit number.
            $concatenated_evens = implode('', $even_digits);

            //This 6 digit number must then be multiplied by 2.
            $evensx2 = $concatenated_evens * 2;

            // Add all the numbers produced from the even numbers x 2
            $added_evens = array_sum( str_split($evensx2) );

            $sum = $added_odds + $added_evens;

            // get the last digit of the $sum
            $last_digit = substr($sum, -1);

            // 10 - $last_digit
            $verify_check_digit = (10 - (int)$last_digit) % 10;

            // test expected last digit against the last digit in $id_number submitted
            if ((int)$verify_check_digit !== (int)$check_digit) {
                $errors = true;
            }

            // if errors haven't been set to true by any one of the checks, we can change verified to true;
            if (!$errors) {
                $validated = true;
            }

        }

        if ($return_details === false) {
            return $validated;
        }
        
        else {

            $citizen_status = !$id_foreigner ? 'YES' : 'NO';

            $birth_year = substr($id_number, 0, 2);
            $birth_month = substr($id_number, 2, 4);
            $year = date('y');
            $month = date('m');
            
            $age = $year < $birth_year ? ($year - $birth_year) + 100 : $year - $birth_year ;
            
            $age =  $month < $birth_month ? $age - 1 : $age;

            array_push($res, $age, $id_gender, $citizen_status);
            return $res;
        }


    }

/* The end of validation of South African ID number */

    /*
    *
    */

    public function apiAuth(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.verifyid.co.za/webservice/authenticate",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('email_address'=>'admin@helloworld.africa', 'password' => 'Newenergy@2022'),
            CURLOPT_HTTPHEADER => array('Accept: application/json')
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response)->Result->API_KEY;
    }

    /*
    *
    */

    public function checkBalance(){
        $curl1 = curl_init();

        curl_setopt_array($curl1, array(
            CURLOPT_URL => "https://www.verifyid.co.za/webservice/authenticate",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('email_address'=>'admin@helloworld.africa', 'password' => 'Newenergy@2022'),
            CURLOPT_HTTPHEADER => array('Accept: application/json')
        ));

        $response1 = curl_exec($curl1);

        curl_close($curl1);
        $decodedRes = json_decode($response1);
        $apikey = $decodedRes->Result->API_KEY;

        $curl2 = curl_init();

        curl_setopt_array($curl2, array(
            CURLOPT_URL => "https://www.verifyid.co.za/webservice/my_credits?api_key=".$apikey,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array('Accept: application/json')
        ));

        $response2 = curl_exec($curl2);

        curl_close($curl2);
        return $response2;
    }

    public function verifyId($id){
        $page_title = "Verify";
        $action = "patient_details";
        $profile = Auth::user()->profile;
        $indigent = Indigency::find($id);

        return view('admin.indigencies.verifyId', compact('page_title', 'action', 'profile', 'indigent'));
    }


    /*
    *
    */

    public function verifyIdNum(Request $request){

        $identityNumber = $request->input('id_number');

        $page_title = "Verify";
        $action = "patient_details";
        $profile = Auth::user()->profile;

        $indigents = Indigency::where('id_number', $identityNumber)->get();
        $indigent = $indigents[0];
        $personal_details = PersonalDetail::where('indigency_id', $indigent->id)->first();

        try{
            $guzzle = new \GuzzleHttp\Client(['base_uri' => 'https://www.verifyid.co.za/webservice/']);

            $raw_response = $guzzle->post('home_affairs_real_time_idv', [
                'headers' => [
                    'Accept'     => 'application/json'
                ],
                'form_params' => [
                    'api_key' => '$2y$10$78MW9BppUH1vETFfPpNwPOiLlrsgacO/hH0Wpn',
                    
                    'id_number' => '8612055576080'
                ]
            ]);

            $result = $raw_response->getBody()->getContents();

            $result = json_decode($result); 

            

            $verificationResult = '';
            if($result->Status == 'Success'){
                $verificationResult = $result->RealTime_Verification;
                //dd($verificationResult);
            }
            elseif($result->Status == 'Failure'){
                return back()->with('message',$result->Error);
            }

            $contents = Storage::get('public/JSON_Response.txt');
            $refined = json_decode($contents);

            

            //return view('pages.crypto.wallet.wallet_coin', compact('result'));
            return view('admin.indigencies.searched', compact('identityNumber', 'refined', 'page_title', 'action', 'profile', 'indigent', 'personal_details', 'verificationResult'));
        } catch (\GuzzleHttp\Exception\RequestException $e){
            //dd($e->getMessage());
            return back()->with('message',$e->getMessage());
        }
        

        
        //dd($indigent);
        
        

        

        
        // return $refined[0];

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "https://www.verifyid.co.za/webservice/super_trace_plus_score",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "POST",
        //     CURLOPT_POSTFIELDS => array('api_key'=>'Your API key goes here', 'id_number' => 'ID number goes here'),
        //     CURLOPT_HTTPHEADER => array('Accept: application/json')
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);
        // echo $response;
    }

    public function verifyIdnumBidder(Request $request){
        $identityNumber = $request->input('id_number');
        //dd($identityNumber);

        $indigents = Indigency::where('id_number', $identityNumber)->get();
        $indigent = $indigents[0];
        //dd($indigent);
        
        $page_title = "EMPLOYEE CIPC INFORMATION";
        $action = "patient_details";
        $profile = Auth::user()->profile;

        $personal_details = PersonalDetail::where('indigency_id', $indigent->id)->first();

        $contents = Storage::get('public/JSON_Response.txt');
        $refined = json_decode($contents);
        // return $refined[0];

        return view('admin.bidderVetting.cipc_info_show', compact('identityNumber', 'refined', 'page_title', 'action', 'profile', 'indigent', 'personal_details'));
 
    }

    // public function verifyIdNum(){
    //     $contents = Storage::get('JSON_Response.txt');

    //     return $contents;
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_title = "Indigent";
        $action = "patient_details";
        $indigent = Indigency::find($id);
        $user1 = User::find($indigent->user_id);
        $pd = $indigent->personalDetail;
        
        $incomes = $indigent->householdIncome;
       
        $docs = $indigent->document;


        $verdict = $indigent->approval;


        $user2 = Auth::user();
        
        $householdInfo = HouseholdCondition::where('indigency_id', $id)->get();

        if ($user2->is_admin == true) {
            $assistantPro = $user1->profile;
            $profile = $user2->profile;
            
            return view('admin.indigencies.show', compact('page_title', 'action', 'indigent', 'user1', 'profile', 'assistantPro', 'incomes','householdInfo','pd', 'docs', 'verdict'));
        }

        return view('admin.indigencies.show', compact('page_title', 'action', 'indigent', 'user1', 'incomes','householdInfo','pd', 'docs', 'verdict'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function confirm(Request $request, $id){
        $indigent = Indigency::find($id);

        if ( $indigent->status == "Completed" ) {
            $indigent->status = "Confirmed";
            $indigent->save();

            $page_title = 'Dashboard';
            $action = 'app_profile';

            ApplicationConfirmed::dispatch($indigent);
            
            return redirect()->route('admin.indigencies.show', ['id' => $id])->with("success", "Application submitted!");
        }
        return redirect()->route('admin.indigencies.show', ['id' => $id])->with('error', "You have not completed the form yet.");
    }

    public function officiallyVerify(Request $request, $id){
        $indigent = Indigency::find($id);

        if ( $indigent->status == "Completed" ) {
            $indigent->status = "Confirmed";
            $indigent->save();

            $page_title = 'Dashboard';
            $action = 'app_profile';

            // ApplicationConfirmed::dispatch($indigent);
            
            return redirect()->route('admin.indigencies.show', ['id' => $id])->with("success", "Application submitted!");
        }
        return redirect()->route('admin.indigencies.show', ['id' => $id])->with('error', "You have not completed the form yet.");
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
