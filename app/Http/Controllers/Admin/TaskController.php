<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /*
    * To display a list of all tasks.
    *
    */
    public function index(){
    	$page_title = 'Profile';
        $action = 'dashboard_1';

        $user = Auth::user();

        $profile = $user->profile;

    	$tasks = Task::join('users', 'tasks.user_id', '=', 'users.id')->join('profiles', 'profiles.user_id', '=', 'users.id')->get(['tasks.id', 'tasks.name', 'tasks.target', 'tasks.is_completed', 'users.email', 'users.role_id', 'profiles.fname', 'profiles.lname']);

    	return view('admin.tasks.index', compact('page_title', 'action', 'tasks', 'profile'));
    }

    /*
    * To view an individual task and pertinent information.
    *
    */

    public function show($id){
        $page_title = 'Profile';
        $action = 'dashboard_1';

        $user = Auth::user();

        $profile = $user->profile;

        $task = Task::find($id);

        return view('admin.tasks.show', compact('page_title', 'action', 'profile', 'task'));
    }
}
