<?php
    $con=mysqli_connect("localhost","root","","siddcutz");
    // Check connection
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $id=$_GET['rn'];
    echo $id;
    $query = "DELETE FROM appointment where id='$id'";
    $data=mysqli_query($con, $query);
    if ($data)
    {
        //echo "Record deleted from database."; - convert to alert?
        // Change availability to available in database based on id of appointment
        $getTime = mysqli_query($con, "SELECT `time` from appointment where `id` = $id;");
        if($row = mysqli_fetch_array($getTime))
        {
            $time = $row['time'];
        }
        $sql = "UPDATE `availability` SET `$time`='1' WHERE `date`=(SELECT `date` from appointment where `id` = $id;)";
        if ($con->query($sql) === TRUE) {
            // echo "Successfully updated availability. ";
            header('Location: admin.php');
          } else {
            echo "Error updating availability: " . $conn->error;
          }
    }
    else
    {
        echo "Failed to delete record from database.";
    }
?>