<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
        <style>
            /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
            }

            /* Firefox */
            input[type=number] {
            -moz-appearance: textfield;
            }
        </style>
    </head>
    <body>
        <div class="topnav">
            <a href="index.html">Home</a>
            <div class="topnav-right">
              <a href="login.html">Login</a>
              <a>Create Account</a>
            </div>
        </div>
        <h4 id="services" style="margin-top: 20px;">Services</h4>
        <div id="container">
            <div>
                <h2>A: $15</h2>
                <h3>Haircut</h3>
            </div>
            <div>
                <h2>B: $20</h2>
                <h3>Haircut + Beard / Shave</h3>
            </div>
            <div>
                <h2>C: $22</h2>
                <h3>Haircut + Beard + Eyebrows</h3>
            </div>
        </div>
        <br>
        <form name="bookingForm" action="http://localhost/SiddCutz/recordAptmt.php" onsubmit="return validateForm()" method="post" style="text-align: center;">
            <!-- <label for="name">Name:</label> -->
            <input type="text" name="name" placeholder="Name" required><br>
            <br>

            <!-- <label for="number">Phone Number:</label> -->
            <input type="number" name="number"  placeholder="Phone Number" required><br>
            <br>

            <!-- <label for="email">Email:</label> -->
            <input type="email" name="email" placeholder="Email" required><br>
            <br>

            <label for="service">Service:</label><br>
            <input type="radio" id="a" name="service" value="a" required>
              <label for="a" style="margin-right: 20px;">A</label><br>
            <input type="radio" id="b" name="service" value="b">
              <label for="b" style="margin-right: 20px;">B</label><br>
            <input type="radio" id="c" name="service" value="c">
              <label for="c" style="margin-right: 20px;">C</label><br>
            <br>

            <label for="location">Location:</label><br>
            <input type="radio" id="parsippany" name="location" value="parsippany" required>
              <label for="parsippany">Parsippany, NJ</label><br>
            <!-- <input type="radio" id="nb" name="location" value="nb">
              <label for="nb">New Brunswick, NJ</label><br>
            <input type="radio" id="house" name="location" value="house">
              <input type="text" for="house" placeholder="House call (enter address)"><br> -->
            <br>
            
            <label for="date">Date:</label>
            <input id="date" type="date" name="date" onchange="onDateChange(value)" required><br>
            <br>

            <div id="availabilities"></div>
            <br>

            <input type="submit" value="Book Appointment"><br><br>
    
        </form><br>
        <p>*By clicking "Book Appointment" I consent to paying the listed price for the selected service*</p>
    </body>
</html>
<script>
    function validateForm() {
        console.log("In validation")
        let num = document.forms["bookingForm"]["number"].value.toString();
        if (num.length != 10 || num.charAt(0) == '0') {
            alert("Please enter a valid phone number.");
            return false;
        }
        let time = document.forms["bookingForm"]["time"];

        console.log(time)
        if (time == null || time.value == null) {
            alert("Please enter an appointment time.");
            return false;
        }

    }
    function onDateChange(val)
    {
        fetch("getAvail.php?date=" + val, {
            method: 'get',
        })
        .then(function (response) {
            return response.text();
        })
        .then(function (text) {
            ele = document.getElementById("availabilities");
            ele.innerHTML = "";
            const times = ["9:00 AM", "10:00 AM", "11:00 AM", "12:00 PM", "1:00 PM", "2:00 PM", "3:00 PM", "4:00 PM", "5:00 PM", "6:00 PM", "7:00 PM", "8:00 PM"];
            const dbtimes = ["9am", "10am", "11am", "12pm", "1pm", "2pm", "3pm", "4pm", "5pm", "6pm", "7pm", "8pm"];
            const militarytimes = [9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];

            let today = new Date()
            let y = today.getFullYear()
            let m = today.getMonth()+1
            let d = today.getDate()
            let hour = today.getHours();
            if (m < 10)
                m = '0' + m;
            if (d < 10)
                d = '0'+d
            today = y + '-'+ m  + '-' + d
            // console.log(today)
            // console.log(val)
            // console.log(hour)

            let noTimes = true;
            for (let i = 0; i < text.length; i++) {
                if (text[i] == 1 && (val != today || (val == today && hour < militarytimes[i]))) {
                    noTimes = false;
                    ele.innerHTML += '<input type="radio" id="' + dbtimes[i] + '" name="time" value="' + dbtimes[i] + '" required>';
                    ele.innerHTML += '<label for="' + dbtimes[i] + '" style="margin-right: 20px;">' + times[i] + '</label><br>';
                }            
            }
            if (noTimes) {
                ele.innerHTML += '<p>No available appointments on ' + val + '</p><br>';
            }
        })
        .catch(function (error) {
            console.log(error)
        });

        return false;
    }
    var date = new Date();
    date.setDate(date.getDate() - 1);
    var yesterday = date.toISOString().split('T')[0];
    document.getElementsByName("date")[0].setAttribute('min', yesterday);
</script>
