<?php
//<!--The user is re-directed to this file after clicking the activation link-->
//<!--Signup link contains two GET parameters: email and activation key-->
session_start();
include('connection.php');      
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account Activation</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  </head>
    <style>
        h1{
            color: purple;
        }
        .contactform{
            border: 1px solid purple;
            margin-top: 50px;
            border-radius: 20px;
        }
    </style>
  <body>
    <div class="container-fluid">
      <div class="row">
          <div class="col-sm-offset-1 col-sm-10 contactform">
              <h1>Account Activation </h1>
              
              <?php
              //<!--If email or activation key is missing show an error-->
if(!isset($_GET['email']) || !isset($_GET['key'])){
    echo '<div class="alert alert-danger>There was an error. Please click on the activation link you recieved by email.</div>'; exit;
}
//<!--else-->
//    <!--Store them in two variables-->
$email = $_GET['email'];
$key = $_GET['key'];
//    <!--Prepare variables for the query-->
$email = mysqli_real_escape_string($link, $email);
$key = mysqli_real_escape_string($link, $key);
//    <!--Run query: set activation field to "activated" for the provided email-->
$sql = "UPDATE users SET activation='activated' WHERE (email='$email' AND activation='$key') LIMIT 1";
$result = mysqli_query($link, $sql);
//    <!--If query is successful, show success message and invite user to login-->
if(mysqli_affected_rows($link) == 1){
    echo '<div class="alert alert-success">Your account has been activated.</div>';
    echo '<a href="1.index.php" type="button" class="btn-lg btn-success">Log in</a>';

  
}else{
    //    <!--else-->
//        <!--Show error message-->
    echo '<div class="alert alert-danger">There was an error. Your account could not be activated. Please try again later.</div>';
}
              ?>
              
              
          </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
     
  </body>
</html>