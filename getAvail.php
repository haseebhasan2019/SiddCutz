<?php
    $con=mysqli_connect("localhost","root","","siddcutz");
    // Check connection
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {
        $availability = mysqli_query($con, "SELECT * FROM availability WHERE date BETWEEN CURDATE() AND CURDATE()+7 ORDER BY date");
        return $availability;
    }

?>
