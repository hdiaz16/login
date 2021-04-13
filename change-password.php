<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "includes/db.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 8){
        $new_password_err = "The password must be at least 8 characters long.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Passwords do not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($mysqli, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
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
    <title>Change password </title>
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
                <h2>Change your password here</h2>
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" id="changePasswordForm"> 
                    <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                        <label>New password</label>
                        <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                        <span class="help-block"><?php echo $new_password_err; ?></span>
                        <span class="help-block-c" id="error"></span>
                    </div>
                    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                        <label>Confirm password</label>
                        <input type="password" name="confirm_password" class="form-control">
                        <span class="help-block"><?php echo $confirm_password_err; ?></span>
                        <span class="help-block-c" id="error"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" >Send</button>
                        <a class="btn btn-link" href="dashboard.php">Cancel</a>
                    </div>
                </form>

            </div>

            <div class="col-4"> </div>
        </div>  



    <script src="assets/js/jquery-3.6.0.min.js" ></script>

    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>