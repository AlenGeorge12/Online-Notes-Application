<?php
session_start();
include('connection.php');

//logout
include('logout.php');
//remember me
include('8.rememberme.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Online Notes</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="styling.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Arvo:ital@0;1&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Arvo', serif;
        }
        .footer{
            position: absolute;
    bottom: 0;
    text-align: center;
    width: 100%;
    padding-top: 10px;
        }
    </style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Online Notes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarcollapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Help</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Contact</a>
                </li>
            </ul>

            <ul class="navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="#loginmodal" data-toggle="modal">Login</a>
                </li>
            </ul>

            
        </div>
    </div>
</nav>
    
    <!--Jumbotron with signup button-->
    
    <div class="jumbotron" id="mycontainer">
        <h1>Online Notes App</h1>
        <p>Your Notes with you wherever you go.</p>
        <p>Easy to use, protects all your notes!</p>
        
        <button type="button" class="btn btn-lg green signup" data-target="#signupmodal" data-toggle="modal">Signup</button>

    </div>
    <!--LOGIN Form-->
    
    <form method="post" id="loginform">
        
        
        <div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="hid" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="hid">Login:</h4>
          
          
        <button class="btn-close" data-dismiss="modal"></button>


          
          
      </div>
      <div class="modal-body">
          
          <!--login message from php file-->
          <div id="loginmessage"></div>
          
          

    <div class="form-group mb-3">
        <label for="loginemail" class="visually-hidden">Email</label>
        <input class="form-control" type="email" name="loginemail" placeholder="Email Address" maxlength="50" id="loginemail">
    </div>

    <div class="form-group mb-3">
        <label for="loginpassword" class="visually-hidden">Password</label>
        <input class="form-control" type="password" name="loginpassword" placeholder="Password" maxlength="30" id="loginpassword">
        
        <div class="mt-4">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="rememberme" id="rememberme">
        <label class="form-check-label" for="rememberme">Remember me</label>
        <a class="float-end" style="cursor: pointer" data-dismiss="modal" data-target="#forgotpasswordmodal" data-toggle="modal">Forgot Password?</a>
    </div>
</div>


    </div>
          

</div>

        
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default pull-left" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#signupmodal">Register</button>-->
          <button type="button" class="btn btn-default me-auto" data-dismiss="modal" data-target="#signupmodal" data-toggle="modal">
                  Register
                </button>



          <input class="btn green" name="login" type="submit" value="Login">
        <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>-->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>


        
      </div>
    </div>
  </div>
</div> 
    
    </form>
    
    <!--Signup Form-->
    <form method="post" id="signupform">
        
        
        <div class="modal fade" id="signupmodal" tabindex="-1" aria-labelledby="hid" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="hid">Sign up today and Start using our Online Notes App!</h4>
        <button class="btn-close" data-dismiss="modal"></button>
          <!--<button class="close" data-dismiss="modal">&times;</button>
-->

      </div>
      <div class="modal-body">
          
          <!--Signup message from php file-->
          <div id="signupmessage"></div>
          
          
    <div class="form-group mb-3">
        <label for="username" class="visually-hidden">Username</label>
        <input class="form-control" type="text" name="username" placeholder="Username" maxlength="30" id="username">
    </div>

    <div class="form-group mb-3">
        <label for="email" class="visually-hidden">Email</label>
        <input class="form-control" type="email" name="email" placeholder="Email Address" maxlength="50" id="email">
    </div>

    <div class="form-group mb-3">
        <label for="password" class="visually-hidden">Password</label>
        <input class="form-control" type="password" name="password" placeholder="Password" maxlength="30" id="password">
    </div>

    <div class="form-group mb-3">
        <label for="password2" class="visually-hidden">Confirm Password</label>
        <input class="form-control" type="password" name="password2" placeholder="Confirm Password" maxlength="30" id="password2">
    </div>
</div>

        
      <div class="modal-footer">
          <input class="btn green" name="signup" type="submit" value="Sign up">
<!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>-->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

        
      </div>
    </div>
  </div>
</div>
        
    
    </form>
    
    
    <!--Forgot Password Form-->
    
    <form method="post" id="forgotpasswordform">
        
        
        <div class="modal fade" id="forgotpasswordmodal" tabindex="-1" aria-labelledby="hid" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="hid">Forgot Password?Enter your email address:</h4>
        <button class="btn-close" data-dismiss="modal"></button>

      </div>
      <div class="modal-body">
          
          <!--forgot password  message from php file-->
          <div id="forgotpasswordmessage"></div>
          
          

    <div class="form-group mb-3">
        <label for="forgotemail" class="visually-hidden">Email</label>
        <input class="form-control" type="email" name="forgotemail" placeholder="Email Address" maxlength="50" id="forgotemail">
    </div>         

</div>

        
      <div class="modal-footer">
         
         <!-- <button type="button" class="btn btn-default float-start" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#signupmodal">Register</button>-->
          <button type="button" class="btn btn-default me-auto" data-dismiss="modal" data-target="#signupmodal" data-toggle="modal">
                  Register
                </button>




          <input class="btn green" name="forgotpassword" type="submit" value="Submit">
        <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>-->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>


        
      </div>
    </div>
  </div>
</div> 
    
    </form>
    
    
    
    <!--Footer-->
     
    <div class="footer">
        <div class="container">
            <p>Abel George Wilson Copyright &copy;<?php
                $today = date("Y");
                    echo $today;
                ?></p>
        </div>
    
    </div>

<script src="js/bootstrap.bundle.js"></script>
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    

<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
    <script src="4.index.js"></script>
    


</body>
</html>
