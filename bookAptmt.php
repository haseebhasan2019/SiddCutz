<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
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
    <body style="background-color: rgb(44, 44, 44); ">

        <!-- Nav bar -->
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="index.html">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled">Create Account</a>
            </li>
        </ul>
        
        <!-- Services - Make a card for each one -->
        <div class="div" id="services" style="margin-top: 20px; text-align: center;">
            <h2 class="display-6" style="color: white">Services</h2>
            <div class="row justify-content-center align-items-wrap">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Bronze</h5>
                            <h6 class="card-subtitle mb-2 text-muted">$15</h6>
                            <p class="card-text">Haircut</p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Silver</h5>
                            <h6 class="card-subtitle mb-2 text-muted">$20</h6>
                            <p class="card-text">Haircut + Beard / Shave</p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Gold</h5>
                            <h6 class="card-subtitle mb-2 text-muted">$22</h6>
                            <p class="card-text">Haircut + Beard + Eyebrows</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <br>
        <div class="row justify-content-center">

        <div class="card" style="text-align: center; place-items: center; width: 500px;">
                    <div class="card-body">
                        <h5 class="card-title">Book an Appointment</h5>

        <form name="bookingForm" action="recordAptmt.php" onsubmit="return validateForm()" method="post" style="text-align: center;">
            <div class="row justify-content-center">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" class="form-control" style="width: 300px; text-align: center" name="name" required>
            
        </div>
        <br>
            <div class="row justify-content-center">
            <label for="number" class="form-label">Phone Number:</label>
            <input type="number" id="number" class="form-control" style="width: 200px; text-align: center" name="number" required>
            
</div>
<br>
            <!-- <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Email" required><br>
            <br> -->

            <div class="form-check">
                <label for="service" class="form-label">Service:</label><br>
                <input type="radio" id="a" name="service" value="a" required>
                  <label for="a" style="margin-right: 20px;">A</label><br>
                <input type="radio" id="b" name="service" value="b">
                  <label for="b" style="margin-right: 20px;">B</label><br>
                <input type="radio" id="c" name="service" value="c">
                  <label for="c" style="margin-right: 20px;">C</label><br>
                <br>
            </div>

            <div class="form-check">
                <label for="location" class="form-label">Location:</label><br>
                <input type="radio" id="parsippany" name="location" value="parsippany" required>
                  <label for="parsippany">Parsippany, NJ</label><br>
                <!-- <input type="radio" id="nb" name="location" value="nb">
                  <label for="nb">New Brunswick, NJ</label><br>
                <input type="radio" id="house" name="location" value="house">
                  <input type="text" for="house" placeholder="House call (enter address)"><br> -->
                <br>
            </div>
            
            <label for="date" class="form-label">Date:</label>
            <input id="date" type="date" name="date" onchange="onDateChange(value)" required>
            <br>

            <div id="availabilities"></div>
            <br>

            <input type="submit" class="btn btn-primary" value="Book Appointment"><br>
    
        </form><br>
                            </div>
                </div>
                    </div>
<br>
        <p style="text-align: center; color: white">*By clicking "Book Appointment" I consent to paying the listed price for the selected service*</p>
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
            const times = ["8:00 AM", "9:00 AM", "10:00 AM", "11:00 AM", "12:00 PM", "1:00 PM", "2:00 PM", "3:00 PM", "4:00 PM", "5:00 PM", "6:00 PM", "7:00 PM", "8:00 PM"];
            const dbtimes = ["8am", "9am", "10am", "11am", "12pm", "1pm", "2pm", "3pm", "4pm", "5pm", "6pm", "7pm", "8pm"];
            const militarytimes = [8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];

            let today = getToday();
            let hour = (new Date()).getHours();
            let noTimes = true;
            let atLeastOne = true;
            const dayOfWeek = (new Date(val)).getDay();
            
            for (let i = 0; i < text.length; i++) {
                if (text[i] == 1 && (val != today || (val == today && hour < militarytimes[i]))) {
                    noTimes = false;
                    if ((dayOfWeek==5 || dayOfWeek==6) && atLeastOne) {
                        ele.innerHTML += '<p>*Appointments from 3:00 PM onwards on Saturday<br>and Sunday incur a $5.00 extra charge*</p><br>';
                        atLeastOne = false;
                    }
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
    function getToday() {
        let today = new Date();
        let y = today.getFullYear();
        let m = today.getMonth()+1;
        let d = today.getDate();
        if (m < 10)
            m = '0'+m;
        if (d < 10)
            d = '0'+d;
        return y + '-'+ m  + '-' + d;
    }
    document.getElementsByName("date")[0].setAttribute('min', getToday());
</script>
