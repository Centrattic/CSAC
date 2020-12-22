<?php
require '../Backend/functions.php';
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

        



        checkForError();

    // make sure page cant be accessed without user being signed in


      ?>
  </body>
</html>
</main>
