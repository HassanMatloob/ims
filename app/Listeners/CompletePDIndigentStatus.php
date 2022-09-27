<?php

namespace App\Listeners;

use App\Events\PersonalDetailGiven;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Indigency;
use App\User;

class CompletePDIndigentStatus
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
     * @param  \App\Events\PersonalDetailGiven  $event
     * @return void
     */
    public function handle(PersonalDetailGiven $event)
    {
        $indigent = Indigency::find( $event->personalDetail->indigency_id );

        $householdInfo = $indigent->householdCondition;
        $docs = $indigent->document;

        if ( isset($householdInfo) && isset($docs) ) {
            $indigent->status = "Completed";
            $indigent->save();
        }

    }
}
