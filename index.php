<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP & Ajax CRUD</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>  </head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<body>
<div class="container">
  <table id="main" border="0" cellspacing="0">
    <tr>
      <td id="header">
        <h1>PHP & Ajax CRUD</h1>
        
        <div id="search-bar">
          <label>Search :</label>
          <input type="text" id="search" autocomplete="off">
        </div>
      </td>
    </tr>
    <tr>
      <td id="table-form">
        <form id="addForm">
          First Name : <input type="text" id="fname">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Last Name : <input type="text" id="lname">
          <input type="submit" id="save-button" value="Save">
        </form>
      </td>
    </tr>
    <tr>
      <td id="table-data">
      </td>
    </tr>
  </table>  
  <div id="error-message"></div>
  <div id="success-message"></div>
<!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body table text-center">
          
        </div>       
      </div>
    </div>
  </div>

  <!-- closing of modal -->
  </div>



  <script src="jquery.js"></script>  
  <script>
      //show tghe data from databasese using ajax
      $(document).ready(function(){
          function loadTable() {            
              $.ajax ({
                  url: 'ajax-load.php',
                  type : "POST",
                  success : function(data) {
                      $('#table-data').html(data);
                  }
              });
          } 
        loadTable();    
        //insert the data into databases from ajax 
         $('#save-button').on("click", function(e){
         e.preventDefault();
         var fname = $('#fname').val();
         var lname = $('#lname').val();
         if(fname == ""|| lname == "") {
             $('#error-message').html("All fields aerr required").slideDown();
             $('#success-message').slideUp();
         } else {
             $.ajax ({
                 url : "ajax-insert.php",
                 type : "POST",
                 data : {first_name:fname , last_name:lname},
                 success : function(data) {
                     if(data === "1") {
                         loadTable();
                         $('#addForm').trigger("reset");
                         $('#success-message').html("Data Inserted Successsfully").slideDown();
                         $('#error-message').slideUp();
                     } else {
                        $('#error-message').html("There is some issue duein insertrtion of data").slideDown();
                        $('#success-message').slideUp();
                     }
                 }
             })
         }
     })
    //  delete data from database
    $(document).on("click", ".delete-btn" ,function() {
        if(confirm("Do You really want to delete this record")){
            var studentId = $(this).data("id");
            var element = this;
            $.ajax ({
                url :  'ajax-delete.php', 
                type  : "POST",
                data :  {id:studentId},
                success : function (data) {
                    if(data == 1) {
                        $(element).closest("tr").fadeOut();
                    } else {
                        $('#error-message').html("Can't delete record").slideDown();
                        $('#success-message').slideUp();

                    }
                }
            })  
        }      
    })

    //   edit  the data from database

    $(document).on("click", ".edit-btn", function() {
        var edit_id = $(this).data("eid");
       $.ajax({
           url : 'edit-form.php',
           type : "POST",
           data : {id:edit_id},
           success : function(data){
              $('.modal-body').html(data);
           }
       })
    })
    // for updation the data 
    $(document).on("click", ".update", function() {
      var edit_id = $('.edit-id').val();
      var edit_fname = $('.edit-fname').val();
      var edit_lname = $('.edit-lname').val();
      $.ajax({
           url : 'update-form.php',
           type : "POST",
           data : {id:edit_id,fname:edit_fname,lname:edit_lname},
           success : function(data){
            if(data === "1") {
                         loadTable();
                     } else {

                     }        
           }
       });
    });
    $(document).on("keyup", "#search", function() {
      var keyword = $(this).val();
      $.ajax({
           url : 'search-form.php',
           type : "POST",
           data : {key:keyword},
           success : function(data){
            $('#table-data').html(data);     
            }        
           
       });
    });
  }) ;
    //search the data    
    
  // </script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>