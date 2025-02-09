$(document).ready(function(){
    //define variables
    var activenote = 0;
    var editmode = false;
    //load notes on page load: ajax call to loadnotes.php
    $.ajax({
        url: "14.loadnotes.php",
        success: function(data){
            $('#notes').html(data);
            clickonnote();
            clickondelete();
        },
        error: function(){
            $('#alertcontent').text("There was an error with ajax call. Please try again.");
                    $("#alert").fadeIn();
        }
         
        
    });
    //add a new note ajax call to createnotes.php
    $('#addnote').click(function(){
        $.ajax({
            url: "15.createnotes.php",
            success: function(data){
                if(data == 'error'){
                   $('#alertcontent').text("There was an issue inserting new notes.");
                    $("#alert").fadeIn();
                }else{
                   //update active note to the id of new note
                    activenote = data;
                    $("textarea").val("");
                    //show hide element
                    showhide(["#notepad", "#allnotes"], ["#notes", "#addnote", "#edit", "#done"]);
                    $("textarea").focus();
                }
            },
            error: function(){
                $('#alertcontent').text("There was an error with ajax call. Please try again.");
                    $("#alert").fadeIn();
            }
        });
        
    });
    //type note: ajax call to updatenote.php
    $("textarea").keyup(function(){
        console.log("Keyup event triggered!");
        //ajax call to update the task of id activenote
        $.ajax({
            url: "16.updatenotes.php",
            type: "POST",
            //we need to send the current note content with its id to the php file
            data: {note: $(this).val(), id: activenote},
            success: function(data){
                if(data == 'error'){
                    $('#alertcontent').text("There was an issue updating the notes in the database! Please try again.");
                    $("#alert").fadeIn();
                }
            
            },
            error: function(){
                $('#alertcontent').text("There was an error with ajax call. Please try again.");
                    $("#alert").fadeIn();
            }
        
        
    });
        
        
    });
    
    
    //click on all notes button
    $("#allnotes").click(function(){
         $.ajax({
            url: "14.loadnotes.php",
            success: function(data){
                $('#notes').html(data);
                showhide(["#addnote", "#edit", "#notes"], ["#allnotes", "#notepad"]);
                clickonnote();
                clickondelete();
            
            },
            error: function(){
                $('#alertcontent').text("There was an error with ajax call. Please try again.");
                    $("#alert").fadeIn();
            }
        
        
    });
    });
    //click on done after editing: loaad notes again
    $("#done").click(function(){
        //switch to none edit mode
        editmode = false;
        //expand the notes
        $(".noteheader").removeClass("col-xs-7 col-sm-9");
        //show hide elements
        showhide(["#edit"], [this, ".delete"]);
    });
    //click on edit: go tp edit mode(show delete buttons, ....)
    $("#edit").click(function(){
        //switch to edit mode
        editmode = true;
        //reduce the width of notes
        $(".noteheader").addClass("col-xs-7 col-sm-9");
        //show hide elements
        showhide(["#done", ".delete"], [this]);
    });
    
    
    //functions
       //click on a note
    function clickonnote(){
         $(".noteheader").click(function(){
        if(!editmode){
            //update active note variable to id of note
            activenote = $(this).attr("id");
            //fill text area
            $("textarea").val($(this).find('.text').text());
            //show hide elements
            showhide(["#notepad", "#allnotes"], ["#notes", "#addnote", "#edit", "#done"]);
                    $("textarea").focus();
        }
    });
    }
       //click on delete
    function clickondelete(){
        $(".delete").click(function(){
            var deletebutton = $(this);
            //send ajax call to delete
            $.ajax({
            url: "17.deletenotes.php",
            type: "POST",
            
            data: {id: deletebutton.next().attr("id")},
            success: function(data){
                if(data == 'error'){
                    $('#alertcontent').text("There was an issue deleting the notes from the database! Please try again.");
                    $("#alert").fadeIn();
                }else{
                    //remove containing div
                    deletebutton.parent().remove();
                }
            
            },
            error: function(){
                $('#alertcontent').text("There was an error with ajax call. Please try again.");
                    $("#alert").fadeIn();
            }
        
        
    });
        });
    }
    
    //show hide
    
    
    function showhide(array1, array2){
        for(i=0; i<array1.length; i++){
            $(array1[i]).show();
        }
        for(i=0; i<array2.length; i++){
            $(array2[i]).hide();
        }
    };
    
    
    
});