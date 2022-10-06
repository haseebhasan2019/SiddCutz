<?php
//Send text message to client
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;
include 'information.php';

// Include config file + information
require_once "config.php";

// Get time and date of appointment
$id=$_GET['rn'];
$getTimeAndDate = mysqli_query($link, "SELECT `time`, `date`, `number`  from appointment where `id` = $id");
while ($row = mysqli_fetch_array($getTimeAndDate)) {
    $time = $row['time'];
    $date = $row['date'];
    $number = $row['number'];
}

// Change availability to available in database based on id of appointment
$sql = "UPDATE `availability` SET `$time`='1' WHERE `date`='$date';";
echo $sql;
if ($link->query($sql) === TRUE)  {
    echo "Successfully updated availability. ";
    //Delete appointment
    $query = "DELETE FROM appointment where id='$id'";
    $data=mysqli_query($link, $query);
    if ($data) {
        echo "Record deleted from database."; //convert to alert?
        header('Location: admin.php');

        // //Message to Client
        // $message = 'Your appointment on ' . $date . ' at ' . $time . ' has been cancelled.';
        // $client = new Client($account_sid, $auth_token);
        // $client->messages->create(
        //     // Where to send a text message (your cell phone?)
        //     $number,
        //     array(
        //         'from' => $twilio_number,
        //         'body' => $message
        //     )
        // );

        // echo '<script>alert("Successfully deleted appointment - the client will receive a text update");</script>';
    } else {
        echo "Failed to delete record from database.";
    }
} else {
    echo "Error updating availability: " . $link->error;
}
?>