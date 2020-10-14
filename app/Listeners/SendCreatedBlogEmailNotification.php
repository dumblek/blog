<?php

namespace App\Listeners;

use App\Events\BlogCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\BlogCreatedMail;
use App\Mail\BlogCreatedEditorMail;
use Mail;

class SendCreatedBlogEmailNotification implements ShouldQueue
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
     * @param  BlogCreatedEvent  $event
     * @return void
     */
    public function handle(BlogCreatedEvent $event)
    {
        Mail::to($event->user)->send(new BlogCreatedMail($event->user, $event->blog));
        Mail::to('editor@example.com')->send(new BlogCreatedEditorMail($event->user, $event->blog));
    }
}
