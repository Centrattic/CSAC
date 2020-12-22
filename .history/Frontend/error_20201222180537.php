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

                  if ($_GET['error'] == "notsignedin") {
                    echo('An error has ocurred! You are not signed in. ');
                  } elseif ($_GET['error'] == "emptyloginfields") {
                    echo('');
                  } elseif ($_GET['error'] == "databaseerror") {
                    echo('');
                  } elseif ($_GET['error'] == "wrong_password") {
                    echo('');
                  } elseif ($_GET['error'] == "CRAZYSTUFF") {
                    echo('');
                  } elseif ($_GET['error'] == "nouser") {
                    echo('');
                  } elseif ($_GET['error'] == "file_size>5MB") {
                    echo('');
                  } elseif ($_GET['error'] == "can't_upload") {
                    echo('');
                  } elseif ($_GET['error'] == "wrong_file_type") {
                    echo('');
                  } elseif ($_GET['error'] == "unsuccessful_store") {
                    echo('');
                  } elseif ($_GET['error'] == "unsuccessful_execute") {
                    echo('');
                  } elseif ($_GET['error'] == "unsuccessful_bind") {
                    echo('');
                  } elseif ($_GET['error'] == "preparation_error") {
                    echo('');
                  } else {
                    echo('');
                  }

                  echo("<br> Please go back (press the back button) to retrieve your entered information and/or retry 😊.");
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
