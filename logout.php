<?php
include 'generate-nav.php';
?>
<head>
<link rel="stylesheet" type="text/css" href="homepagecss.css">
<meta charset="UTF-8">
</head>
<body>
<?php
if ($_SESSION["adminflag"] == true)
{
	session_unset();
	session_destroy();
	header('Location: /twa/twa108/assignment1/adminlogin.php');	
}
else if ($_SESSION["customerflag"] == true)
{
	session_unset();
	session_destroy();
	header('Location: /twa/twa108/assignment1/customerlogin.php');
}
else header('Location: /twa/twa108/assignment1/customerlogin.php');
?>
</body>
