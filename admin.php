<?php
    $con=mysqli_connect("localhost","root","","siddcutz");
    // Check connection
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $result = mysqli_query($con,"SELECT * FROM appointment WHERE DATE(date) >= CURDATE() ORDER BY date;");
    $availability = mysqli_query($con, "SELECT * FROM availability WHERE date BETWEEN CURDATE() AND CURDATE()+14 ORDER BY date");
?>
<!DOCTYPE html>
<style>
    body{
        text-align: center;
    }
    .green {
        background-color: rgb(51, 255, 51);
    }
    .yellow {
        background-color: rgb(255, 153, 51);
    }
    .red {
        background-color: rgb(255, 51, 51);
    }
</style>
<html>
    <head>
        <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
    </head>
    <div class="topnav">
        <a href="index.html">Home</a>
        <div class="topnav-right">
          <a class="active">Admin Portal</a>
        </div>
    </div>    
    <h1>Welcome to Admin Portal</h1>
    <!-- <form action="http://localhost/loadDb.php" method="get">
        <input type="submit" value="my button"/>
      </form> -->
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
                // mysqli_close($con);
            ?>
        </table>
        <br>
        <form action="http://localhost/SiddCutz/recordAvail.php" method="post" style="text-align: center;">
            <table align="center" border="1px">
                <tr>
                    <th colspan="13"><h2>Select Availability</h2></th>
                </tr>
                <tr>
                    <td>Day</td>
                    <td>9:00am</td>
                    <td>10:00am</td>
                    <td>11:00am</td>
                    <td>12:00pm</td>
                    <td>1:00pm</td>
                    <td>2:00pm</td>
                    <td>3:00pm</td>
                    <td>4:00pm</td>
                    <td>5:00pm</td>
                    <td>6:00pm</td>
                    <td>7:00pm</td>
                    <td>8:00pm</td>
                </tr>
                <tr>
                    <td><input type="date" name="date" onselect=<?php echo "hi" ?>></td>
                    <td><input type="checkbox" name="9am" value="1"></td>
                    <td><input type="checkbox" name="10am" value="1"></td>
                    <td><input type="checkbox" name="11am" value="1"></td>
                    <td><input type="checkbox" name="12pm" value="1"></td>
                    <td><input type="checkbox" name="1pm" value="1"></td>
                    <td><input type="checkbox" name="2pm" value="1"></td>
                    <td><input type="checkbox" name="3pm" value="1"></td>
                    <td><input type="checkbox" name="4pm" value="1"></td>
                    <td><input type="checkbox" name="5pm" value="1"></td>
                    <td><input type="checkbox" name="6pm" value="1"></td>
                    <td><input type="checkbox" name="7pm" value="1"></td>
                    <td><input type="checkbox" name="8pm" value="1"></td>
            </table>
            <input type="submit">
        </form>
        <br>

        <table align="center" border="1px">
            <tr>
                <th colspan="13"><h2>Availability</h2></th>
            </tr>
            <tr>
                <td>Date</td>
                <td>9:00am</td>
                <td>10:00am</td>
                <td>11:00am</td>
                <td>12:00pm</td>
                <td>1:00pm</td>
                <td>2:00pm</td>
                <td>3:00pm</td>
                <td>4:00pm</td>
                <td>5:00pm</td>
                <td>6:00pm</td>
                <td>7:00pm</td>
                <td>8:00pm</td>
            </tr>
            <?php
                while($row = mysqli_fetch_array($availability))
                {
            ?>
                    <tr>
                        <td><?php echo $row['date']; ?></td>
                        <?php
                        // $emparray[] = $row;
                        // $y = json_encode($emparray);
                            // foreach ($row as $key) {
                            //     echo "<script>console.log($key);</script>";

                                // $output = "";
                                // if ($value == "2") {
                                //     $output = "Apt";
                                // }
                                // elseif ($value == "1") {
                                //     $output = "X";
                                // }
                                // echo "<td>$output</td>";
                                
                            // }
                        ?>
                        

                        <?php if ($row['9am'] == "2") {echo "<td class='green'></td>";} elseif ($row['9am'] == "1") echo "<td class='yellow'></td>"; else echo "<td class='red'></td>"?>
                        <?php if ($row['10am'] == "2") {echo "<td class='green'></td>";} elseif ($row['10am'] == "1") echo "<td class='yellow'></td>"; else echo "<td class='red'></td>"?>
                        <?php if ($row['11am'] == "2") {echo "<td class='green'></td>";} elseif ($row['11am'] == "1") echo "<td class='yellow'></td>"; else echo "<td class='red'></td>"?>
                        <?php if ($row['12pm'] == "2") {echo "<td class='green'></td>";} elseif ($row['12pm'] == "1") echo "<td class='yellow'></td>"; else echo "<td class='red'></td>"?>
                        <?php if ($row['1pm'] == "2") {echo "<td class='green'></td>";} elseif ($row['1pm'] == "1") echo "<td class='yellow'></td>"; else echo "<td class='red'></td>"?>
                        <?php if ($row['2pm'] == "2") {echo "<td class='green'></td>";} elseif ($row['2pm'] == "1") echo "<td class='yellow'></td>"; else echo "<td class='red'></td>"?>
                        <?php if ($row['3pm'] == "2") {echo "<td class='green'></td>";} elseif ($row['3pm'] == "1") echo "<td class='yellow'></td>"; else echo "<td class='red'></td>"?>
                        <?php if ($row['4pm'] == "2") {echo "<td class='green'></td>";} elseif ($row['4pm'] == "1") echo "<td class='yellow'></td>"; else echo "<td class='red'></td>"?>
                        <?php if ($row['5pm'] == "2") {echo "<td class='green'></td>";} elseif ($row['5pm'] == "1") echo "<td class='yellow'></td>"; else echo "<td class='red'></td>"?>
                        <?php if ($row['6pm'] == "2") {echo "<td class='green'></td>";} elseif ($row['6pm'] == "1") echo "<td class='yellow'></td>"; else echo "<td class='red'></td>"?>
                        <?php if ($row['7pm'] == "2") {echo "<td class='green'></td>";} elseif ($row['7pm'] == "1") echo "<td class='yellow'></td>"; else echo "<td class='red'></td>"?>
                        <?php if ($row['8pm'] == "2") {echo "<td class='green'></td>";} elseif ($row['8pm'] == "1") echo "<td class='yellow'></td>"; else echo "<td class='red'></td>"?>

                    </tr>
            <?php
                }
                mysqli_close($con);
            ?>
        </table>
        <br>


        <!-- <table align="center" border="1px">
            <tr>
                <th colspan="13"><h2>Availability</h2></th>
            </tr>
            <tr>
                <th></th>
                <td>9:00am</td>
                <td>10:00am</td>
                <td>11:00am</td>
                <td>12:00pm</td>
                <td>1:00pm</td>
                <td>2:00pm</td>
                <td>3:00pm</td>
                <td>4:00pm</td>
                <td>5:00pm</td>
                <td>6:00pm</td>
                <td>7:00pm</td>
                <td>8:00pm</td>
            </tr>
            <tr>
                <td>Monday</td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
            </tr>
            <tr>
                <td>Tuesday</td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
            </tr>
            <tr>
                <td>Wednesday</td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
            </tr>
            <tr>
                <td>Thursday</td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
            </tr>
            <tr>
                <td>Friday</td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
            </tr>
            <tr>
                <td>Saturday</td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
            </tr>
            <tr>
                <td>Sunday</td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
                <td><input type="checkbox" id="check" name="check" value="check"></td>
            </tr>
        </table> -->

</html>
