<?PHP
/*
    Contact Form from HTML Form Guide
    This program is free software published under the
    terms of the GNU Lesser General Public License.
    See this page for more info:
    http://www.html-form-guide.com/contact-form/simple-php-contact-form.html
*/
require_once("./include/fgcontactform.php");

$formproc = new FGContactForm();


//1. Add your email address here.
//You can add more than one receipients.
$formproc->AddRecipient('dvm2016@fvm.ukim.edu.mk'); //<<---Put your email address here

//2. For better security. Get a random tring from this link: http://tinyurl.com/randstr
// and put it here
$formproc->SetFormRandomKey('CnRrspl1FyEylUj');


if(isset($_POST['submitted']))
{
   if($formproc->ProcessForm())
   {

    /*-----------POCETOK-----------Kod za postavuvanje na podatoci vo baza---------------------------------------------*/
       // At this point in the code, we know someone has posted data and
  // is trying to post a comment. We therefore need to now connect
  // to the database

  // Below we are setting up our connection to the server. Because
  // the database lives on the same physical server as our php code,
  // we are connecting to "localhost". inmoti6_myuser and mypassword
  // are the username and password we setup for our database when
  // using the "MySQL Database Wizard" within cPanel
  $con = mysql_connect("localhost","fvmukim_viktor","V3t3r1na");

  // The statement above has just tried to connect to the database.
  // If the connection failed for any reason (such as wrong username
  // and or password, we will print the error below and stop execution
  // of the rest of this php script
  if (!$con)
  {
    die('Could not connect: ' . mysql_error());
  }

  // We now need to select the particular database that we are working with
  // In this example, we setup (using the MySQL Database Wizard in cPanel) a
  // database named inmoti6_mysite
  mysql_select_db("fvmukim_dvm", $con);

  // We now need to create our INSERT command to insert the user's
  // comment into the database.
  //
  // Let's first take a look at the sample INSERT code we received when we
  // used phpMyAdmin to create a test comment:
  //
  // INSERT INTO `inmoti6_mysite`.`comments` (`id`, `name`, `email`, `website`,
  // `comment`, `timestamp`, `articleid`) VALUES (NULL, 'John Smith',
  // 'johns@domain.com', 'johnsmith.com', 'This is a test comment.',
  // CURRENT_TIMESTAMP, '1');
  //
  // If we ran this command, it would insert the same exact comment from John
  // Smith every time. What we need to do is update this query so that it
  // includes all of the data that the user typed in.
  //
  // When we setup our HTML Form, some of the text boxes we used were:
  // <input type='text' name='name' id='name' />
  // <input type='text' name='email' id='email' />
  // The important information we need from this is the "id" that is set.
  // For example, to get the user's name, we can grab the 'name'. To
  // get their email address, we need to get the value of 'email'.
  //
  // Using the $_POST variable, we can get this data. This is what we're
  // doing below
  $users_name = $_POST['name'];
  $users_degree = $_POST['degree'];
  $users_address = $_POST['address'];
  $users_institution = $_POST['institution'];
  $users_postalcode = $_POST['postalcode'];
  $users_country = $_POST['country'];
  $users_phone = $_POST['phone'];
  $users_email = $_POST['email'];
  $users_person1 = $_POST['person1'];
  $users_person2 = $_POST['person2'];
  $users_person3 = $_POST['person3'];
  $users_person4 = $_POST['person4'];
  
  $users_80e_Participants_before_June = $_POST['80e_Participants_before_June'];
  $users_100e_Participants_after_July = $_POST['100e_Participants_after_July'];
  
  $users_70e_Accompanying_Persons_before_June = $_POST['70e_Accompanying_Persons_before_June'];
  $users_100e_Accompanying_Persons_after_June = $_POST['100e_Accompanying_Persons_after_June'];
  
  $users_150e_Package_SingleRoom_before_June = $_POST['150e_Package_SingleRoom_before_June'];
  $users_180e_Package_SingleRoom_after_July = $_POST['180e_Package_SingleRoom_after_July'];

  $users_120e_Package_DoubleRoom_before_June = $_POST['120e_Package_DoubleRoom_before_June'];
  $users_150e_Package_DoubleRoom_after_July = $_POST['150e_Package_DoubleRoom_after_July'];

  $users_30e_Ohrid_Tour_dinner = $_POST['30e_Ohrid_Tour_dinner'];

  // We now have all of the data that the user inputed. What you don't want
  // to do is trust the user's input. Savy users / hackers may attempt to use
  // an sql injection attack in order to run sql statements that you did not
  // intend to run. For example, the following is a basic query for checking
  // someone's username and password:
  //
  // SELECT * FROM users WHERE user='USERNAME' AND password='PASSWORD'
  //
  // In the above, we're assuming the user typed USERNAME as their username and
  // PASSWORD as their PASSWORD. But, what if the user typed the following as
  // their password?
  //
  // ' OR ''='
  //
  // The new query would then be the following:
  //
  // SELECT * FROM users WHERE user='USERNAME' AND password='' OR ''=''
  //
  // Running the above query would allow anyone to login as any user! We can use
  // the mysql_real_escape_string function to escape the user's input. If used in
  // the above example, the new query would read:
  //
  // SELECT * FROM users WHERE user='USERNAME' AND password='\' OR \'\'=\''
  //
  // Because the single quotes are "escaped" (i.e. appended with a backslash), the
  // hackers attempt would fail.
  $users_name = mysql_real_escape_string($users_name);
  $users_degree = mysql_real_escape_string($users_degree);
  $users_address = mysql_real_escape_string($users_address);
  $users_institution = mysql_real_escape_string($users_institution);
  $users_postalcode = mysql_real_escape_string($users_postalcode);
  $users_country = mysql_real_escape_string($users_country);
  $users_phone = mysql_real_escape_string($users_phone);
  $users_email = mysql_real_escape_string($users_email);
  $users_person1 = mysql_real_escape_string($users_person1);
  $users_person2 = mysql_real_escape_string($users_person2);
  $users_person3 = mysql_real_escape_string($users_person3);
  $users_person4 = mysql_real_escape_string($users_person4);
  
  $users_80e_Participants_before_June = mysql_real_escape_string($users_80e_Participants_before_June);
  $users_100e_Participants_after_July = mysql_real_escape_string($users_100e_Participants_after_July);
  
  $users_70e_Accompanying_Persons_before_June = mysql_real_escape_string($users_70e_Accompanying_Persons_before_June);
  $users_100e_Accompanying_Persons_after_June = mysql_real_escape_string($users_100e_Accompanying_Persons_after_June);
  
  $users_150e_Package_SingleRoom_before_June = mysql_real_escape_string($users_150e_Package_SingleRoom_before_June);
  $users_180e_Package_SingleRoom_after_July = mysql_real_escape_string($users_180e_Package_SingleRoom_after_July);

  $users_120e_Package_DoubleRoom_before_June = mysql_real_escape_string($users_120e_Package_DoubleRoom_before_June);
  $users_150e_Package_DoubleRoom_after_July = mysql_real_escape_string($users_150e_Package_DoubleRoom_after_July);

  $users_30e_Ohrid_Tour_dinner = mysql_real_escape_string($users_30e_Ohrid_Tour_dinner);
  
  // We also need to get the article id, so we know if the comment belongs
  // to page 1 or if it belongs to page 2. The article id is going to be
  // passed in the URL. For example, looking at this URL:
  //
  // http://phpandmysql.inmotiontesting.com/page1.php?id=1
  //
  // The article id is 1. To get data from the url, use the $_GET variable,
  // as in:
  //  $articleid = $_GET['id'];

  // We also want to add a bit of security here as well. We assume that the $article_id
  // is a number, but if someone changes the URL, as in this manner:
  // http://phpandmysql.inmotiontesting.com/page2.php?id=malicious_code_goes_here
  // ... then they will have the potential to run any code they want in your
  // database. The following code will check to ensure that $article_id is a number.
  // If it is not a number (IE someone is trying to hack your website), it will tell
  // the script to stop executing the page
  // if( ! is_numeric($articleid) )
  //  die('invalid article id');

  // At this point, we've grabbed all of the data that we need. We now need
  // to update our SQL query. For example, instead of "John Smith", we'll
  // use $users_name. Below is our updated SQL command:
  $query = "
  INSERT INTO `fvmukim_dvm`.`participants` (`id`, `fullname`, `degree`, `address`, `institution`, 
  `postal`, `country`, `phone`, `email`, `person1`, `person2`, `person3`, `person4`, 
  `confeepartbef`, `confeeaccbef`, `singleroombef`, `confeepartaft`, `confeeaccaft`, `singleroomaft`, 
  `doubleroombef`, `doubleroomaft`, `socfeetour`, `date`) VALUES (NULL, '$users_name', '$users_degree',
         '$users_address', '$users_institution', '$users_postalcode', '$users_country', '$users_phone',
         '$users_email', '$users_person1', '$users_person2', '$users_person3', '$users_person4', 
         '$users_80e_Participants_before_June', '$users_70e_Accompanying_Persons_before_June', 
         '$users_150e_Package_SingleRoom_before_June', '$users_100e_Participants_after_July', 
         '$users_100e_Accompanying_Persons_after_June', '$users_180e_Package_SingleRoom_after_July', 
         '$users_120e_Package_DoubleRoom_before_June', '$users_150e_Package_DoubleRoom_after_July',
         '$users_30e_Ohrid_Tour_dinner', CURRENT_TIMESTAMP)";

  // Our SQL stated is stored in a variable called $query. To run the SQL command
  // we need to execute what is in the $query variable.
  mysql_query($query);

  // We can inform the user to what's going on by printing a message to
  // the screen using php's echo function
  // echo "<h2>Thank you for your Comment!</h2>";

  // At this point, we've added the user's comment to the database, and we can
  // now close our connection to the database:
  mysql_close($con);
  /*-----------KRAJ-----------Kod za postavuvanje na podatoci vo baza---------------------------------------------*/

        $formproc->RedirectToURL("thank-you.php");
   }
}

?>
      
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" type="image/x-icon" href="images/fvms.png" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<script type='text/javascript'>

(function()
{
  if( window.localStorage )
  {
    if( !localStorage.getItem( 'firstLoad' ) )
    {
      localStorage[ 'firstLoad' ] = true;
      window.location.reload();
    }  
    else
      localStorage.removeItem( 'firstLoad' );
  }
})();

</script>

    <title>Days of veterinary medicine 2016</title>

    <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/animate.css">
        <link href="css/animate.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet" />
        <link rel="shortcut icon" type="image/x-icon" href="images/fvms.png" />

       <script type='text/javascript' src='Scripts/gen_validatorv31.js'></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body onLoad="resizingWindowLoaded('1024px', '768px')"
  onResize="resizingWindowResized()">
      <!-- Preloader -->
<div id="preloader">
  <div id="loader">
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="lading"></div>
  </div>
</div>
<!-- /#preloader -->
<!-- Preloader End-->	
<header id="header">
  <nav class="navbar navbar-default navbar-static-top" role="banner">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <div class="navbar-brand">
            <table><tr>
                <td style="vertical-align: top;">
                <img src="images/ukim.gif" alt="ukim" style="height: 50px; width: 50px;" />
                    &nbsp;&nbsp;&nbsp;
                </td>
                <td>
                <a href="index.html">
                <h1>"Ss. Cyril and Methodius"</br>University in Skopje</br>
                    Faculty of Veterinary</br>Medicine in Skopje
                </h1>
                </a>
                </td><td style="vertical-align: top;">
                &nbsp;&nbsp;&nbsp;
                <img src="images/fvms.png" alt="fvms" style="height: 50px; width: 50px;" />
            
                </td>
            </tr></table>  
        </div>
      </div>
      <div class="navbar-collapse collapse">
        <div class="menu">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><a href="index.html">Home</a></li>
            <li role="presentation"><a href="orgcom.html">Organizer</a></li>
            <li role="presentation"><a href="venue.html">Accommodation</a></li>
            <li role="presentation"><a href="program.html">Program</a></li>
            <li role="presentation"><a href="callforpapers.html">Abstracts</a></li>
            <li role="presentation"><a href="geninfo.html">Information's</a></li>
            <li role="presentation"><a href="registration.php" class="active">Register</a></li>
          </ul>
        </div>
      </div>
    </div>
    <!--/.container-->
  </nav>
  <!--/nav-->
</header><!--/header-->	   
    <center><div class="col-md-12" style=" padding-top: 10px; padding-bottom: 30px;">
    <table><tr><td style="text-align: center; ">
        <p style="font-size: x-large;" >
           7<sup>th</sup> International Scientific Meeting - “Days of veterinary medicine-2016”</br>
            22 - 24 September 2016, Struga, R. of Macedonia
        </p>
    </td></tr></table>
    </div>
            </center> 
<!--   
<center>
</br><h3>The <a href="Registration Form DVM2015.pdf" target="_blank"><strong>registration form</strong></a>  can be submitted on line or via e-mail, mail and fax too.</h3>
</center> 
-->     
      <div class="row team-bar">
					<div class="first-one-arrow hidden-xs">
						<hr>
					</div>
					<div class="first-arrow hidden-xs">
						<hr> 
					</div>
					<div class="second-arrow hidden-xs">
						<hr> 
					</div>
					<div class="third-arrow hidden-xs">
						<hr>
					</div>
					<div class="fourth-arrow hidden-xs">
						<hr>
					</div>
	   </div> <!--skill_border-->

<!-- Form Code Start -->
<form id='contactus' action='<?php echo $formproc->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<fieldset>

<input type='hidden' name='submitted' id='submitted' value='1'/>
<input type='hidden' name='<?php echo $formproc->GetFormIDInputName(); ?>' value='<?php echo $formproc->GetFormIDInputValue(); ?>'/>
<input type='text'  class='spmhidip' name='<?php echo $formproc->GetSpamTrapInputName(); ?>' style='display:none;'/>

<!--------------------------------PERSONAL INFORMATION----------------------------------------------------------------->
<div class="container">
			<div style="text-align: justify;">
                
               <center> <p><font color="red" >*</font> required fields</p></center>
                <div class="col-md-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" >

                <div><span class='error'><?php echo $formproc->GetErrorMessage(); ?></span></div>
                
                <center><h2>PERSONAL INFORMATION</h2>
                 
                <table><tr><td>
                           
                <p><label for='name' >Full Name and Surname:<font color="red">*</font> </label></br>
                <input type='text' name='name' id='name' value='<?php echo $formproc->SafeDisplay('name') ?>' maxlength="80" /><br/>
                <span id='contactus_name_errorloc' class='error'></span>
                </p>
          
                <p><label for='degree' >Professional Degree:</label></br>
                <input type='text' name='degree' id='degree' value='<?php echo $formproc->SafeDisplay('degree') ?>' maxlength="50" /><br/>
                <!--<span id='contactus_email_errorloc' class='error'></span>-->
                </p>
         
                <p><label for='address' >Address:</label></br>
                <input type='text' name='address' id='address' value='<?php echo $formproc->SafeDisplay('address') ?>' maxlength="80" /><br/>
                <!--<span id='contactus_email_errorloc' class='error'></span>-->
                </p>
                    
                <p><label for='institution'>Institution:</label></br>
                <input type='text' name='institution' id='institution' value='<?php echo $formproc->SafeDisplay('institution') ?>' maxlength="100" /><br/>
                <!--<span id='contactus_email_errorloc' class='error'></span>-->
                </p>
             </td><td style="padding-left: 70px;">
                <p><label for='postalcode'>Postal Code and City:</label></br>
                <input type='text' name='postalcode' id='postalcode' value='<?php echo $formproc->SafeDisplay('postalcode') ?>' maxlength="150" /><br/>
                <!--<span id='contactus_email_errorloc' class='error'></span>-->
                </p>
                           
                <p><label for='country' >Country:</label></br>
                <input type='text' name='country' id='country' value='<?php echo $formproc->SafeDisplay('country') ?>' maxlength="50" /><br/>
                <!--<span id='contactus_email_errorloc' class='error'></span>-->
                </p>
        
                <p><label for='phone' >Phone Number:<font color="red">*</font></label></br>
                <input type='text' name='phone' id='phone' value='<?php echo $formproc->SafeDisplay('phone') ?>' maxlength="15" /><br/>
                <span id='contactus_phone_errorloc' class='error'></span>
                </p>
           
                <p><label for='email' >Email Address:<font color="red">*</font></label></br>
                <input type='text' name='email' id='email' value='<?php echo $formproc->SafeDisplay('email') ?>' maxlength="50" />
                <span id='contactus_email_errorloc' class='error'></span>
                </p>
                    </td></tr></table>
                    </center>
            </div>
                                <div class="col-md-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" >
                                <center>
                <h2>ACCOMPANYING PERSON/S</h2>

                <table><tr><td>
        
                                <p><label for='person1' >Person 1 Full Name: </label><br/>
                                <input type='text' name='person1' id='person1' value='<?php echo $formproc->SafeDisplay('person1') ?>' maxlength="80" />
                                </p>
           
                                <p><label for='person2' >Person 2 Full Name: </label><br/>
                                <input type='text' name='person2' id='person2' value='<?php echo $formproc->SafeDisplay('person2') ?>' maxlength="80" />
                                </p>
                        </td>
                        <td style="padding-left: 70px;">
           
                                <p><label for='person3' >Person 3 Full Name: </label><br/>
                                <input type='text' name='person3' id='person3' value='<?php echo $formproc->SafeDisplay('person3') ?>' maxlength="80" />
                                </p>
            
                                <p><label for='person4' >Person 4 Full Name: </label><br/>
                                <input type='text' name='person4' id='person4' value='<?php echo $formproc->SafeDisplay('person4') ?>' maxlength="80" />
                                </p>
            
                        </td></tr></table>
                    </center>
                   </div>
        
    </div>
</div>
<!--------------------------------PERSONAL INFORMATION----------------------------------------------------------------->


<!--------------------------------ACCOMPANYING PERSON----------------------------------------------------------------->

<!--------------------------------PAYMENT OF CONFERENCE FEES----------------------------------------------------------------->
<center>
<div class="container">
			<div style="text-align: justify;">

                <div class="col-md-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="700ms" >

<h3>1. PAYMENT OF CONFERENCE FEES</h3>

<table>
    <tr>
        <td></td>
        <td style="padding-left: 10px; text-align: center; width: 150px;">
            <p><label for='80e_Participants_before_June' ><font color="red">Before June 30, 2016</font></label></p></td>
        <td style="padding-left: 30px; text-align: center; width: 150px;">
            <p><label for='100e_Participants_after_July' ><font color="red">After July 01, 2016</font></label></p></td>
    </tr>
    <tr>
        <td style="text-align: left; vertical-align: middle;">
          
                <p><label>Participants<font color="red">*</font></label></p>
          
        </td>
        <td style="text-align: right; padding-right: 20px;">
                <p style="color: red;"><input name='80e_Participants_before_June' type='checkbox' id='80e_Participants_before_June' value='80' style='visibility:hidden;' />
                    &nbsp;&nbsp;80 €
                </p>
            
        </td>
        <td style="text-align: right; padding-right: 20px;">
                <p><input name='100e_Participants_after_July' type='checkbox' id='100e_Participants_after_July' value='100' />
                    100 €
                </p>
            
        </td>
    </tr>
    <tr>
        <td style="text-align: left; vertical-align: middle;">
           
                <p><label>Accompanying Persons/Residents/Students<font color="red">**</font></label></p>
            
        </td>
        <td style="text-align: right; padding-right: 20px;">
                <p style="color: red;"><label for='70e_Accompanying_Persons_before_June' ></label>
                <input name='70e_Accompanying_Persons_before_June' type='checkbox' id='70e_Accompanying_Persons_before_June' value='70' style='visibility:hidden;' />
               &nbsp;&nbsp;70 €
                </p>
            
        </td>
        <td style="text-align: right; padding-right: 20px;">
                <p><label for='100e_Accompanying_Persons_after_June' ></label>
                <input name='100e_Accompanying_Persons_after_June' type='checkbox' id='100e_Accompanying_Persons_after_June' value='100' />
                    100 €
                </p>
           
        </td>
    </tr>
</table>
          
<!--------------------------------PAYMENT OF CONFERENCE FEES----------------------------------------------------------------->

<!--------------------------------Conference Fee  includes----------------------------------------------------------------->	 	

<table style="padding-left: 200px;">
    <tr>
        <td colspan="2">
           <p><b><font color="red">*</font>Conference Fee for Participants/ Students includes:</b></p>
        </td>
    </tr>
    <tr>
        <td style="text-align: left;  padding-left: 50px;">
            <p><font color="red">&#X25CE;</font> Conference kit</p>
            <p><font color="red">&#X25CE;</font> Coffee breaks</p>
            <p><font color="red">&#X25CE;</font> Welcome cocktail</p>				  
        </td>
        <td style="text-align: left;">
            <p><font color="red">&#X25CE;</font> One gala dinner ticket</p>
            <p><font color="red">&#X25CE;</font> Luncheons</p>             
        </td>					
    <tr>
        <td colspan="2" >
            <p><b><font color="red">**</font>Accompanying Persons Conference Fee includes:</b></p>                        
        </td>
    </tr>					
    <tr>
        <td style="text-align: left; padding-left: 50px;">
            <p><font color="red">&#X25CE;</font> Coffee breaks</p>
            <p><font color="red">&#X25CE;</font> Welcome cocktail</p>					  
        </td>
        <td style="text-align: left; padding-left: 50px;">
            <p><font color="red">&#X25CE;</font> One gala dinner ticket</p>
            <p><font color="red">&#X25CE;</font> Luncheons</p>                          
        </td>
    </tr>
</table>
        </div>
    </div>

    <div style="text-align: justify;">

         <div class="col-md-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1000ms" >
             <h3>2. ACCOMODATION</h3>

                <table style="text-align:center;">
                    <tr>
                        <td></td>
                        <td style="padding-left: 10px; text-align: center;">
                            <p><label for='150e_Package_SingleRoom_before_June' ><font color="red">Before June 30, 2016</font></label></p></td>
                        <td style="padding-left: 30px; text-align: center;">
                            <p><label for='180e_Package_SingleRoom_after_July' ><font color="red">After July 01, 2016</font></label></p></td>
                    </tr>
                    <tr>
                        <td  style="text-align: left; vertical-align: middle;" colspan="2">
                            <p><label>Participants/Accompanying Persons/Residents/Students</label></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><font color="red">*</font>Package for 3 nights in Single Room</p>
                        </td>
                        <td>
                                <p style="color: red;"><input name='150e_Package_SingleRoom_before_June' type='checkbox' id='150e_Package_SingleRoom_before_June' value='150' style='visibility:hidden;' />
                                    150 €
                                </p>
                        </td>
                        <td>
                                <p><input name='180e_Package_SingleRoom_after_July' type='checkbox' id='180e_Package_SingleRoom_after_July' value='180' />
                                    180 €
                                </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><font color="red">**</font>Package for 3 nights in Double Room</p>
                        </td>
                        <td>
                                <p style="color: red;"><input name='120e_Package_DoubleRoom_before_June' type='checkbox' id='120e_Package_DoubleRoom_before_June' value='120' style='visibility:hidden;' />
                                    120 €
                                </p>
                        </td>
                        <td>
                                <p><input name='150e_Package_DoubleRoom_after_July' type='checkbox' id='150e_Package_DoubleRoom_after_July' value='150' />
                                    150 €
                                </p>
                        </td>
                    </tr>
                </table>
<table style="padding-left: 200px;">
    <tr>
        <td>
           <p><b><font color="red">*</font>Participants/Accompanying Persons/Students accommodation fee includes: </b></p>
        </td>
    </tr>
    <tr>
        <td style="text-align: left;  padding-left: 50px;">
            <p><font color="red">&#X25CE;</font> Accommodation for 3 days per person (breakfas is included)</p>
            <p><font color="red">&#X25CE;</font> Free WiFi access is available</p>
            <p><font color="red">&#X25CE;</font> Free private parking is possible on site</p>
            <p><font color="red">&#X25CE;</font> Free spa and wellness centre with a hammam, sauna, fitness centre and indoor pool.</p>             
        </td>
    </tr>
</table>
</div>

<div class="col-md-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" >
    </br></br>        
    <p style="color: red; padding-left: 140px;">PLEASE NOTE</p></br>
            <ul style="color: #808080; padding-left: 140px;">
                <li>The Conference Organizer offer special rates for the 3 night package rooms per person in the Hotel Izgrev*****.</li>
                <li>For the participants, the booking the hotel rooms with the special pieces are possible only trough the Conference Organizer.</li>
            </ul>
</div>
        <center>
<div class="col-md-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" >
<h3>3. SOCIAL PROGRAM</h3>

                <table style="text-align:center;">
                    <tr>
                        <td  style="text-align: left; vertical-align: middle;">
                            <p><label>Guided Ohrid Tour & DINNER at National Macedonian Restaurant</label></p>
                        </td>
                        <td style="padding-left: 100px;">
                                <p><input name='30e_Ohrid_Tour_Dinner' type='checkbox' id='30e_Ohrid_Tour_Dinner' value='30' />
                                    30 €
                                </p>
                        </td>
                    </tr>
                </table>
    <table style="padding-left: 200px;">
    <tr>
        <td>
           <p><b><font color="red">**</font>Participants/Accompanying Persons/Students social program fee includes:</b></p>
        </td>
    </tr>
    <tr>
        <td style="text-align: left;  padding-left: 50px;">
            <p><font color="red">&#X25CE;</font> Dinner at National Macedonian Restaurant (optional)</p>
            <p><font color="red">&#X25CE;</font> Boat tour trough Ohrid lake and historical tour to Ohrid city</p>
        </td>
        <td style="text-align: left;  padding-left: 50px;">
            <p><font color="red">&#X25CE;</font> Tickets to all historical museums in Ohrid</p>
            <p><font color="red">&#X25CE;</font> Surely of attendance</p>             
        </td>
    </tr>
</table>
</div>
 </center>           

    </div>
</div>
     </center>
<!------------------------------------------------------------------------------------------------->	 	
 	
<!------------------------------------------------------------------------------------------------->	 	
<div class="container">
			<div style="text-align: justify;">
                <div class="col-md-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" > 

    <div style="text-align: center;">
        
        <div class="form-group">
              <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Submit Form</button></br></br>
        </div>
   <!--- <p><input type='submit' name='Submit' id="submit" value='Submit'/></p>-->
</div>
<div class="clear"></div>

        </div>
    </div>
</div>
<!----------------------------------------------------------------------------------------------->
</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com ------------------------------------------------------------------------>

<script type='text/javascript'>
// <![CDATA[
    var frmvalidator  = new Validator("contactus");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("name","req","Please provide your name");

    frmvalidator.addValidation("email","req","Please provide your email address");
	
	

    frmvalidator.addValidation("email","email","Please provide a valid email address");
	

    frmvalidator.addValidation("message","maxlen=2048","The message is too long!(more than 2KB!)");

    frmvalidator.addValidation("phone","req","Please provide your phone number");
// ]]>
</script>           


<div class="container">
			<div style="text-align: justify;">

				<div class="col-md-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" >

<h3>PAYMENT</h3>
	

            <blockquote>
			     <div style="text-align: left;">
                      <p><strong>Correspondent bank details (:56:):</strong><br />
                      DEUTSCHE BUNDESBANK  ZENTRALE<br />
                      Address: Wilhelm  Epstein strasse 14, Frankfurt am Main, GERMANY SWIFT BIC: MARK DE FF<br />
                      <strong>Bank details (:57:):</strong><br />
                      NATIONAL BANK OF THE  REPUBLIC OF MACEDONIA<br />
                      Address: Bul  &quot;Kuzman Josifovski Pitu&quot; br. 1<br />
                      1000 Skopje,  MACEDONIA<br />
                      SWIFT BIC: NBRM MK 2X<br />
                      <strong>Final beneficiary (:59:):</strong><br />
                      IBAN: MK07 1007 0100  0011 422<br />
                      <strong>Name: </strong> Faculty of veterinary medicine - Skopje
                      </p>
                 </div>
             </blockquote>
             </div>

            <div class="col-md-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" >
      
            <h3>GENERAL CONDITIONS</h3>
	  
             <blockquote>
                  <p style="text-align: justify;">&raquo; All payments must be made in <strong>Euros</strong>.<br />
                        &raquo; Please write <strong>“</strong><strong>DAYS OF VETERINARY  MEDICINE 2016</strong><strong>” </strong>and <strong>your full name</strong> on the money transfer. Also, please send us the transfer BANK copy by fax, (transfer order is not valid).<br />
						&raquo; Bank transfer charges must be paid by the participant. 
                  </p>
                  <p style="text-align: justify;"><strong>CONFERENCE CANCELLATION / REFUND POLICY</strong><br />
                       &raquo; All cancellations made <strong>before June 15st</strong> will be subject to a penalty of 100 €.<br />
                        &raquo; All cancellations made <strong>after June 15st</strong> will be subject to a penalty of the total amount paid. 
                  </p>
             </blockquote>
       
            </div>
        </div>
    </div>

<!------------------------------------------------------------------------------------------------->	 	
<div class="container">
			<div style="text-align: justify;">
                <div class="col-md-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" > 

    <div style="text-align: center;">
        <p style="color: black;"><strong>Please note:</strong> <span >Any College student with a letter of approval from faculty advisor may attend the conference at the special rate.</span></p>
        <div style="text-align: center;"><p style="color: red;">Please send us copy of the receipt of yout Bank Transfer to avoid any possible mistake on the following mail:</sp></div>
            <p style="text-align:center;"><a href="mailto: dvm2016@fvm.ukim.edu.mk"><b>dvm2016@fvm.ukim.edu.mk</b></a></p>
</div>
<div class="clear"></div>

        </div>
    </div>
</div>
<!----------------------------------------------------------------------------------------------->



</div> <!-- end of post body -->
                            
</div> <!-- end of a post -->
			
<div class="cleaner"></div> 
  
</div> <!-- templatemo_content -->

<footer>
<div class="container">
<div class="col-md-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="200ms">
  <h4>About Us</h4>
  <p>Faculty of Veterinary Medicine in Skopje</p>
  <div class="contact-info">
    <ul>
      <li><i class="fa fa-home fa"></i>&nbsp; Address: Lazar Pop-Trajkov 5-7,</br> 1000 Skopje, R. Macedonia </br></br></li>
      <li><i class="fa fa-phone fa"></i>&nbsp; Tel: +389 2 3240 700</li>
      <li><i class="fa fa-phone fa"></i>&nbsp; Fax: +389 2 3114 619</li>
      <li><i class="fa fa-envelope fa"></i>&nbsp; E-mail: <a href="mailto: dvm2016@fvm.ukim.edu.mk">dvm2016@fvm.ukim.edu.mk</a></li>
      <li><i class="fa fa-web fa"></i>Web: &nbsp; <a href="http://fvm.ukim.edu.mk/en" target="_blank">www.fvm.ukim.edu.mk</a></li>
    </ul>
  </div>
</div>

    <div class="col-md-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="500ms">
  <h4>&nbsp;</h4>
  <p>"Ss. Cyril and Methodius" University in Skopje</p>
  <div class="contact-info">
    <ul>
      <li><i class="fa fa-home fa"></i>&nbsp; Address: blvd. Goce Delcev 9,<br> 1000 Skopje, R. Macedonia<br></br></li>
      <li><i class="fa fa-phone fa"></i>&nbsp; Tel: +389 3293 293 (call centar)</li>
      <li><i class="fa fa-phone fa"></i>&nbsp; Fax: +389 3293 202</li>
      <li><i class="fa fa-envelope fa"></i>&nbsp; E-mail: <a href="mailto: dvm2016@fvm.ukim.edu.mk">ukim@ukim.edu.mk</a></li>
      <li><i class="fa fa-web fa"></i>Web: &nbsp; <a href="http://ukim.edu.mk/en_index.php" target="_blank">www.ukim.edu.mk</a></li>
    </ul>
  </div>
</div>


    <!--
<div class="col-md-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="500ms">
  <div class="text-center">
    <h4>Photo Gallery</h4>
    <ul class="sidebar-gallery">
      <li><a href="#"><img src="img/gallery1.png" alt="" /></a></li>
      <li><a href="#"><img src="img/gallery2.png" alt="" /></a></li>
      <li><a href="#"><img src="img/gallery3.png" alt="" /></a></li>
      <li><a href="#"><img src="img/gallery4.png" alt="" /></a></li>
      <li><a href="#"><img src="img/gallery5.png" alt="" /></a></li>
      <li><a href="#"><img src="img/gallery6.png" alt="" /></a></li>
    </ul>
  </div>
</div>
     -->
<div class="col-md-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="800ms">
  <div class="">
    <h4>Design and Edited by:</h4>
    
				 <a href="http://www.linkedin.com/pub/viktor-denkovski/18/b9/762" target="_blank">MSc Viktor Denkovski</a><br> System Administrator at Faculty of Veterinary Medicine - Skopje<br>
                </br></br> Copyright Content © 2016 <a href="http://fvm.ukim.edu.mk/en/" target="_blank">&nbsp;</br>Faculty of Veterinary Medicine - Skopje</a>
    </br></br>
            <a href="contact.html" style="font-size: x-large;">Contact Us
            <img src="img/locationfvms.jpg" alt="FVM Skopje" height="80px;" width="190px;" />
            </a>
  </div>
</div>
</div>   
</footer>
<div class="sub-footer">
  <div class="container">
    <div class="social-icon">
      <div class="col-md-4">
        <ul class="social-network">
          <li><a href="https://www.facebook.com/fvmskopje" target="_blank" class="fb tool-tip" title="Facebook"><i class="fa fa-facebook"></i></a></li>
          <!--<li><a href="#" class="twitter tool-tip" title="Twitter"><i class="fa fa-twitter"></i></a></li>-->
          <!--<li><a href="#" class="gplus tool-tip" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>-->
          <li><a href="https://mk.linkedin.com/in/fvmsalumni" target="_blank" class="linkedin tool-tip" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
          <li><a href="https://www.youtube.com/channel/UCpMxglv_MiHxwucT_4eQdag" target="_blank" class="ytube tool-tip" title="You Tube"><i class="fa fa-youtube-play"></i></a></li>
        </ul>
      </div>
    </div>
    <div class="col-md-4 col-md-offset-4">
      <div class="copyright"> &copy; Day 2016 by <a target="_blank" href="http://bootstraptaste.com/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">Bootstrap Themes</a>.All Rights Reserved. </div>
      <!-- 
                    All links in the footer should remain intact. 
                    Licenseing information is available at: http://bootstraptaste.com/license/
                    You can buy this theme without footer links online at: http://bootstraptaste.com/buy/?theme=Day
                -->
    </div>
  </div>
</div>
    </div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/wow.min.js"></script>

<!--Script for resizing the window = not to deform-->
<script src="resizing_window.js"></script>

<script>
	wow = new WOW(
	 {
	
		}	) 
		.init();
</script>
<!-- jQuery Library -->
<script type="text/javascript" src="assets/js/jquery-2.1.0.min.js"></script>
<!-- Modernizr js -->
<script type="text/javascript" src="assets/js/modernizr-2.8.0.min.js"></script>
<!-- Plugins -->
<script type="text/javascript" src="assets/js/plugins.js"></script>
<!-- Custom JavaScript Functions -->
<script type="text/javascript" src="assets/js/functions.js"></script>
<!-- Custom JavaScript Functions -->
<script type="text/javascript" src="assets/js/jquery.ajaxchimp.min.js"></script>	

<!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
var sc_project=10873464; 
var sc_invisible=1; 
var sc_security="97deb3f1"; 
var scJsHost = (("https:" == document.location.protocol) ?
"https://secure." : "http://www.");
document.write("<sc"+"ript type='text/javascript' src='" + scJsHost+
"statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><a title="free web stats"
href="http://statcounter.com/" target="_blank"><img class="statcounter"
src="http://c.statcounter.com/10873464/0/97deb3f1/1/" alt="free web
stats"></a></div></noscript>
<!-- End of StatCounter Code for Default Guide -->

  </body>
</html>
