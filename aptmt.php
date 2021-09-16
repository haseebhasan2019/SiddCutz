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
            <input type="text" name="name"><br>
            <br>

            <label for="number">Phone Number:</label>
            <input type="text" name="number"><br>
            <br>

            <label for="service">Service:</label><br>
            <input type="radio" id="a" name="service" value="a">
              <label for="a" style="margin-right: 20px;">A</label>
            <input type="radio" id="b" name="service" value="b">
              <label for="b" style="margin-right: 20px;">B</label>
            <input type="radio" id="c" name="service" value="c">
              <label for="c" style="margin-right: 20px;">C</label>
            <input type="radio" id="d" name="service" value="d">
              <label for="d" style="margin-right: 20px;">D</label><br>
            <br>

            <label for="location">Location:</label><br>
            <input type="radio" id="parsippany" name="location" value="parsippany">
              <label for="parsippany">Parsippany, NJ</label><br>
            <input type="radio" id="nb" name="location" value="nb">
              <label for="nb">New Brunswick, NJ</label><br>
            <input type="radio" id="house" name="location" value="house">
              <input type="text" for="house" placeholder="House call (enter address)"><br>
            <br>
            
            <label for="date">Date:</label>
            <input type="date" name="date" onchange="onDateChange(value)"><br>
            <!-- <input type="week" name="date"><br> -->
            <br>

            <div id="availabilities">
            <!-- <p>Content</p> -->
            </div>
            <br>

            <label for="time">Time:</label>
            <input type="time" value="12:00:00" name="time"><br>
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
        console.log(val)
        fetch("getAvail.php", {
            method: 'get',
            body: val
        })
        .then(function (response) {
            return response.text();
        })
        .then(function (text) {
            console.log(text);
        })
        .catch(function (error) {
            console.log(error)
        });
        return false;


        ele = document.getElementById("availabilities");
        // ele.innerHTML = "";
        // ele.innerHTML += '<ul><li>Hello</li><li>Hi\
        // </li></ul>';
        // ele.append(<ul><li>hi<li></ul>)
        // ele.insertAdjacentHTML("beforeend", '<input type="radio" id="t" name="t" value="t">' +
        // $x = 0;
        // while ($x < 3){
        //     echo '<p>$x</p>';
        //     $x++;}
        //     +"'");
        // ele.insertAdjacentHTML('beforeend', '<ul><li>hi<li></ul>')
        // ele.insertAdjacentHTML('beforeend', '<ul><li>hi<li></ul>')

    }
</script>
