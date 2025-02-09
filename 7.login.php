<?php
//<!-- Start session -- >
session_start();
//<!-- Connect to the database -- >
include("connection.php");

//<!-- Check user inputs -- >
//    <!-- Define error messages -- >
$missingemail = '<p><strong>Please enter your email!</strong></p>';
$missingpassword = '<p><strong>Please enter your Password!</strong></p>';

$email = "";
$password = "";
$errors = '';

//    <!-- Get email and password -- >
//    <!-- Store errors in errors variable -- >
if(empty($_POST["loginemail"])){
    $errors .= $missingemail;
}else{
    $email = filter_var($_POST["loginemail"], FILTER_SANITIZE_EMAIL);   
}
if(empty($_POST["loginpassword"])){
    $errors .= $missingpassword;
}else{
    $password = filter_var($_POST["loginpassword"], FILTER_SANITIZE_STRING);   
}
//    <!-- If there are any errors -- >
if($errors){
    //        <!-- print error message -- >
    $resultmessage = '<div class="alert alert-danger">' . $errors . '</div>';
    echo $resultmessage;
}else{
    //    <!-- else: No errors -- >
    //<!-- Prepare variables for the query >
        $email = mysqli_real_escape_string($link, $email);
        $password = mysqli_real_escape_string($link, $password);
        $password = hash('sha256', $password);       
//        <!-- Run query: Check combinaton of email & password exists -- >
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND activation='activated'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query</div>';
    exit;
}
//        <!-- If email & password don't match print error -- >
$count = mysqli_num_rows($result);
if($count !== 1){
    echo '<div class="alert alert-danger">Wrong Username or password.</div>';
}else{
    //        <!-- else -- >
//            <!-- log the user in: Set session variables -- >
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $_SESSION['user_id']=$row['user_id'];
    $_SESSION['username']=$row['username'];
    $_SESSION['email']=$row['email'];
    //            <!-- If remember me is not checked -- >
//                <!-- print "success" -- >
    if(empty($_POST['rememberme'])){
        echo "success";
    }else{
        //            <!-- else -- >
//                <!-- Create two variables $authentificator1 and $authentificator2 -- >
        $authentificator1 = bin2hex(openssl_random_pseudo_bytes(10));
        //2*2*2
        $authentificator2 = openssl_random_pseudo_bytes(20);
        //       Store them in a cookie -- >
        function f1($a,$b){
            $c = $a . "," . bin2hex($b);
            return $c;
        }
        $cookievalue = f1($authentificator1, $authentificator2);
        setcookie(
            "rememberme",
            $cookievalue,
            time() + 1296000
        );
        //       <!-- Run query to store them in rememberme table -- >
        function f2($a){
            $b = hash('sha256', $a);
            return $b;
        }
        $f2authentificator2 = f2($authentificator2);
        $user_id = $_SESSION['user_id'];
        $expiration = date('Y-m-d H:i:s', time() + 1296000);
        $sql = "INSERT INTO rememberme (`authentificator1`, `f2authentificator2`, `user_id`, `expires`) VALUES ('$authentificator1', '$f2authentificator2', '$user_id', '$expiration')";
        $result = mysqli_query($link, $sql);
        if(!$result){
            echo '<div class="alert alert-danger">There is a error in storing your data</div>';
        }else{
            echo "success";
        }
    }
}
}

//                <!-- If query unsuccessful -- >
//                    <!-- print error -- >
//                <!-- else -- >
//                    <!-- print "success" -- >
                    ?>