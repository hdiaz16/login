<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: dashboard.php");
  exit;
}
 
// Include config file
require_once "includes/db.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter your username.";
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
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($mysqli, $sql)){
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
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

                    if(mysqli_stmt_fetch($stmt)){

                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: dashboard.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you have entered is not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "There is no account registered with that username.";
                }
            } else{
                echo "Something went wrong, please try again.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($mysqli);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>

    <div class="row pt-5">
            <div class="col-4" > </div>

            <div class="col-4"> 
                <h2>Login</h2>
                <p>Please fill in your credentials to login.</p>

                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" id="formLogin">

                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $username_err; ?></span>
                        <span class="help-block-c" id="error"></span>
                    </div>  

                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                        <span class="help-block"><?php echo $password_err; ?></span>
                        <span class="help-block-c" id="error"></span>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" value="Login">Login</button>
                    </div>

                    <p>You still do not have an account ? <a href="register.php">Sing Up here</a>.</p>
                </form>

            </div>

            <div class="col-4"> </div>
        </div> 




     <script src="assets/js/jquery-3.6.0.min.js" ></script>

    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/js/jquery.validate.min.js"></script>

    <script src="assets/js/validateLogin.js"></script>   
</body>
</html>