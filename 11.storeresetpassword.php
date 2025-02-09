<?php
// <!--This file receives: user_id, generated key to reset password, password1 and password2-->
// <!--This file then resets password for user id if all checks are correct-->
session_start();
include('connection.php');  

//<!--If user_id or key is missing show an error-->
if(!isset($_POST['user_id']) || !isset($_POST['key'])){
    echo '<div class="alert alert-danger">There was an error. Please click on the link you recieved by email.</div>'; exit;
}
//<!--else-->
//    <!--Store them in two variables-->
$user_id = $_POST['user_id'];
$key = $_POST['key'];
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
 //define error message
$missingpassword = '<p><strong>Please enter a Password!</strong></p>';
$invalidpassword = '<p><strong>Your password should be at least 6 characters long and include one capital letter and one number!</strong></p>';
$differentpassword = '<p><strong>Please enter the same Password!</strong></p>';
$missingpassword2 = '<p><strong>Please confirm your Password!</strong></p>';
$password ="";
$password2 = "";
$errors = "";
//get password
if(empty($_POST["password"])){
    $errors .= $missingpassword;
}elseif(!(strlen($_POST["password"])>6
       and preg_match('/[A-Z]/',$_POST["password"])
        and preg_match('/[0-9]/',$_POST["password"])
       )
       ){
    $errors .= $invalidpassword;
}else{
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    if(empty($_POST["password2"])){
        $errors .= $missingpassword2;
    }else{
         $password2 = filter_var($_POST["password2"], FILTER_SANITIZE_STRING);
        if($password !==$password2){
            $errors .= $differentpassword;
        }
    }
}
// If there are any errors print error
if ($errors) {
    $resultmessage = '<div class="alert alert-danger">' . $errors . '</div>';
    echo $resultmessage;
    exit;
}
 //<!--Prepare variables for the query-->
$password = mysqli_real_escape_string($link, $password);
$password = hash('sha256', $password);
$user_id = mysqli_real_escape_string($link, $user_id);
// <!--Run Query: update users password in the users table

$sql = "UPDATE users SET password='$password' WHERE user_id='$user_id'";
$result = mysqli_query($link, $sql);
if(!$result){
        echo '<div class="alert alert-danger">EROR! There was a problem in storing the new password</div>';
        exit;
}
//set the key status to "used" int the forgot password table to prevent the key from being used twice
$sql = "UPDATE forgotpassword SET status='used' WHERE rkey='$key' AND user_id='$user_id'";

$result = mysqli_query($link, $sql);
if(!$result){
        echo '<div class="alert alert-danger">EROR Running the query</div>';
}else{
    echo '<div class="alert alert-success">Your password has been updated successfully! <a href="1.index.php">Login</a></div>';
}


?>