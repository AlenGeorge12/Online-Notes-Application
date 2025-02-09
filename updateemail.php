<?php
//start a session and connect
session_start();
include('connection.php');
//get user_id and new email
$user_id = $_SESSION['user_id'];
$newemail = $_POST['email'];
//check if new email exists 
$sql = "SELECT * FROM users WHERE email='$newemail'";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);
if($count>0){
    echo '<div class="alert alert-danger">There is already a user registered with that email! Please choose another email.</div>';exit;
}

//get the current email
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);
if($count == 1){
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $email = $row['email'];
}else{
    echo "There was an error retrieving the email from the database";exit;
}

//create a unique activation code
$activationkey = bin2hex(openssl_random_pseudo_bytes(16));

//insert a new activation code in users table
$sql = "UPDATE users SET activation2='$activationkey' WHERE user_id='$user_id'";

$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">There was an error inserting user details in the database.</div>';exit;
}else{
    //send an email link to activatenewemail.php with current email. new email and activation code
   
    $message = "Please click on this link to change your email:\n\n";
    
    $message .= "http://localhost/Projects/10.Online%20Notes%20App/activatenewemail.php?email=" . urlencode($email) . "&newemail=" . urlencode($newemail) . "&key=$activationkey";
if(mail($newemail, 'Email Update for you Online Notes App', $message, 'From:'.'abelgeorgewilson796@gmail.com')){
       echo "<div class='alert alert-success'>An email has been sent to $newemail. Please click on the link to change your email address.</div>";
}

    
}



?>