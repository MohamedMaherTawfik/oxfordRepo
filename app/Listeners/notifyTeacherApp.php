<?php

namespace App\Listeners;

use App\Events\notifyTeacher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class notifyTeacherApp
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(notifyTeacher $event): void
    {
        dd($event->user);
        Mail::to($event->user)->send(new \App\Mail\notifyTeacher($event->user));
    }
}
