<?php
// Start session and check if already logged in
session_start(); 
if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true){
    header("location: admin.php");
    exit;
}

// Include config file + information
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM user WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $db_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(strcmp($password, $db_password)==0){                      
                            session_start();
                            // Store data in session variables
                            $_SESSION["logged_in"] = true;
                            // Redirect user to welcome page
                            header("location: admin.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <meta charset="utf-8">
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

    <!-- Form -->
    <div class="row justify-content-center">
        <div class="card" style="text-align: center; place-items: center; width: 300px;">
            <div class="card-body" style="place-items: center;">
                <h5 class="card-title">Please log in to continue:</h5>

                <?php 
                if(!empty($login_err)){
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }        
                ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="row justify-content-center">
                        <label class="form-label" for="username">Username:</label>
                        <input type="text" name="username" style="width: 200px;" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <label class="form-label" for="password">Password:</label>
                        <input type="password" name="password" style="width: 200px;" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <br>
                    <input class="btn btn-primary" type="submit" value="Login"><br>

                </form><br>
            </div>
        </div>
    </div>
</body>
</html>