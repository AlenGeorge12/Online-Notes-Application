<?php
//Start session
session_start();

include('connection.php');

//Check user inputs
    //Define error messages
$missingusername = '<p><strong>Please enter a username!</strong></p>';
$missingemail = '<p><strong>Please enter your email address!</strong></p>';
$invalidemail = '<p><strong>Please enter a valid email address!</strong></p>';
$missingpassword = '<p><strong>Please enter a Password!</strong></p>';
$invalidpassword = '<p><strong>Your password should be at least 6 characters long and include one capital letter and one number!</strong></p>';
$differentpassword = '<p><strong>Please enter the same Password!</strong></p>';
$missingpassword2 = '<p><strong>Please confirm your Password!</strong></p>';
    //Get username, email, password, password2

$username = "";
$email = "";
$password = "";
$errors = '';
//get username
if(empty($_POST["username"])){
    $errors .= $missingusername;  
}else{
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
}
//get email
if(empty($_POST["email"])){
    $errors .= $missingemail;
}else{
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidemail;
    }
}
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
} else {
    // No errors, proceed with database checks and insertion

    // Prepare variables for the queries
    $username = mysqli_real_escape_string($link, $username);
    $email = mysqli_real_escape_string($link, $email);
    $password = mysqli_real_escape_string($link, $password);
    $password = hash('sha256', $password);

    // If username exists in the users table, print error
    $sql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo '<div class="alert alert-danger">Error running the query</div>';
        exit;
    }
    $results = mysqli_num_rows($result);
    if ($results) {
        echo '<div class="alert alert-danger">This username is already taken</div>';
        exit;
    }

    // If email exists in the users table, print error
    $sql = "SELECT * FROM `users` WHERE email = '$email'";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo '<div class="alert alert-danger">Error running the query</div>';
        exit;
    }
    $results = mysqli_num_rows($result);
    if ($results) {
        echo '<div class="alert alert-danger">This email is already taken</div>';
        exit;
    }

    // Create a unique activation code
    $activationkey = bin2hex(openssl_random_pseudo_bytes(16));

    // Insert user details and activation code in the users table
    $sql = "INSERT INTO users (`username`,`email`,`password`,`activation`) VALUES ('$username', '$email', '$password', '$activationkey')";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo '<div class="alert alert-danger">Error inserting the details in the database</div>';
        exit;
    }

    // Send the user an email with a link to activate.php with their email and activation code
    $message = "Please click on this link to activate your account:\n\n";
    $message .= "http://localhost/Projects/10.Online%20Notes%20App/6.activate.php?email=" . urlencode($email) . "&key=$activationkey";

    if (mail($email, 'Confirm your registration', $message, 'From:' . 'abelgeorgewilsom796@gmail.com')) {
        echo "<div class='alert alert-success'>Thank you for registering! A confirmation email has been sent to $email. Please click on the activation link to activate the account</div>";
    }
}

?>