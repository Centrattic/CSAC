<?php

if (!function_exists('searchBar'))   {
    function searchBar() {
        echo '<form action = "connectHeroScript.php" method = "post">
        <input type = "text" name = "Search" placeholder = "Search for Heroes by Category" style = "width: 18.5%; height: 5%; font-size: 1.25em; margin-left: 2%; margin-top: 2%; margin-right: 2%;">
        <input type = "submit" value = "Go" style = "width: 5%; height: 5%; font-size: 1.25em; margin-left: -1.5%;">
        </form>';
    }
}

if (!function_exists('connectToDB'))   {

    function connectToDB() {
        
        //prepared statement for security
        $database = "localhost";
        $username = "root";
        $password = ""; //password might change
        $connection = mysqli_connect($database, $username, $password) or die ("could not connect");
        $connection->select_db("young_heroes") or die("could not find database"); //DistanceHacks might change based on name of database
        return $connection;
        
    }
}

if (!function_exists('navbar'))   {

    function navbar() {
        session_start();
        echo('
        <nav>
          <ul class="menu-area">');
            echo('<li id = "logo">Logo</li>
            <li><a class = "navlink" href = "home.php">Home</a></li>
            <li><a class = "navlink" href="nomination.php">Youth Nomination</a></li>
            <li><a class = "navlink" href="adultnomination.php">Adult Nomination</a></li>');

                if(isset($_SESSION['UserID'])){
                    echo '<li><a class = "navlink" href="verification.php">Verify Nominations</a></li>';
                } else {
                    echo('');
                }

            echo('<li><a class = "navlink" href = "connectHeroScript.php">View Heroes</a></li>');


              if(!isset($_SESSION['UserID'])) {
                echo '<li>
                    <a class = "navlink" href = "loginpage.php"> Admin</a>
                  </li>';
              } else {
                  echo('<li> 
                  <form id = "logout" action = "../Backend/logoutscript.php" method = "post">      
                  <button onclick = "logout();" type = "submit" name = "logout-submit">Logout</button> 
                  </form>
                </li>');
              }

            //input of password and username set up
            //button to submit entry form
            // sign up form

          echo('</ul>
      </nav>');

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

if (!function_exists('viewHeroes'))   {

    function viewHeroes() {
        
        $mysqli = connectToDB();
        
        //collecting info from form
        if(isset($_POST['Search'])){ //Since everything wrapped in this post search, nothing appears until we search. If I want to change that, go here
            
            $searchq = $_POST['Search'];
            //filter out chars that are not nums because only searching for zip code
            //$searchq = preg_replace("#[^0-9]#", "", $searchq); //replaces all chars of searchq that are not a num with blank
            
            //sql query to search database
            $sqlquery = "SELECT * FROM nominations WHERE statusNominee = 'winner' ";

            $result = $mysqli->query($sqlquery) or die ("could not search");

            $count = mysqli_num_rows($result);
            $index=0;
        
            if ($count == 0){
                echo "<p style = 'margin-left:2%; font-size: 1.5em;'><br><br>There are no heroes in this category; click the button above to nominate one!</p>";
            } else {
                echo "<br>Found $count Heroes!!<br><br>";

                while($row = mysqli_fetch_array($result)){
                    
                    $image = $row['headshotNominee'];
                    $image2 = $row['pic2Nominee'];
                    $image3 = $row['pic3Nominee'];

                    $work = $row['workNominee'];
                    $category = $row['nameNominee'];
                    $bio = $row['bioNominee'];
                    $email = $row['emailNominee'];
                    $name = $row['nameNominee'];

                    $facebook = $row['facebookNominee'];
                    $twitter = $row['twitterNominee'];
                    $instagram = $row['instagramNominee'];
                    $news = $row['newsNominee'];
                    $website = $row['websiteNominee'];

                    if ($image == "") {
                        $image = "../Images/defaulthero.png";
                    }

                    if ($image2 == "") {
                        $image2 = "../Images/defaultservice.jpeg";
                    }

                    if ($image3 == "") {
                        $image3 = "../Images/defaultservice2.jpeg";
                    }

                    
                    /*

                    $newslinktext = "";
                    if ($news != "") {
                        $newslinktext="Hero's News Link";
                    }
                    */

                    
                    $output = "
                    <div class = 'print heroWrapper'>
                        <div class = 'name-item'> 
                             $name
                        </div>
                        <div class = 'category-item'> 
                            $category
                        </div>
                        <div class = 'headshot-item'> 
                            <img class = 'headshot' src= '../Images/$image'>
                        </div>
                        <div class = 'bio-item'> 
                            <b class = 'grid-title'> Hero's Biography </b> <br>
                            $bio
                        </div>
                        <div class = 'work-item'> 
                            <b class = 'grid-title'> Hero's Work </b> <br>
                             $work
                        </div>
                        <div class = 'contact-item'>
                        <div class = 'contact-info'> <b class = 'grid-title'> Hero's Contact </b> </div> <br>
                            <div class = 'social'>
                                 <b> Twitter:</b> <a class = 'sociallink' href = '$twitter'> $twitter</a> <br>
                                <b> Facebook: </b> <a class = 'sociallink' href = '$facebook'> $facebook </a>  <br>
                                <b> Instagram: </b> <a class = 'sociallink' href = '$instagram'> $instagram </a>
                            </div>
                            <div class = 'social1'>
                                <b> Email Address:</b> $email <br>
                                <b> News Link: </b> <a class = 'sociallink' href = '$news'>  $news </a> <br>
                                <b> Website: </b> <a class = 'sociallink' href = '$website'>  $website </a>
                            </div>
                        </div>
                        <div class = 'pic2-item'> 
                            <img class = 'pic2-pic' src= '../Images/$image2'>
                        </div>
                        <div class = 'pic3-item'> 
                            <img class = 'pic3-pic' src= '../Images/$image3'>
                        </div>
                    </div>";

                    
                    echo $output;


                        $index++;

            }
            mysqli_free_result($result);
        }

    }

        mysqli_close($mysqli);

    }
}


if (!function_exists('additionalMembers'))   {

    function additionalMembers($aMindex) {
        echo ( "<div>
                    <label for = 'nameNominee$aMindex'>Nominee's Full Name</label>
                    <div class='inputWrapper'>
                        <input type='text' id = 'nameNominee' name='nameNominee$aMindex' value='' title='Nominee's Full Name'>
                    </div>
                </div>

                <div>               
                <label for='ageNominee$aMindex'>Nominee's Grade</label>
                    <div class='inputWrapper'>
                        <input type='number' name='ageNominee$aMindex' min = '1' max = '12' value='' title='Nominee's Grade'> <!-- add drop down for this-->
                    </div>
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

                <div>
                    <label for='emailNominee$aMindex'>Nominee's Email</label>
                    <div class='inputWrapper'>
                        <input type='text' name='emailNominee$aMindex' value='' title='Nominee's Email'>
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
                    </div>");
    }
}

?>