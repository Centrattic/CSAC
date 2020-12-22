<?php
session_start();

?>

<main>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">
    <link rel = "stylesheet" href = "../CSS/navbar.css">
  </head>
  <body>

    <?php
        navbar();

        
        if (!function_exists('checkForError')) {
          function checkForError() {
              if(isset($_GET['error'])) {
                  echo("<span class = 'error-message' style = 'all: unset; color:red; font-size: 1.25em; font-weight: 500;'>");

                  List of errors
                  - notsignedin
                  - emptyloginfields
                  - databaseerror
                  - wrong_password
                  - CRAZYSTUFF
                  - nouser
                  - file_size>5MB
                  - can't_upload
                  - wrong_file_type



                  echo ('Error: '. $_GET['error']);



                  echo("<br> Press the back button to retrieve your entered information.");
                  echo("</span>");
              }
          }
        }





        checkForError();

    // make sure page cant be accessed without user being signed in


      ?>
  </body>
</html>
</main>
