<?php
    $name = $_POST['name'];
    $number = $_POST['number'];
    $service = $_POST['service'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    //Database connection
    $conn = new mysqli('localhost', 'root', '', 'siddcutz');
    if ($conn->connect_error){
        echo "$conn->connect_error";
        die('Connection Failed : ' .$conn->connect_error);
    } else {
        // Change availability to appointment in database
        $sql = "UPDATE `availability` SET `$time`='2' WHERE `date`='$date'";
        if ($conn->query($sql) !== TRUE) {
            echo "Error updating availability: " . $conn->error;
          }

        $stmt = $conn->prepare("insert into appointment(name, number, service, location, date, time)
        values(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissss", $name, $number, $service, $location, $date, $time);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header('Location: confirmation.html');
    }
/*
    //Send text message to client AND Shaheer
        require __DIR__ . '/vendor/autoload.php';
        use Twilio\Rest\Client;
        include 'information.php';

        //Message to Client
        $message = 'Successfully booked appointment on ' . $date . ' at ' . $time . '!';
        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            // Where to send a text message (your cell phone?)
            $number,
            array(
                'from' => $twilio_number,
                'body' => $message
            )
        );

        //Message to Shaheer
        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            // Where to send a text message (your cell phone?)
            $number, //$admin_number
            array(
                'from' => $twilio_number,
                'body' => 'New appointment, check dashboard!'
            )
        );
        //Error handling for incorrect number?
*/
?>