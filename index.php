<?php
include 'generate-nav.php';
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="homepagecss.css">
<meta charset="UTF-8">
</head>
<body>
<div id="container">
<div id="header"><h1>Western Sydney Hotel</h1></div>
  <div id="wrapper">
    <div id="content">
<p>The Western Sydney hotel has cheap, affordable prices for customers that need lodging in the 
Western Sydney area.
We offer package deals for longer amounts of time stayed, along with lots of great benefits 
like spa-access, room service, etc.</p>

<p>To return to the homepage, use the home link. To register, simply click on the register link 
in the navigation section. If you have already registered, use the login link. To book, press 
the book link.
To see available hotel rooms, use the search link. To book a room, once logged in, use the book 
link. Once you are finished, you can use the logout link to logout.</p>
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
