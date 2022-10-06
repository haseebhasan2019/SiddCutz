<?php
session_start();
if(!isset( $_SESSION['logged_in']) || empty($_SESSION['logged_in']) || $_SESSION['logged_in']==false) {
    header("location: login.php");
    exit;
}
// Include config file
require_once "config.php";

$result = mysqli_query($link,"SELECT * FROM appointment WHERE DATE(date) >= CURDATE() ORDER BY date, 
CASE when time = '8am' then '1' when time = '9am' then '2' when time = '10am' then '3' when time = '11am' 
then '4' when time = '12pm' then '5' when time = '1pm' then '6' when time = '2pm' then '7' when time = '3pm' 
then '8' when time = '4pm' then '9' when time = '5pm' then '10' when time = '6pm' then '11' when time = '7pm' 
then '12' when time = '8pm' then '13' ELSE time END ASC;");
$availability = mysqli_query($link, "SELECT * FROM availability WHERE date >= CURDATE() ORDER BY date;");
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
        <!-- <link rel="stylesheet" href="styles.css"> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <meta charset="utf-8">
    </head>
    <body>
        <!-- Nav bar -->
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="index.html">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled">Create Account</a>
            </li>
        </ul>
        <h1 style="text-align: center;">Welcome to Admin Portal</h1>
        <!-- Appointments Table -->
        <table class="table table-bordered" align="center" border="1px" style="width:1000px; line-height:40px; text-align: center;">
            <tr>
                <th colspan="8"><h2>Appointments</h2></th>
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
                        <td><a href='delete.php?rn=<?php echo $row['id']?>'>X</td>
                    </tr>
            <?php
                }
                // mysqli_close($con);
            ?>
        </table>
        <br>

        <!-- Record Availability Form -->
        <form action="recordAvail.php" method="post" style="text-align: center;">
            <table class="table table-bordered" align="center" border="1px">
                <tr>
                    <th colspan="15"><h2>Select Availability</h2></th>
                </tr>
                <tr>
                    <td>Day</td>
                    <td>8:00am</td>
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
                    <td></td>
                </tr>
                <tr>
                    <td><input type="date" id="date" name="date" onchange="onDateChange(value)" required></td>
                    <td><input type="checkbox" id="8am" name="8am" value="1"></td>
                    <td><input type="checkbox" id="9am" name="9am" value="1"></td>
                    <td><input type="checkbox" id="10am" name="10am" value="1"></td>
                    <td><input type="checkbox" id="11am" name="11am" value="1"></td>
                    <td><input type="checkbox" id="12pm" name="12pm" value="1"></td>
                    <td><input type="checkbox" id="1pm" name="1pm" value="1"></td>
                    <td><input type="checkbox" id="2pm" name="2pm" value="1"></td>
                    <td><input type="checkbox" id="3pm" name="3pm" value="1"></td>
                    <td><input type="checkbox" id="4pm" name="4pm" value="1"></td>
                    <td><input type="checkbox" id="5pm" name="5pm" value="1"></td>
                    <td><input type="checkbox" id="6pm" name="6pm" value="1"></td>
                    <td><input type="checkbox" id="7pm" name="7pm" value="1"></td>
                    <td><input type="checkbox" id="8pm" name="8pm" value="1"></td>
                    <td><input type="button" value="Default" onClick="return defaultAvailability()"></td>
            </table>
            <input type="submit">
        </form>
        <br>

        <!-- Availability Table -->
        <table class="table table-bordered" align="center" border="1px" style="text-align: center;">
            <tr>
                <th colspan="14"><h2>Availability</h2></th>
            </tr>
            <tr>
                <td>Date</td>
                <td>8:00am</td>
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
                            $times = array("8am", "9am", "10am", "11am", "12pm", "1pm", "2pm", "3pm", "4pm", "5pm", "6pm", "7pm", "8pm");
                            foreach ($times as $time)
                            {
                                if ($row[$time] == "2") 
                                    {echo "<td style='background-color: rgb(51, 255, 51);'></td>";} 
                                elseif ($row[$time] == "1") 
                                    {echo "<td style='background-color: rgb(255, 153, 51);'></td>";}
                                else 
                                    {echo "<td style='background-color: rgb(255, 51, 51);'></td>";}
                            }
                        ?>
                    </tr>
            <?php
                }
                mysqli_close($link);
            ?>
        </table>
        <br>
    </body>
</html>
<script>
    const times = ["8am", "9am", "10am", "11am", "12pm", "1pm", "2pm", "3pm", "4pm", "5pm", "6pm", "7pm", "8pm"];
    function defaultAvailability() {
        let date = document.getElementById("date").value;
        if (date == null || date == "") {
            alert("Select Date");
            return false;
        }
        const dayOfWeek = (new Date(date)).getDay();
        const avail = new Map();
        avail.set(0, ["8am", "9am", "10am", "11am"]);
        avail.set(1, ["8am", "9am", "10am", "11am"]);
        avail.set(2, ["8am", "9am", "10am", "11am"]);
        avail.set(3, ["8am", "9am", "10am", "11am"]);
        avail.set(4, ["8am", "9am", "10am", "11am"]);
        avail.set(5, ["10am", "11am", "12pm", "1pm", "2pm", "3pm", "4pm", "5pm", "6pm", "7pm", "8pm"]);
        avail.set(6, ["10am", "11am", "12pm", "1pm", "2pm", "3pm", "4pm", "5pm", "6pm", "7pm", "8pm"]);
        
        times.forEach(time => document.getElementById(time).checked = false);
        avail.get(dayOfWeek).forEach(time => document.getElementById(time).checked = true);

        return true;
    }
    function onDateChange(val) {
        times.forEach(time => document.getElementById(time).checked = false);
    }
</script>