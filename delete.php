<?php
    $con=mysqli_connect("localhost","root","","siddcutz");
    // Check connection
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $id=$_GET['rn'];
    $query = "DELETE FROM appointment where id='$id'";
    $data=mysqli_query($con, $query);
    if ($data)
    {
        echo "Record deleted from database.";
    }
    else
    {
        echo "Failed to delete record from database.";
    }
?>