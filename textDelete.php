<?php

require_once 'vendor/autoload.php'; // Loads the library
use Twilio\TwiML\MessagingResponse;

$response = new MessagingResponse();
$response->message("The Robots are coming! Head for the hills!");
print $response;

/*
require_once 'vendor/autoload.php'; // Loads the library
use Twilio\TwiML\MessagingResponse;
$response = new MessagingResponse();
$body = $_REQUEST['body'];
$from = $_REQUEST['from'];
$default = "If you would like to cancel your most recent appointment, type 'CANCEL'";
$cancel = "Successfully cancelled appointment from " . $from . ".";

if (strtolower($body) == 'cancel aptmt') {
    //Delete from database using phone number - how to get it
    //Text Shaheer to check Dashboard
    $response->message($cancel);
} else {
    $response->message($default);
}
echo "Body is: " . $body;
print $response;

*/
?>