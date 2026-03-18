<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use App\Mail\ContactMail;
use illuminate\Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Log as FacadesLog;

class MailController extends Controller
{
    public function sendEmail($senderEmail, $subject = null, $message = null, $senderName = null)
{
    try {
        // Send message to owner
        $m = Mail::to("anantapoudyal24@gmail.com")
            ->send(new ContactMail($senderEmail, $subject, $message, $senderName));
// dd("Email sent to owner successfully.", $senderEmail, $subject, $message, $senderName, $m);
FacadesLog::info("Email sent to owner successfully.", ['senderEmail' => $senderEmail, 'subject' => $subject, 'message' => $message, 'senderName' => $senderName, 'mailResult' => $m]);
        // // Send confirmation to user
        // $confirmationMessage = "Your message has been received. We will get back to you shortly."
        // . "\nSender Email: $senderEmail"
        // ."\nSender Name: $senderName"
        // . "\nSubject: $subject"
        // . "\nMessage: $message"
        // ."\n\nThank you for contacting us!";

        // Mail::to("anantapoudyal24@gmail.com")
        // ->send(new ContactMail($senderEmail, "Confirmation: We received your message", $confirmationMessage, $senderName));
        // dd($senderEmail, $subject, $message, $senderName);

        return response()->json(['message' => 'Emails sent successfully.']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to send emails.'], 500);
    }
}

    }
