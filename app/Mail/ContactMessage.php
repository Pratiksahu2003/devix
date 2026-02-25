<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $name,
        public string $email,
        public ?string $phone,
        public ?string $company,
        public string $messageText,
    ) {}

    public function build(): self
    {
        return $this->subject('New studio enquiry from ' . $this->name)
            ->replyTo($this->email, $this->name)
            ->view('mail.contact');
    }
}

