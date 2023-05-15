<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content,$subject,$app_name)
    {
        $this->content = $content;
        $this->subject = $subject;
        $this->app_name = $app_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))->subject('('.$this->app_name.')'.$this->subject)
        ->view('send_mail')->with([
            'content' => $this->content,
        ]);
    }
}
