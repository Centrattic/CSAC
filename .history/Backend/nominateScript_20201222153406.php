<?php

require 'functions.php';

if(isset($_POST['submit_button'])){

    function fileNameGenerator($number, $questionName, $defaultName) {
        if(!isset($_FILES[$questionName]) || $_FILES[$questionName]['error'] == UPLOAD_ERR_NO_FILE) {
            ${'fileNameNew' . $number} = $defaultName;
        } else {
            $filenameprefix = preg_replace('/\s+/', '', $_POST['nameNominee1']);

            ${'file' . $number} = $_FILES[$questionName]; //files transmits file contents
            
            //getting file attributes
            ${'fileName' . $number} = ${'file' . $number}['name']; //gets name of file
            ${'fileTmpName' . $number} = ${'file' . $number}['tmp_name']; //gets temp location of file
            ${'fileSize' . $number} = ${'file' . $number}['size']; //gets size of file
            ${'fileError' . $number} = ${'file' . $number}['error']; //checks if error while uploading file
            ${'fileType' . $number} = ${'file' . $number}['type']; //gets type of file, /png
 
            //restricting file types
            ${'fileExt' . $number} = explode('.', $fileName[$number]); //splits file name into file name and file type
            ${'fileActualExt' . $number} = strtolower(end($fileExt[$number])); //makes file type lowercase
            if ($questionName = "resumeNominee") {
                ${'allowed' . $number} = array('docx', 'pdf');
            } else {
                ${'allowed' . $number} = array('jpg', 'png', 'jpeg');
            }
            ${'fileNameNew' . $number} = $filenameprefix . "_" . uniqid('','true').".". ${'fileActualExt' . $number}; //creates unqiue id for each image because if images have same name, gets overriden        

            //checks if correct file type is in file
            if(in_array(${'fileActualExt' . $number}, ${'allowed' . $number})){
                if(${'fileError' . $number} === 0) {
                    //0 means no error uploading
                    //restricting file size
                    if (${'fileSize' . $number} < 5000000)/*5000000 = 5mb */{
                        ${'fileDestination' . $number} = '../Images/'. ${'fileNameNew' . $number};
                        //uploading file function
                        move_uploaded_file(${'fileTmpName' . $number}, ${'fileDestination' . $number}); //moves file from temp location to real one
                        //header("Location: nomination.php?uploadSucess=1"); //brings back to heroes.php
                        #echo 'Success!!';
                    } else {
                        if($_POST['isYouth'] == 1) {
                            header("Location: ../Frontend/nomination.php?error=file_size>5MB");
                        } else if ($_POST['isYouth'] == 0) {
                            header("Location: ../Frontend/adultnomination.php?error=file_size>5MB");
                        }
                        exit();
                    }

                } else if(${'fileError' . $number} === 1) {
                    //1 means error uploading
                    if($_POST['isYouth'] == 1) {
                        header("Location: ../Frontend/nomination.php?error=can't_upload");
                    } else if ($_POST['isYouth'] == 0) {
                        header("Location: ../Frontend/adultnomination.php?error=can't_upload");
                    }
                    exit();
                }

            } elseif(!in_array(${'fileActualExt' . $number}, ${'allowed' . $number})) {
                if($_POST['isYouth'] == 1) {
                    header("Location: ../Frontend/nomination.php?error=wrong_file_type");
                } else if ($_POST['isYouth'] == 0) {
                    header("Location: ../Frontend/adultnomination.php?error=wrong_file_type");
                }
                exit();
            }
        } 
    }

    fileNameGenerator(1, "headshotNominee", "defaultservice.jpeg");
    fileNameGenerator(2, "pic2Nominee", "defaultservice.jpeg");
    fileNameGenerator(3, "pic3Nominee", "defaultservice.jpeg");
    fileNameGenerator(4, "resumeNominee", "5fe230c0cac4f3.24108706.pdf");

  /*  mail("pialityagi@gmail.com", "New CSAC Awards Submission!", "Another person has been nominated for a CSAC award.\n Sign in to review the nomination.");*/
 /*   $filenameprefix = preg_replace('/\s+/', '', $_POST['nameNominee1']);

        $file1 = $_FILES['headshotNominee']; //files transmits file contents
        
        //getting file attributes
        $fileName1 = $file['name']; //gets name of file
        $fileTmpName1 = $file['tmp_name']; //gets temp location of file
        $fileSize1 = $file['size']; //gets size of file
        $fileError1 = $file['error']; //checks if error while uploading file
        $fileType1 = $file['type']; //gets type of file, /png

        if ($fileSize1 === 0) {
            $fileNameNew1 = "defaulthero.png";

        } else {
            //restricting file types
            $fileExt1 = explode('.', $fileName); //splits file name into file name and file type
            $fileActualExt1 = strtolower(end($fileExt)); //makes file type lowercase
            $allowed1 = array('jpg', 'png', 'jpeg');
            $fileNameNew1 = $filenameprefix . "_" . uniqid('','true').".".$fileActualExt; //creates unqiue id for each image because if images have same name, gets overriden        

            //checks if correct file type is in file
            if(in_array($fileActualExt1, $allowed1)){
                if($fileError1 === 0) {
                    //0 means no error uploading
                    //restricting file size
                    if($fileSize1 < 5000000)/*5000000 = 5mb {
                        $fileDestination1 = '../Images/'.$fileNameNew1;
                        //uploading file function
                        move_uploaded_file($fileTmpName1, $fileDestination1); //moves file from temp location to real one
                        //header("Location: nomination.php?uploadSucess=1"); //brings back to heroes.php
                        #echo 'Success!!';
                    } else {
                        if($_POST['isYouth'] == 1) {
                            header("Location: ../Frontend/nomination.php?error=file_size>5MB");
                        } else if ($_POST['isYouth'] == 0) {
                            header("Location: ../Frontend/adultnomination.php?error=file_size>5MB");
                        }
                        exit();
                    }

                } else if($fileError1 === 1) {
                    //1 means error uploading
                    if($_POST['isYouth'] == 1) {
                        header("Location: ../Frontend/nomination.php?error=can't_upload");
                    } else if ($_POST['isYouth'] == 0) {
                        header("Location: ../Frontend/adultnomination.php?error=can't_upload");
                    }
                    exit();
                }

            } elseif(!in_array($fileActualExt1, $allowed1)) {
                if($_POST['isYouth'] == 1) {
                    header("Location: ../Frontend/nomination.php?error=wrong_file_type");
                } else if ($_POST['isYouth'] == 0) {
                    header("Location: ../Frontend/adultnomination.php?error=wrong_file_type");
                }
                exit();
            }
        }

/*-----------------------------------------------------------------------------*/
       /* $file2 = $_FILES['pic2Nominee']; //files transmits file contents
        
        //getting file attributes
        $fileName2 = $file2['name']; //gets name of file
        $fileTmpName2 = $file2['tmp_name']; //gets temp location of file
        $fileSize2 = $file2['size']; //gets size of file
        $fileError2 = $file2['error']; //checks if error while uploading file
        $fileType2 = $file2['type']; //gets type of file, /png

        if ($fileSize2 === 0) {
            $fileNameNew2 = "defaultservice.jpeg";

        } else {
            //restricting file types
            $fileExt2 = explode('.', $fileName2); //splits file name into file name and file type
            $fileActualExt2 = strtolower(end($fileExt2)); //makes file type lowercase
            $allowed2 = array('jpg', 'png', 'jpeg');
            $fileNameNew2 = $filenameprefix . "_" . uniqid('','true').".".$fileActualExt2; //creates unqiue id for each image because if images have same name, gets overriden        

            //checks if correct file type is in file
            if(in_array($fileActualExt2, $allowed2)){
                if($fileError2 === 0) {
                    //0 means no error uploading
                    //restricting file size
                    if($fileSize2 < 5000000)/*5000000 = 5mb {
                        $fileDestination2 = '../Images/'.$fileNameNew2;
                        //uploading file function
                        move_uploaded_file($fileTmpName2, $fileDestination2); //moves file from temp location to real one
                        header("Location: nomination.php?uploadSucess=1"); //brings back to heroes.php
                        #echo 'Success!!';
                    } else {
                        if($_POST['isYouth'] == 1) {
                            header("Location: ../Frontend/nomination.php?error=file_size>5MB");
                        } else if ($_POST['isYouth'] == 0) {
                            header("Location: ../Frontend/adultnomination.php?error=file_size>5MB");
                        }
                        exit();
                    }
                        
                } else if($fileError2 === 1) {
                    //1 means error uploading
                    if($_POST['isYouth'] == 1) {
                        header("Location: ../Frontend/nomination.php?error=can't_upload");
                    } else if ($_POST['isYouth'] == 0) {
                        header("Location: ../Frontend/adultnomination.php?error=can't_upload");
                    }
                    exit();
                }

            } elseif(!in_array($fileActualExt2, $allowed2)) {
                if($_POST['isYouth'] == 1) {
                    header("Location: ../Frontend/nomination.php?error=wrong_file_type");
                } else if ($_POST['isYouth'] == 0) {
                    header("Location: ../Frontend/adultnomination.php?error=wrong_file_type");
                }
                exit();
            }
        }
/*-----------------------------------------------------------------------------
        $file3 = $_FILES['pic3Nominee']; //files transmits file contents
        
        //getting file attributes
        $fileName3 = $file3['name']; //gets name of file
        $fileTmpName3 = $file3['tmp_name']; //gets temp location of file
        $fileSize3 = $file3['size']; //gets size of file
        $fileError3 = $file3['error']; //checks if error while uploading file
        $fileType3 = $file3['type']; //gets type of file, /png

        if ($fileSize3 === 0) {
            $fileNameNew3 = "../Images/defaultservice2.jpeg";

        } else {
            //restricting file types
            $fileExt3 = explode('.', $fileName3); //splits file name into file name and file type
            $fileActualExt3 = strtolower(end($fileExt3)); //makes file type lowercase
            $allowed3 = array('jpg', 'png', 'jpeg');
            $fileNameNew3 = $filenameprefix . "_" . uniqid('','true').".".$fileActualExt3; //creates unqiue id for each image because if images have same name, gets overriden        

            //checks if correct file type is in file
            if(in_array($fileActualExt3, $allowed3)){
                if($fileError3 === 0) {
                    //0 means no error uploading
                    //restricting file size
                    if($fileSize3 < 5000000)/*5000000 = 5mb {
                        $fileDestination3 = '../Images/'.$fileNameNew3;
                        //uploading file function
                        move_uploaded_file($fileTmpName3, $fileDestination3); //moves file from temp location to real one
                        header("Location: nomination.php?uploadSucess=1"); //brings back to heroes.php
                        #echo 'Success!!';
                    } else {
                        if($_POST['isYouth'] == 1) {
                            header("Location: ../Frontend/nomination.php?error=file_size>5MB");
                        } else if ($_POST['isYouth'] == 0) {
                            header("Location: ../Frontend/adultnomination.php?error=file_size>5MB");
                        }
                        exit();
                    }
                    
                } else if($fileError3 === 1) {
                    //1 means error uploading
                    if($_POST['isYouth'] == 1) {
                        header("Location: ../Frontend/nomination.php?error=can't_upload");
                    } else if ($_POST['isYouth'] == 0) {
                        header("Location: ../Frontend/adultnomination.php?error=can't_upload");
                    }
                    exit();
                }

            }elseif(!in_array($fileActualExt3, $allowed3)){
                if($_POST['isYouth'] == 1) {
                    header("Location: ../Frontend/nomination.php?error=wrong_file_type");
                } else if ($_POST['isYouth'] == 0) {
                    header("Location: ../Frontend/adultnomination.php?error=wrong_file_type");
                }
                exit();
            }
        } 

/*-----------------------------------------------------------------------------*/
        /*$file = $_FILES['resumeNominee']; //files transmits file contents *** THIS SHOULD ALSO BE ADDITIONAL INFORMATION
        
        //getting file attributes
        $fileName = $file['name']; //gets name of file
        $fileTmpName = $file['tmp_name']; //gets temp location of file
        $fileSize = $file['size']; //gets size of file
        $fileError = $file['error']; //checks if error while uploading file
        $fileType = $file['type']; //gets type of file, /png

        if ($fileSize === 0) {
            $fileNameResume = "";
        } else {

            //restricting file types
            $fileExt = explode('.', $fileName); //splits file name into file name and file type
            $fileActualExt = strtolower(end($fileExt)); //makes file type lowercase
            $allowed = array('pdf', 'docx');
            $fileNameResume = $filenameprefix . "_" . uniqid('','true').".".$fileActualExt; //creates unqiue id for each image because if images have same name, gets overriden        

            //checks if correct file type is in file
            if(in_array($fileActualExt, $allowed)){
                if($fileError === 0) {
                    //0 means no error uploading
                    //restricting file size
                    if($fileSize < 5000000)/*5000000 = 5mb {
                        $fileDestination = '../Images/'.$fileNameResume;
                        //uploading file function
                        move_uploaded_file($fileTmpName, $fileDestination); //moves file from temp location to real one
                        //header("Location: ../Frontend/nomination.php?uploadSucess=1"); //brings back to heroes.php
                        #echo 'Success!!';
                    } else {
                        if($_POST['isYouth'] == 1) {
                            header("Location: ../Frontend/nomination.php?error=file_size>5MB");
                        } else if ($_POST['isYouth'] == 0) {
                            header("Location: ../Frontend/adultnomination.php?error=file_size>5MB");
                        }
                        exit();
                        //echo 'Your file is too big! Try uploading another file!'; // doesn't even appear rip b/c this happens after upload ....
                    }
                } else if($fileError === 1) {
                    //1 means error uploading
                    if($_POST['isYouth'] == 1) {
                        header("Location: ../Frontend/nomination.php?error=can't_upload");
                    } else if ($_POST['isYouth'] == 0) {
                        header("Location: ../Frontend/adultnomination.php?error=can't_upload");
                    }
                    exit();
                    //echo 'There was an error uploading your file';
                }
            } elseif(!in_array($fileActualExt, $allowed)) {
                if($_POST['isYouth'] == 1) {
                    header("Location: ../Frontend/nomination.php?error=wrong_file_type");
                } else if ($_POST['isYouth'] == 0) {
                    header("Location: ../Frontend/adultnomination.php?error=wrong_file_type");
                }
                exit();
                //echo 'Wrong file type. Only pdf or docx is allowed';
            }
        } */
/*-----------------------------------------------------------------------------*/
        $groupName = $_POST['groupName'];
        $nameNominee1 = $_POST['nameNominee1'];

        if ($groupName === '') {
            $groupName = $nameNominee1;
        }

        $isYouth = $_POST['isYouth'];

        if ($isYouth == 1) {
            $gradeNominee1 = "Gr. " . $_POST['gradeNominee1'];
            $emailParent1 = $_POST['emailParent1'];
            $schoolNominee1 = $_POST['schoolNominee1'];
            $nameParent1 = $_POST['nameParent1'];
        } else if ($isYouth == 0) {
            $gradeNominee1 = '';
            $emailParent1 = '';
            $schoolNominee1 = '';
            $nameParent1 = '';
        }

        $nameNominee2 = $_POST['nameNominee2'];
        $nameNominee3 = $_POST['nameNominee3'];
        $nameNominee4 = $_POST['nameNominee4'];
        $ageNominee1 = $_POST['ageNominee1'] . " yrs";

        $ageNominee2 = ''; /* Useless*/
        $ageNominee3 = ''; /* Useless*/
        $ageNominee4 = ''; /* Useless*/
        

        $gradeNominee2 = ''; /* Useless*/
        $gradeNominee3 = ''; /* Useless*/
        $gradeNominee4 = ''; /* Useless*/

        $phoneParent1 = $_POST['phoneParent1'];

        

        $emailNominee1 = $_POST['emailNominee1'];
        $emailNominee2 = $_POST['emailNominee2'];
        $emailNominee3 = $_POST['emailNominee3'];
        $emailNominee4 = $_POST['emailNominee4'];
        

        
        $schoolNominee2 = ''; /* Useless*/
        $schoolNominee3 = ''; /* Useless*/
        $schoolNominee4 = ''; /* Useless*/

        
        $nameParent2 = ''; /* Useless*/
        $nameParent3 = ''; /* Useless*/
        $nameParent4 = ''; /* Useless*/

        
        $emailParent2 = ''; /* Useless*/
        $emailParent3 = ''; /* Useless*/
        $emailParent4 = ''; /* Useless*/
        
        $phoneParent2 = ''; /* Useless*/
        $phoneParent3 = ''; /* Useless*/
        $phoneParent4 = ''; /* Useless*/
      

        $nameNominator = $_POST['nameNominator'];
        $emailNominator = $_POST['emailNominator'];
        $phoneNominator = $_POST['phoneNominator'];

        $mediaRelease = ''; /* Useless*/

        date_default_timezone_set("America/New_York");
        $timeSubmission = getCurrentTime();
        $yearNomination = date("Y");


        $headshotNominee = $fileNameNew1;
        $pic2Nominee = $fileNameNew2;
        $pic3Nominee = $fileNameNew3;
        $resumeNominee = $fileNameNew4;

        $Captionpic2Nominee = $_POST['Captionpic2Nominee'];
        $Captionpic3Nominee = $_POST['Captionpic3Nominee'];

        $bioNominee = ''; /* Useless*/

        $workNominee = $_POST['workNominee'];

        $twitterNominee = ''; /* Useless*/
        $newsNominee = ''; /* Useless*/
        $websiteNominee = ''; /* Useless*/

        $facebookNominee = $_POST['facebookNominee'];
        $instagramNominee = $_POST['instagramNominee'];
        
        $statusNominee = 'submitted';
        

      /*  if ($isYouth == 1) {
            if ($ageNominee1 != "")  { $ageNominee1 = "Grade " .  $ageNominee1; }
            if ($ageNominee2 != "")  { $ageNominee2 = "Grade " .  $ageNominee2; }
            if ($ageNominee3 != "")  { $ageNominee3 = "Grade " .  $ageNominee3; }
            if ($ageNominee4 != "")  { $ageNominee4 = "Grade " .  $ageNominee4; }
        }*/

        $sqlquery = "INSERT INTO nominations (
        groupName, nameNominee1, nameNominee2, nameNominee3, nameNominee4, 
        ageNominee1, ageNominee2, ageNominee3, ageNominee4, 
        gradeNominee1, gradeNominee2, gradeNominee3, gradeNominee4, 
        emailNominee1, emailNominee2, emailNominee3, emailNominee4, 
        schoolNominee1, schoolNominee2, schoolNominee3, schoolNominee4, 
        nameParent1, nameParent2, nameParent3, nameParent4, 
        emailParent1, emailParent2, emailParent3, emailParent4, 
        phoneParent1, phoneParent2, phoneParent3, phoneParent4, 
        nameNominator, emailNominator, phoneNominator, mediaRelease, timeSubmission,
        headshotNominee, pic2Nominee, captionPic2, pic3Nominee, captionPic3, 
        bioNominee, workNominee, twitterNominee, facebookNominee, instagramNominee, 
        newsNominee, websiteNominee, statusNominee, isYouth, yearNomination, resumeNominee
        ) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"; //need to bind params for placeholders to work // nameNominee is storing allinfo
        
        $connection = connectToDB();
        $statement = mysqli_stmt_init($connection); 


        //prepare statement
        if(!mysqli_stmt_prepare($statement, $sqlquery)){
            mysqli_close($connection);
            header("Location: ../Frontend/nomination.php?/unsuccessful"); //brings back to heroes.php
        } else {
            //storing info in database (3 params of info)
            mysqli_stmt_bind_param($statement, "ssssssssssssssssssssssssssssssssssssissssssssssssssiis", //ints are booleans, 1 if true, 0 if false
            $groupName,$nameNominee1,$nameNominee2,$nameNominee3,$nameNominee4,
            $ageNominee1,$ageNominee2,$ageNominee3,$ageNominee4,
            $gradeNominee1,$gradeNominee2,$gradeNominee3,$gradeNominee4,
            $emailNominee1,$emailNominee2,$emailNominee3,$emailNominee4,
            $schoolNominee1,$schoolNominee2,$schoolNominee3,$schoolNominee4,
            $nameParent1,$nameParent2,$nameParent3,$nameParent4,
            $emailParent1,$emailParent2,$emailParent3,$emailParent4,
            $phoneParent1,$phoneParent2,$phoneParent3,$phoneParent4,
            $nameNominator,$emailNominator,$phoneNominator,$mediaRelease,$timeSubmission,
            $headshotNominee,$pic2Nominee,$Captionpic2Nominee,$pic3Nominee,$Captionpic3Nominee,
            $bioNominee,$workNominee,$twitterNominee,$facebookNominee,$instagramNominee,
            $newsNominee,$websiteNominee,$statusNominee,$isYouth,$yearNomination,$resumeNominee
            );
            if (mysqli_error($connection) != '') {
                mysqli_close($connection);
                header("Location: ../Frontend/nomination.php?error=unsuccessful_bind");
                exit();
            }

            mysqli_stmt_execute($statement);
            if (mysqli_error($connection) != '') {
                header("Location: ../Frontend/nomination.php?error=unsuccessful_execute-". $_GET[mysqli_error($connection)]);
                exit();
            }

            mysqli_stmt_store_result($statement);
            if (mysqli_error($connection) != '') {
                mysqli_close($connection);
                header("Location: ../Frontend/nomination.php?error=unsuccessful_store");
                exit();
            }

            mysqli_stmt_close($statement);
            mysqli_close($connection);
            header("Location: ../Frontend/viewheroes.php?type=currentwinners"); //brings back to heroes.php
        }   



}


?>
