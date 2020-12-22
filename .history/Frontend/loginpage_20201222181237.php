<?php
require('../Backend/functions.php');
session_start();

echo(' 
<html>
  <head>
    <link rel = "stylesheet" href = "../CSS/navbar.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">
  </head>
  <body>');

  navbar();

  echo(' <div class = "circle">
        <div id = "h1-sizing">
            <h1 id = "admin"> ADMIN SIGN IN </h1>
        </div>
            <form method = "post" id = "login" action = "../Backend/loginscript.php">
            <div class = "login-list">
                <input  class = "login-info" required type = "text" name = "emailuid" placeholder = "Username/Email">
                <input class = "login-info" required type = "password" name = "pwd" placeholder = "Password"> 
                <button id = "login-submit" class = "login-info"  type = "submit" name = "login-submit">LOGIN</button> 
                
            </div>
            </form>
    </div>'
);


echo('
<style>
   
    .circle {
        background-image: url("../Images/circle.png ");
        width: 50vw;
        height: 50vw;
        background-repeat: no-repeat;
        background-size: 50vw;
        margin: 0 auto;
    }

    * {
        text-align: center;
        font-family: "Lato", sans-serif;       
    }

    .login-list {
        margin: 0 auto;
        width: 50%;
    }

    .login-info {
        width: 100%;
        margin: 5px 0;
        padding: 10px;
        text-align: left; 
    }

    #admin {
        color: white;
    }

    #h1-sizing {
        height: 30%;
        display: flex;
        align-items: flex-end;
        justify-content: center;

    }

    #login-submit {
        margin-top: 10%;
        text-align: center;
        width: 50%;
        font-size: 1.25em;
    }

    
</style>
')


?>
