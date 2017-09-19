<?php
include 'generate-nav.php';
if(isset($_SESSION["adminflag"]) && $_SESSION["adminflag"] == false)
{
	echo "Only logged in admins may see tables.";
	header('location: index.php');
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="homepagecss.css">
<style>
table, th, td {
 border: 1px solid black;
}
</style>
<?php
$table = $_POST["Table"];
?>
</head>
<body>
<div id="container">
<div id="header"><h1> Table: <?php echo $table; ?></h1></div>
<div id="wrapper">
<div id="content">
<?php
$connection = mysqli_connect ('localhost', 'twa108', 'twa108fh','westernhotel108');
		if ( !$connection ) 
		{
			die("Connection failed: " . mysqli_connect_error());
		}
$sql = "SHOW COLUMNS FROM $table";
$result = mysqli_query($connection, $sql)
		or die ('Problem with query' . mysqli_error($connection));
echo "<table>";
echo "<tr>";
while ($row = mysqli_fetch_array($result))
{
	echo '<th>' . $row[0] . '</th>';
}
echo "</tr>";
$sql = "SELECT * FROM $table";
	$results = mysqli_query($connection, $sql)
	 		or die ('Problem with query' . mysqli_error($connection));
$num = mysqli_num_rows($results);
if ($num > 0)
{
	if ($table == 'administrators')
	{
		while ($row = mysqli_fetch_array($results))
		{
			echo '<tr>';
			echo '<td>' . $row["username"] .  '</td>';
			echo '<td>' . $row["password"] .  '</td>';
			echo '<td>' . $row["gname"] .  '</td>';
			echo '<td>' . $row["surname"] .  '</td>';
			echo '</tr>';
		}
	}
	else if ($table == 'bookings')
	{
		while ($row = mysqli_fetch_array($results))
		{
			echo '<tr>';
			echo '<td>' . $row["bid"] .  '</td>';
			echo '<td>' . $row["rid"] .  '</td>';
			echo '<td>' . $row["username"] .  '</td>';
			echo '<td>' . $row["checkin"] .  '</td>';
			echo '<td>' . $row["checkout"] .  '</td>';
			echo '<td>' . $row["cost"] .  '</td>';
			echo '<td>' . $row["btime"] .  '</td>';
			echo '</tr>';
		}
	}
	else if ($table == 'customers')
	{
		while ($row = mysqli_fetch_array($results))
		{
			echo '<tr>';
			echo '<td>' . $row["username"] .  '</td>';
			echo '<td>' . $row["password"] .  '</td>';
			echo '<td>' . $row["gname"] .  '</td>';
			echo '<td>' . $row["sname"] .  '</td>';
			echo '<td>' . $row["address"] .  '</td>';
			echo '<td>' . $row["state"] .  '</td>';
			echo '<td>' . $row["postcode"] .  '</td>';
			echo '<td>' . $row["mobile"] .  '</td>';
			echo '<td>' . $row["email"] .  '</td>';
			echo '</tr>';
		}
	}
	else if ($table == 'rooms')
	{
		while ($row = mysqli_fetch_array($results))
		{
			echo '<tr>';
			echo '<td>' . $row["rid"] .  '</td>';
			echo '<td>' . $row["level"] .  '</td>';
			echo '<td>' . $row["beds"] .  '</td>';
			echo '<td>' . $row["orientation"] .  '</td>';
			echo '<td>' . $row["price"] .  '</td>';
			echo '</tr>';
		}
	}
	echo '</table>';
	mysqli_close($connection);
}
else 
{
	echo '<tr>';
	echo 'No results in that table.';
	echo '</tr>';
	echo '</table>';
	mysqli_close($connection);
}
?>
</table>
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