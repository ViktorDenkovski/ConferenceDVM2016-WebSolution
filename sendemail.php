<?php
 
if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "lpendovski@fvm.ukim.edu.mk";
 
    $email_subject = "Contact information for DVM 2016";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
 
        echo "These errors appear below.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Please go back and fix these errors.<br /><br />";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['first_name']) ||
 
        !isset($_POST['email']) ||
 
        !isset($_POST['telephone']) ||

        !isset($_POST['company']) ||

        !isset($_POST['subject']) ||
 
        !isset($_POST['comments'])) {
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
 
    }
 
     
 
    $first_name = $_POST['first_name']; // required
 
    $email_from = $_POST['email']; // required
 
    $telephone = $_POST['telephone']; // not required

    $company = $_POST['company']; // not required

    $subject = $_POST['subject']; // required
 
    $comments = $_POST['comments']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
 
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
 
  }
 
  if(!preg_match($string_exp,$subject)) {
 
    $error_message .= 'The Subject you entered does not appear to be valid.<br />';
 
  }
 
  if(strlen($comments) < 2) {
 
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Form details below.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "First Name: ".clean_string($first_name)."\n";
      
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Telephone: ".clean_string($telephone)."\n";

    $email_message .= "Company Name: ".clean_string($company)."\n";

    $email_message .= "Subject: ".clean_string($subject)."\n";
 
    $email_message .= "Message: ".clean_string($comments)."\n";
 
     
 
     
 
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  
 
?>
 
 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" type="image/x-icon" href="images/fvms.png" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Days of veterinary medicine 2016</title>

    <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/animate.css">
<link href="css/animate.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet" />
<link rel="shortcut icon" type="image/x-icon" href="images/fvms.png" />
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
            <li role="presentation"><a href="index.html" >Home</a></li>
            <li role="presentation"><a href="orgcom.html">Organizer</a></li>
            <li role="presentation"><a href="venue.html">Accommodation</a></li>
            <li role="presentation"><a href="program.html">Program</a></li>
            <li role="presentation"><a href="callforpapers.html">Abstracts</a></li>
            <li role="presentation"><a href="geninfo.html">Information's</a></li>
            <li role="presentation"><a href="registration.php">Register</a></li>
          </ul>
        </div>
      </div>
    </div>
    <!--/.container-->
  </nav>
  <!--/nav-->
</header>><!--/header-->
<center><div class="col-md-12" style=" padding-top: 10px; padding-bottom: 30px;">
    <table><tr><td style="text-align: center; ">
        <p style="font-size: x-large;" >
           7<sup>th</sup> International Scientific Meeting - “Days of veterinary medicine-2016”</br>
            22 - 24 September 2016, Struga, R. of Macedonia
        </p>
    </td></tr></table>
    </div>
            </center>
<div class="services">
    <div class=" container col-md-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" >
<center>
<h2>Thank you for contacting us. We will be in touch with you very soon.</h2>
</center>

    </div>

      <div class="container">				
				<div class="col-md-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" >
                    &nbsp;
                    </div>
          </div>
    <div class="container">				
				<div class="col-md-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" >
                    &nbsp;
                    </div>
          </div>
    <div class="container">				
				<div class="col-md-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" >
                    &nbsp;
                    </div>
          </div>
    <div class="container">				
				<div class="col-md-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" >
                    &nbsp;
                    </div>
          </div>
    <div class="container">				
				<div class="col-md-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" >
                    &nbsp;
                    </div>
          </div>
    <div class="container">				
				<div class="col-md-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" >
                    &nbsp;
                    </div>
          </div>
</div>

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
  </body>
</html>
 
<?php
 
}
 
?>