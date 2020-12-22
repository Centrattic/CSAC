<?php
require '../Backend/functions.php';
session_start();
?>

<main> 
    <html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link href="../CSS/nomination.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href = "../CSS/navbar.css">

        <style>
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

            </style>

    </head>
    <body>
        
    <?php
        navbar();

        $connection = connectToDB();
        list ($formStatus, $comments, $time) = readFormStatus($connection);
        mysqli_close($connection);

        if ( $formStatus != "open") {
            echo('<h1 style = "font-size: 1.5em;"> Nominations for this year have closed. They will open again on January 1st. Please check back later. <br><br> Thank you! ');
            exit();
        }
    ?>

    <h1> Adult Nomination </h1>
    <br>


    <h2 class= "age-definition"> Adults: Ages 19+</h2>
    <h3 style = "font-size: 1.25em; width: 60%; margin: 5px auto; font-weight: 800;"> All information is confidential for use by the Community Service Award Committee. </h3>
    
    <form action = "../Backend/nominateScript.php" method="post" name="nominate" enctype="multipart/form-data">

        <fieldset>
            <legend> Nominee Information</legend>
            <i>Please provide the following information about the individual you are nominating. If you are nominating a group, enter a group name and provide information here 
            about the group organizer/leader.</i>
            <br> <br>

<!-- How many youth are you providing information about?-->

                <div class = "form-row">
                    <div class = "col-6">
                        <label for = "groupName">Group Name, if applicable </label>
                        <input class = "form-control" type="text" maxlength="80" id = "groupName" name="groupName" value="" title="Nominee's Full Name">
                    </div>

                    <div class = "col-5">
                        <label for = "nameNominee1">Nominee's Name * </label>
                        <input class = "form-control" required type="text" id = "nameNominee1" name="nameNominee1" value="" title="Nominee's Full Name">
                    </div>
                </div>

                <div class = "form-row">
                    <div class = "col-3">               
                    <label for="ageNominee1">Nominee's Age Group *</label>
                            <select class = "form-control" required id="" name="ageNominee1">
                                <option value="" hidden disabled selected></option>
                                <option value="19-25">19-25</option>
                                <option value="25-40">25-40</option>
                                <option value="40-60">40-60</option>
                                <option value="60+">60+</option>
                            </select>
                    </div>

                    <div class = "col-4">
                        <label for="emailNominee1">Nominee's Email *</label>
                        <input class = "form-control" required type="text" name="emailNominee1" value="" title="Nominee's Email">
                    </div>

                    <div class = "col-4">
                        <label for="phoneParent1">Nominee's Phone *</label>
                        <input class = "form-control" required type="text" name="phoneParent1" value="" title="Nominee's Phone"> <!-- adult phone-->
                    </div>
            </div>
        </fieldset>


        <fieldset>
            <legend> Additional Group Information </legend>
            <i> If you are nominating a group, please provide information about up to 3 additional members of the group.</i>
            <br> <br>
            <!--<button type="button" class="collapsible">Group Member 2</button>
            <div id = "CollapseInfo2" class = "info-content">
            </div>-->
                <?php
                    additionalAdultMembersHTML(2);
                ?>

        <!--<button type="button" class="collapsible">Group Member 3</button>
            <div id = "CollapseInfo3" class = "info-content">
            </div>-->
                <?php
                    additionalAdultMembersHTML(3);
                ?>

        <!--<button type="button" class="collapsible">Group Member 4</button>
            <div id = "CollapseInfo4" class = "info-content">
            </div>-->
                <?php
                    additionalAdultMembersHTML(4);
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
        </fieldset>



        <fieldset>
            <legend> Nominee Contributions</legend>
            <i> If your nominee is selected as a winner, this information may be used to promote the awards to the public. </i>
            <br> <br>

            <div>
                <label for="workNominee">Please summarize the action(s) and notable contributions of the individual or group and why you believe they are noteworthy for this award. 
                You may attach additional information below. *</label> <!--  they are/were taking, what prompted them to take such action, their goal, how they have/had engaged others in their efforts, and their impact. -->
                <div class="inputWrapper">
                    <textarea class = "form-control" required maxlength="1500" name="workNominee" title="What work is the young hero/group doing?"></textarea>
                    <span>Limit: 1500 characters</span>
                </div>
            </div>
<!--
            <div>
                <label for="bioNominee">Write a short bio about the hero/group. Please summarize why they care about the issue and what personal interests, passions, or skills they have that are relevant to their service. *</label>
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
                    <label for="facebookNominee">Facebook</label> 
                    <input class = "form-control" maxlength = "100" type="text" name="facebookNominee" value="" title="Nominee's Facebook">
                    <span class="hint">Must be in full URL format. For example, http://www.facebook.com/younghero</span>
                </div>

                <div class = "col-6">
                    <label for="instagramNominee">Instagram</label>
                    <input class = "form-control" maxlength = "100" type="text" name="instagramNominee" value="" title="Nominee's Instagram">
                    <span class="hint">Must be in full URL format. For example, https://www.instagram.com/youthservice/</span>
                </div>
            </div>
            <br>
            
            <h4> Pictures </h4>
            <i>We encourage you to share photos of the work. Please upload them below along and include a short caption. We accept .jpg and .png formats. </i>
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

            <h4> Miscellaneous </h4>

            <i>Please upload any additional miscellaneous information. We accept .pdf and .docx formats less than 5MB.</i>
            <br>
            
            <div class = "form-row col-12">
                <label for = "resumeNominee">Upload Miscellaneous Information </label>
                <input type = "file" name = "resumeNominee" class = "form-control-file col-12">
            </div>
        </fieldset>

        <!--

        <fieldset id = "pictures">
            <legend> Nominee Pictures </legend>
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
            <i> <b> This section is optional. </b> If you choose to fill out social media information, it will only be viewed by the Community Service Award Committee, not the public. </i> 
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
            <legend>Nominee Resumé/Additional Information</legend>
            <i> <b> This section is optional. </b> <br> If you choose to upload a resumé or share additional information, it will only be viewed by the Community Service Award Committee, not the public.</i>
            <div> <br>
                <label for = "resumeNominee">Upload Resumé as .pdf < 5MB </label><br>
                <input type = "file" name = "resumeNominee" placeholder = "Upload Resumé as .pdf < 5MB">
            </div>
        </fieldset> 

        <!--<fieldset>
            <legend>Media Release Approval</legend>

            <div class="inputWrapper" id = "mediaflex">
                <i>Please ensure that the young hero approves of themselves appearing in the media. </i>
                <br>
     
                <br>
                <input required type="radio" id = "mediarelease" name="mediaRelease" value="1">
                <label for="mediaRelease" id = "media"> The young hero approves of themselves appearing in the media. *</label>
      
            </div>



        </fieldset> -->

        <div>
            <input style = "display: none;" id = "isYouth" name="isYouth" value="0">   
        </div>


        <input type="submit" name="submit_button" value="Submit" class = "submit_button">

        <!--
        <div class="oneField field-container-D    " id="tfa_12-D">
        <label id="tfa_12-L" class="label preField reqMark" for="tfa_12">Nominator's Last Name</label><div class="inputWrapper"><input type="text" id="tfa_12" name="tfa_12" value="" aria-required="true" title="Nominator's Last Name" class="required"></div>
        </div>
        <div class="oneField field-container-D    " id="tfa_10-D">
        <label id="tfa_10-L" class="label preField reqMark" for="tfa_10">Nominator's Email</label><div class="inputWrapper"><input type="text" id="tfa_10" name="tfa_10" value="" aria-required="true" title="Nominator's Email" class="validate-email required"></div>
        </div>
        <div class="oneField field-container-D    " id="tfa_13-D">
        <label id="tfa_13-L" class="label preField reqMark" for="tfa_13">Nominator's Phone</label><div class="inputWrapper"><input type="text" id="tfa_13" name="tfa_13" value="" aria-required="true" title="Nominator's Phone" class="required"></div>
        </div>
        </fieldset>
        <fieldset id="tfa_588" class="section wf-acl-hidden">
        -->
        </form>

        <?php
      footer();
     ?>

        <!--<div id = "quote">
            <h1> COVID Nomination </h1>
        </div>


        <br><br><br><br>


        <div id = "directions">
        <h2> Nominate a COVID Hero!</h2>
        <h4> In your form, please don't use any inapproriate or spam entries or your nomination will be removed and your account banned. Also, 
            do not write in full sentences when filling out the contact and location sections. </h4> 
        </div>

        <br><br><br><br><br><br>

        <div id = "border">
            <p class= large> Upload Your Image of a COVID Hero </p>
            <p> Only use .jpeg, .png, or .jpg for your image. For best results, use an image with a slightly longer length than width. </p> <br>
        
            <form action = "fileUploadScript.php" method = "post" enctype = "multipart/form-data" id ="nominate"> 
            <input type = "file" name = "image" placeholder = "Upload image of COVID Hero (5MB max)" id = "uploadedimg">

            <br>
        
            <br>
            <p class= large> All About Your Hero (300 chars max) </p>
            <p> Ex. Josh Chun is a Millburn High School student who loves plain yogurt, coding, and geometry class. </p> <br>
            <textarea name = "description" rows = 5 placeholder = "Personal Description of Hero (200 chars max)" maxlength = "200"> </textarea> <br><br>

            <p class= large> Hero's Location </p>
            <p> Ex. Millburn, New Jersey, 07078 (please include the hero's zipcode)</p> <br>
            <textarea name = "location" placeholder = "Hero's Location (100 chars max)" rows = 5 maxlength = "100"> </textarea> <br><br>

            <p class= large> What Has Your Hero Done? </p>
            <p> Ex. Josh Chun sews masks and donates them to Goodwill shelters during this period. </p> <br>
            <textarea name = "job" placeholder = "What the Hero has Done (200 chars max)" rows = 5 maxlength = "200"> </textarea> <br><br>

            <p class= large> Way to Contact Hero </p>
            <p> Please type only a phone number and/or email address. </p>
            <textarea name = "contact" placeholder = "Hero's Phone Number/Email Address (100 chars max)" rows = 5 maxlength = "100"> </textarea> <br><br>

            <p class= large> Hero's News Links </p>
            <p> Please put, maximum, one http link of your hero's. If none, leave this field empty. </p>
            <textarea name = "news" placeholder = "News URL" rows = 3>  </textarea> <br><br>
            
            <button id = "nominatehero" type = "submit" name = "nominate"> Nominate Hero</button>
            

            </form>
        -->

<!--
            <script>
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
            </script>-->

    </body>
    </html>
</main>
