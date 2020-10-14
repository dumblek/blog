<?php

namespace App\Listeners;

use App\Events\BlogPublishedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\BlogPublishedMail;
use Mail;

class SendPublishedBlogEmailNotification implements ShouldQueue
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
     * @param  BlogPublishedEvent  $event
     * @return void
     */
    public function handle(BlogPublishedEvent $event)
    {
        Mail::to($event->user)->send(new BlogPublishedMail($event->user, $event->blog));
    }
}
