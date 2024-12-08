<?php

namespace App\Http\Controllers;

use Aws\Sns\SnsClient;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function send(Request $request)
    {
        // Validate the request inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Get form data
        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        // Initialize SNS Client
        $sns = new SnsClient([
            'version' => 'latest',
            'region' => config('services.sns.region'),
            'credentials' => [
                'key' => config('services.sns.key'),
                'secret' => config('services.sns.secret'),
            ],
        ]);

        try {
            // Publish the message to SNS
            $sns->publish([
                'TopicArn' => config('services.sns.topic_arn'),
                'Message' => "Name: $name\nEmail: $email\nMessage: $message",
                'Subject' => 'New Contact Form Submission',
            ]);

            return back()->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send your message. Please try again.');
        }
    }
}
