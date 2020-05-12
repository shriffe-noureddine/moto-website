<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
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
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        /*
        $this->withSwiftMessage(function ($message) {
            $message->getHeaders()
                ->addTextHeader('Custom-Header', 'HeaderValue');
        });
        */

        // Mail::to(MailableObject with email and name properties);

        
        return $this->from('marc@marcsmotorcycles.com')
            ->view('emails.standard_mail')
            ->text('emails.standard_mail_plain')
            ->with([
                'test' => 'testing',
                'someobject' => 'object',
            ]);
    }
}
