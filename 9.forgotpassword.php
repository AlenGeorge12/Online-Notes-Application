<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//Start session 
session_start();
// Connect to the database 
include('connection.php');

// Check user inputs 
//     Define error messages 
$missingemail = '<p><strong>Please enter your email address!</strong></p>';
$invalidemail = '<p><strong>Please enter a valid email address!</strong></p>';
//     Get email -
//     Store errors in errors variable
$forgotemail = "";
$errors = "";
if(empty($_POST["forgotemail"])){
    $errors .= $missingemail;
}else{
    $email = filter_var($_POST["forgotemail"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidemail;
    }
}

//     If there are any errors -
//         print error message -
if ($errors) {
    $resultmessage = '<div class="alert alert-danger">' . $errors . '</div>';
    echo $resultmessage;
    exit;
}
//     else: No errors -- >-->
//         Prepare variables for the query -
$email = mysqli_real_escape_string($link, $email);
//         Run query to check if the email exists in the users table -- >-->
$sql = "SELECT * FROM `users` WHERE email = '$email'";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo '<div class="alert alert-danger">Error running the query</div>';
        exit;
    }
    $count = mysqli_num_rows($result);
    if ($count != 1) {
        echo '<div class="alert alert-danger">This email does not exist.</div>';
        exit;
    }

//         else -- >-->
//             get the user_id -- >-->
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$user_id = $row['user_id'];
//             Create a unique activation code -- >-->
 $key = bin2hex(openssl_random_pseudo_bytes(16));
//             Insert user details and activation code in the forgotpassword table -- >-->
$time = time();
$status = 'pending';
$sql = "INSERT INTO forgotpassword (`user_id`, `rkey`, `time`, `status`) VALUES ('$user_id', '$key', '$time', '$status')";
$result = mysqli_query($link, $sql);
 if (!$result) {
        echo '<div class="alert alert-danger">Error inserting the details in the database</div>';
        exit;
    }
//             Send email with link to resetpassword.php with user id and activation code -- >-->
$message = "Please click on this link to reset your password:\n\n";
    $message .= "http://localhost/Projects/10.Online%20Notes%20App/10.resetpassword.php?user_id=$user_id&key=$key";

    if (mail($email, 'Reset your Password', $message, 'From:' . 'abelgeorgewilsom796@gmail.com')) {
        //             If email sent successfully -- >-->
//             print success message -- >-->
        echo "<div class='alert alert-success'>An Email has been sent to $email. Please click on the link to reset your password.</div>";
    }

?>