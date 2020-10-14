<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Blog;

class BlogCreatedEditorMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user, $blog;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $blog)
    {
        $this->user = $user;
        $this->blog = $blog;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('example@example.com')
                    ->view('send_email_blog_created_to_editor')
                    ->with([
                        'nama' => $this->user->name,
                        'judul' => $this->blog->title,
                    ]);
    }
}
