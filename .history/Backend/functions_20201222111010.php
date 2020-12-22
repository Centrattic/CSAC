<?php

if (!function_exists('getCurrentTime'))   {
    function getCurrentTime() {
    date_default_timezone_set("America/New_York"); //
    return date("m/d/Y, h:i:sa"). " EST";
    }
}

if (!function_exists('searchBar'))   {
    function searchBar() {
        echo '<form action = "connectHeroScript.php" method = "post">
        <input type = "text" name = "Search" placeholder = "Search for Heroes by Category" style = "width: 18.5%; height: 5%; font-size: 1.25em; margin-left: 2%; margin-top: 2%; margin-right: 2%;">
        <input type = "submit" value = "Go" style = "width: 5%; height: 5%; font-size: 1.25em; margin-left: -1.5%;">
        </form>';
    }
}

if (!function_exists('checkForError')) {
    function checkForError() {
        echo("<span class = 'error-message' style = 'color:red; font-size: 1.25em; font-weight: 500;'>");
        if(isset($_GET['error']))
        echo 'Error: '. $_GET['error'];
      echo("</span>");
  
    }
}


if (!function_exists('connectToDB'))   {

    function connectToDB() {
        
        //prepared statement for security
        $database = "localhost";
        $username = "troopsho_yhuser";
        $password = "6ZFvFCUWHu9"; //password might change
        $connection = mysqli_connect($database, $username, $password) or die ("could not connect");
        $connection->select_db("troopsho_yh") or die("could not find database"); //DistanceHacks might change based on name of database
        return $connection;
        
    }
}

if (!function_exists('navbar'))   {

    function navbar($formstatus = null) {
        #session_start(); //session.start CANT be here since then since navbar is in the body, stuff outputs before this
        echo('
        
        <nav>
            <div class = "navbar">

                <ul class="menu-area">');

                echo ('
                <li>
                <div id = "logo">
                    <img src = "../Images/CSAClogo.png">
                </div>
                </li>');
                
                echo('
                <li class = "non-dropdown"><a class = "navlink" href = "home.php">Home</a></li>
                <li class = "non-dropdown"><a class = "navlink" href="adultnomination.php">Adult Nomination</a></li>
                <li class = "non-dropdown"><a class = "navlink" href="nomination.php">Youth Nomination</a></li>
                ');

                
                echo('<li class="nav-dropdown">
                <a href="javascript:void(0)" class="nav-dropbtn">View Heroes</a>
                <div class="dropdown-content">
                    <a class = "navlink" href="viewheroes.php?type=currentwinners">Current Winners</a> <!-- Winners chosen in December and naturally lasting one year after chosen date?-->
                    <a class = "navlink" href="viewheroes.php?type=pastwinners">Past Winners</a>
                    <a class = "navlink" href="before2020.php">Award Recipients</a> 
                </div>
            </li>');
                if(isset($_SESSION['UserID'])){
                   echo("
                        <li class='nav-dropdown'>
                            <a href='javascript:void(0)' class='nav-dropbtn'>Admin Features</a>
                            <div class='dropdown-content'>
                                <a class = 'navlink' href='admin.php?type=submitted'>Verify Nominations</a>
                                <a class = 'navlink' href='admin.php?type=archived'>Archived Heroes</a>
                                <a class = 'navlink' href='admin.php?type=editwinners'>Edit Winners</a>
                                <a class = 'navlink' href = 'auditlog.php'> Audit Log </a>
                            </div>
                        </li>
                        ");
                } else {
                    echo('');
                }


              if(!isset($_SESSION['UserID'])) {
                echo '<li class = "non-dropdown">
                    <a class = "navlink" href = "loginpage.php"> Admin</a>
                  </li>';
              } else {
                  echo('<li> 
                  <form id = "logout" action = "../Backend/logoutscript.php" method = "post">      
                  <button style = "border-radius: 0px" onclick = "logout();" type = "submit" name = "logout-submit">Logout</button> 
                  </form>
                </li>');
              }

            //input of password and username set up
            //button to submit entry form
            // sign up form

          echo('</ul>
          </div>
      </nav> 

      <style>
              #logo {                
                  display: inline-flex;
                  align-items: end;
                  justify-content: center;
                  width: 10%;
                  float: left;
                  height: 10%;
               }
            
            #logo img {     
                width: 90px;
                height:125px;
            }
            
        </style>
      ');

    }
}

if (!function_exists('footer')) {
    function footer() {
        echo('<footer id="colophon" class="site-footer" role="contentinfo">
      <div class="social-wrapper">
        <ul>
          <li>
            <a href="#" target="_blank">
              <img src="https://cdn1.iconfinder.com/data/icons/logotypes/32/twitter-128.png" alt="Twitter Logo" class="twitter-icon"></a>
          </li>
          <li>
            <a href="#" target="_blank">
              <img src="https://www.mchenryvillage.com/images/instagram-icon.png" alt="Instagram Logo" class="instagram-icon"></a>
          </li>
          <li>
            <a href="#" target="_blank">
              <img src="https://content.linkedin.com/content/dam/me/business/en-us/amp/brand-site/v2/bg/LI-Bug.svg.original.svg" alt="Linkedin Logo" class="linkedin-icon"></a>
          </li>
          <li>
            <a href="#" target="_blank">
              <img src="http://www.iconarchive.com/download/i54037/danleech/simple/facebook.ico" alt="Facebook Logo" class="facebook-icon"></a>
          </li>
          
        </ul>
      </div>

      <nav class="footer-nav" role="navigation">
        <p>Copyright &copy;
          <?php echo date("Y"); ?> All rights reserved.</p>
      </nav>
    </footer>');
    }
}




if (!function_exists('generateVerifiedHeroes'))   {

    function generateVerifiedHeroes() {
        
        $mysqli = connectToDB();
        
        //collecting info from form
        /*if(isset($_POST['Search'])){ //Since everything wrapped in this post search, nothing appears until we search. If I want to change that, go here
            
            $searchq = $_POST['Search'];*/
            //filter out chars that are not nums because only searching for zip code
            //$searchq = preg_replace("#[^0-9]#", "", $searchq); //replaces all chars of searchq that are not a num with blank
            
            //sql query to search database
            $sqlquery = "SELECT * FROM nominations WHERE statusNominee = 'submitted' ";

            $result = $mysqli->query($sqlquery) or die ("could not search");

            $count = mysqli_num_rows($result);
            $index=0;
        
            if ($count == 0){
                echo "<p><br><br>There are no heroes for verification.</p>"; //eventually make it so that verified heroes no longer appear in the verify nominations area.
            } else {
                echo "<br><p style = 'font-size: 1.25em;'> Found $count Heroes!</p><br><br>";

                while($row = mysqli_fetch_array($result)){

                    $idNominations = $row['idNominations'];

                    $groupName = $row['groupName'];
                    $nameNominee1 = $row['nameNominee1'];
                    $nameNominee2 = $row['nameNominee2'];
                    $nameNominee3 = $row['nameNominee3'];
                    $nameNominee4 = $row['nameNominee4'];
                    $ageNominee1 = $row['ageNominee1'];
                    $ageNominee2 = $row['ageNominee2'];
                    $ageNominee3 = $row['ageNominee3'];
                    $ageNominee4 = $row['ageNominee4'];
                    $emailNominee1 = $row['emailNominee1'];
                    $emailNominee2 = $row['emailNominee2'];
                    $emailNominee3 = $row['emailNominee3'];
                    $emailNominee4 = $row['emailNominee4'];
                    $schoolNominee1 = $row['schoolNominee1'];
                    $schoolNominee2 = $row['schoolNominee2'];
                    $schoolNominee3 = $row['schoolNominee3'];
                    $schoolNominee4 = $row['schoolNominee4'];
                    $nameParent1 = $row['nameParent1'];
                    $nameParent2 = $row['nameParent2'];
                    $nameParent3 = $row['nameParent3'];
                    $nameParent4 = $row['nameParent4'];
                    $emailParent1 = $row['emailParent1'];
                    $emailParent2 = $row['emailParent2'];
                    $emailParent3 = $row['emailParent3'];
                    $emailParent4 = $row['emailParent4'];
                    $phoneParent1 = $row['phoneParent1'];
                    $phoneParent2 = $row['phoneParent2'];
                    $phoneParent3 = $row['phoneParent3'];
                    $phoneParent4 = $row['phoneParent4'];
                    $nameNominator = $row['nameNominator'];
                    $emailNominator = $row['emailNominator'];
                    $phoneNominator = $row['phoneNominator'];
                    $mediaRelease = $row['mediaRelease'];
                    $timeSubmission = $row['timeSubmission'];

                    $headshotNominee = $row['headshotNominee'];
                    $pic2Nominee = $row['pic2Nominee'];
                    $pic3Nominee = $row['pic3Nominee'];

                    $bioNominee = $row['bioNominee'];
                    $workNominee = $row['workNominee'];
                    $twitterNominee = $row['twitterNominee'];
                    $facebookNominee = $row['facebookNominee'];
                    $instagramNominee = $row['instagramNominee'];
                    $newsNominee = $row['newsNominee'];
                    $websiteNominee = $row['websiteNominee'];
                    $statusNominee = $row['statusNominee'];
                    $isYouth = $row['isYouth'];
                    

                    if ($headshotNominee == "") {
                        $headshotNominee = "defaulthero.png";
                    }

                    if ($pic2Nominee == "") {
                        $pic2Nominee = "defaultservice.jpeg";
                    }

                    if ($pic3Nominee == "") {
                        $pic3Nominee = "defaultservice2.jpeg";
                    }

                    /*

                    $newslinktext = "";
                    if ($news != "") {
                        $newslinktext="Hero's News Link";
                    }
                    */

                    if ($groupName === "") {
                        $groupName = $nameNominee1;
                    }
                
                    $output = "

                        <div class = 'no-print'>
                            <a class = 'removelink' href = ../Backend/removeHeroesScript.php?id=$idNominations> ARCHIVE/REMOVE </a>
                            <a class = 'approvelink' href = ../Backend/approveHeroesScript.php?id=$idNominations> MAKE WINNER </a>
                        </div>
                        <div class = 'print heroWrapper'>

                            <div class = 'heroGrid1'>
                            
                                <div class = 'name-item'> 
                                    $groupName
                                </div>

                                <div class = 'members-item'>
                                    <b class = 'grid-title'> Group Members </b> <br>

                                    <table class = 'membertable'>
                                    <tr>
                                        <th>Name</th>
                                        <th>Grade</th>
                                        <th>School Name</th>
                                        <th>Email</th>
                                        <th>Parent Name</th>
                                        <th>Parent Email</th>
                                        <th>Parent Phone</th>
                                    </tr> 
                                        <tr>
                                            <td>$nameNominee1</td>
                                            <td>$ageNominee1</td>
                                            <td>$schoolNominee1</td>
                                            <td>$emailNominee1</td>
                                            <td>$nameParent1</td>
                                            <td>$emailParent1</td>
                                            <td>$phoneParent1</td>
                                        </tr> 
                                        <tr>
                                            <td>$nameNominee2</td>
                                            <td>$ageNominee2</td>
                                            <td>$schoolNominee2</td>
                                            <td>$emailNominee2</td>
                                            <td>$nameParent2</td>
                                            <td>$emailParent2</td>
                                            <td>$phoneParent2</td>
                                        </tr> 
                                        <tr>
                                            <td>$nameNominee3</td>
                                            <td>$ageNominee3</td>
                                            <td>$schoolNominee3</td>
                                            <td>$emailNominee3</td>
                                            <td>$nameParent3</td>
                                            <td>$emailParent3</td>
                                            <td>$phoneParent3</td>
                                        </tr> 

                                        <tr>
                                            <td>$nameNominee4</td>
                                            <td>$ageNominee4</td>
                                            <td>$schoolNominee4</td>
                                            <td>$emailNominee4</td>
                                            <td>$nameParent4</td>
                                            <td>$emailParent4</td>
                                            <td>$phoneParent4</td>
                                        </tr>
                                    </table>
                            
                                </div>
                                
                                <div class = 'headshot-item'> 
                                    <img class = 'headshot' src= '../Images/$headshotNominee'>
                                </div>
                                <div class = 'bio-item'> 
                                    <b class = 'gridtitle-'> Hero's Biography </b> <br>
                                    $bioNominee
                                </div>
                                <div class = 'work-item'> 
                                    <b class = 'grid-title'> Hero's Work </b> <br>
                                    $workNominee
                                </div>

                            </div>

                            <div class = 'heroGrid2'>

                                <div class = 'contact-item'>
                                <div class = 'contact-info'> <b class = 'grid-title'> Hero's Contact </b> </div> <br>
                                    <div class = 'social'>
                                        <b> Twitter:</b> <a class = 'sociallink' target = '_blank' href = '$twitterNominee'>Twitter Link</a> <br>
                                        <b> Facebook: </b> <a class = 'sociallink' target = '_blank' href = '$facebookNominee'>Facebook Link</a>  <br>
                                        <b> Instagram: </b> <a class = 'sociallink' target = '_blank' href = '$instagramNominee'>Instagram Link </a>
                                    </div>
                                    <div class = 'social1'>
                                        <b> News Link: </b> <a class = 'sociallink' target = '_blank' href = '$newsNominee'> News Link</a> <br>
                                        <b> Website: </b> <a class = 'sociallink' target = '_blank' href = '$websiteNominee'> Website Link </a>
                                    </div>
                                </div>

                                <div class = 'pic2-item'> 
                                    <img class = 'pic2-pic' src= '../Images/$pic2Nominee'>
                                </div>
                                <div class = 'pic3-item'> 
                                    <img class = 'pic3-pic' src= '../Images/$pic3Nominee'>
                                </div>
                                <div class = 'nominator-item'> 
                                    <p><b>Nominated by: </b> $nameNominator, $emailNominator, $phoneNominator</p> 
                                    <p> <b> Submission Time: </b> $timeSubmission UTC</p>
                                </div>
                            </div>
                    </div>";

                    
                    echo $output;


                        $index++;              

            }


            mysqli_free_result($result);
        }


        mysqli_close($mysqli);

        /*echo('
        <form method = "post" action = "../Frontend/connectHeroScript.php">
            <button class = "approve-all" name = "approve" type = "submit"> Approve All Heroes </button>
        </form>');*/

        echo ('
                    <style>

                        .removelink, .approvelink {
                            all: unset;
                            text-decoration: none;
                            padding: 5px;
                            width: 20%;
                            font-size: 1.25em;
                            margin: 5px;
                        }

                        .removelink {
                            background-color: red;
                        }

                        .approvelink {
                            background-color: green;
                        }
     
                        </style>

                        ');
    }
}


if (!function_exists('generateHeroesListing'))   {

    function generateHeroesListing($type) {
        
        // type can be:
        // 1. archived  :  (ADMIN role) show archieve and allow them to unarchieve which will convert to submitted
        // 2. submitted : (ADMIN role) show submitted ones and allow to make winner or archieve
        // 3. editwinner : (ADMIN role) Show list of winners and allow them to "remove winner to archieve" which will make them submitted
        // 5. currentwinners : grid  of current winners
        // 4. pastwinners : grid of past winners

        $mysqli = connectToDB();
        
        //collecting info from form
        /*if(isset($_POST['Search'])){ //Since everything wrapped in this post search, nothing appears until we search. If I want to change that, go here
            
            $searchq = $_POST['Search'];*/
            //filter out chars that are not nums because only searching for zip code
            //$searchq = preg_replace("#[^0-9]#", "", $searchq); //replaces all chars of searchq that are not a num with blank
            
            //sql query to search database
            $sqlquery = "SELECT * FROM nominations WHERE statusNominee = 'nothing' ";
            if ($type === "submitted" || $type === "currentnominations") {
                $sqlquery = "SELECT * FROM nominations WHERE statusNominee = 'submitted' ";
                
            } elseif ($type === "archived") {
                $sqlquery = "SELECT * FROM nominations WHERE statusNominee = 'archived' ";
            } elseif ($type === "editwinners") {
                $sqlquery = "SELECT * FROM nominations WHERE statusNominee = 'winner' ";
            } elseif ($type === "editpastwinners") {
                $sqlquery = "SELECT * FROM nominations WHERE statusNominee = 'pastwinner' ";
            } elseif ($type === "currentwinners") {
                $sqlquery = "SELECT * FROM nominations WHERE statusNominee = 'winner' "; /* AND yearNomination =" . date(Y);*/
            } elseif ($type === "pastwinners") {
                $sqlquery = "SELECT * FROM nominations WHERE statusNominee = 'pastwinner' ";
            }

            $result = $mysqli->query($sqlquery) or die ("could not search");

            $count = mysqli_num_rows($result);
            $index=0;
        
            if ($count === 0){
                echo "<p><br><br>There are no heroes in this section.</p>"; //eventually make it so that verified heroes no longer appear in the verify nominations area.
            } else {
                echo "<br><p style = 'font-size: 1.25em;'> Found $count Heroes!</p><br><br>";

                while($row = mysqli_fetch_array($result)){

                    $idNominations = $row['idNominations'];

                    $groupName = $row['groupName'];
                    $nameNominee1 = $row['nameNominee1'];
                    $nameNominee2 = $row['nameNominee2'];
                    $nameNominee3 = $row['nameNominee3'];
                    $nameNominee4 = $row['nameNominee4'];
                    $ageNominee1 = $row['ageNominee1'];
                    $ageNominee2 = $row['ageNominee2'];
                    $ageNominee3 = $row['ageNominee3'];
                    $ageNominee4 = $row['ageNominee4'];

                    $gradeNominee1 = $row['gradeNominee1'];
                    $gradeNominee2 = $row['gradeNominee2'];
                    $gradeNominee3 = $row['gradeNominee3'];
                    $gradeNominee4 = $row['gradeNominee4'];

                    $emailNominee1 = $row['emailNominee1'];
                    $emailNominee2 = $row['emailNominee2'];
                    $emailNominee3 = $row['emailNominee3'];
                    $emailNominee4 = $row['emailNominee4'];
                    $schoolNominee1 = $row['schoolNominee1'];
                    $schoolNominee2 = $row['schoolNominee2'];
                    $schoolNominee3 = $row['schoolNominee3'];
                    $schoolNominee4 = $row['schoolNominee4'];
                    $nameParent1 = $row['nameParent1'];
                    $nameParent2 = $row['nameParent2'];
                    $nameParent3 = $row['nameParent3'];
                    $nameParent4 = $row['nameParent4'];
                    $emailParent1 = $row['emailParent1'];
                    $emailParent2 = $row['emailParent2'];
                    $emailParent3 = $row['emailParent3'];
                    $emailParent4 = $row['emailParent4'];
                    $phoneParent1 = $row['phoneParent1'];
                    $phoneParent2 = $row['phoneParent2'];
                    $phoneParent3 = $row['phoneParent3'];
                    $phoneParent4 = $row['phoneParent4'];
                    $nameNominator = $row['nameNominator'];
                    $emailNominator = $row['emailNominator'];
                    $phoneNominator = $row['phoneNominator'];
                    $mediaRelease = $row['mediaRelease'];
                    $timeSubmission = $row['timeSubmission'];

                    $headshotNominee = $row['headshotNominee'];
                    $pic2Nominee = $row['pic2Nominee'];
                    $pic3Nominee = $row['pic3Nominee'];     

                    $bioNominee = $row['bioNominee'];
                    $workNominee = $row['workNominee'];
                    $twitterNominee = $row['twitterNominee'];
                    $facebookNominee = $row['facebookNominee'];
                    $instagramNominee = $row['instagramNominee'];    
                    $newsNominee = $row['newsNominee'];
                    $websiteNominee = $row['websiteNominee'];

                    $statusNominee = $row['statusNominee'];
                    $isYouth = $row['isYouth'];
                    $resumeNominee = $row['resumeNominee'];
                    

                    if ($headshotNominee == "") {
                        $headshotNominee = "defaulthero.png";
                    }

                    if ($pic2Nominee == "") {
                        $pic2Nominee = "defaultservice.jpeg";
                    }

                    if ($pic3Nominee == "") {
                        $pic3Nominee = "defaultservice2.jpeg";
                    }

                    /*

                    $newslinktext = "";
                    if ($news != "") {
                        $newslinktext="Hero's News Link";
                    }
                    */

                    /*if ($groupName === "") {
                        $groupName = $nameNominee1;
                    } I put this directly into db stores*/

                    if ($type === "submitted") {
                        $editHeroButtons = "
                        <a class = 'removelink' href = ../Backend/editHeroesScript.php?newstatus=archived&type=$type&id=$idNominations> ARCHIVE </a>
                        <a class = 'approvelink' href = ../Backend/editHeroesScript.php?newstatus=winner&type=$type&id=$idNominations> MAKE WINNER </a>";
                    } elseif ($type === "archived") {
                        $editHeroButtons = "
                        <a class = 'removelink' href = ../Backend/editHeroesScript.php?newstatus=submitted&type=$type&id=$idNominations> UNARCHIVE </a>
                        <a class = 'approvelink' href = ../Backend/editHeroesScript.php?newstatus=winner&type=$type&id=$idNominations> MAKE WINNER </a>";
                    } elseif ($type === "editwinners") {
                        $editHeroButtons = "
                        <a class = 'removelink' href = ../Backend/editHeroesScript.php?newstatus=submitted&type=$type&id=$idNominations> REMOVE WINNER STATUS</a>
                        <a class = 'removelink' href = ../Backend/editHeroesScript.php?newstatus=archived&type=$type&id=$idNominations> ARCHIVE </a>
                        <a class = 'approvelink' href = ../Backend/editHeroesScript.php?newstatus=pastwinner&type=$type&id=$idNominations> MAKE PAST WINNER </a>";
                    } elseif ($type === "editpastwinners") {
                        $editHeroButtons = "
                        <a class = 'approvelink' href = ../Backend/editHeroesScript.php?newstatus=winner&type=$type&id=$idNominations> MAKE CURRENT WINNER</a>";
                    } else {
                        $editHeroButtons = "";
                    }

                    if ($isYouth == 1) {
                        $youthAdult = "Youth Nomination";
                        $headerstr = "<th>Grade</th> <th>School Name</th>";

                    } elseif ($isYouth == 0) {
                        $youthAdult = "Adult Nomination";
                        $headerstr = "";
                    }

                   /* if ($type === "currentnominations") {
                        $output = "
                            <li> $groupName </li>
                        "; }*/

                    if ($type === "currentwinners" || $type === "pastwinners") {
                        if($isYouth == 1) {
                            $memberInfo1 = "<tr> <td>$nameNominee1 </td> <td>$ageNominee1</td> <td> $gradeNominee1</td> <td>$schoolNominee2</td></tr>";
                            $memberInfo2 = "<tr> <td>$nameNominee2</td> <td>$ageNominee2</td> <td> $gradeNominee2</td> <td>$schoolNominee2</td> </tr>";
                            $memberInfo3 = "<tr> <td>$nameNominee3</td> <td>$ageNominee3</td> <td> $gradeNominee3</td> <td>$schoolNominee3</td> </tr>";
                            $memberInfo4 = "<tr> <td>$nameNominee4</td> <td>$ageNominee3</td> <td> $gradeNominee3</td> <td>$schoolNominee4</td> </tr>";
                        } else if ($isYouth == 0) {
                            $memberInfo1 = "<tr> <td>$nameNominee1 </td> <td>$ageNominee1</td></tr>";
                            $memberInfo2 = "<tr> <td>$nameNominee2</td> <td>$ageNominee2</td></tr>";
                            $memberInfo3 = "<tr> <td>$nameNominee3</td> <td>$ageNominee3</td></tr>";
                            $memberInfo4 = "<tr> <td>$nameNominee4</td> <td>$ageNominee3</td></tr>";
                        }

                        if ($nameNominee2 === "") { $memberInfo2 = ""; }
                        if ($nameNominee3 === "") { $memberInfo3 = ""; }
                        if ($nameNominee4 === "") { $memberInfo4 = ""; }
                        
                        $output = "

                        <div class = 'no-print'>
                            $editHeroButtons   
                        </div>

                        <div class = 'print heroViewWrapper'>

                                <div class = 'name-item'> 
                                    $groupName
                                </div>

                                <div class = 'youth-adult-item'>
                                    $youthAdult
                                </div>

                                <div class = 'members-item'>
                                    <b class = 'grid-title'> Group Members </b> <br>

                                    <table class = 'membertable'>
                                    <tr>
                                        <th>Name</th>
                                        <th>Age</th>
                                        $headerstr
                                    </tr> 
                                        $memberInfo1 
                                        $memberInfo2 
                                        $memberInfo3 
                                        $memberInfo4
                                    </table>
                                </div>
                                
                                <div class = 'headshot-item'> 
                                    <img class = 'headshot' src= '../Images/$headshotNominee'>
                                </div>

                                <!-- COMMENTED OUT
                                <div class = 'bio-item'> 
                                    <b class = 'gridtitle-'> Hero's Biography </b> <br>
                                    $bioNominee
                                </div>-->
                                <div class = 'work-item'> 
                                    <b class = 'grid-title'> Hero's Work </b> <br>
                                    $workNominee
                                </div>

                                <div class = 'pic2-item'> 
                                    <img class = 'pic2-pic' src= '../Images/$pic2Nominee'>
                                </div>
                                <div class = 'pic3-item'> 
                                    <img class = 'pic3-pic' src= '../Images/$pic3Nominee'>
                                </div>
                    </div>";
                        
                    } else {
                        //Admin page

                        $memberInfo1 = "<tr> <td>$nameNominee1</td> <td>$emailNominee1</td>  <td> $ageNominee1</td> <td>$gradeNominee1</td> <td>$schoolNominee1</td>";
                        $memberInfo2 = "<tr> <td>$nameNominee2</td> <td>$emailNominee2</td>  <td>  $ageNominee2</td>  <td>$gradeNominee2</td> <td>$schoolNominee2</td>";
                        $memberInfo3 = "<tr> <td>$nameNominee3</td> <td>$emailNominee3</td> <td>  $ageNominee3</td> <td>$gradeNominee3</td>  <td>$schoolNominee3</td>";
                        $memberInfo4 = "<tr> <td>$nameNominee4</td> <td>$emailNominee4</td> <td>  $ageNominee4</td> <td>$gradeNominee4</td> <td>$schoolNominee4</td>";

                        if ($isYouth == "1") {
                            $headerstr = "<th>Grade</th> <th>School Name</th> ";
                            /*$headerstr= "<th>Parent Name</th><th>Parent Email</th> <th>Parent Phone</th>";
                            $memberInfo1 = $memberInfo1 . "<td>$nameParent1</td> <td>$emailParent1</td> <td>$phoneParent1</td> </tr>";
                            $memberInfo2 = $memberInfo2 . "<td>$nameParent2</td> <td>$emailParent2</td> <td>$phoneParent2</td> </tr>";
                            $memberInfo3 = $memberInfo3 . "<td>$nameParent3</td> <td>$emailParent3</td> <td>$phoneParent3</td> </tr>";
                            $memberInfo4 = $memberInfo4 . "<td>$nameParent4</td> <td>$emailParent4</td> <td>$phoneParent4</td> </tr>";*/

                            $parentInfo = "<tr> <td>$nameParent1</td> <td>$emailParent1</td> <td>$phoneParent1</td> </tr>";
                            $belowWork = "<div class = 'below-work-item'>
                            <b class = 'grid-title'> Parental Contact </b> <br>
                            <table class = 'below-work-table'>
                                <tr>
                                    <th>Parent Name</th>
                                    <th>Parent Email</th>
                                    <th>Parent Phone</th>
                                </tr>
                                    $parentInfo
                                </table>
                            </div>";

                            
                            $nominatorItem = "<div class = 'nominator-item'> 
                            <p><b>Nominated by: </b> $nameNominator, $emailNominator, $phoneNominator</p> 
                            <p> <b> Submission Time: </b> $timeSubmission</p>
                        </div>";

                        }  elseif ($isYouth == "0") {
                            $headerstr = "<th>Nominee Phone</th>";
                            $memberInfo1 = "<tr> <td>$nameNominee1</td> <td>$emailNominee1</td>  <td> $ageNominee1</td> <td>$phoneParent1</td>";
                            $memberInfo2 = "<tr> <td>$nameNominee2</td> <td>$emailNominee2</td>  <td>  $ageNominee2</td>  <td>$phoneParent2</td>";
                            $memberInfo3 = "<tr> <td>$nameNominee3</td> <td>$emailNominee3</td> <td>  $ageNominee3</td> <td>$phoneParent3</td>";
                            $memberInfo4 = "<tr> <td>$nameNominee4</td> <td>$emailNominee4</td> <td>  $ageNominee4</td> <td>$phoneParent4</td>";

                            $nominatorInfo = "<tr> <td>$nameNominator</td> <td>$emailNominator</td> <td>$phoneNominator</td> </tr>";

                            $belowWork = "<div class = 'below-work-item'>
                            <b class = 'grid-title'> Nominator </b> <br>
                            <table class = 'below-work-table'>
                                <tr>
                                    <th>Nominator Name</th>
                                    <th>Nominator Email</th>
                                    <th>Nominator Phone</th>
                                </tr>
                                $nominatorInfo
                            </table>
                        </div>";
                        $nominatorItem = "<div class = 'nominator-item'> 
                            <p> <b> Submission Time: </b> $timeSubmission</p>
                        </div>";
                        }

                        if ($nameNominee2 === "") { $memberInfo2 = ""; }
                        if ($nameNominee3 === "") { $memberInfo3 = ""; }
                        if ($nameNominee4 === "") { $memberInfo4 = ""; }

                        if ($resumeNominee == "") {
                            $miscellaneousInfo = "<b> Miscellaneous: </b>None";
                        } else {
                            $miscellaneousInfo = "<b> Miscellaneous: </b> <a class = 'sociallink' target = '_blank' href = '../Images/$resumeNominee'> Additional Info</a>";
                        }

                        if ($facebookNominee == "") {
                            $facebookInfo = "<b> Facebook: </b> None";
                        } else {
                            $facebookInfo = "<b> Facebook: </b> <a class = 'sociallink' target = '_blank' href = '$facebookNominee'>Facebook Link</a>";
                        }

                        if ($instagramNominee == "") {
                            $instagramInfo = "<b> Instagram: </b> None";
                        } else {
                            $instagramInfo = "<b> Instagram: </b> <a class = 'sociallink' target = '_blank' href = '$instagramNominee'>Instagram Link </a>";
                        }

                /// currentwinner, pastwinner -- change the grid
                    $output = "

                        <div class = 'no-print'>
                            $editHeroButtons   
                        </div>

                        <div class = 'print heroWrapper'>

                            <div class = 'heroGrid1'>
                            
                                <div class = 'name-item'> 
                                    $groupName
                                </div>

                                <div class = 'youth-adult-item'>
                                    $youthAdult
                                </div>

                                <div class = 'members-item'>
                                    <b class = 'grid-title'> Group Members </b> <br>

                                    <table class = 'membertable'>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Age</th>
                                        $headerstr
                                    </tr> 
                                        $memberInfo1
                                        $memberInfo2
                                        $memberInfo3
                                        $memberInfo4
                                    </table>
                            
                                </div>
                                
                                <div class = 'headshot-item'> 
                                    <img class = 'headshot' src= '../Images/$headshotNominee'>
                                </div>
                                <!-- COMMENTED OUT
                                <div class = 'bio-item'> 
                                    <b class = 'gridtitle-'> Hero's Biography </b> <br>
                                    $bioNominee
                                </div>-->
                                <div class = 'work-item'> 
                                    <b class = 'grid-title'> Hero's Work </b> <br>
                                    $workNominee
                                </div>

                               

                            </div>

                            <div class = 'heroGrid2'>

                                $belowWork


                                <div class = 'media-item'>
                                    <b class = 'grid-title'> Hero's Media </b>  <br>
                                        $miscellaneousInfo<br>
                                        $facebookInfo<br>
                                        $instagramInfo
                                </div>

                                <div class = 'pic2-item'> 
                                    <img class = 'pic2-pic' src= '../Images/$pic2Nominee'>
                                </div>

                                <div class = 'pic3-item'> 
                                    <img class = 'pic3-pic' src= '../Images/$pic3Nominee'>
                                </div>

                                $nominatorItem


                            </div>
                    </div>";
                }

                    
                echo $output;
                $index++;              

            }

            mysqli_free_result($result);
        }


        mysqli_close($mysqli);

        /*echo('
        <form method = "post" action = "../Frontend/connectHeroScript.php">
            <button class = "approve-all" name = "approve" type = "submit"> Approve All Heroes </button>
        </form>');*/

        echo ('
                    <style>

                        .removelink, .approvelink {
                            all: unset;
                            text-decoration: none;
                            padding: 5px;
                            width: 20%;
                            font-size: 1.25em;
                            margin: 5px;
                        }

                        .removelink {
                            background-color: red;
                        }

                        .approvelink {
                            background-color: green;
                        }
     
                        </style>

                        ');
    }
}



if (!function_exists('additionalMembersHTML'))   {

    function additionalMembersHTML($aMindex) {
        echo ( "
            <div class = 'form-row'>
                <div class = 'col-6'>
                    <label for = 'nameNominee$aMindex'>Nominee $aMindex's Full Name</label>
                    <input class = 'form-control' type='text' id = 'nameNominee' name='nameNominee$aMindex' value='' title='Nominee's Full Name'>
                </div>

                <div class = 'col-5'>
                    <label for='emailNominee$aMindex'>Nominee $aMindex's Email</label>
                    <input class = 'form-control' type='text' name='emailNominee$aMindex' value='' title='Nominee's Email'>
                </div>
            </div>

                <!--

                <div>               
                <label for='ageNominee$aMindex'>Nominee's Age</label>
                    <div class='inputWrapper'>
                        <input class = 'form-control' type='number' name='ageNominee$aMindex' min = '1' max = '18' value='' title='Nominee's Age'> <!-- add drop down for this
                    </div>
                </div> <!-- JUST ADDED TODAY, DO PUT INTO DATABASE PROPERLY

                <div>               
                <label for='gradeNominee$aMindex'>Nominee's Current Grade</label>
                    <div class='inputWrapper'>
                        <input class = 'form-control' type='number' name='gradeNominee$aMindex' min = '1' max = '12' value='' title='Nominee's Grade'> <!-- add drop down for this
                    </div> <!--- NEED TO PUT GRADE SECTION INTO DB
                </div>


                <div>
                    <label for='schoolNominee$aMindex'>Nominee's School Name</label>
                    <div class='inputWrapper'>
                    
                    <select id='schoolNominee' name='schoolNominee$aMindex'>
                        <option value='Glenwood Elementary School'>Glenwood Elementary School</option>
                        <option value='Deerfield Elementary School'>Deerfield Elementary School</option>
                        <option value='Hartshorn Elementary School'>Hartshorn Elementary School</option>
                        <option value='South Mountain Elementary School'>South Mountain Elementary School</option>
                        <option value='Wyoming Elementary School'>Wyoming Elementary School</option>
                        <option value='Washington School'>Washington School</option>
                        <option value='Millburn Middle School'>Millburn Middle School</option>
                        <option value='Millburn High School'>Millburn High School</option>
                        <option value='The Pingry School'>The Pingry School </option>
                        <option value='Far Brook School'>Far Brook School </option>
                        <option value='St. Rose of Lima Academy'>St. Rose of Lima Academy </option>
                        <option value='Kent Place School'>Kent Place School </option>
                        <option value='Newark Academy'>Newark Academy </option>
                        <option value='Other'> Other</option>
                    </select>
                    </div>
                </div>

                

                    <br>

                <div>
                    <label for = 'nameParent$aMindex'>Parent's Full Name</label>
                        <div class='inputWrapper'>
                            <input type='text' id = 'nameParent$aMindex' name='nameParent$aMindex' value='' title='Parent's Full Name'>
                        </div>
                    </div>

                    <div>               
                    <label for='emailParent$aMindex'>Parent's Email</label>
                        <div class='inputWrapper'>
                            <input type='text'name='emailParent$aMindex' value='' title='Parent's Email'>
                        </div>
                    </div>

                    <div>               
                    <label for='phoneParent$aMindex'>Parent's Phone Number</label>
                        <div class='inputWrapper'>
                            <input type='tel'name='phoneParent$aMindex' value='' title='Parent's Phone'>
                        </div>
                    </div> 
                    -->");
    }
}


if (!function_exists('additionalAdultMembersHTML'))   {

    function additionalAdultMembersHTML($aMindex) {
        echo ( "
    <div class = 'form-row'>
        <div class = 'col-6'>
            <label for = 'nameNominee$aMindex'>Nominee $aMindex's Name </label>
            <input class = 'form-control' type='text' id = 'nameNominee$aMindex' name='nameNominee$aMindex' value='' title='Nominee's Full Name'>
        </div>

        <div class = 'col-5'>
            <label for='emailNominee$aMindex'>Nominee $aMindex's Email </label>
            <input class = 'form-control' type='text' name='emailNominee$aMindex' value='' title='Nominee's Email'>
        </div>
    </div>

    
    <!--<div>               
    <label for='ageNominee$aMindex'>Nominee's Age Group </label>
        <div class='inputWrapper'>
            <select id='' name='ageNominee$aMindex'>
                <option value='' selected></option>
                <option value='18-25'>18-25</option>
                <option value='25-40'>25-40</option>
                <option value='40-60'>40-60</option>
                <option value='60+'>60+</option>
            </select>
        </div>
    </div>


    <div>
        <label for='emailNominee$aMindex'>Nominee's Email </label>
        <div class='inputWrapper'>
            <input type='text' name='emailNominee$aMindex' value='' title='Nominee's Email'>
        </div>
    </div>

    <div>
        <label for='phoneParent$aMindex'>Nominee's Phone </label>
        <div class='inputWrapper'>
            <input type='text' name='phoneParent$aMindex' value='' title='Nominee's Phone'>
        </div>
    </div>-->");
    }
}


if (!function_exists('readFormStatus'))   {

    function readFormStatus($connection) {
        
        $sqlquery = "SELECT * FROM `formstatus` ORDER BY id DESC LIMIT 1";

        $result = $connection->query($sqlquery);

        $formStatus = "closed";
        $comments = "inital status";
        $time = "Big Bang!!";

        if ($result) {
            if ($row = mysqli_fetch_array($result)) {

                $formStatus = $row['formStatus'];
                $comments = $row['comments'];
                $time = $row['updateTime'];
            }
            $result->free();
        }

        return array ($formStatus, $comments, $time);
    }


    if (!function_exists('updateFormStatus'))   {

        function updateFormStatus($connection, $status, $comments, $time) {
        
            $sqlquery = "INSERT INTO formstatus (formStatus, comments, updateTime) VALUES (?,?,?)"; //need to bind params for placeholders to work // nameNominee is storing allinfo

            $statement = mysqli_stmt_init($connection); 

            $result = "Success";
            //prepare statement
            if(!mysqli_stmt_prepare($statement, $sqlquery)){
                $result = "Error: " . mysqli_error($connection);
            } else {
                //storing info in database (3 params of info)
                mysqli_stmt_bind_param($statement, "sss", $status, $comments, $time);
                mysqli_stmt_execute($statement);
                mysqli_stmt_store_result($statement);
            }  
            mysqli_stmt_close($statement);

            return $result;
        }
    }

    if (!function_exists('getNomineeName'))   {
        function getNomineeName($connection, $idNomination) {
            $sqlquery = "SELECT groupName FROM nominations WHERE idNominations = '$idNomination'";
            
            $result = $connection->query($sqlquery);
            if ($result) {
                if ($row = mysqli_fetch_array($result)) {
                    $nomineeName = $row['groupName'];
                }
                $result->free();
            } else {
                $nomineeName = "";
            }
            return $nomineeName;
        }
    }


    if (!function_exists('updateAuditLog'))   {

        function updateAuditLog($connection, $idNomination, $auditMessage) {

            $auditTime = getCurrentTime();
        
            $nameNominee = "";
            if ($idNomination != 0) {
                $nameNominee = getNomineeName($connection, $idNomination);
            }
            $sqlquery = "INSERT INTO auditlog (auditTime, idNomination, nameNominee, auditMessage) VALUES (?,?,?,?)"; //need to bind params for placeholders to work // nameNominee is storing allinfo

            $statement = mysqli_stmt_init($connection); 

            $result = "Success";
            //prepare statement
            if(!mysqli_stmt_prepare($statement, $sqlquery)){
                $result = "Error: " . mysqli_error($connection);
            } else {
                //storing info in database (3 params of info)
                mysqli_stmt_bind_param($statement, "siss", $auditTime, $idNomination, $nameNominee, $auditMessage);
                mysqli_stmt_execute($statement);
                mysqli_stmt_store_result($statement);
            }  
            mysqli_stmt_close($statement);

            return $result;
        }
    }  
    
    function readAuditLog($connection) {
        
        $sqlquery = "SELECT * FROM `auditlog` ORDER BY id DESC";

        $result = $connection->query($sqlquery);

        $num_rows = 0;
        $last_result = array();
        while ( $row = mysqli_fetch_array( $result ) ) {
            $last_result[$num_rows] = $row;
            $num_rows++;
        }
        
        $result->free();
        return $last_result;
    }
    
}

?>
