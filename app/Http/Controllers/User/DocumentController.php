<?php

namespace App\Http\Controllers\User;

use App\Events\DocumentsUploaded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Indigency;
use App\Models\Document;
class DocumentController extends Controller
{
    public function create(){
    	$page_title = 'Documents';
    	$action = 'dashboard_1';
    	$user = Auth::user();
    	$indigent = $user->indigency;
        if (isset($indigent->document)) {
            return redirect()->back()->with("error", "No Indigent to reference!");
        }
    	return view('user.documents.create', compact('page_title', 'action', 'indigent'));
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'municipal_acc' => 'required|mimes:pdf,jpg,jpeg,png',
    		'id_doc' => 'required|mimes:pdf,jpg,jpeg,png',
    		'confirm_pension' => 'nullable|mimes:pdf,jpg,jpeg,png',
    		'income_proof' => 'nullable|mimes:pdf,jpg,jpeg,png',
    		'affidavit' => 'nullable|mimes:pdf,jpg,jpeg,png',
    		'death_cert' => 'nullable|mimes:pdf,jpg,jpeg,png',
    		'council_testimony' => 'nullable|mimes:pdf,jpg,jpeg,png',
    	]);

        $user = Auth::user();
        $indigent = $user->indigency;

        // return $indigent->id;

        // Handle Municipal Account file upload
        if ( $request->hasFile('municipal_acc') ) {
            # Get the file name with its extension.
            $municipalAccNameWithExt = $request->file('municipal_acc')->getClientOriginalName();

            # Get just the file name.
            $municipalAccName = pathinfo($municipalAccNameWithExt, PATHINFO_FILENAME);

            # Get just the file name extension.
            $municipalAccExtension = $request->file('municipal_acc')->getClientOriginalExtension();

            # Construct the file name to store.
            $municipalAccNameToStore = $municipalAccName . "_" . time() . "." . $municipalAccExtension;

            # Store the file in storage/app/public/indigency_id
            $path = $request->file('municipal_acc')->storeAs('public/'.$indigent->id, $municipalAccNameToStore);
        }

        // Handle ID document file upload
        if ( $request->hasFile('id_doc') ) {
            # Get the file name with its extension.
            $idDocNameWithExt = $request->file('id_doc')->getClientOriginalName();

            # Get just the file name.
            $idDocName = pathinfo($idDocNameWithExt, PATHINFO_FILENAME);

            # Get just the file name extension.
            $idDocExtension = $request->file('id_doc')->getClientOriginalExtension();

            # Construct the file name to store.
            $idDocNameToStore = $idDocName . "_" . time() . "." . $idDocExtension;

            # Store the file in storage/app/public/indigency_id
            $path = $request->file('id_doc')->storeAs('public/'.$indigent->id, $idDocNameToStore);
        }

        // Handle Confirmation of Pension document file upload
        if ( $request->hasFile('confirm_pension') ) {
            # Get the file name with its extension.
            $pensionProofNameWithExt = $request->file('confirm_pension')->getClientOriginalName();

            # Get just the file name.
            $pensionProofName = pathinfo($pensionProofNameWithExt, PATHINFO_FILENAME);

            # Get just the file name extension.
            $pensionProofExtension = $request->file('confirm_pension')->getClientOriginalExtension();

            # Construct the file name to store.
            $pensionProofNameToStore = $pensionProofName . "_" . time() . "." . $pensionProofExtension;

            # Store the file in storage/app/public/indigency_id
            $path = $request->file('confirm_pension')->storeAs('public/'.$indigent->id, $pensionProofNameToStore);
        } else {
            $pensionProofNameToStore = "no document uploaded";
        }

        // Handle Proof of Income document file upload
        if ( $request->hasFile('income_proof') ) {
            # Get the file name with its extension.
            $incomeProofNameWithExt = $request->file('income_proof')->getClientOriginalName();

            # Get just the file name.
            $incomeProofName = pathinfo($incomeProofNameWithExt, PATHINFO_FILENAME);

            # Get just the file name extension.
            $incomeProofExtension = $request->file('income_proof')->getClientOriginalExtension();

            # Construct the file name to store.
            $incomeProofNameToStore = $incomeProofName . "_" . time() . "." . $incomeProofExtension;

            # Store the file in storage/app/public/indigency_id
            $path = $request->file('income_proof')->storeAs('public/'.$indigent->id, $incomeProofNameToStore);
        } else {
            $incomeProofNameToStore = "no document uploaded";
        }

        // Handle Affidavit document file upload
        if ( $request->hasFile('affidavit') ) {
            # Get the file name with its extension.
            $affidavitNameWithExt = $request->file('affidavit')->getClientOriginalName();

            # Get just the file name.
            $affidavitName = pathinfo($affidavitNameWithExt, PATHINFO_FILENAME);

            # Get just the file name extension.
            $affidavitExtension = $request->file('affidavit')->getClientOriginalExtension();

            # Construct the file name to store.
            $affidavitNameToStore = $affidavitName . "_" . time() . "." . $affidavitExtension;

            # Store the file in storage/app/public/indigency_id
            $path = $request->file('affidavit')->storeAs('public/'.$indigent->id, $affidavitNameToStore);
        } else {
            $affidavitNameToStore = "no document uploaded";
        }

        // Handle Death Certificate (if the owner is deceased) file upload
        if ( $request->hasFile('death_cert') ) {
            # Get the file name with its extension.
            $deathCertNameWithExt = $request->file('death_cert')->getClientOriginalName();

            # Get just the file name.
            $deathCertName = pathinfo($deathCertNameWithExt, PATHINFO_FILENAME);

            # Get just the file name extension.
            $deathCertExtension = $request->file('death_cert')->getClientOriginalExtension();

            # Construct the file name to store.
            $deathCertNameToStore = $deathCertName . "_" . time() . "." . $deathCertExtension;

            # Store the file in storage/app/public/indigency_id
            $path = $request->file('death_cert')->storeAs('public/'.$indigent->id, $deathCertNameToStore);
        } else {
            $deathCertNameToStore = "no document uploaded";
        }

        // Handle Letter from Council/proof of unemployment status document file upload
        if ( $request->hasFile('council_testimony') ) {
            # Get the file name with its extension.
            $councilTestNameWithExt = $request->file('council_testimony')->getClientOriginalName();

            # Get just the file name.
            $councilTestName = pathinfo($councilTestNameWithExt, PATHINFO_FILENAME);

            # Get just the file name extension.
            $councilTestExtension = $request->file('council_testimony')->getClientOriginalExtension();

            # Construct the file name to store.
            $councilTestNameToStore = $councilTestName . "_" . time() . "." . $councilTestExtension;

            # Store the file in storage/app/public/indigency_id
            $path = $request->file('council_testimony')->storeAs('public/'.$indigent->id, $councilTestNameToStore);
        } else {
            $councilTestNameToStore = "no document uploaded";
        }

    	$document_record = new Document;

    	$document_record->indigency_id = $indigent->id;
    	$document_record->municipal_acc_doc = $municipalAccNameToStore;
    	$document_record->id_doc = $idDocNameToStore;
    	$document_record->confirmation_of_pension = $pensionProofNameToStore;
    	$document_record->proof_of_income = $incomeProofNameToStore;
    	$document_record->affidavit = $affidavitNameToStore;
    	$document_record->death_cert = $deathCertNameToStore;
    	$document_record->letter_from_council = $councilTestNameToStore;
    	$document_record->save();

        DocumentsUploaded::dispatch($document_record);
        
    	return redirect()->route('user.home')->with("success", "Documents uploaded successfully!");
    }
}
