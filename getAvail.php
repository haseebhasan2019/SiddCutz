<?php
    $con=mysqli_connect("localhost","root","","siddcutz");
    // Check connection
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {
        $date = $_GET['date'];
        // echo "Date is $date";

        $availability = mysqli_query($con, "SELECT * FROM availability WHERE date = '$date'");
        // -- BETWEEN CURDATE() AND CURDATE()+7 ORDER BY date");
        while ($row = $availability->fetch_assoc()) {
            echo $row['8am'];
            echo $row['9am'];
            echo $row['10am'];
            echo $row['11am'];
            echo $row['12pm'];
            echo $row['1pm'];
            echo $row['2pm'];
            echo $row['3pm'];
            echo $row['4pm'];
            echo $row['5pm'];
            echo $row['6pm'];
            echo $row['7pm'];
            echo $row['8pm'];
        }
    }

?>
