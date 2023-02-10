<?php
// Require the bundled autoload file - the path may need to change
// based on where you downloaded and unzipped the SDK
require __DIR__ . '/lib/twilio-php-main/src/Twilio/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$sid = 'ACfe75ccd30c190b8b84dac80cc6af03cf';
$token = 'e9b5f8b52565793b383ade98f3163ea1';
$client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!
$client->messages->create(
    // the number you'd like to send the message to
    '+573213411415',
    [
        // A Twilio phone number you purchased at twilio.com/console
        'from' => '+15392164621',
        // the body of the text message you'd like to send
        'body' => "Hola Jonathan, este es un mensaje de prueba"
    ]
);