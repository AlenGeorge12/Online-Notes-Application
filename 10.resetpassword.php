<?php

session_start();
include('connection.php');      
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
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
              <h1>Reset Password:</h1>
              
              <div id="resultmessage">
              
              </div>
              
              <?php
              //<!--If user_id or key is missing show an error-->
if(!isset($_GET['user_id']) || !isset($_GET['key'])){
    echo '<div class="alert alert-danger">There was an error. Please click on the link you recieved by email.</div>'; exit;
}
//<!--else-->
//    <!--Store them in two variables-->
$user_id = $_GET['user_id'];
$key = $_GET['key'];
$time = time() - 86400;
//    <!--Prepare variables for the query-->
$user_id = mysqli_real_escape_string($link, $user_id);
$key = mysqli_real_escape_string($link, $key);
//    <!--Run query: check combination of user_id and key exits and less than 24h old
$sql = "SELECT user_id FROM forgotpassword WHERE rkey='$key' AND user_id='$user_id' AND time > '$time' AND status='pending'";
$result = mysqli_query($link, $sql);
if(!$result){
        echo '<div class="alert alert-danger">Error running the query</div>';
        exit;
}
//if combination does not exists
              //show error
$count = mysqli_num_rows($result);
if($count !== 1){
    echo '<div class="alert alert-danger">Please try again.</div>';
    exit;
}
  //  print reset form  
echo "
<form method='post' id='passwordreset'>
    <input type='hidden' name='key' value='$key'>
    <input type='hidden' name='user_id' value='$user_id'>

    <div class='form-group'>
        <label for='password' class='fw-bold'>Enter your new Password:</label>
        <input type='password' name='password' id='password' placeholder='Enter Password' class='form-control'>
    </div>

    <div class='form-group'>
        <label for='password2' class='fw-bold'>Re-enter Password:</label>
        <input type='password' name='password2' id='password2' placeholder='Re-enter Password' class='form-control'>
    </div>

    <div class='form-group mt-3'>
        <input type='submit' name='resetpassword' class='btn btn-success btn-lg' value='Reset Password'>
    </div>
</form>
";                     
              ?>
              
              
                    </div>

        </div>
    </div>

    
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      
      <script>
             //Once the form is submitted
            $("#passwordreset").submit(function(event){ 
                //prevent default php processing
                event.preventDefault();
                //collect user inputs
                var datatopost = $(this).serializeArray();
            //    console.log(datatopost);
                //send them to signup.php using AJAX
                $.ajax({
                    url: "11.storeresetpassword.php",
                    type: "POST",
                    data: datatopost,
                    success: function(data){

                        $('#resultmessage').html(data);
                    },
                    error: function(){
                        $("#resultmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");

                    }

                });

            });           
            
            </script>
     
  </body>
</html>