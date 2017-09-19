<?php
include 'generate-nav.php';
?>
<head>
<link rel="stylesheet" type="text/css" href="homepagecss.css">
<meta charset="UTF-8">
<?php
$usererror = $passerror = $repasserror = $firsterror = $lasterror = "";
$addresserror = $staterror = $posterror = $mobilerror = $emailerror = "";
$errors = false;
$namepattern = "/^[a-zA-Z-' ]{1,20}+$/";
$numberpattern = "/^[0-9]+$/";
$mobilepattern = "/^[0-9]{10}+$/";
$emailpattern = " ";
if(isset($_POST['submit']))
{
	$mobile = $_POST["mobile"];
	$firstnumber = substr($mobile, 0, 1);
	$secondnumber = substr($mobile, 1, 1);
	$emailpattern = "/^\w+@\w+\.\w|\.\W+$/";
	if (empty($_POST["username"]))
	{
		$usererror = "* Username is required.";
		$errors = true;
	}
	else if (strlen($_POST["username"]) > 20)
	{
		$usererror = " *Maximum of 20 characters";
		$errors = true;
	}
	if (empty($_POST["password"]))
	{
		$passerror = " *Password is required.";
		$errors = true;
	}
	else if (strlen($_POST["password"]) > 20 || strlen($_POST["password"]) < 6)
	{
		$passerror = " *Password must be between 6 and 20 characters.";
		$errors = true;
	}
	if (empty($_POST["password"]))
	{
		$repasserror = " *Re-entering password required.";
		$errors = true;
	}
	else if ($_POST["password"] != $_POST["repassword"])
	{
		$repasserror = " *Passwords don't match.";
		$errors = true;
	}
	if (empty($_POST["firstname"]))
	{
		$firsterror = "* First name is required";
		$errors = true;
	}
	else if (!preg_match($namepattern, $_POST["firstname"]))
	{
		$firsterror = "* Letters, hyphens, apostrophes, space and a maximum of 20 
characters only accepted for first name.";
		$errors = true;
	}
	if (empty($_POST["lastname"]))
	{
		$lasterror = "* Last name is required";
		$errors = true;
	}
	else if (!preg_match($namepattern, $_POST["lastname"]))
	{
		$lasterror = "* Letters, hyphens, apostrophes, space and a maximum of 20 
characters only accepted for last name.";
		$errors = true;
	}
	if (empty($_POST["address"]))
	{
		$addresserror = "* Address is required";
		$errors = true;
	}
	else if (strlen($_POST["address"]) > 40)
	{
		$addresserror = "* Cannot be more than 40 characters";
		$errors = true;
	}
	if (empty($_POST["state"]))
	{
		$staterror = "* State is required";
		$errors = true;
	}
	if (empty($_POST["postcode"]))
	{
		$posterror = "* Postcode is required";
		$errors = true;
	}
	else if (strlen($_POST["postcode"]) != 4 || !preg_match($numberpattern, 
$_POST["postcode"]))
	{
		$posterror = "* Postcode must be 4 digits";
		$errors = true;
	}
	if (empty($_POST["mobile"]))
	{
		$mobilerror = "* Mobile is required";
		$errors = true;
	}
	else if (!preg_match($mobilepattern, $mobile) || $firstnumber != 0 || $secondnumber != 
4)
	{
		$mobilerror = "* Mobile number must start with 04 and consist of 10 numbers";
		$errors = true;
	}
	if (empty($_POST["email"]))
	{
		$emailerror = "* Email is required";
		$errors = true;
	}
	else if (!preg_match($emailpattern, $_POST["email"]) || strlen($_POST["email"]) > 40)
	{
		$emailerror = "* Email must have only one @, with a dot after at. It cannot be 
over 40 characters.";
		$errors = true;
	}

		$connection = mysqli_connect ('localhost', 'twa108', 
'twa108fh','westernhotel108');
		if ( !$connection ) 
		{
			die("Connection failed: " . mysqli_connect_error());
		}
		$username = mysqli_real_escape_string($connection, $_POST["username"]);
		$password = mysqli_real_escape_string($connection, $_POST["password"]);
		$firstname = mysqli_real_escape_string($connection, $_POST["firstname"]);
		$lastname = mysqli_real_escape_string($connection, $_POST["lastname"]);
		$address = mysqli_real_escape_string($connection, $_POST["address"]);
		$state = mysqli_real_escape_string($connection, $_POST["state"]);
		$postcode = mysqli_real_escape_string($connection, $_POST["postcode"]);
		$mobile = mysqli_real_escape_string($connection, $_POST["username"]);
		$email = mysqli_real_escape_string($connection, $_POST["email"]);
		$query = "SELECT username FROM customers WHERE username = '$username'";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result) == 0 && $errors == false)
		{
			$sql = "INSERT INTO customers (username, password, gname, sname, 
address, state, postcode, mobile, email) ";
			$sql .= "VALUES ('$username', '$password', '$firstname', '$lastname', 
'$address', '$state', '$postcode', 
			'$mobile', '$email') ";
		
			$result = mysqli_query($connection, $sql)
					or die ('Problem with query' . 
mysqli_error($connection));

			if (mysqli_affected_rows($connection) > 0)
			{
				echo "Successful registration.";
				header('Location: /twa/twa108/assignment1/customerlogin.php');
			}
			mysqli_close($connection);
		}
		else
		{
		 echo "Failed registration.";
		 mysqli_close($connection);
		}
}
?>
<script>
function validate()
{
	var pattern = /^[a-zA-Z-' ]+$/;
	var numberpattern = /^[0-9]+$/;
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	var repassword = document.getElementById("repassword").value;
	var firstname = document.getElementById("firstname").value;
	var lastname = document.getElementById("lastname").value;
	var address = document.getElementById("address").value;
	var state = document.getElementById("state").value;
	var postcode = document.getElementById("postcode").value;
	var mobile = document.getElementById("mobile").value;
	var email = document.getElementById("email").value;
	var atCounter = 0;
	var atLocation;
	var dotCounter = 0;
	var dotAfterAt = false;
	var dotLocation = 0;
	var num = 0;
	for (num = 0; num < email.length-1; num++)
	{
		if (email.charAt(num) == "@")
		{
			atCounter += 1;
			atLocation = num;
		}
		if (email.charAt(num) == ".")
		{
			dotCounter = 1;
			dotLocation = num;
			if (dotLocation > atLocation)
			{
				dotAfterAt = true;
			}
		}
	}
	if (username.length > 20)
	{
		document.getElementById("usererror").innerHTML = "* Maximum 20 characters.";
		return false;
	}
	else document.getElementById("usererror").innerHTML = "";
	if (password.length < 6 || password.length > 20)
	{
		if (password.length < 6)
			document.getElementById("passerror").innerHTML = "* Must be 6 or more 
characters.";
		else
			document.getElementById("passerror").innerHTML = "* Maximum 20 
characters.";
		return false;
	}
	else document.getElementById("passerror").innerHTML = "";
	if (password != repassword)
	{
		document.getElementById("repasserror").innerHTML = "* Password does not 
match.";
		return false;
	}
	else document.getElementById("repasserror").innerHTML = "";
	if (!pattern.test(firstname) || firstname.length > 20)
	{
		if (!pattern.test(firstname))
			document.getElementById("firsterror").innerHTML = "* Letters, hyphens, 
apostrophes and space only accepted for first name.";
		else 
			document.getElementById("firsterror").innerHTML = "* Maximum 20 
characters.";
		return false;
	}
	else document.getElementById("firsterror").innerHTML = "";
	if (!pattern.test(lastname) || lastname.length > 20)
	{
		if (!pattern.test(lastname))
			document.getElementById("lasterror").innerHTML = "* Letters, hyphens, 
apostrophes and space only accepted for last name.";
		else 
			document.getElementById("lasterror").innerHTML = "* Maximum 20 
characters.";
		return false;
	}
	else document.getElementById("lasterror").innerHTML = "";
	if (address.length > 40)
	{
		document.getElementById("addresserror").innerHTML = "* Maximum of 40 
characters.";
		return false;
	}
	else document.getElementById("addresserror").innerHTML = "";
	if (postcode.length != 4 || (!numberpattern.test(postcode)))
	{
		if (postcode.length != 4)
			document.getElementById("posterror").innerHTML = "* Postcode must be 4 
digits long.";
		else
			document.getElementById("posterror").innerHTML ="* Postcode must be 4 
numbers between 0 and 9.";
		return false;
	}
	else document.getElementById("posterror").innerHTML = "";
	if (mobile.length != 10 || mobile.charAt(0) != 0 || mobile.charAt(1) != 4 || 
(!numberpattern.test(mobile)))
	{
		document.getElementById("mobilerror").innerHTML = "* Mobile number must be 10 
numbers starting with 04.";
		return false;
	}
	else document.getElementById("mobilerror").innerHTML = "";
	if (atCounter != 1 || dotCounter < 1 || dotAfterAt != true || email.length > 40)
      {
      	document.getElementById("emailerror").innerHTML =  "* Email cannot be more than 40 
characters and must have one @ along with at least one dot after the @.";
        return false;
      } 
    else document.getElementById("emailerror").innerHTML =  "";
}
</script>
</head>
<html>
<body>
<div id="container">
<div id="header"><h1> Registration</h1></div>
<div id="wrapper">
<div id="content">
<form onsubmit="return validate();" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); 
?>" method="post">
Enter desired username: <input type = 'text' id='username' name='username' required> <?php echo 
$usererror; ?> <span id="usererror" style="color: red;"></span>
<br><br>
Enter password: <input type = 'password' id='password' name='password' required> <?php echo 
$passerror; 
?> <span id="passerror" style="color: red;"></span>
<br><br>
Please re-type password: <input type = 'password' id = 'repassword' name='repassword' required> 
<?php 
echo $repasserror; ?> <span id="repasserror" style="color: red;"></span>
<br><br>
Enter your first name: <input type = 'text' id = 'firstname' name='firstname' required> <?php 
echo 
$firsterror; ?> <span id="firsterror" style="color: red;"></span>
<br><br>
Enter your last name: <input type = 'text' id = 'lastname' name='lastname' required> <?php echo 
$lasterror; ?> <span id="lasterror" style="color: red;"></span>
<br><br>
Enter your address: <input type='text' id='address' name='address' required> <?php echo 
$addresserror; ?> <span id="addresserror" style="color: red;"></span>
<br><br>
Enter your state: 
<select id='state' name='state' required>
<option value=""></option>
<option value="NSW">NSW</option>
<option value="QLD">QLD</option>
<option value="NT">NT</option>
<option value="WA">WA</option>
<option value="TASMANIA">TAS</option>
<option value="ACT">ACT</option>
<option value="SA">SA</option>
<option value="VIC">VIC</option>
</select> <?php echo $staterror; ?> <span id="stateerror" style="color: red;"></span>
<br><br>
Enter postcode: <input type='text' id='postcode' name='postcode' required> <?php echo 
$posterror; ?> 
<span id="posterror" style="color: red;"></span>
<br><br>
Enter mobile: <input type='text' id ='mobile' name='mobile' required> 
<?php echo $mobilerror; ?> <span 
id="mobilerror" style="color: red;"></span>
<br><br>
Enter email: <input type='text' id='email' name='email' required> <?php echo $emailerror; ?> 
<span 
id="emailerror" style="color: red;"></span>
<br>
<br>
<input type="submit" name="submit" value="Register"> 
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
