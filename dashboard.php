<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
   
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#"> <?php echo ($_SESSION["username"]); ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="change-password.php">Change Password</a>
          </li>
        </ul>
        <a type="button" class="btn btn-danger" href="logOut.php">Sing Out</a>
      </div>
    </nav>

     <div class="page-header">
        <h3>Hi, <b><?php echo ($_SESSION["username"]); ?></b>. Welcome to the dashboard.</h1>
            <p>Whant to change your password?</p>
            <div class="row">
                <div class="col-6" > <a type="button" class="btn btn-primary" href="change-password.php">Yes</a> </div>
                <div class="col-6"> <a type="button" class="btn btn-danger" href="#">No</a> </div>
            </div>
    </div>



    <script src="assets/js/jquery-3.6.0.min.js" ></script>

    <script src="assets/js/bootstrap.min.js"></script>



</body>
</html>