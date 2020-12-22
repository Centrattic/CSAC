<?php
require '../Backend/functions.php';
session_start();
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
  ?>

    <!--<h4> This website is affiliated with the Millburn Township Community Service Award Committee. </h4> -->
    <!--Banner/Header : history of CSAC , Ok describe that on website ::: incorporate thios is new initative but builds on previous initiative, came up on time of COVID, instead of "THE IMPORTANCE OF RECOGNIING YOUTH VOLUNTEERS -->
    <!-- Delete Mission Statement - JUst describe CSAC Iniative  ======================= OUR HISTORY, with the onset of COVID -- do this.... 
    
    Community Service Award OverView and Now YOUNG HEROES   
    
    ALL NEEDED IS TO BE A MILLBURN TOWNSHIP RESIDENTs-->


    <h1 id = "homepagetitle"> Millburn Township Community Service Award Committee </h1>

    <div id = "homepicgrid">
      <div>
        <img src = "../Images/itsquad.jpg">
      </div>
      <div>
        <img src = "../Images/millburncsac.jpg">
      </div>
      <div>
        <img src = "../Images/fineran.jpg">
      </div>
      <div>
        <img src = "../Images/millburnhome.jpg">
      </div>
    </div>

    

    
    <h2> We are now accepting nominations!</h2>

    <!--<div id = "hometextgrid">
      <div>
        <h2> The Importance of Recognizing Youth Volunteers </h2>
        <p>Today’s youth are taking charge of environmental and social reforms, 
          and they deserve credit and appreciation where it’s due. Up to 55% of youth 
          actively participate in service, be it through school or other organizations, but they 
          have gone severely underrepresented of late. By commending their efforts, more youth will be 
          inspired to volunteer their time towards the community and the nation as a whole. Youth Service 
          America reminds us that adolescent brains in particular offer creative solutions to problems, 
          unaffected and unaware to the nonanswers common of some, older brains. They provide fresh outlooks 
          and ideas that would otherwise go unthought of. Youth service is mutually beneficial to both the 
          community and the youth in question; it has also been shown to improve success in the workforce 
          and academics in later life with early leadership foundations, as well as fostering positive 
          development traits and cosmopolitan mindsets. Some youth lack the incentive -the drive- to 
          go out and make a difference, which is why it is vital for them to have an outlet of support and recognition.  </p>
      </div>
      <div>
        <h2> Our Mission Statement </h2>
        <p> The mission of the Young Heroes is to recognize Millburn/Short Hills youth for their contributions, 
          to promote community service and good citizenship, to positively impact the community, and to 
          give hope and inspiration to others, especially during difficult times such as COVID-19. 
          This will be accomplished through a nomination process, verification, parental approval, and 
          a final posting to the Millburn Township Young Heroes webpage. The posts will summarize the Young hero’s work
           and qualify them for an annual award given to the two heroes (and runners-ups) who demonstrate the most profound
          service and dedication to the Township, specific cause, and/or the community as a whole.
        </p>
      </div>
    </div>
    
    and who, through their volunteer activities, have enhanced the quality of life in the Township of Millburn 
        and the community at large.” 

        who acknowledged the impact of the service work many youth had done to help alleviate 
        the effects of the pandemic.
    
    -->

    <div id = "CSAChistory">
      <h2> The History </h2>
      <p> The Millburn Township Community Service Award Committee (CSAC) was established in 1991 and has continued to "recognize and award members of the community who have 
        generously given their time, and who, through their volunteer activities, have enhanced the quality of life in the Township of Millburn and the community at large." 
        Learn more about the committee and the community service awards<a href = "https://twp.millburn.nj.us/188/Community-Service-Award-Committee">here.</a> 
        <br> <br>In 2021, Young Heroes is a new initiative that builds on the CSAC’s mission statement by creating an additional award category that recognizes the youth of the Millburn Township community.
         It was inspired and developed during the COVID-19 pandemic in 2020 by Scouts BSA Troop 19 Scout Riya Tyagi. As part of her Eagle Scout Project, Ms. Tyagi partnered with the CSAC to develop and support
          youth engagement in community service and created this website to facilitate nominations from the public. <br> <br> The only requirement to be eligible for an award is to be a Millburn Township resident or volunteer who does not receive any direct financial reward for their service.
      </p>
    </div>

    <div id = "getinvolved">
          <div id = "nominateahero">
            <h2> How to Get Involved</h2> 
            <br>
              <h3> 1. Nominate a Hero!</h3>
              <h4> The Millburn CSAC is accepting public nominations for the Community Service Awards.</h4>
                <p> Nominate an adult or young hero in Millburn Township who you feel has completed profound service work that demonstrates measurable improvement to the greater community. <br><p>      
               <h3>  2. Spread the Word </h3> <p>Please communicate word of this incredible service recognition opportunity with others!</p>
               <!--<h3> 3. <a href = "https://forms.gle/pbJxUtVEzWF9bCSh6"> Volunteer </a></h3>  <p> Millburn Township Young Heroes is an Eagle Scout Project by Riya Tyagi of Troop 19. Volunteer to help her out! </p> -->
               <!-- <h3> 4.<a href = "https://gf.me/u/y3cpyf">Donate</a> </h3> <p> Donate to recognize heroes and their causes. We are very grateful for all donations. All money received will be used to purchase bronze 
                  plaques to recognize winners of the awards and to handle the costs of advertising and creating a website. Any extra funds will be donated to the CSAC for future use.</li>
                </p>  -- Put this in explanation of Project --- part of narrative, footer  NICE 
                
                Any youth nominee will also 
                become a member of the inaugural class of Youth Heroes award winners. 
                                The committee will be accepting nominations at all times of the year.-->
            </div> 
    </div>

      <!--<div id = "impact">
        <h2> Our Impact</h2>
        <h3> ____ Youth Heroes Recognized </h3>
        <h3> ____ Adult Heroes Recognized </h3>
        <h3> ____ Awards Given</h3>
      </div>-->

    <h4 style = "width: 80%; margin: 0 auto;"> </h4>

    <br> 

    <p> If you have any questions or would like more information, please email<a href = "mailto:administrator@millburntwp.org">administrator@millburntwp.org</a> with subject line "Community Service Awards".</p>


     <?php
      footer();
     ?>


   


</body>
</html>

