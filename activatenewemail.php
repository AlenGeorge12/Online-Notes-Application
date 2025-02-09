<?php
//<!--The user is re-directed to this file after clicking the link-->
//<!-- link contains tHREE GET parameters: email, newemail and activation key-->
session_start();
include('connection.php');      
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New email Activation</title>
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
              <h1>Email Activation </h1>
              
              <?php
              
              //<!--If email or activation key is missing show an error-->
if(!isset($_GET['email']) || 
   !isset($_GET['newemail']) ||
   !isset($_GET['key'])){
    echo '<div class="alert alert-danger">There was an error. Please click on the link you recieved by email.</div>'; exit;
}
//<!--else-->
//    <!--Store them in two variables-->
$email = $_GET['email'];
$newemail = $_GET['newemail'];
$key = $_GET['key'];
//    <!--Prepare variables for the query-->
$email = mysqli_real_escape_string($link, $email);
$newemail = mysqli_real_escape_string($link, $newemail);
$key = mysqli_real_escape_string($link, $key);
//    <!--Run query: update email-->
$sql = "UPDATE users SET email='$newemail', activation2='0' WHERE (email='$email' AND activation2='$key') LIMIT 1";
$result = mysqli_query($link, $sql);
//    <!--If query is successful, show success message and invite user to login-->
if(mysqli_affected_rows($link) == 1){
    session_destroy();
    setcookie("rememberme", "", time()-3600);
    echo '<div class="alert alert-success">Your email has been successfully changed.</div>';
    echo '<a href="1.index.php" type="button" class="btn-lg btn-success">Log in</a>';

  
}else{
    //    <!--else-->
//        <!--Show error message-->
    echo '<div class="alert alert-danger">There was an error. Your email could not be changed. Please try again later.</div>';
}
              ?>
              
              
          </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
     
  </body>
</html>