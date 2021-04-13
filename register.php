<?php



// Include db file
require_once "includes/db.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please Enter Username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($mysqli, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This user has already been taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Something went wrong.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Password at least have 8 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please retype your password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password Did not Match !.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($mysqli, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash for security
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
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

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <title>Hello, world!</title>
  </head>
  <body>

        <div class="container">

            <div class="row pt-5">

                <div class="col-4">
                    
                </div>

                <div class="col-4">

                    <div class="wrapper">
                        <h2>Register</h2>
                        <p>Please complete this form to create an account..</p>

                        <form id="validateForm" action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" >
                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                                <span class="help-block"><?php echo $username_err; ?></span>
                                <span class="help-block-c" id="error"></span>
                            </div>    
                            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control" value="<?php echo $password; ?>">
                                <span class="help-block"><?php echo $password_err; ?></span>
                                <span class="help-block-c" id="error"></span>
                            </div>
                            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                                <span class="help-block"><?php echo $confirm_password_err; ?></span>
                                <span class="help-block-c" id="error"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"  id="formRegister">Sing Up</button>
                            </div>
                            <p>Do you already have an account? <a href="login.php">Login here</a>.</p>
                        </form>
                    </div>    
                    
                </div>

                <div class="col-4">
                    
                </div>
            </div>
        </div>



    <script src="assets/js/jquery-3.6.0.min.js" ></script>

    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/js/jquery.validate.min.js"></script>

    <script src="assets/js/validateRegister.js"></script>

  </body>
</html>