<?php
require '../Backend/functions.php';
session_start();
?>

<html>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">
    
    <link rel = "stylesheet" href = "../CSS/navbar.css">
  </head>

  <body>
    <?php
        navbar();
        checkForError();
    ?>
    
    <h1> Nominations for this year have closed. They will open again on January 1st. Please check back later. Thank you! </h1>
  </body>
</html>
