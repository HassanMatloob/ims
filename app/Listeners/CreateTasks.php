<?php

namespace App\Listeners;

use App\Events\NewApplication;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use App\Indigency;
use App\User;
use App\Models\Task;

class CreateTasks
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewApplication  $event
     * @return void
     */
    public function handle(NewApplication $event)
    {
        $task1 = new Task;
        $task1->name = "Capture";
        $task1->user_id = Auth::user()->id;
        $task1->target = $event->indigent->id;
        $task1->is_completed = false;
        $task1->save();

        $task2 = new Task;
        $task2->name = "Approval";
        $task2->user_id = Auth::user()->id;
        $task2->target = $event->indigent->id;
        $task2->is_completed =$event->indigent->id;
        $task2->save();
    }
}
