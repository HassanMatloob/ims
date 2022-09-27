<?php

namespace App\Listeners;

use App\Models\Approval;
use App\Indigency;
use App\Events\ApplicationApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ApproveIndigentStatus
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
     * @param  \App\Events\ApplicationApproved  $event
     * @return void
     */
    public function handle(ApplicationApproved $event)
    {
        $indigent = Indigency::find($event->appr->indigency_id);

        $indigent->status = $event->appr->verdict;
        $indigent->save();
    }
}
