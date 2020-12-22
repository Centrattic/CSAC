<?php
require '../Backend/functions.php';
session_start();

if(!isset($_SESSION['UserID'])) {
  header("Location: ../Frontend/home.php?error=notsignedin");       
}
?>

<html>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">
    <link href="../CSS/home.css" rel="stylesheet" type="text/css" />
    
    <link rel = "stylesheet" href = "../CSS/navbar.css">
  </head>

  <body>

    <style>
      #audit-table, #audit-table th, #audit-table td {
        padding: 4px;
        border: 1px solid black;
        border-radius: 0px;
        margin: 0 auto;
      }

      #audit-table {
        border-collapse: collapse;
        background-color: #FFEEFE; 
      }
    </style>

    <?php
      navbar(); 
    ?>

    <?php

        $connection = connectToDB();
        $rows = readAuditLog($connection);
        mysqli_close($connection);

        echo ("<table id = 'audit-table'>");
        echo ("<tr>");
        echo ("<th> ID </th>");
        echo ("<th> Time </th>");
        echo ("<th> Nomination Id </th>");
        echo ("<th> Nomination Name </th>");
        echo ("<th> Message </th>");
        echo ("</tr>");

        foreach ($rows as $row) {
            echo ("<tr>");
            echo ("<td>".$row['id']."</td>");
            echo ("<td>".$row['auditTime']."</td>");
            echo ("<td>". $row['idNomination']."</td>");
            echo ("<td>". $row['nameNominee']."</td>");
            echo ("<td>". $row['auditMessage']."</td>");
            echo ("</tr>");
        }
        echo ("</table>");
    ?>
        
  </body>

</html>
