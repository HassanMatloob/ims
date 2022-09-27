<?php

namespace App\Listeners;

use App\Events\DocumentsUploaded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Indigency;

class CompleteDocsIndigentStatus
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
     * @param  \App\Events\DocumentsUploaded  $event
     * @return void
     */
    public function handle(DocumentsUploaded $event)
    {
        $indigent = Indigency::find( $event->docs->indigency_id );

        $pd = $indigent->personalDetail;
        $household = $indigent->householdCondition;

        if ( isset($pd) && isset($household) ) {
            $indigent->status = "Completed";
            $indigent->save();
        }
    }
}
