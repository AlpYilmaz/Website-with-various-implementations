<?php
include 'generate-nav.php';
if (isset($_SESSION["adminflag"]) && $_SESSION["adminflag"] == true)
{
	echo "Only customers may book rooms.";
	header('location: index.php');
}
if (isset($_SESSION["customerflag"]) && $_SESSION["customerflag"] == false)
{
	echo "You must be a logged in customer to book rooms.";
	header('location: index.php');
}
$inerror = "";
$outerror = "";
$currentdate = date("Y/m/d");
$datepattern = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
$year = substr($currentdate, 0, 4);
$day = substr($currentdate, -2);
$month = substr($currentdate, 5, -3);
$failed = "";
$successflag = false;
if(isset($_POST['Submit']))
{
	$errors = false;
	$indateful = $_POST["checkindate"];
	$inyear = substr($indateful, 0, 4);
	$inday = substr($indateful, -2);
	$inmonth = substr($indateful, 5, -3);
	$outdateful = $_POST["checkoutdate"];
	$outyear = substr($outdateful, 0, 4);
	$outday = substr($outdateful, -2);
	$outmonth = substr($outdateful, 5, -3);
	if (empty($_POST["checkindate"]))
	{
		$errors = true;
		$inerror = "* Must select a check in date.";
	}
	else if (!preg_match($datepattern, $_POST["checkindate"]))
	{
		$errors = true;
		$inerror = "* YYYY-MM-DD format for date; must be a valid date.";
	}
	else if (preg_match($datepattern, $_POST["checkindate"]) && !empty($_POST["checkindate"]))
	{
		if ($inyear < $year || ($inyear == $year && $inmonth < $month) || ($inyear == $year && $inmonth == $month && $inday < $day))
		{
			$errors = true;
			$inerror = "* Check in date must be after current date.";
		}
	}
	if (empty($_POST["checkoutdate"]))
	{
		$errors = true;
		$outerror = "* Must select a check out date.";
	}
	else if (!preg_match($datepattern, $_POST["checkoutdate"]))
	{
		$errors = true;
		$outerror = "* YYYY-MM-DD format for date; must be a valid date.";
	}
	else if (preg_match($datepattern, $_POST["checkoutdate"]) && !empty($_POST["checkoutdate"]))
	{
		if ($outyear < $inyear || ($outyear == $inyear && $outmonth < $inmonth) || ($outyear == $inyear && $outmonth == $inmonth && $outday <= $inday))
		{
			$outerror = "* Checkout date must be after check in date.";
			$errors = true;
		}
	}
}
?>
<head>
<link rel="stylesheet" type="text/css" href="homepagecss.css">
<meta charset="UTF-8">
</head>
<body>
<div id="container">
<div id="header"><h1> Booking </h1></div>
<div id="wrapper">
<div id="content">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<?php echo $failed; ?><br>
<?php
$connection = mysqli_connect ('localhost', 'twa108', 
'twa108fh','westernhotel108');
		if ( !$connection ) 
		{
			die("Connection failed: " . mysqli_connect_error());
		}
$sql = "SELECT rid FROM rooms";
$result = mysqli_query($connection, $sql)
or die ('Problem with query' . 
mysqli_error($connection));
$num = mysqli_num_rows($result);
echo 'Room id: <br>';
echo '<select name="roomid">';
while ($row = mysqli_fetch_array($result))
{
	echo '<option name= ' . $row["rid"] . 'value= ' . $row["rid"] . '>' . $row["rid"] . '<br>';
} 
echo '</select>';
echo '<br><br>';
mysqli_close($connection);
?>

Number of beds: <br>
<select name="numberofbeds">
<option name="1beds" value="1bed">1 bed<br>
<option name="2beds" value="2bed">2 beds<br>
<option name="3beds" value="3bed">3 beds<br>
</select>
<br><br>
Check in date: <br>
<input type = "text" name="checkindate"><?php echo $inerror; ?><br>
<br>
Check out date: <br>
<input type = "text" name="checkoutdate"><?php echo $outerror; ?><br>
<br>
<input type ="submit" name = "Submit" value="Submit">
</form>

</div>
</div>
<div id="navigation"> 
    <ul>
      <li><?php if($_SESSION["home"] == true) echo '<a class="one" href = 
index.php>Home</a>';?> </li>
      <li><?php if($_SESSION["customerregistration"] == true)echo '<a class="one" href = 
register.php>Customer Registration</a>'; ?></li>
      <li><?php if($_SESSION["customerlogin"] == true)echo '<a class="one" href = 
customerlogin.php>Customer Login</a>';?></li>
	  <li><?php if($_SESSION["administratorlogin"] == true)echo '<a class="one" href = 
adminlogin.php>Administrator login</a>';?></li>
      <li><?php if($_SESSION["changepricing"] == true)echo '<a class="one" href = 
pricing.php>Pricing</a>';?></li>
      <li><?php if($_SESSION["browsedatabasetables"] == true)echo '<a class="one" href = 
browse.php>Browse tables</a>';?></li>
      <li><?php if($_SESSION["searchrooms"] == true)echo '<a class="one" href = 
search.php>Search rooms</a>';?></li>
      <li><?php if($_SESSION["bookrooms"] == true)echo '<a class="one" href = 
book.php>Book</a>';?></li>
	  <li><?php if($_SESSION["navlogout"] == true)echo '<a class="one" href = 
logout.php>Logout</a>';?></li>
    </ul>
 </div>
 <div id="footer">
    <p>Copyright Western Sydney Hotel 2016</p>
  </div>
</div>
</body>
