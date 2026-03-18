<?php

    namespace App\Mail;

    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Mail\Mailable;
    use Illuminate\Mail\Mailables\Content;
    use Illuminate\Mail\Mailables\Envelope;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Mail\Mailables\Address;

    class ContactMail extends Mailable
    {
        use Queueable, SerializesModels;


        public $senderEmail;
        public $subject;
        public $message;
        public $senderName;

        public function __construct($senderEmail, $subject, $message, $senderName = null)
        {
            $this->senderEmail = $senderEmail;
            $this->subject = $subject;
            $this->message = $message;
            $this->senderName = $senderName ?? $senderEmail;
        }

        /**
         * Get the message envelope.
         */
   public function envelope(): Envelope
{
    return new Envelope(
        subject: $this->subject,

    );
}

/*
from:	Ananta Poudyal <anantapoudyal24@gmail.com>
reply-to:	Ananta Poudyal <anantapoudyal3015@gmail.com>
to:	anantapoudyal24@gmail.com
date:	Dec 4, 2025, 6:43 PM
subject:	Contact Form Submission
mailed-by:	gmail.com
*/

        /**
         * Get the message content definition.
         */
        public function content(): Content
        {
            return new Content(
                view: 'mail.Contact.index',
                with: [
                    'messageBody' => $this->message,
                    'senderName' => $this->senderName,
                    'senderEmail' => $this->senderEmail,

                ],

            );
        }



        /**
         * Get the attachments for the message.
         *
         * @return array<int, \Illuminate\Mail\Mailables\Attachment>
         */
        public function attachments(): array
        {
            return [];
        }
    }
