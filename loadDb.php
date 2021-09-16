<?php
    $con=mysqli_connect("localhost","root","","siddcutz");
    // Check connection
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $result = mysqli_query($con,"SELECT * FROM appointment WHERE DATE(date) >= CURDATE();");
?>
<!DOCTYPE html>
<style>
    body{
        text-align: center;
    }
</style>
<html>
    <title>
        <head>Fetch Data from Database</head>
    </title>
    <body>
        <table align="center" border="1px" style="width:600px; line-height:40px;">
            <tr>
                <th colspan="7"><h2>Appointments</h2></th>
            </tr>
            <t>
                <th>Name</th>
                <th>Number</th>
                <th>Service</th>
                <th>Location</th>
                <th>Date</th>
                <th>Time</th>
                <th>Delete</th>
            </t>
            <?php
                while($row = mysqli_fetch_array($result))
                {
            ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['number']; ?></td>
                        <td><?php echo $row['service']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['time']; ?></td>
                        <td><a href='delete.php?rn=$result[id]'>X</td>
                    </tr>
            <?php
                }
                mysqli_close($con);
            ?>
        </table>
    </body>
</html>    