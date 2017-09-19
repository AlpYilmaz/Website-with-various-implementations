<?php
include 'generate-nav.php';
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="homepagecss.css">
<meta charset="UTF-8">
<?php
$adminloginusererror = "";
$adminloginpasserror = "";
$adminlogintesterror = "";
$adminloginerrors = false;
$_SESSION["adminflag"] = false;
if(isset($_POST['Submit']))
{
	if (empty($_POST["adminloginname"]))
	{
		$adminloginusererror = "* Username required.";
		$adminloginerrors = true;
	}
	if(empty($_POST["adminpasswordname"]))
	{
		$adminloginpasserror = "* Password required.";
		$adminloginerrors = true;
	}
	if ($adminloginerrors == false)
	{
		$connection = mysqli_connect ('localhost', 'twa108', 
'twa108fh','westernhotel108');
		if ( !$connection ) 
		{
			die("Connection failed: " . mysqli_connect_error());
		}
		$adminloginusername = mysqli_real_escape_string($connection, 
$_POST["adminloginname"]);
		$adminpasswordusername = mysqli_real_escape_string($connection, 
$_POST["adminpasswordname"]);
		$sql = "SELECT username, password FROM administrators WHERE username = 
'$adminloginusername' AND password = '$adminpasswordusername'";
		$result = mysqli_query($connection, $sql)
		or die ('Problem with query' . mysqli_error($connection));
		$numberresult = mysqli_num_rows($result);
		if ($numberresult <= 0)
		{
			$adminlogintesterror = "* No login with that username and password 
found.";
		}
		else
		{
			$_SESSION["adminflag"] = true;
			header('Location: /twa/twa108/assignment1/browse.php');
		}
	}
	
}
?>
</head>
<body>
<div id="container">
<div id="header"><h1> Login </h1></div>
<div id="wrapper">
<div id="content">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<p>Username: <input type = "text" id = "adminloginname" name = "adminloginname"> <?php echo 
$adminloginusererror; ?> </p>
<p>Password: <input type = "password" id = "adminpasswordname" name = "adminpasswordname"> <?
php echo $adminloginpasserror; ?> </p>
<input type="submit" value="Submit" name = "Submit">
<button type="reset" value="Reset">Reset</button>
<p><?php echo $adminlogintesterror;?></p>
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
      <li><?php if($_SESSION["changepricing"] == true)echo '<a class="one" href = 
pricing.php>Pricing</a>';?></li>
      <li><?php if($_SESSION["browsedatabasetables"] == true)echo '<a class="one" href = 
browse.php>Browse tables</a>';?></li>
      <li><?php if($_SESSION["navlogout"] == true)echo '<a class="one" href = 
logout.php>Logout</a>';?></li>
      <li><?php if($_SESSION["searchrooms"] == true)echo '<a class="one" href = 
search.php>Search rooms</a>';?></li>
      <li><?php if($_SESSION["bookrooms"] == true)echo '<a class="one" href = 
book.php>Book</a>';?></li>
      <li><?php if($_SESSION["administratorlogin"] == true)echo '<a class="one" href = 
adminlogin.php>Administrator login</a>';?></li>
    </ul>
 </div>
</div>
</body>
</html>

