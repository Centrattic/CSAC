<?php
require '../Backend/functions.php';
session_start();

?>

<main>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">
    <link rel = "stylesheet" href = "../CSS/navbar.css">
    <link rel="shortcut icon" type="image/png" href="../Images/CSAClogo.png"/>
    <title> Oh no! An error! </title>
    <link rel="shortcut icon" type="image/png" href="../Images/CSAClogo.png"/>

  </head>
  <body>

    <?php
        navbar();
    ?>

      <?php

        
        if (!function_exists('checkForError')) {
          function checkForError() {
              if(isset($_GET['error'])) {
                  echo("<br> <br> <span class = 'error-message' style = 'all: unset; color:red; font-size: 1.5em; font-weight: 500;'>");
                  echo('An error has ocurred! ');

                  if ($_GET['error'] == "notsignedin") {
                    echo('You are not signed in.');
                  } elseif ($_GET['error'] == "emptyloginfields") {
                    echo('You have empty login fields you must fill out.');
                  } elseif ($_GET['error'] == "databaseerror") {
                    echo('This is a very odd database error. ' . $_GET['msg']);
                  } elseif ($_GET['error'] == "wrong_password") {
                    echo('You have entered the wrong password.');
                  } elseif ($_GET['error'] == "CRAZYSTUFF") {
                    echo('This is CRAZY STUFF!');
                  } elseif ($_GET['error'] == "nouser") {
                    echo('There is no such user in the database.');
                  } elseif ($_GET['error'] == "file_size>5MB") {
                    echo('One or more of the file(s) you uploaded are larger than 5MB.');
                  } elseif ($_GET['error'] == "can't_upload") {
                    echo('The file(s) you uploaded failed to upload.');
                  } elseif ($_GET['error'] == "wrong_file_type") {
                    echo('One or more of the file(s) you uploaded have the wrong file type. 
                    The correct types are: jpg, png, or jpeg for images & docx or pdf for files.');
                  } elseif ($_GET['error'] == "unsuccessful_store") {
                    echo('Your information could not be stored.');
                  } elseif ($_GET['error'] == "unsuccessful_execute") {
                    echo('Your information could not be entered into the database.');
                  } elseif ($_GET['error'] == "unsuccessful_bind") {
                    echo('Your information could not be processed.');
                  } elseif ($_GET['error'] == "preparation_error") {
                    echo('Your information could not be prepared for databse entry.');
                  } elseif ($_GET['error'] == 'no-javascript') {
                    echo('You must enable Javascript in order to use this form. Please enable it!')
                  } else {
                    echo('What a confusing error!');
                  }

                  echo("<br><br> Please go back (press the back arrow) to retrieve your entered information and/or retry 😊.");
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
