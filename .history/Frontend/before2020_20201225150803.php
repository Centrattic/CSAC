<?php
require '../Backend/functions.php';
session_start();
?>

<html>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">
    <title> Community Service Award Recipients Before 2020 </title>
    <link rel = "stylesheet" href = "../CSS/navbar.css">

  </head>

  <body>

    <?php
        navbar();
    ?>

    <h1> Community Service Award Recipients</h1> <!-- Most recent first!!! -->
    <br>

    <style>
        h1 {
            font-size: 2em;
        }

        #before2020-table {
            margin: 0 auto;
            border: 5px solid black;
            border-radius: 0px;
            background-color: #E2DECC; 
            width: 60%;
        }

        th,td {
            padding: 10px;
        }

        /*td:nth-child(1) {
            border-right: 2px solid black;
            border-radius: 0px;
            padding-bottom: 0px;
            margin-bottom: 0px;
        }*/

        tr {
            border: 2px solid #BEBEBE;
        }

        .last-of-year {
            border-bottom: 6px solid black;
        }

    </style>

    <table id = "before2020-table" rules = "all"> 
        <tr>
            <th> # </th>
            <th> Name </th>
            <th> Date </th>
        </tr>  
        <!-- Most to least recent--> 
        

        <tr class = "last-of-year">
            <td> 85 </td>
            <td> JENNIFER SACHAR DUCKWORTH </td>
            <td> 1/21/20 </td>
        </tr>
		
		<tr>
            <td> 84 </td>
            <td> CARING KIDS </td>
            <td> 11/12/19 </td>
        </tr>
		
		<tr>
            <td> 83 </td>
            <td> ROY & DORIS SERRUTO </td>
            <td> 6/4/19 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 82 </td>
            <td> ROGER MANSHEL</td>
            <td> 4/16/19 </td>
        </tr>
		
		<tr>
            <td> 81 </td>
            <td> KAREN GAYLORD </td>
            <td> 12/4/18 </td>
        </tr>
		
		<tr>
            <td> 80 </td>
            <td> ARLINE SHAPIRO</td>
            <td> 11/17/18 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 79 </td>
            <td> INTERFAITH HOSPITALITY NETWORK OF ESSEX COUNTY IN MILLBURN </td>
            <td> 3/20/18 </td>
        </tr>
		
		<tr>
            <td> 78 </td>
            <td> DEBORAH FRANK </td>
            <td> 12/5/17 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 77 </td>
            <td> EDUCATION FOUNDATION </td>
            <td> 5/16/17 </td>
        </tr>
		<tr>
            <td> 76 </td>
            <td> PETER & SOFIA BLANCHARD </td>
            <td> 12/6/16 </td>
        </tr>
		
		<tr>
            <td> 75 </td>
            <td> BOB HINGEL </td>
            <td> 4/19/16 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 74 </td>
            <td> RICK DOLANSKY </td>
            <td> 4/19/16 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 73 </td>
            <td> KENNETH W. FINERAN </td>
            <td> 9/15/15 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 72 </td>
            <td> ROBERT B. HEINTZ </td>
            <td> 3/18/14 </td>
        </tr>
		
		<tr>
            <td> 71 </td>
            <td> STEVE SUSKAUER </td>
            <td> 11/12/13 </td>
        </tr>
		
		<tr>
            <td> 70 </td>
            <td> ANDREA HIRSCHFELD & LOIS CANTWELL (bookBgone) </td>
            <td> 6/18/13 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 69 </td>
            <td> ED BORNEMAN </td>
            <td> 3/5/13 </td>
        </tr>
		
		<tr>
            <td> 68 </td>
            <td> PEGGY ARNOLD </td>
            <td> 9/11/12 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 67 </td>
            <td> DAVID SIEGFRIED </td>
            <td> 4/17/12 </td>
        </tr>
		
		<tr>
            <td> 66 </td>
            <td> JAKE SILVERMAN FAMILY </td>
            <td> 11/22/11 </td>
        </tr>
		
		<tr>
            <td> 65 </td>
            <td> ALDA KRINSMAN </td>
            <td> 6/21/11 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 64 </td>
            <td> JOHN MURRAY </td>
            <td> 3/1/11 </td>
        </tr>
		
		<tr>
            <td> 63 </td>
            <td> WENDI WEILL </td>
            <td> 10/26/10 </td>
        </tr>
		
		<tr>
            <td> 62 </td>
            <td> NAN WADE </td>
            <td> 5/18/10 </td>
        </tr>

        <tr class = "last-of-year">
            <td> 61 </td>
            <td> FRANK DASTI </td>
            <td> 2/23/10 </td>
        </tr>

        <tr>
            <td> 60 </td>
            <td> JANE KARAN </td>
            <td> 10/6/09 </td>
        </tr>

        <tr>
            <td> 59 </td>
            <td> JOHN “JAKE” DALTON </td>
            <td> 6/23/09 </td>
        </tr>

        <tr class = "last-of-year">
            <td> 58 </td>
            <td> ROBERT M. REED </td>
            <td> 3/31/09 </td>
        </tr>

        <tr>
            <td> 57 </td>
            <td> VACLAV “VIC” BENES </td>
            <td> 6/17/08 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 56 </td>
            <td> MALCOLM MacKINNON </td>
            <td> 4/1/08 </td>
        </tr>

		<tr>
            <td> 55 </td>
            <td> MARIE PACELLE </td>
            <td> 12/18/07 </td>
        </tr>
		
		<tr>
            <td> 54 </td>
            <td> WILLIAM HULSTRUNK </td>
            <td> 6/19/07 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 53 </td>
            <td> TIM ARNOLD </td>
            <td> 4/10/07 </td>
        </tr>
		
		<tr>
            <td> 52 </td>
            <td> JUDITH FREDMAN </td>
            <td> 12/19/06 </td>
        </tr>
		
		<tr>
            <td> 51 </td>
            <td> REGINA ARSI </td>
            <td> 6/20/06 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 50 </td>
            <td> JACK SILVERMAN </td>
            <td> 4/18/06 </td>
        </tr>

        <tr>
            <td> 49 </td>
            <td> JACK CLEMENCE </td>
            <td> 10/25/05 </td>
        </tr>

        <tr class = "last-of-year">
            <td> 48 </td>
            <td> GERALDINE SILVERMAN </td>
            <td> 4/19/05 </td>
        </tr>

        <tr>
            <td> 47 </td>
            <td> ELAINE & KARL BECKER </td>
            <td> 12/21/04 </td>
        </tr>
		
		<tr>
            <td> 46 </td>
            <td> MAUREEN LEE </td>
            <td> 9/21/04 </td>
        </tr>
		
		<tr>
            <td> 45 </td>
            <td> ANNE V. SMITH </td>
            <td> 6/15/04 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 44 </td>
            <td> W. OWEN LAMPE </td>
            <td> 4/8/04 </td>
        </tr>
		
		<tr>
            <td> 43 </td>
            <td> EVA GOTTSCHO </td>
            <td> 12/2/03 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 42 </td>
            <td> WILLIAM E. JUDES </td>
            <td> 6/10/03 </td>
        </tr>
		
		<tr>
            <td> 41 </td>
            <td> DELIA WALBRIDGE </td>
            <td> 12/3/02 </td>
        </tr>
		
		<tr>
            <td> 40 </td>
            <td> SHARON & AVI BRENDER </td>
            <td> 9/10/02 </td>
        </tr>

		<tr class = "last-of-year">
            <td> 39 </td>
            <td> ANGELO Del ROSSI </td>
            <td> 6/11/02 </td>
        </tr>
        
		<tr>
            <td> 38 </td>
            <td> LOUISE GILI </td>
            <td> 11/20/01 </td>
        </tr>
		
		<tr>
            <td> 37 </td>
            <td> THOMAS J. EAKLEY </td>
            <td> 8/21/01 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 36 </td>
            <td> SHERMAN T. BREWER, JR. </td>
            <td> 3/20/01 </td>
        </tr>
		
		<tr>
            <td> 35 </td>
            <td> MARK GUTERMAN </td>
            <td> 12/5/00 </td>
        </tr>
		
		<tr>
            <td> 34 </td>
            <td> ELEANOR T. McGLAUGHLIN </td>
            <td> 9/19/00 </td>
        </tr>
		
		<tr>
            <td> 33 </td>
            <td> JOAN DAESCHLER </td>
            <td> 6/13/00 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 32 </td>
            <td> WALTER JEFFREY, JR. </td>
            <td> 4/18/00 </td>
        </tr>
		
		<tr>
            <td> 31 </td>
            <td> DR. PAUL KEARNEY </td>
            <td> 11/9/99 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 30 </td>
            <td> LEIGH GIFFORD </td>
            <td> 4/13/99 </td>
        </tr>
		
		<tr>
            <td> 29 </td>
            <td> LYNNE RANIERI </td>
            <td> 12/15/98 </td>
        </tr>
		
		<tr>
            <td> 28 </td>
            <td> ELAINE BIRNHOLZ </td>
            <td> 10/20/98 </td>
        </tr>
		
		<tr>
            <td> 27 </td>
            <td> NANCY GOAT </td>
            <td> 6/9/98 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 26 </td>
            <td> JAMES LAURIE </td>
            <td> 3/17/98 </td>
        </tr>
	
		<tr>
            <td> 25 </td>
            <td> JOAN BORNEMAN </td>
            <td> 12/16/97 </td>
        </tr>
		
		<tr>
            <td> 24 </td>
            <td> PHYLLIS KINGSBURY </td>
            <td> 10/7/97 </td>
        </tr>
		
		<tr>
            <td> 23 </td>
            <td> LINDSEY REBECCA HUSTON </td>
            <td> 6/24/97 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 22 </td>
            <td> ALFRED H. CONNELLEE </td>
            <td> 4/19/97 </td>
        </tr>
		
		<tr>
            <td> 21 </td>
            <td> HARRIET LOWENGRUB </td>
            <td> 12/3/96 </td>
        </tr>
		
		<tr>
            <td> 20 </td>
            <td> JOHN S. WARE </td>
            <td> 6/25/96 </td>
        </tr>

        <tr class = "last-of-year">
            <td> 19 </td>
            <td> SUSANNAH J. LIKINS </td>
            <td> 3/19/96 </td>
        </tr>

        <tr>
            <td> 18 </td>
            <td> IRIS STOLOFF </td>
            <td> 12/5/95 </td>
        </tr>

        <tr>
            <td> 17 </td>
            <td> DOUGLAS REED </td>
            <td> 9/5/95 </td>
        </tr>
        
		<tr>
            <td> 16 </td>
            <td> CHARLES T. & DOROTHY KING </td>
            <td> 6/27/95 </td>
        </tr>
        
		<tr class = "last-of-year">
            <td> 15 </td>
            <td> ROBERT E. MARSHALL </td>
            <td> 3/21/95 </td>
        </tr>

        <tr>
            <td> 14 </td>
            <td> LOUIS J. KURTZ </td>
            <td> 2/6/94 </td>
        </tr>

		<tr>
            <td> 13 </td>
            <td> LEZETTE PROUD </td>
            <td> 9/13/94 </td>
        </tr>

		<tr class = "last-of-year">
            <td> 12 </td>
            <td> LAUREN HUSTON </td>
            <td> 6/14/94 </td>
        </tr>
		
		<tr>
            <td> 11 </td>
            <td> DONALD L. CAMPBELL </td>
            <td> 7/6/93 </td>
        </tr>
		
		<tr class = "last-of-year">
            <td> 10 </td>
            <td> MAUREEN S. SILVER </td>
            <td> 4/27/93 </td>
        </tr>

        <tr>
            <td> 9 </td>
            <td> STEPHEN LEIT </td>
            <td> 6/16/92 </td>
        </tr>

        <tr>
            <td> 8 </td>
            <td> MURIEL SCHWARTZSTEIN </td>
            <td> 5/5/92 </td>
        </tr>

        <tr class = "last-of-year">
            <td> 7 </td>
            <td> EVELYN ORTNER </td>
            <td> 3/3/92 </td>
        </tr>
        
        <tr>
            <td> 6 </td>
            <td> LINDA McDONOUGH </td>
            <td> 12/17/91 </td>
        </tr>

        <tr>
            <td> 5 </td>
            <td> ALFRED T. PEDECINE </td>
            <td> 9/3/91 </td>
        </tr>

        <tr>
            <td> 4 </td>
            <td> EDITH CONNELLEE </td>
            <td> 8/16/91 </td>
        </tr>

        <tr>
            <td> 3 </td>
            <td> LORI FRIEDMAN </td>
            <td> 6/11/91 </td>
        </tr>

        <tr>
            <td> 2 </td>
            <td> WILLIAM CONROE </td>
            <td> 5/21/91 </td> 
        </tr>

        <tr>
            <td> 1 </td>
            <td> ELIZABETH NAUGHTON </td>
            <td> 5/5/91 </td> 
        </tr>
        
    </table>



</body>
</html>

