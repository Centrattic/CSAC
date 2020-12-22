<?php 
    require('functions.php');


        $mysqli = connectToDB(); 
        
        $sqlquery = "UPDATE nominations SET statusNominee='winner' WHERE idNominations='$_GET[id]'";

        if(mysqli_query($mysqli, $sqlquery)) {
            header("Location: ../Frontend/verification.php");
        } else {
            echo("database error");
            exit();

        }
        /* 
         while($row = mysqli_fetch_array($result)){ //returns row, so we store it in variable row
            echo $output;
            
            



            if(isset($_POST['remove'])){
                $idval = $_POST['remove'];
             } 
                $removal = "DELETE FROM nominations WHERE idNominations = ?";
                $statement = mysqli_stmt_init($connection);   
                
                if (!mysqli_stmt_prepare($statement, $removal)) { //checking that this info can be extracted for database/any errors in it
                    header("Location: ../Frontend/verification.php?error=databaseerror");
                    exit();
            
                } else {
                mysqli_stmt_bind_param($statement, "i", $idval);
                mysqli_stmt_execute($statement);
                header("Location: ../Frontend/verification.php");
            }  
         }
        }

*/
        
mysqli_close($connection);

  ?>