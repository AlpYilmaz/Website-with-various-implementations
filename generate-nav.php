<?php
session_start();
?>
<?php
$_SESSION["home"] = false;
$_SESSION["changepricing"] = false;
$_SESSION["browsedatabasetables"] = false;
$_SESSION["navlogout"] = false;
$_SESSION["searchrooms"] = false;
$_SESSION["bookrooms"] = false;
$_SESSION["customerregistration"] = false;
$_SESSION["customerlogin"] = false;
$_SESSION["administratorlogin"] = false;
if (isset($_SESSION["adminflag"]) && $_SESSION["adminflag"] == true)
{
	$_SESSION["home"] = true;
	$_SESSION["changepricing"] = true;
	$_SESSION["browsedatabasetables"] = true;
	$_SESSION["navlogout"] = true;
}
else if (isset($_SESSION["customerflag"]) &&  $_SESSION["customerflag"] == true)
{
	$_SESSION["home"] = true;
	$_SESSION["searchrooms"] = true;
	$_SESSION["bookrooms"] = true;
	$_SESSION["navlogout"] = true;
}
else
{
	$_SESSION["home"] = true; 
	$_SESSION["customerregistration"] = true;
	$_SESSION["customerlogin"] = true;
	$_SESSION["administratorlogin"] = true;
}
?>