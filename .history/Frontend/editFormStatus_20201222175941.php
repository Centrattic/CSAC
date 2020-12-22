<?php
require '../Backend/functions.php';
session_start();

if(!isset($_SESSION['UserID'])) {
   header("Location: ../Frontend/error.php?error=notsignedin");
}
?>

<html>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">
    <link href="../CSS/home.css" rel="stylesheet" type="text/css" />
    
    <link rel = "stylesheet" href = "../CSS/navbar.css">
  </head>

  <body>

    <?php
      navbar();
      checkForError();

    ?>


    <?php

        $connection = connectToDB();

        if(isset($_POST['editFormStatus'])){ // if this is update request
           
            $statusInput = $_POST['status'];
            $comments = $_POST['comments'];
            $time = getCurrentTime();

            $status = "unknown";
            if ($statusInput == "Open Nominations") {
                $status = "open";
            } elseif ($statusInput == "Close Nominations") {
                $status = "closed";
            }

            updateAuditLog($connection, 0, "Nomination Form " . $status . ". Comment:" . $comments);
            $result = updateFormStatus($connection, $status, $comments, $time);

            if ($result == "Success") {
                header("Location: ../Frontend/editFormStatus.php?");
            } else {            
                header("Location: ../Frontend/editFormStatus.php?error=".$result); // error just go in else
            }
        }

        // Read current form status and display the page.
        list ($formStatus, $comments, $time) = readFormStatus($connection);
        mysqli_close($connection);

        $buttonLabel = "Error"; //inital button label
        if ($formStatus == 'open') {
            echo('<h1> Currently, the form is open. It was opened at time: '.$time.' with comments: <br>'.$comments.'. <br>');
            echo('To close the form, enter your name and any comments and press the button.');
            $buttonLabel = "Close Nominations";
        } elseif ($formStatus == 'closed') {
            echo('<h1> Currently, the form is closed. It was closed at '.$time. ' with comments: <br>'.$comments.'. <br>');
            echo('To open the form, enter your name and any comments and press the button.');
            $buttonLabel = "Open Nominations";
        } elseif ($formStatus == 'unknown') {
            echo('<h1> Currently, the form status is unknown at '.$time. ' with comments: <br>'.$comments.'. <br>');
            echo('To open the form, enter your name and any comments and press the button.');
            $buttonLabel = "Open Nominations";
        }

        echo("<form id = 'close-open-nomination' action = 'editFormStatus.php' method = 'post'>      
                <button style = 'border-radius: 0px;' type = 'submit' name = 'editFormStatus'> $buttonLabel</button> 
                <textarea required name='comments' maxlength = '200' placeholder = 'Enter your name and any other comments you may have.' value='' title='formStatusComments'></textarea> <!-- add drop down for this-->
                <input style = 'display: none;' name = 'status' value ='$buttonLabel'>
            </form>");

        exit();
    ?>

            
  </body>

</html>
