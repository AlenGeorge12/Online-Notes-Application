<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: 1.index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Notes</title>

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
            margin-top: 120px;
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
        .noteheader{
            border: 1px solid grey;
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            padding: 0 10px;
            background: linear-gradient(#FFFFFF, #ECEAE7);
        }
        .text{
            font-size: 20px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .timetext{
            font-size: 13px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .delete{
            display: none;
        }
        #allnotes,#done,#notepad{
            display: none;
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
                    <a class="nav-link" aria-current="page" href="3.profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Help</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#" tabindex="-1" aria-disabled="true">My Notes</a>
                </li>
            </ul>

            <ul class="navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="3.profile.php">Logged in as <b><?php echo $_SESSION['username']?></b></a>
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
        <!--Alert message-->
        <div id="alert" class="alert alert-danger collapse">
            <a class="close" data-dismiss="alert">
                &times;
            </a>
            <p id="alertcontent"></p>
        </div>
        <div class="row">
            
           <div class="offset-md-3 col-md-6">
    <div class="buttons">
    <button id="addnote" type="button" class="btn btn-lg violet">Add Note</button>
    <button id="edit" type="button" class="btn btn-lg violet float-end">Edit</button>
    <button id="done" type="button" class="btn green btn-lg float-end">Done</button>
    <button id="allnotes" type="button" class="btn btn-lg violet">All Notes</button>
</div>
               
               <div id="notepad">
                   
                   <textarea rows="10"></textarea>
                   
               </div>
               
               <div id="notes" class="notes">
                   <!--Ajax call to a php file-->
               </div>

</div>

        
        </div>
    
    </div>
    
    
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
<script src="13.mynotes.js"></script>
    


    <!-- jQuery -->


<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
    


</body>
</html>
