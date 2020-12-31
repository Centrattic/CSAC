<?php
require '../Backend/functions.php';
session_start();
?>

<main> 
    <!DOCTYPE html>
    <html lang = "en">
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link href="../CSS/nomination.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/png" href="../Images/CSAClogo.png"/>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href = "../CSS/navbar.css">
        <title> Youth Nomination </title>

        <script> 
            function myKeyPress(e){
                var keynum;
                if(window.event) { // IE                    
                keynum = e.keyCode;
                } else if(e.which){ // Netscape/Firefox/Opera                   
                keynum = e.which;
                }
                if(keynum==62 || keynum==60)
                    e.preventDefault();
            }
        </script>


            <!--<style>
                .collapsible {
                    background-color: #eee;
                    color: #444;
                    cursor: pointer;
                    padding: 18px;
                    width: 100%;
                    border: none;
                    text-align: left;
                    outline: none;
                    font-size: 15px;
                    text-align: center;
                    margin-bottom: 1%;
                    width: 90%;
                }
                
                .active, .collapsible:hover {
                    background-color: #ccc;
                }
                
                
                .info-content {
                    padding: 0 18px;
                    display: none;
                    overflow: hidden;
                    background-color: #ffffff;
                    width: 90%;
                    margin: 1% auto;
                }

            </style>-->

    </head>

       
    
    <body>


    <?php
        navbar();

        $connection = connectToDB();
        list ($formStatus, $comments, $time) = readFormStatus($connection);
        mysqli_close($connection);

        if ($formStatus != "open") {
            echo('<h1 style = "font-size: 1.5em;"> Nominations for this year have closed. They will open again on January 1st. Please check back later. <br><br> Thank you! ');
            exit();
        }
    ?>

    <!-- Parental Contact after Additional Member Information 
    
    Email optional for child
    Age optional for child

    -->


    
    <div id = "nomination-body">

    <h1> Youth Nomination </h1>
    <br>

    
    <!---<h1 style = "display: none;"> Nominations for this year have closed. They will open again on January 1st. Please check back later. Thank you! </h1>-->
    <h2 class = "age-definition"> Youth: Up to 18 years old</h2>
    <h3 style = "font-size: 1.25em; width: 60%; margin: 5px auto; font-weight: 800;"> All information is confidential for use by the Community Service Award Committee. </h3> <!-- until notification by the Community Service Award Committee of your finalist status.  and will only be shared with the Community Service Award Committee members. 
    <br> <br> We will only share a youth's information with the public if he, she, or they is selected as a award recipient. 
        Before we share any information, we will receive Media Release approval from the parents of the youth.  -->

    <form action = "../Backend/nominateScript.php" method="post" name="nominate" enctype="multipart/form-data" >

        <fieldset>
            <legend> Nominee Information</legend>
            <i>Please provide the following information about the individual you are nominating. If you are nominating a group, enter a group name and provide information here 
            about the group organizer/leader</i>

            <!--<br> <br>
            <i> If your nominee is selected as a winner, and parental permission is given, this information will be viewed by the public. </i>-->
            <br> <br>
<!-- How many youth are you providing information about?-->

                <div class = "col-12">
                    <label for = "groupName">Group Name, if applicable </label>
                    <input onkeypress="return myKeyPress(event)" class = "form-control" type="text" maxlength="80" id = "groupName" name="groupName" value="" title="Nominee's Full Name">
                </div>

                <div class = "form-row">
                    <div class = "col-6">
                        <label for = "nameNominee1">Nominee's Name * </label>
                        <input class = "form-control" required type="text" id = "nameNominee1" name="nameNominee1" value="" title="Nominee's Full Name">
                    </div>

                    <div class = "col-5">
                        <label for="emailNominee1">Nominee's Email *</label>
                        <input required class = "form-control" type="text" name="emailNominee1" value="" title="Nominee's Email">
                    </div>
                </div>

                <div class = "form-row">
                    <div class = "col-3">               
                        <label for="ageNominee1">Nominee's Age *</label>
                        <input required class = "form-control" type="number" name="ageNominee1" min = "1" max = "18" value="" title="Nominee's Age"> <!-- add drop down for this-->
                    </div> <!-- JUST ADDED TODAY, DO PUT INTO DATABASE PROPERLY-->
         
                    <div class = "col-3">               
                        <label for="gradeNominee1">Nominee's Grade *</label>
                        <input required class = "form-control" type="number" name="gradeNominee1" min = "1" max = "12" value="" title="Nominee's Grade"> <!-- add drop down for this-->
                        <!-- CHANGED UP GRADE WHEN PUT INTO DB, DO PUT INTO DATABASE PROPERLY-->
                    </div>

                    <div class = "col-5">
                        <label for="schoolNominee">Nominee's School Name *</label>
                        <input required class = "form-control" id="schoolNominee" type="text" name="schoolNominee1" value="" title="Nominee's School Name">
                        <!--<select required id="schoolNominee" name="schoolNominee1">
                            <option value="" hidden disabled selected></option>
                            <option value="Glenwood Elementary School">Glenwood Elementary School</option>
                            <option value="Deerfield Elementary School">Deerfield Elementary School</option>
                            <option value="Hartshorn Elementary School">Hartshorn Elementary School</option>
                            <option value="South Mountain Elementary School">South Mountain Elementary School</option>
                            <option value="Wyoming Elementary School">Wyoming Elementary School</option>
                            <option value="Washington School">Washington School</option>
                            <option value="Millburn Middle School">Millburn Middle School</option>
                            <option value="Millburn High School">Millburn High School</option>
                            <option value="The Pingry School">The Pingry School </option>
                            <option value="Far Brook School">Far Brook School </option>
                            <option value="St. Rose of Lima Academy">St. Rose of Lima Academy </option>
                            <option value="Kent Place School">Kent Place School </option>
                            <option value="Newark Academy">Newark Academy </option>
                            <option value="Other"> Other</option>
                        </select>-->
                    </div>
                </div>

                

        </fieldset>

        
        <fieldset>
            <legend> Additional Member Information </legend> <!-- No COLLAPSIBLE HERE-->
            <i> If you are nominating a group, please provide information about up to 3 additional members of the group.</i>
            <br> <br>
            <!--<button type="button" class="collapsible">Group Member 2</button>
            <div id = "CollapseInfo2" class = "info-content">
            </div>-->
            
                <?php
                    additionalMembersHTML(2); /// just name and email for additional group members (nominees, no parent stuff), all in one line
                ?>

        <!--<button type="button" class="collapsible">Group Member 3</button>-->
            <!--<div id = "CollapseInfo3" class = "info-content">
            </div>-->
                <?php
                    additionalMembersHTML(3);
                ?>
                
            

        <!--<button type="button" class="collapsible">Group Member 4</button>
        <div id = "CollapseInfo4" class = "info-content">
        </div>-->
            
                <?php
                    additionalMembersHTML(4);
                ?>

        </fieldset>

        <fieldset>
            <legend> Nominator Information </legend>
            <i> This information will only be viewed by the Community Service Award Committee and will not be made public. </i> <br> <br>
                    <div class = "col-12">
                        <label for = "nameNominator">Nominator's Full Name *</label>
                        <input class = "form-control" required type="text" id = "nameNominator" name="nameNominator" value="" title="Parent's Full Name">
                    </div>

                    <div class = "form-row">
                        <div class = "col-5">               
                            <label for="emailNominator">Nominator's Email *</label>
                            <input class = "form-control" required type="text"name="emailNominator" value="" title="Parent's Email">
                        </div>

                        <div class = "col-6">               
                            <label for="phoneNominator">Nominator's Phone Number *</label>
                            <input class = "form-control" required type="tel"name="phoneNominator" value="" title="Parent's Phone">
                        </div>
                    </div>  

                    <!-- Make form appear shorter, take more screen space --- MAKE IT LESS SCROLLING REQUIRED-->
        </fieldset>

        <fieldset>
            <legend> One Parental Contact </legend>
            <i>This information will only be viewed by the Community Service Award Committee and will not be made public. </i> 
            <br> <br>
                
                    <div class = "col-12">
                        <label for = "nameParent1">Parent's Full Name *</label>
                        <input class = "form-control" required type="text" id = "nameParent1" name="nameParent1" value="" title="Parent's Full Name">
                    </div>

                <div class = "form-row">

                    <div class = "col-5">               
                    <label for="emailParent1">Parent's Email *</label>
                        <input class = "form-control" required type="text"name="emailParent1" value="" title="Parent's Email">
                    </div>

                    <div class = "col-6">               
                    <label for="phoneParent1">Parent's Phone Number *</label>
                        <input class = "form-control" required type="tel"name="phoneParent1" value="" title="Parent's Phone">
                    </div>
                <div>
        </fieldset>




        <fieldset>
            <legend> Nominee Contributions</legend>
            <i> If your nominee is selected as a winner, this information may be used to promote the awards to the public. </i>
            <br> <br>
            <div>
                <label for="workNominee"> Please summarize the action(s) and notable contributions of the individual or group and why you believe they are noteworthy for this award. You may attach additional information below. *</label>
                <div class="inputWrapper">
                    <textarea class = "form-control" required maxlength="1500" name="workNominee" title="What work is the young hero/group doing?"></textarea>
                    <span>Limit: 1500 characters</span>
                </div>
            </div>

            <!--
            <div>
                <label for="bioNominee">Write a short bio about the young hero/group. Please summarize why they care about the issue and what personal interests, passions, or skills they have that are relevant to their service. *</label>
                <div class="inputWrapper">
                    <textarea class = "form-control" required maxlength="250" name="bioNominee" title="Person: Write a short bio about the young hero/group. Please summarize why they care about the issue, and what personal interests, passions, or skills they have that are relevant to their service." ></textarea>
                    <span>Limit: 250 characters</span>
                </div>
            </div>
            -->

            
        </fieldset>

        <fieldset> 
            <legend>Additional Supporting Information</legend>
            <i> <b> This section is optional. </b> <br> If necessary, please share additional information to support the nomination (including social media links, pictures, a resumé, and/or a .pdf/.docx file).</i>
            
            <br> <br>

            <h4> Social Media </h4>

            <div class = "form-row">

                <div class = "col-5">
                    <label for="facebookNominee">Nominee's Facebook</label> 
                    <input class = "form-control" maxlength = "100" type="text" name="facebookNominee" value="" title="Nominee's Facebook">
                    <span class="hint">Must be in full URL format. For example, http://www.facebook.com/younghero</span>
                </div>

                <div class = "col-6">
                    <label for="instagramNominee">Nominee's Instagram</label>
                    <input class = "form-control" maxlength = "100" type="text" name="instagramNominee" value="" title="Nominee's Instagram">
                    <span class="hint">Must be in full URL format. For example, https://www.instagram.com/youthservice/</span>
                </div>
            </div>
            <br>
            
            <h4> Pictures </h4>
            <i> We encourage you to share photos of the work. Please upload them below along and include a short caption. We accept .jpg and .png formats. </i>
            <br>

            <div class = "form-row col-12">
                <label>Headshot of Nominee/Group </label>
                <input type = "file" name = "headshotNominee" class = "form-control-file col-12" id = "customFile">         

            </div>

            <div class = "form-row">

                <div class = "col-6">
                    <label for = "pic2Nominee">Working Picture </label> <br>
                    <input class = "form-control-file" type = "file"  name = "pic2Nominee">

                    <input class = "form-control" type = "text" maxlength="80" name = "Captionpic2Nominee" placeholder = "Caption">
                    <span>Limit: 80 characters</span>
                </div>

                <div class = "col-5">
                     <label for = "pic3Nominee">Working Picture </label> <br>
                    <input class = "form-control-file" type = "file" name = "pic3Nominee">
                    <input class = "form-control" type = "text" maxlength="80" name = "Captionpic3Nominee" placeholder = "Caption">
                    <span>Limit: 80 characters</span>
                </div>
            </div>

            <br>

            <h4> Miscellaneous</h4>

            <i>Please upload any additional miscellaneous information. We accept .pdf and .docx formats less than 5MB.</i>
            <br>
            
            <div class = "form-row col-12">
                <label for = "resumeNominee">Upload Miscellaneous Information </label>
                <input type = "file" name = "resumeNominee" class = "form-control-file col-12">
            </div>



        </fieldset>


        <!--
        <fieldset id = "pictures">
            <legend> Nominee Pictures </legend> <!-- Additional Supporting Information, social media links all in one document (just basic oneS) :::   
            <i> <b> This sectional is optional. </b> <br> However, we encourage you to share photos of a nominee and their work. If you are willing, please upload them here along with a caption (also optional). We accept jpg, png, and jpeg formats. </i>
            <br><br>

            <div>
                <label for = "headshotNominee">Headshot of Young Hero(es) </label> <br>
                <input type = "file" name = "headshotNominee" placeholder = "Upload image of COVID Hero (5MB max)">
            </div>

            <div>
                <br> <label for = "pic2Nominee">Working Picture </label> <br>
                <input type = "file" name = "pic2Nominee" placeholder = "Upload image of COVID Hero (5MB max)">
                <input type = "text" maxlength="80" name = "Captionpic2Nominee" placeholder = "Caption"> <br>
                <span>Limit: 80 characters</span>
            </div>

            <div>
                <br> <label for = "pic3Nominee">Working Picture </label> <br>
                <input type = "file" name = "pic3Nominee" placeholder = "Caption">
                <input type = "text" maxlength="80" name = "Captionpic3Nominee" placeholder = "Caption"> <br>
                <span>Limit: 80 characters</span>
            </div>

        </fieldset>

        <fieldset id = "social-media">
            <legend> Nominee Social Media </legend>
            <i> <b> This section is optional. </b> <br> If you choose to fill out social media information, it will only be viewed by the Community Service Award Committee, not the public. </i> 
            <br><br>
        
            <div>
                <label for="facebookNominee">Nominee's Facebook</label> 
                <div class="inputWrapper">
                    <input maxlength = "100" type="text" name="facebookNominee" value="" title="Nominee's Facebook">
                    <br>
                    <span class="hint">Must be in full URL format. For example, http://www.facebook.com/younghero</span>
                </div>
            </div>

            <div>
                <label for="twitterNominee">Nominee's Twitter</label>
                <div class="inputWrapper">
                    <input maxlength = "100" type="text" name="twitterNominee" value="" title="Nominee's Twitter">
                    <br>
                    <span class="hint">Must be in full URL format. For example, http://www.twitter.com/youthservice</span>
                </div>
            </div>

            <div>
                <label for="instagramNominee">Nominee's Instagram</label>
                <div class="inputWrapper">
                    <input maxlength = "100" type="text" name="instagramNominee" value="" title="Nominee's Instagram"></div>
                    <span class="hint">Must be in full URL format. For example, https://www.instagram.com/youthservice/</span>
            </div>

            <div>
                <label for="websiteNominee">Nominee's Website</label>
                <div class="inputWrapper">
                    <input maxlength = "100" type="text" name="websiteNominee" value="" title="Nominee's Website" class="">
                    <br>
                    <span class="hint">Must be in full URL format. For example, http://www.ysa.org</span>
                </div>
            </div>

            <div>
                <label for="newsNominee">Nominee's One News Link</label>
                <div class="inputWrapper">
                    <input maxlength = "100" type="text" name="newsNominee" value="" title="Nominee's News Link">
                    <br>
                    <span class="hint">Must be in full URL format. For example, https://patch.com/new-jersey/millburn/short-hills-scouts-host-coding-camp</span>
                </div>
            </div>

        </fieldset> 

        <fieldset> 
            <legend>Additional Information</legend>
            <i> <b> This section is optional. </b> <br> If you choose to share additional information, it will only be viewed by the Community Service Award Committee, not the public.</i>
            <div> <br>
                <label for = "resumeNominee">Upload Resumé as .pdf < 5MB </label><br>
                <input type = "file" name = "resumeNominee" placeholder = "Upload Resumé as .pdf < 5MB">
            </div>
        </fieldset> -->


        <!--<fieldset>
            <legend>Media Release Approval</legend>

            <div class="inputWrapper" id = "mediaflex">
                <i>Please ensure that the young hero's parent/guardian approves of their child appearing in the media. </i>
                <br>
     
                <br>
                <input required type="radio" id = "mediarelease" name="mediaRelease" value="1">
                <label for="mediaRelease" id = "media"> The young hero's parent/guardian approves media release for their child. *</label>
      
            </div>



        </fieldset> -->

        <div>
            <input style = "display: none;" id = "isYouth" name="isYouth" value="1">   
        </div>

        <input type="submit" name="submit_button" value="Submit" class = "submit_button">
        </form>

        <?php 
        footer();

        ?>


            <!--<script>
            var coll = document.getElementsByClassName("collapsible");
            var i;

            for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                content.style.display = "none";
                } else {
                content.style.display = "block";
                }
            });
            }
            </script> -->
    </div>
    </body>
    </html>
</main>
