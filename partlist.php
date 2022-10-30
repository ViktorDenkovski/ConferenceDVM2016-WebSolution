<?

//ini_set('display_errors', 1);
// At this point in the code, we want to show all of the comments
// submitted by users for this particular page. As the comments
// are stored in the database, we will begin by connecting to
// the database
 
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

// We now need to setup our SQL query to grab all comments from this page.
// The example SQL query we copied from phpMyAdmin is:
// SELECT * FROM `comments` WHERE `articleid` =1 LIMIT 0 , 30
// If we run this query, it will ALWAYS grab only the comments from our
// article with an id of 1. We therefore need to update the SQL query
// so that on article 2 is searches for the "2", on page is searches for
// "3", and so on.
// If you notice in the URL, the id of the article is set after id=
// For example, in the following URL:
// http://phpandmysql.inmotiontesting.com/page2.php?id=2
// ... the article id is 2. We can grab and store this number in a variable
// by using the following code:

// $article_id = $_GET['id'];

// We also want to add a bit of security here. We assume that the $article_id
// is a number, but if someone changes the URL, as in this manner:
// http://phpandmysql.inmotiontesting.com/page2.php?id=malicious_code_goes_here
// ... then they will have the potential to run any code they want in your
// database. The following code will check to ensure that $article_id is a number.
// If it is not a number (IE someone is trying to hack your website), it will tell
// the script to stop executing the page

// if( ! is_numeric($article_id) )
//  die('invalid article id');

// Now that we have our article id, we need to update our SQL query. This
// is what it looks like after we update the article number and assign the
// query to a variable named $query

$query = "SELECT * FROM `participants`";

// Now that we have our Query, we will run the query against the database
// and actually grab all of our comments

$participants = mysql_query($query);

// Before we start writing all of the comments to the screen, let's first
// print a message to the screen telling our users we're going to start
// printing comments to the page.

echo "

<h2>Online Registered Participants</h2>

<form action='exportlist.php' method='get'>
<button type='submit' name='submit' class='btn btn-primary btn-lg'>Export table to Excel</button></br>
</form>

";

// We are now ready to print our comments! Below we will loop through our
// comments and print them one by one.

$i = 1;

// The while statement will begin the "looping"

echo "
  <table border='1'>
  <thead>
    <tr>
      <th>No.</th>
      <th>DATE</th>
      <th>Full Name</th>
      <th>Prof. Degree</th>
      <th>Address</th>
      <th>Institution</th>
      <th>Postal/City</th>
      <th>Country</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Person 1</th>
      <th>Person 2</th>
      <th>Person 3</th>
      <th>Person 4</th>
      <th>ConFeePartBef</th>
      <th>ConFeePartAft</th>
      <th>ConFeeAccBef</th>
      <th>ConFeeAccAft</th>
      <th>SingleRoomBef</th>
      <th>SingleRoomAft</th>
      <th>DoubleRoomBef</th>
      <th>DoubleRoomAft</th>
      <th>SocFeeTour</tr>
    </tr>
  </thead>
  <tbody>
  ";

while($row = mysql_fetch_array($participants, MYSQL_ASSOC))
{

  // As we loop through each comment, the specific comment we're working
  // with right now is stored in the $row variable.

  // for example, to print the commenter's name, we would use:
  // $row['name']
  
  // if we want to print the user's comment, we would use:
  // $row['comment']
  
  // As this is a beginner tutorial, to make our code easier to read
  // we will take the values above (from our array) and put them into
  // individual variables

  $fullname = $row['fullname'];
  $degree = $row['degree'];
  $address = $row['address'];
  $institution = $row['institution'];
  $postal = $row['postal'];
  $country = $row['country'];
  $phone = $row['phone'];
  $email = $row['email'];
  $person1 = $row['person1'];
  $person2 = $row['person2'];
  $person3 = $row['person3'];
  $person4 = $row['person4'];
  $confeepartbef = $row['confeepartbef'];
  $confeeaccbef = $row['confeeaccbef'];
  $singleroombef = $row['singleroombef'];
  $confeepartaft = $row['confeepartaft'];
  $confeeaccaft = $row['confeeaccaft'];
  $singleroomaft = $row['singleroomaft'];
  $doubleroombef = $row['doubleroombef'];
  $doubleroomaft = $row['doubleroomaft'];
  $socfeetour = $row['socfeetour'];
  $date = $row['date'];
  
  // Be sure to take security precautions! Even though we asked the user
  // for their "name", they could have typed anything. A hacker could have
  // entered the following (or some variation) as their name:
  //
  // <script type="text/javascript">window.location = "http://SomeBadWebsite.com";</script>
  //
  // If instead of printing their name, "John Smith", we would be printing
  // javascript code that redirects users to a malicious website! To prevent
  // this from happening, we can use the htmlspecialchars function to convert
  // special characters to their HTML entities. In the above example, it would
  // instead print:
  //
  // <script type="text/javascript">window.location = "http://SomeBadWebsite.com";</script>
  //
  // This certainly would look strange on the page, but it would not be harmful
  // to visitors
  $fullname = htmlspecialchars($row['fullname'],ENT_QUOTES);
  $degree = htmlspecialchars($row['degree'],ENT_QUOTES);
  $address = htmlspecialchars($row['address'],ENT_QUOTES);
  $institution = htmlspecialchars($row['institution'],ENT_QUOTES);
  $postal = htmlspecialchars($row['postal'],ENT_QUOTES);
  $country = htmlspecialchars($row['country'],ENT_QUOTES);
  $phone = htmlspecialchars($row['phone'],ENT_QUOTES);
  $email = htmlspecialchars($row['email'],ENT_QUOTES);
  $person1 = htmlspecialchars($row['person1'],ENT_QUOTES);
  $person2 = htmlspecialchars($row['person2'],ENT_QUOTES);
  $person3 = htmlspecialchars($row['person3'],ENT_QUOTES);
  $person4 = htmlspecialchars($row['person4'],ENT_QUOTES);
  $confeepartbef = htmlspecialchars($row['confeepartbef'],ENT_QUOTES);
  $confeeaccbef = htmlspecialchars($row['confeeaccbef'],ENT_QUOTES);
  $singleroombef = htmlspecialchars($row['singleroombef'],ENT_QUOTES);
  $confeepartaft = htmlspecialchars($row['confeepartaft'],ENT_QUOTES);
  $confeeaccaft = htmlspecialchars($row['confeeaccaft'],ENT_QUOTES);
  $singleroomaft = htmlspecialchars($row['singleroomaft'],ENT_QUOTES);
  $doubleroombef = htmlspecialchars($row['doubleroombef'],ENT_QUOTES);
  $doubleroomaft = htmlspecialchars($row['doubleroomaft'],ENT_QUOTES);
  $socfeetour = htmlspecialchars($row['socfeetour'],ENT_QUOTES);

  // We will now print the comment to the screen
 

  echo "  
  
    <tr>
      <td>$i</td>
      <td>$date</td>
      <td>$fullname</td><td>$degree</td><td>$address</td><td>$institution</td>
      <td>$postal</td><td>$country</td><td>$phone</td><td>$email</td>
      <td>$person1</td><td>$person2</td><td>$person3</td><td>$person4</td><td>$confeepartbef</td>
      <td>$confeeaccbef</td><td>$singleroombef</td><td>$confeepartaft</td><td>$confeeaccaft</td><td>$singleroomaft</td>
      <td>$doubleroombef</td><td>$doubleroomaft</td><td>$socfeetour</td>
    </tr>
  
  ";
  $i=$i+1;
}
 echo"</tbody></table>";

// At this point, we've added the user's comment to the database, and we can
// now close our connection to the database:
mysql_close($con);

?>
