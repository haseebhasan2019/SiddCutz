<?php
$date = $_POST['date'];
$_8am = $_POST['8am'] ?? 0;
$_9am = $_POST['9am'] ?? 0;
$_10am = $_POST['10am'] ?? 0;
$_11am = $_POST['11am'] ?? 0;
$_12pm = $_POST['12pm'] ?? 0;
$_1pm = $_POST['1pm'] ?? 0;
$_2pm = $_POST['2pm'] ?? 0;
$_3pm = $_POST['3pm'] ?? 0;
$_4pm = $_POST['4pm'] ?? 0;
$_5pm = $_POST['5pm'] ?? 0;
$_6pm = $_POST['6pm'] ?? 0;
$_7pm = $_POST['7pm'] ?? 0;
$_8pm = $_POST['8pm'] ?? 0;

// Include config file + information
require_once "config.php";

//Get times that already have appointments
$getTimes = mysqli_query($link, "SELECT * FROM availability WHERE date = '$date'");
while($row = mysqli_fetch_array($getTimes))
{
    if ($row['8am'] == "2") {$_8am = "2";}
    if ($row['9am'] == "2") {$_9am = "2";}
    if ($row['10am'] == "2") {$_10am = "2";}
    if ($row['11am'] == "2") {$_11am = "2";}
    if ($row['12pm'] == "2") {$_12pm = "2";}
    if ($row['1pm'] == "2") {$_1pm = "2";}
    if ($row['2pm'] == "2") {$_2pm = "2";}
    if ($row['3pm'] == "2") {$_3pm = "2";}
    if ($row['4pm'] == "2") {$_4pm = "2";}
    if ($row['5pm'] == "2") {$_5pm = "2";}
    if ($row['6pm'] == "2") {$_6pm = "2";}
    if ($row['7pm'] == "2") {$_7pm = "2";}
    if ($row['8pm'] == "2") {$_8pm = "2";}
}
//if this date already exists in the table, delete it first
$sql = "DELETE FROM availability WHERE date = '$date'";
if ($link->query($sql) === TRUE) {
    echo "Successfully deleted record. ";
} 
else {
    echo "Error deleting record: " . $link->error;
}

$stmt = $link->prepare("insert into availability(date, 8am, 9am, 10am, 11am, 12pm, 1pm, 2pm, 3pm, 4pm, 5pm, 6pm, 7pm, 8pm)
values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("siiiiiiiiiiiii", $date, $_8am, $_9am, $_10am, $_11am, $_12pm, $_1pm, $_2pm, $_3pm, $_4pm, $_5pm, $_6pm, $_7pm, $_8pm);
$stmt->execute();
echo "Availability recorded.";
$stmt->close();
$link->close();
header('Location: admin.php');
?>
