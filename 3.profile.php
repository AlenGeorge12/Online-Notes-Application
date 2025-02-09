<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: 1.index.php");
}
include('connection.php');
$user_id = $_SESSION['user_id'];
//get username and email
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);
if($count == 1){
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $username = $row['username'];
    $email = $row['email'];
}else{
    echo "There was an error retrieving the username and email from the database";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="styling.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Arvo:ital@0;1&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Arvo', serif;
        }
        #container{
            margin-top: 100px;
            
        }
        textarea{
            width: 100%;
            max-width: 100%;
            font-size: 16px;
            line-height: 1.5em;
            border-left-width: 20px;
            border-color: #8D5496;
            /* background-color: ;
            color: ;*/
            padding: 10px;
        }
        tr{
            cursor: pointer;
        }
        .table tbody {
            background-color: rgba(255, 255, 255, 0); /* Adjust the alpha value for transparency */
            border-color: rgba(0, 0, 0, 0.1);
        }

        .table td {
            background-color: rgba(255, 255, 255, 0); /* Adjust the alpha value for transparency */
            border-color: rgba(0, 0, 0, 0);
        }

        .table th {
            background-color: rgba(255, 255, 255, 0); /* Adjust the alpha value for transparency */
            border-color: rgba(0, 0, 0, 0.1);
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
                    <a class="nav-link active" aria-current="page" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Help</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="2.mainpageloggedin.php" tabindex="-1" aria-disabled="true">My Notes</a>
                </li>
            </ul>

            <ul class="navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="#">Logged in as <b><?php echo $username; ?></b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="1.index.php?logout=1">Log out</a>
                </li>
            </ul>

            
        </div>
    </div>
</nav>
    
    <!--Container-->
    
    <div class="container" id="container">
        <div class="row">
            
           <div class="offset-md-3 col-md-6">
               
               <h2>Account Settings:</h2>
               
               <div class="table-responsive ">
        <table class="table table-hover table-condensed table-bordered">
          <tr data-target="#updateusername" data-toggle="modal">
            <td>Username</td>
            <td><?php echo $username; ?></td>
          </tr>
          <tr data-target="#updateemail" data-toggle="modal">
            <td>Email</td>
            <td><?php echo $email; ?></td>
          </tr>
          <tr data-target="#updatepassword" data-toggle="modal">
            <td>Password</td>
            <td>hidden</td>
          </tr>
        </table>
      </div>        
    
</div>

        
        </div>
    
    </div>
    
    <!--update username Form-->
    
    <form method="post" id="updateusernameform">
        
        
        <div class="modal fade" id="updateusername" tabindex="-1" aria-labelledby="hid" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="hid">Edit Username:</h4>
          
          
        <button class="btn-close" data-dismiss="modal"></button>


          
          
      </div>
      <div class="modal-body">
          
          <!--updateusername message from php file-->
          <div id="updateusernamemessage"></div>
          
          

    <div class="form-group mb-3">
        <label for="username">Username:</label>
        <input class="form-control" type="text" name="username" maxlength="30" id="username" value="<?php echo $username; ?>">
    </div>
         
</div>
        
      <div class="modal-footer">
        
          <input class="btn green" name="updateusername" type="submit" value="Submit">
        <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>-->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        
      </div>
    </div>
  </div>
</div> 
    
    </form>
    
   <!--update email Form-->
    
    <form method="post" id="updateemailform">
        
        
        <div class="modal fade" id="updateemail" tabindex="-1" aria-labelledby="hid" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="hid">Enter new Email:</h4>
          
          
         <button class="btn-close" data-dismiss="modal"></button>


          
          
      </div>
      <div class="modal-body">
          
          <!--update email message from php file-->
          <div id="emailmessage"></div>
          
          

    <div class="form-group mb-3">
        <label for="email">Email:</label>
        <input class="form-control" type="email" name="email" maxlength="30" id="email" value="<?php echo $email; ?>">
    </div>
         
</div>
        
      <div class="modal-footer">
        
          <input class="btn green" name="updateemail" type="submit" value="Submit">
        <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>-->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        
      </div>
    </div>
  </div>
</div> 
    
    </form>
    
   <!--update password Form-->
    
    <form method="post" id="updatepasswordform">
        
        
        <div class="modal fade" id="updatepassword" tabindex="-1" aria-labelledby="hid" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="hid">Enter Current and New Password:</h4>
          
          
        <button class="btn-close" data-dismiss="modal"></button>


          
          
      </div>
      <div class="modal-body">
          
          <!--password message from php file-->
          <div id="passwordmessage"></div>
          
          

    <div class="form-group mb-3">
        <label for="currentpassword" class="visually-hidden">Your Current Password:</label>
        <input class="form-control" type="password" name="currentpassword" maxlength="30" id="currentpassword" placeholder="Your Current Password">
    </div>
          
          
          <div class="form-group mb-3">
        <label for="password" class="visually-hidden">Choose a Password:</label>
        <input class="form-control" type="password" name="password" maxlength="30" id="password" placeholder="Choose a Password">
    </div>
          
          
          <div class="form-group mb-3">
        <label for="password2" class="visually-hidden">Confirm Password:</label>
        <input class="form-control" type="password" name="password2" maxlength="30" id="password2" placeholder="Confirm Password">
    </div>
         
</div>
        
      <div class="modal-footer">
        
          <input class="btn green" name="updatepassword" type="submit" value="Submit">
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
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="profile.js"></script>

    <!-- jQuery -->


<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
    


</body>
</html>
