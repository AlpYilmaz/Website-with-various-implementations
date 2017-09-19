<?php
include 'generate-nav.php';
if (isset($_SESSION["customerflag"]) &&  $_SESSION["customerflag"] == true)
{
	echo "Only admins may browse the tables.";
	header('location: index.php');
}
if(isset($_SESSION["adminflag"]) && $_SESSION["adminflag"] == false)
{
	echo "Only logged in admins may browse tables.";
	header('location: index.php');
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="homepagecss.css">
<meta charset="UTF-8">
<?php
$connection = mysqli_connect ('localhost', 'twa108', 'twa108fh','westernhotel108');
		if ( !$connection ) 
		{
			die("Connection failed: " . mysqli_connect_error());
		}
$sql = "show tables";
$result = mysqli_query($connection, $sql)
		or die ('Problem with query' . mysqli_error($connection));
?>
</head>
<body>
<div id="container">
<div id="header"><h1> Tables of the westernhotel database: </h1></div>
<div id="wrapper">
<div id="content">
<?php 
echo '<form action="showtable.php" method="POST">';
while ($row = mysqli_fetch_array($result))
{
	echo '<input type="radio" required name="Table" value="' . $row[0] . '">' . $row[0] . 
'<br/>';
}
mysqli_close($connection);
?>
<br>
<input type="submit" value="Submit" name = "Submit">
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