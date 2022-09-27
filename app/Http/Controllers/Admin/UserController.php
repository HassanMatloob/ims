<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('superuser', Auth::user())) {
            abort(403);
        }
        $page_title = 'Users';
        $action = 'patient_list';
        $users = User::all();
        return view("admin.users.index", compact('page_title', 'action', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('superuser', Auth::user())) {
            abort(403);
        }
        $page_title = 'Users';
        $action = 'patient_list';

        return view("admin.users.create", compact('page_title', 'action'));
    }

    /**
    * Store a user record in users table
    *
    * @param Request $request
    * @return \Illuminate\Http\Response
    */

    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required | string | email | max:255 | unique:users',
            'password' => 'required | string | min:8 | confirmed',
            'admin_status' => 'required',
            'position' => 'required'
        ]);

        $user = new User;
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->is_admin = true;
        $user->role_id = $request->input('position');
        $user->save();

        return redirect()->route('admin.users')->with('success', 'New user created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('superuser', Auth::user())) {
            abort(403);
        }
        $user = User::findOrFail($id);
        $page_title = 'Users';
        $action = 'patient_list';
        return view("admin.users.show", compact('page_title', 'action', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('superuser', Auth::user())) {
            abort(403);
        }
        $user = User::findOrFail($id);
        $page_title = 'Users';
        $action = 'patient_list';

        return view("admin.users.edit", compact('page_title', 'action', 'user'));
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
        if (!Gate::allows('superuser', Auth::user())) {
            abort(403);
        }
        $this->validate($request, ['position' => 'required']);

        $user = User::findOrFail($id);

        $user->role_id = $request->input('position');
        $user->save();

        return redirect()->route("admin.users")->with('success', "User role changed!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('superuser', Auth::user())) {
            abort(403);
        }
        //
    }
}
