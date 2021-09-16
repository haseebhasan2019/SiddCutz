<?php
    $date = $_POST['date'];
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


    //Database connection
    $conn = new mysqli('localhost', 'root', '', 'siddcutz');
    if ($conn->connect_error){
        echo "$conn->connect_error";
        die('Connection Failed : ' .$conn->connect_error);
    } else {
        //if this date already exists in the table, delete it first
        $sql = "DELETE FROM availability WHERE date = '$date'";
        if ($conn->query($sql) === TRUE) {
            echo "Successfully deleted record. ";
          } else {
            echo "Error deleting record: " . $conn->error;
          }
        
        $stmt = $conn->prepare("insert into availability(date, 9am, 10am, 11am, 12pm, 1pm, 2pm, 3pm, 4pm, 5pm, 6pm, 7pm, 8pm)
        values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siiiiiiiiiiii", $date, $_9am, $_10am, $_11am, $_12pm, $_1pm, $_2pm, $_3pm, $_4pm, $_5pm, $_6pm, $_7pm, $_8pm);
        $stmt->execute();
        echo "Availability recorded.";
        $stmt->close();
        $conn->close();
        header('Location: admin.php');
    }
?>
