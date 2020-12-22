<?php // ASK DAD WHY IT IS UNSUCCSFLL TO INPUT INTO QUERY LOG
    require 'functions.php';
    require 'dbhconnect.php';
    
    if(!isset($_SESSION['UserID'])) {
        header("Location: ../Frontend/home.php?error=notsignedin");       
    }


    if (!function_exists('editHeroStatus'))   {

    function editHeroStatus($connection, $id, $newStatus, $type) {
        $sqlquery = "UPDATE nominations SET statusNominee='$newStatus' WHERE idNominations='$id'";

        if(mysqli_query($connection, $sqlquery)) {
            if ($type == "editpastwinners") {
                $type = "editwinners";
            }
            header("Location: ../Frontend/admin.php?type=$type");
            
        } else {
            echo("database error");
            exit();
        }
    }

    $connection = connectToDB(); 

    $newstatus = $_GET['newstatus'];
    $type = $_GET['type'];

    editHeroStatus($connection, $_GET['id'], $newstatus, $type);

    if ($newstatus == "archived") {
        $message = "Archived"; 
    } elseif ($newstatus == "submitted" && $type == "editwinners") {
        $message = "Removed the winner status"; 
    } elseif ($newstatus == "submitted" && $type == "archived") {
        $message = "Unarchived"; 
    } elseif ($newstatus == "winner") {
        $message = "Made a current winner!";
    } elseif ($newstatus == "pastwinner") {
        $message = "Made a current winner to a past winner!";
    }

    updateAuditLog($connection, $_GET['id'], $message);
    mysqli_close($connection);

    }

  ?>