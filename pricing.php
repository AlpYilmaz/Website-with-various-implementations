<?php
include 'generate-nav.php';
if (isset($_SESSION["customerflag"]) &&  $_SESSION["customerflag"] == true)
{
	echo "Only admins may change pricing.";
	header('location: index.php');
}
if(isset($_SESSION["adminflag"]) && $_SESSION["adminflag"] == false)
{
	echo "Only logged in admins may change prices.";
	header('location: index.php');
}
$pricerror = "";
$failed = "";
$errors = false;
$testflag = "";
if(isset($_POST['submit']))
{
if(empty($_POST["newprice"]) || $_POST["newprice"] < 10.0 || $_POST["newprice"] > 999.0)
{
	$pricerror = "* Must input a price between $10 and $999.";
	$errors = true;
}
if ($errors == false)
{
$connection = mysqli_connect ('localhost', 'twa108', 
'twa108fh','westernhotel108');
		if ( !$connection ) 
		{
			die("Connection failed: " . mysqli_connect_error());
		}
$roomid = $_POST["roomid"];
$newprice = mysqli_real_escape_string($connection, $_POST["newprice"]);
$sql = "UPDATE rooms SET price = '$newprice' WHERE rid = '$roomid'";
$results = mysqli_query($connection, $sql)
or die ('Problem with query' . mysqli_error($connection));
if (mysqli_affected_rows($connection) > 0)
{
$testflag = "Price changed successfully.";
}
mysqli_close($connection);
}
}
?>
<head>
<link rel="stylesheet" type="text/css" href="homepagecss.css">
<meta charset="UTF-8">
</head>
<body>
<div id="container">
<div id="header"><h1> Pricing</h1></div>
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
?>
New price: <input type = "text" name = "newprice"> <?php echo $pricerror; ?>
<br><br>
<input type="submit" value="Submit" name = "submit">
<button type="reset" value="Reset">Reset</button>
<br><br>
<?php echo $testflag; ?>
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
