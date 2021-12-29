<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
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
                <h2>Service A</h2>
                <h3>Regular Haircut: $13</h3>
                <ul>
                    <li>All tapers</li>
                    <li>Top hair trim</li>
                    <li>Line up</li>
                    <li>Blade work</li>
                    <li>Pencil enhancement</li>
                    <li>Cool mist spray</li>
                    <li>Talc powder neck</li>
                    <li>Hairstyling & hair product</li>
                </ul>
            </div>
            <div>
                <h2>Service B</h2>
                <h3>Skin Fades: $15</h3>
                <ul>
                    <li>All skin fades</li>
                    <li>Top hair trim</li>
                    <li>Line up</li>
                    <li>Blade work</li>
                    <li>Pencil enhancement</li>
                    <li>Cool mist spray</li>
                    <li>Talc powder neck</li>
                    <li>Hairstyling & hair product</li>
                </ul>
            </div>
            <div>
                <h2>Service C</h2>
                <h3>Clean up: $5</h3>
                <ul>
                    <li>Shape up</li>
                    <li>Clean up around neck</li>
                    <li>Line up</li>
                    <li>Blade work</li>
                    <li>Pencil enhancement</li>
                    <li>Cool mist spray</li>
                    <li>Talc powder neck</li>
                </ul>
            </div>
            <div>
                <h2>Service D</h2>
                <h3>Blade work: $5</h3>
                <ul>
                    <li>Beard work or full shave</li>
                    <li>Beard trim</li>
                    <li>Beard shape up</li>
                    <li>Beard Blade work</li>
                    <li>Beard pencil enhancement</li>
                </ul>
            </div>
        </div>
        <form action="http://localhost/SiddCutz/recordAptmt.php" method="post" style="text-align: center;">
            <label for="name">Name:</label>
            <input type="text" name="name" required><br>
            <br>

            <label for="number">Phone Number:</label>
            <input type="text" name="number" required><br>
            <br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br>
            <br>

            <label for="service">Service:</label><br>
            <input type="radio" id="a" name="service" value="a" required>
              <label for="a" style="margin-right: 20px;">A</label>
            <input type="radio" id="b" name="service" value="b">
              <label for="b" style="margin-right: 20px;">B</label>
            <input type="radio" id="c" name="service" value="c">
              <label for="c" style="margin-right: 20px;">C</label>
            <input type="radio" id="d" name="service" value="d">
              <label for="d" style="margin-right: 20px;">D</label><br>
            <br>

            <label for="location">Location:</label><br>
            <input type="radio" id="parsippany" name="location" value="parsippany" required>
              <label for="parsippany">Parsippany, NJ</label><br>
            <input type="radio" id="nb" name="location" value="nb">
              <label for="nb">New Brunswick, NJ</label><br>
            <input type="radio" id="house" name="location" value="house">
              <input type="text" for="house" placeholder="House call (enter address)"><br>
            <br>
            
            <label for="date">Date:</label>
            <input type="date" name="date" onchange="onDateChange(value)" required><br>
            <br>

            <div id="availabilities"></div>
            <br>

            <input type="submit"><br><br>
    
        </form><br>
    </body>
</html>
<script>
    function success() 
    {
        alert("Successfully recorded appointment! Check your email for confirmation.");
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

            for (let i = 0; i < text.length; i++)
            {
                if (text[i] == 1)
                {
                    ele.innerHTML += '<input type="radio" id="' + dbtimes[i] + '" name="time" value="' + dbtimes[i] + '" required>';
                    ele.innerHTML += '<label for="' + dbtimes[i] + '" style="margin-right: 20px;">' + times[i] + '</label><br>'
                }            
            }
        })
        .catch(function (error) {
            console.log(error)
        });

        return false;
    }
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("date")[0].setAttribute('min', today);
</script>
