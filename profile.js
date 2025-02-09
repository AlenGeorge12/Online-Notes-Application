$(document).ready(function(){
//ajax call to updateusername.php
$("#updateusernameform").submit(function(event){
    //prevent default php processing
    event.preventDefault();
    
    //collect user inputs
    var datatopost = $(this).serializeArray();
    //console.log(datatopost);
    //send them to updateusername.php using AJAX
    //$.post({}).done(when success).fail();
    $.ajax({
        url: "updateusername.php",
        type: "POST",
        data: datatopost,
        //AJAX Call successful: show error or success message
        success: function(data){
            if(data){
                $("#updateusernamemessage").html(data);
            }else{
                location.reload();
            }
        },
        //AJAX Call fails: show Ajax Call error
        error: function(){
            $("#updateusernamemessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
        }
    });
    console.log("userForm submitted"); 
    
});  
console.log("Form submitted"); 
//ajax call to updatepassword.php
$("#updatepasswordform").submit(function(event){
    //prevent default php processing
    event.preventDefault();
    console.log("Form submitted"); 
    //collect user inputs
    var datatopost = $(this).serializeArray();
    
    $.ajax({
        url: "updatepassword.php",
        type: "POST",
        data: datatopost,
        //AJAX Call successful: show error or success message
        success: function(data){
            if(data){
                $("#passwordmessage").html(data);
            }
        },
        //AJAX Call fails: show Ajax Call error
        error: function(){
            $("#passwordmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
        }
    });
    
    
});  

//ajax call to updateemail.php
    $("#updateemailform").submit(function(event){
    //prevent default php processing
    event.preventDefault();
    console.log("Form submitted"); 
    //collect user inputs
    var datatopost = $(this).serializeArray();
    
    $.ajax({
        url: "updateemail.php",
        type: "POST",
        data: datatopost,
        //AJAX Call successful: show error or success message
        success: function(data){
            if(data){
                $("#emailmessage").html(data);
            }
        },
        //AJAX Call fails: show Ajax Call error
        error: function(){
            $("#emailmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
        }
    });
    
    
}); 
});