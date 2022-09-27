<?php

namespace App\Listeners;

use App\Events\HouseProvided;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Indigency;

class CompleteHouseIndigentStatus
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
    public function handle(HouseProvided $event)
    {
        $indigent = Indigency::find( $event->household->indigency_id );

        $pd = $indigent->personalDetail;
        $docs = $indigent->document;

        if ( isset($pd) && isset($docs) ) {
            $indigent->status = "Completed";
            $indigent->save();
        }
    }
}
