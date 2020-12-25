<?php
require '../Backend/functions.php';
session_start();
?>

<main>
    <html>
    <head>
        <link rel = 'stylesheet' href = '../CSS/connecthero.css'>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">
        <link rel = 'stylesheet' href = '../CSS/navbar.css'>
        <link rel = 'stylesheet' href = '../CSS/heroview_public.css'>
        <title> View Community Service Heroes </title>
     <!--   <link rel = 'stylesheet' href = '../CSS/print.css' media = "print">-->
    </head>
    <body>
        <div class = "no-print">
            
            <?php
            navbar();
            ?>

        </div>

    <?php
    //connect script 

    //WORK TO DO
    // figure out how to print results onto same page
    // make sure page cant be accessed without user being signed in

        
     /*   echo(' <h2>These are the names of all who have been nominated so far.</h2> <ul>');
        generateHeroesListing("currentnominations");
        echo('</ul>');*/

        if($_GET['type'] === "currentwinners") {
            echo("<h1> This Year's Winners </h1>");
        } elseif ($_GET['type'] === "pastwinners") {
          echo("<h1> Past Years' Winners </h1>");
        } else {
            echo("<h1> Invalid Request</h1>"); //why errors if I go to that page?
        }

        generateHeroesListing($_GET['type']); //change it so that it's not that they can only delete heroes, but verify them BEFORE they appear. MUST build that functionality soon.

    ?>

    </body>
    </html>
</main>
