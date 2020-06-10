<?php

namespace App\Listeners;

use App\Events\CreateStaff;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use App\Mail\NewStaff;

class NewStaffEmail
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
     * @param  CreateStaff  $event
     * @return void
     */
    public function handle(CreateStaff $event)
    {
        Mail::to($event->staff->email)->send(new NewStaff($event->staff));
    }
}
