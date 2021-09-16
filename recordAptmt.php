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
        //Change availability
        // $sql = "UPDATE `availability` SET `$time`='2' WHERE `date`='$date'";
        // if ($conn->query($sql) === TRUE) {
        //     echo "Successfully updated availability. ";
        //   } else {
        //     echo "Error updating availability: " . $conn->error;
        //   }


        $stmt = $conn->prepare("insert into appointment(name, number, service, location, date, time)
        values(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissss", $name, $number, $service, $location, $date, $time);
        $stmt->execute();
        // echo "Appointment recorded";
        $stmt->close();
        $conn->close();
        // header('Location: aptmt.php');
        echo '<script>alert("Successfully recorded appointment! Check your email for confirmation.");</script>';
        echo '<html><body><a href="index.html">Home</a></body></html>'
   ;
    }
?>
<Script>
    //Alert saying aptmt recorded successful
    function success() {
        alert("Successfully recorded appointment! Check your email for confirmation.");
    }
</Script>