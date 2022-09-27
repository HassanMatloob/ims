<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	$page_title = "Index";
	$action = "dashboard_1";
	$logo = 'indigent-logo.png';
    return view('welcome', compact('page_title', 'action', 'logo'));
});

Auth::routes();

// Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('verified');



Route::get('/email/verify', function() {
    //
    $action = 'dashboard_1';
    return view('auth.verify-email', compact('action'));
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function(EmailVerificationRequest $request) {
    //
	$request->fulfill();
    if (Auth::user()->is_admin == true) {
        return redirect('admin/home');
    }
	return redirect('user/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function(Request $request) {
    //
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::group(['middleware' => 'auth'], function(){
    Route::group([
        'prefix' => 'admin',
        'middleware' => 'is_admin',
        'as' => 'admin.',
    ], function(){
        Route::get('/indigencies/apiauth', 'App\Http\Controllers\Admin\IndigencyController@apiAuth')->name('indigencies.apiauth')->middleware('verified');
        Route::get('/indigencies/checkbalance', 'App\Http\Controllers\Admin\IndigencyController@checkBalance')->name('indigencies.checkbalance')->middleware('verified');
        Route::get('home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home')->middleware('verified');
        Route::get('/indigencies', 'App\Http\Controllers\Admin\IndigencyController@index')->name('indigencies')->middleware('verified');
        Route::get('/indigencies/verifyId/{id}', 'App\Http\Controllers\Admin\IndigencyController@verifyId')->middleware('verified');
        Route::post('/indigencies/verifyIdnum', 'App\Http\Controllers\Admin\IndigencyController@verifyIdNum')->middleware('verified');
        Route::get('/indigencies/verifyIdnum', 'App\Http\Controllers\Admin\IndigencyController@verifyIdNum')->middleware('verified');

        Route::post('/indigencies/verifyIdnumBidder', 'App\Http\Controllers\Admin\IndigencyController@verifyIdnumBidder')->middleware('verified');

        
        Route::get('indigencies/edit/{$id}', 'App\Http\Controllers\Admin\IndigencyController@edit')->name('indigencies.edit');
        Route::get('/indigencies/create', 'App\Http\Controllers\Admin\IndigencyController@create')->name('indigencies.create')->middleware('verified');
        Route::get('/indigencies/show/{id}', 'App\Http\Controllers\Admin\IndigencyController@show')->name('indigencies.show')->middleware('verified');
        Route::post('/indigencies/store', 'App\Http\Controllers\Admin\IndigencyController@store')->name('indigencies.store')->middleware('verified');
        Route::put('/indigencies/confirm/{id}', "App\Http\Controllers\Admin\IndigencyController@confirm")->name("indigencies.confirm")->middleware("verified");
        Route::get('/indigencies/approved', 'App\Http\Controllers\Admin\IndigencyController@viewApproved')->name('indigencies.approved')->middleware('verified');
        Route::get('/indigencies/rejected', 'App\Http\Controllers\Admin\IndigencyController@viewRejected')->name('indigencies.rejected')->middleware('verified');
        Route::get('/indigencies/pending', 'App\Http\Controllers\Admin\IndigencyController@viewPending')->name('indigencies.pending')->middleware('verified');

        Route::get('/personalDetails/create/{id}', 'App\Http\Controllers\Admin\PersonalDetailController@create')->name('personalDetails.create')->middleware('verified');
        Route::post('/personalDetails/store', 'App\Http\Controllers\Admin\PersonalDetailController@store')->name('personalDetails.store')->middleware('verified');
        Route::get('/personalDetails/createPersonalDetails/{id}', 'App\Http\Controllers\Admin\PersonalDetailController@createPersonalDetails')->name('personalDetails.createPersonalDetails')->middleware('verified');
        Route::post('/personalDetails/storePersonalDetails', 'App\Http\Controllers\Admin\PersonalDetailController@storePersonalDetails')->name('personalDetails.storePersonalDetails')->middleware('verified');
        Route::get('/personalDetails/createEmploymentDetails/{id}', 'App\Http\Controllers\Admin\PersonalDetailController@createEmploymentDetails')->name('personalDetails.createEmploymentDetails')->middleware('verified');
        Route::post('/personalDetails/storeEmploymentDetails', 'App\Http\Controllers\Admin\PersonalDetailController@storeEmploymentDetails')->name('personalDetails.storeEmploymentDetails')->middleware('verified');
        Route::get('/personalDetails/editPD/{id}', 'App\Http\Controllers\Admin\PersonalDetailController@editPD')->name('personalDetails.editPD')->middleware('verified');
        Route::get('/personalDetails/editED/{id}', 'App\Http\Controllers\Admin\PersonalDetailController@editED')->name('personalDetails.editED')->middleware('verified');
        Route::get('/personalDetails/update/{id}', 'App\Http\Controllers\Admin\PersonalDetailController@update')->name('personalDetails.update')->middleware('verified');

        Route::get('profiles/index', 'App\Http\Controllers\Admin\ProfileController@index')->name('profiles.index')->middleware('verified');
        Route::get('profiles/create', 'App\Http\Controllers\Admin\ProfileController@create')->name('profiles.create')->middleware('verified');
        Route::post('profiles/store', 'App\Http\Controllers\Admin\ProfileController@store')->name('profiles.store')->middleware('verified');
        Route::get('profiles/show/{id}', 'App\Http\Controllers\Admin\ProfileController@show')->name('profiles.show')->middleware('verified');

        Route::get('/householdIncomes/create/{id}', 'App\Http\Controllers\Admin\HouseholdIncomeController@create')->name('householdIncomes.create')->middleware('verified');
        Route::post('/householdIncomes/store', 'App\Http\Controllers\Admin\HouseholdIncomeController@store')->name('householdIncomes.store')->middleware('verified');

        Route::get('/householdConditions/create/{id}', 'App\Http\Controllers\Admin\HouseholdConditionController@create')->name('householdConditions.create')->middleware('verified');
        Route::post('/householdConditions/store', 'App\Http\Controllers\Admin\HouseholdConditionController@store')->name('householdConditions.store')->middleware('verified');

        Route::get('/documents/create/{id}', 'App\Http\Controllers\Admin\DocumentController@create')->name('documents.create')->middleware('verified');
        Route::post('/documents/store', 'App\Http\Controllers\Admin\DocumentController@store')->name('documents.store')->middleware('verified');
        Route::get('/documents/viewDoc/{id}/{field}', 'App\Http\Controllers\Admin\DocumentController@viewDoc')->name('documents.viewDoc')->middleware('verified');

        Route::get('/approvals/create/{id}', 'App\Http\Controllers\Admin\ApprovalController@create')->name('approvals.create')->middleware('verified');
        Route::post('/approvals/approve', 'App\Http\Controllers\Admin\ApprovalController@approve')->name('approvals.approve')->middleware('verified');

        Route::get('/verification/choose/{id}', 'App\Http\Controllers\Admin\VerificationController@choose')->middleware('verified');
        Route::post('/verification/chosen', 'App\Http\Controllers\Admin\VerificationController@chosen')->middleware('verified');
        Route::get('/verification/manualVerification/{id}', 'App\Http\Controllers\Admin\VerificationController@manualVerification')->middleware('verified');
        Route::get('/verification/autoVerification/{id}', 'App\Http\Controllers\Admin\VerificationController@autoVerification')->middleware('verified');
        Route::post('/verifications/store', 'App\Http\Controllers\Admin\VerificationController@store')->name('verification.store')->middleware('verified');

        Route::get('/verification/bidderVetting', 'App\Http\Controllers\Admin\VerificationController@bidderVetting')->name('verification.bidderVetting')->middleware('verified');

        Route::get('users', 'App\Http\Controllers\Admin\UserController@index')->name('users');
        Route::get('users/create', 'App\Http\Controllers\Admin\UserController@create')->name('users.create');
        Route::post('users/store', 'App\Http\Controllers\Admin\UserController@store')->name('users.store');
        Route::get('users/show/{id}', 'App\Http\Controllers\Admin\UserController@show')->name('users.show');
        Route::get('users/edit/{id}', 'App\Http\Controllers\Admin\UserController@edit')->name('users.edit');
        Route::put('users/update/{id}', 'App\Http\Controllers\Admin\UserController@update')->name('users.update');

        Route::get('tasks/', 'App\Http\Controllers\Admin\TaskController@index')->name('tasks');
        Route::get('tasks/show/{id}', 'App\Http\Controllers\Admin\TaskController@show')->name('tasks.show');
    });

    Route::group([
        'prefix' => 'user',
        'as' => 'user.',
    ], function(){
        Route::get('home', [App\Http\Controllers\User\HomeController::class, 'index'])->name('home')->middleware('verified');

        Route::get('/indigencies/create', 'App\Http\Controllers\User\IndigencyController@create')->name('indigencies.create')->middleware('verified');
        Route::post('/indigencies/store', 'App\Http\Controllers\User\IndigencyController@store')->name('indigencies.store')->middleware('verified');
        Route::get('indigencies/edit/{id}', 'App\Http\Controllers\User\IndigencyController@edit')->name('indigencies.edit')->middleware('verified');
        Route::put('/indigencies/confirm/{id}', "App\Http\Controllers\User\IndigencyController@confirm")->name("indigencies.confirm")->middleware("verified");
        Route::put('indigencies/update/{id}', 'App\Http\Controllers\User\IndigencyController@update')->name('indigencies.update')->middleware('verified');

        Route::get('/personalDetails/create', 'App\Http\Controllers\User\PersonalDetailController@create')->name('personalDetails.create')->middleware('verified');
        Route::post('/personalDetails/store', 'App\Http\Controllers\User\PersonalDetailController@store')->name('personalDetails.store')->middleware('verified');
        Route::get('/personalDetails/createPersonalDetails', 'App\Http\Controllers\User\PersonalDetailController@createPersonalDetails')->name('personalDetails.createPersonalDetails')->middleware('verified');
        Route::post('/personalDetails/storePersonalDetails', 'App\Http\Controllers\User\PersonalDetailController@storePersonalDetails')->name('personalDetails.storePersonalDetails')->middleware('verified');
        Route::get('/personalDetails/createEmploymentDetails', 'App\Http\Controllers\User\PersonalDetailController@createEmploymentDetails')->name('personalDetails.createEmploymentDetails')->middleware('verified');
        Route::post('/personalDetails/storeEmploymentDetails', 'App\Http\Controllers\User\PersonalDetailController@storeEmploymentDetails')->name('personalDetails.storeEmploymentDetails')->middleware('verified');
        Route::get('/personalDetails/editPD/{id}', 'App\Http\Controllers\User\PersonalDetailController@editPD')->name('personalDetails.editPD')->middleware('verified');
        Route::get('/personalDetails/editED/{id}', 'App\Http\Controllers\User\PersonalDetailController@editED')->name('personalDetails.editED')->middleware('verified');
        Route::put('/personalDetails/updatePD/{id}', 'App\Http\Controllers\User\PersonalDetailController@update')->name('personalDetails.updatePD')->middleware('verified');
        Route::put('/personalDetails/updateED/{id}', 'App\Http\Controllers\User\PersonalDetailController@update')->name('personalDetails.updateED')->middleware('verified');

        Route::get('/householdIncomes/create', 'App\Http\Controllers\User\HouseholdIncomeController@create')->name('householdIncomes.create')->middleware('verified');
        Route::post('/householdIncomes/store', 'App\Http\Controllers\User\HouseholdIncomeController@store')->name('householdIncomes.store')->middleware('verified');

        Route::get('/householdConditions/create', 'App\Http\Controllers\User\householdConditionController@create')->name('householdConditions.create')->middleware('verified');
        Route::post('/householdConditions/store', 'App\Http\Controllers\User\householdConditionController@store')->name('householdConditions.store')->middleware('verified');

        Route::get('/documents/create', 'App\Http\Controllers\User\DocumentController@create')->name('documents.create');
        Route::post('/documents/store', 'App\Http\Controllers\User\DocumentController@store')->name('documents.store');
    });
});
