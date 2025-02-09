<?php
//start a session and connect
session_start();
include('connection.php');
//define error message
$missingcurrentpassword = '<p><strong>Please enter your Current Password!</strong></p>';
$incorrectcurrentpassword = '<p><strong>The password entered is incorrect!</strong></p>';
$missingpassword = '<p><strong>Please enter a new Password!</strong></p>';
$invalidpassword = '<p><strong>Your password should be at least 6 characters long and inlcude one capital letter and one number!</strong></p>';
$differentpassword = '<p><strong>Passwords don\'t match!</strong></p>';
$missingpassword2 = '<p><strong>Please confirm your password</strong></p>';

$errors = "";
//check for errors
if(!$_POST["currentpassword"]){
    $errors .= $missingcurrentpassword;
}else{
    $currentpassword = $_POST["currentpassword"];
    $currentpassword = filter_var($currentpassword, FILTER_SANITIZE_STRING);
    $currentpassword =  mysqli_real_escape_string($link, $currentpassword);
    $currentpassword = hash('sha256', $currentpassword);
    //check if it is correct
    
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT password FROM users WHERE user_id='$user_id'";
    $result = mysqli_query($link, $sql);
    $count = mysqli_num_rows($result); 
    if($count !== 1){
        echo '<div class="alert alert-danger">There was a problem running the query</div>';
    }else{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($currentpassword != $row['password']){
            $errors .= $incorrectcurrentpassword;
        }
    }
    
}

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
//if error print error message
if($errors){
    $resultmessage = "<div class='alert alert-danger'>$errors</div>";
    echo $resultmessage;
}else{
    $password = mysqli_real_escape_string($link, $password);
    $password = hash('sha256', $password);
    //else run query update password
    $sql = "UPDATE users SET password='$password' WHERE user_id='$user_id'";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo "<div class='alert alert-danger'>Password could not be reset. PLease try again later.</div>";
    }else{
        echo "<div class='alert alert-success'>Your password has been updated successfully.</div>";
    }
}
//else update password
?>