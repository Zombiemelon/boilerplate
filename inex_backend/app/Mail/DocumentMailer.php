<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DocumentMailer extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var string
     */
    private $filename;

    /**
     * DocumentMailer constructor.
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('documents@inex.com')
            ->view('/documents/document');
    }
}
