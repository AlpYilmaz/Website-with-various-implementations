<?php
include 'generate-nav.php';
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="homepagecss.css">
<meta charset="UTF-8">
<?php
$loginusererror = "";
$loginpasserror = "";
$logintesterror = "";
$loginerrors = false;
$_SESSION["customerflag"] = false;
if(isset($_POST['Submit']))
{
	if (empty($_POST["loginname"]))
	{
		$loginusererror = "* Username required.";
		$loginerrors = true;
	}
	if(empty($_POST["passwordname"]))
	{
		$loginpasserror = "* Password required.";
		$loginerrors = true;
	}
	if ($loginerrors == false)
	{
		$connection = mysqli_connect ('localhost', 'twa108', 
'twa108fh','westernhotel108');
		if ( !$connection ) 
		{
			die("Connection failed: " . mysqli_connect_error());
		}
		$loginusername = mysqli_real_escape_string($connection, $_POST["loginname"]);
		$passwordusername = mysqli_real_escape_string($connection, 
$_POST["passwordname"]);
		$sql = "SELECT username, password FROM customers WHERE username = 
'$loginusername' AND password = '$passwordusername'";
		$result = mysqli_query($connection, $sql)
		or die ('Problem with query' . mysqli_error($connection));
		$numberresult = mysqli_num_rows($result);
		if ($numberresult <= 0)
		{
			$logintesterror = "* No login with that username and password found.";
		}
		else
		{
			$_SESSION["customerflag"] = true;
			mysqli_close($connection);
			header('Location: /twa/twa108/assignment1/search.php');
		}
		mysqli_close($connection);
	}
	
}
?>
</head>
<body>
<div id="container">
<div id="header"><h1> Customer login </h1></div>
<div id="wrapper">
<div id="content">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<p>Username: <input type = "text" id = "loginname" name = "loginname"> <?php echo 
$loginusererror; ?> </p>
<p>Password: <input type = "password" id = "passwordname" name = "passwordname"> <?php echo 
$loginpasserror; ?> </p>
<input type="submit" value="Submit" name = "Submit">
<button type="reset" value="Reset">Reset</button>
<p><?php echo $logintesterror;?></p>
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
</html>

