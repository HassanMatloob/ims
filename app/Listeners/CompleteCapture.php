<?php

namespace App\Listeners;

use App\Events\ApplicationConfirmed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Indigency;
use App\Models\Task;


class CompleteCapture
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
     * @param  \App\Events\ApplicationConfirmed  $event
     * @return void
     */
    public function handle(ApplicationConfirmed $event)
    {
        $task = Task::where('target', $event->indigent->id)->get();

        $task[0]->is_completed = true;
        $task[0]->save();
    }
}
