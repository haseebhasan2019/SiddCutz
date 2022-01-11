<?php
    $con=mysqli_connect("localhost","root","","siddcutz");
    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
        // Get time of appointment
        $id=$_GET['rn'];
        echo $id;
        $time = "none";
        $getTime = mysqli_query($con, "SELECT `time` from appointment where `id` = $id");
        while ($row = mysqli_fetch_array($getTime)) {
            $time = $row['time'];
        }
        echo $time;

        // Change availability to available in database based on id of appointment
        $sql = "UPDATE `availability` SET `$time`='1' WHERE `date`=(SELECT `date` from appointment where `id` = $id);";
        echo $sql;
        if ($con->query($sql) === TRUE)  {
            echo "Successfully updated availability. ";
            //Delete appointment
            $query = "DELETE FROM appointment where id='$id'";
            $data=mysqli_query($con, $query);
            if ($data) {
                echo "Record deleted from database."; //convert to alert?
                header('Location: admin.php');
            } else {
                echo "Failed to delete record from database.";
            }
        } else {
            echo "Error updating availability: " . $con->error;
        }
    }
?>