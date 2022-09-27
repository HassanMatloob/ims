<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Events\ApplicationApproved;
use App\Events\PersonalDetailGiven;
use App\Events\HouseProvided;
use App\Events\DocumentsUploaded;
use App\Events\NewApplication;
use App\Events\ApplicationConfirmed;
use App\Listeners\ApproveIndigentStatus;
use App\Listeners\CompletePDIndigentStatus;
use App\Listeners\CompleteHouseIndigentStatus;
use App\Listeners\CompleteDocsIndigentStatus;
use App\Listeners\CreateTasks;
use App\Listeners\CompleteCapture;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [SendEmailVerificationNotification::class,],
        PersonalDetailGiven::class => [CompletePDIndigentStatus::class],
        HouseProvided::class => [CompleteHouseIndigentStatus::class],
        DocumentsUploaded::class => [CompleteDocsIndigentStatus::class],
        ApplicationApproved::class => [ApproveIndigentStatus::class],
        NewApplication::class => [CreateTasks::class],
        ApplicationConfirmed::class => [CompleteCapture::class],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
