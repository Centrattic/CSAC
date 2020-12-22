<?php
require '../Backend/functions.php';
session_start();

if(!isset($_SESSION['UserID'])) {
  header("Location: ../Frontend/error.php?error=notsignedin");       
}
?>

<main>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">
    <link rel = "stylesheet" href = "../CSS/navbar.css">
    <link rel = "stylesheet" href = "../CSS/verification.css">
    <link rel = 'stylesheet' href = '../CSS/heroview_admin.css'>
    <link rel = 'stylesheet' href = '../CSS/print_admin.css' media = "print">
  </head>
  <body>
  
  <div class = "no-print">
    <?php
        navbar();
    // make sure page cant be accessed without user being signed in


          if(!isset($_GET['type'])){
            echo("Error in calling admin functions");
            die();
          }

          if($_GET['type'] === "archived") {
            echo(' <h1 id = "verify">Archived Heroes</h1>');
          } else if($_GET['type'] === "editwinners") {
            echo(' <h1 id = "verify">Edit Winners</h1>');
          } else if($_GET['type'] === "submitted") {
            echo(' <h1 id = "verify">Verify Heroes</h1>');
          }
      ?>


    </div>

    <?php     
      if ($_GET['type'] === "editwinners") {
        echo(' <br> <h1>Current Winners</h1>');
        generateHeroesListing("editwinners");
        
        echo(' <br> <h1>Past Winners</h1>');
        generateHeroesListing("editpastwinners");
      } else {
        generateHeroesListing($_GET['type']);
      }
    ?>

    </body>
</html>
</main>
