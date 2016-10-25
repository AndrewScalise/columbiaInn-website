<!DOCTYPE html>
<html>
<head>
<meta charset = "utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">

<title>Feedback</title>
<meta name="keywords" content="Cougar Inn, Columbia College, Cougar Athletics, Hotel, Columbia MO, 65202, Columbia Motel, Cougars, Columbia Stay" />
<meta name="description" content="Cougar Inn is located in Columbia, MO.  We provide a comfortable place to say near Colubmia College at low prices. Go Cougars!" />
</head>

<body>

<div class="container-fluid">
	<header class="text-xs-center">
		<h1 class="p-t-3 p-b-2">Feedback</h1>
		<nav class="navbar bg-faded">
		<div class="hidden-xs-down">
			<ul class="nav nav-inline">
				<li class="nav-item"><a href="home.html">Home</a></li>
				<li class="nav-item"><a href="about.html">About Us</a></li>
				<li class="nav-item"><a href="columbiacollege.html">Columbia College</a></li>
				<li class="nav-item"><a href="around.html">Around Town</a></li>
				<li class="nav-item"><a href="feedback.html">Feedback</a></li>
			</ul>
		</div>
		<button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#myNavbar">&#9776;</button>
		
		<div class="collapse navbar-toggleable-xs hidden-sm-up" id="myNavbar">
			<ul class="nav navbar-nav">
				<li class="nav-item"><a href="home.html">Home</a></li>
				<li class="nav-item"><a href="about.html">About Us</a></li>
				<li class="nav-item"><a href="columbiacollege.html">Columbia College</a></li>
				<li class="nav-item"><a href="around.html">Around Town</a></li>
				<li class="nav-item"><a href="feedback.html">Feedback</a></li>
			</ul>
		</div>
		</nav>
	</header>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'scaliseDB');
if (!$conn)
	echo "<p>Connection failed.</p>";
if (isset($_POST['submit']))
{
// get values from the form
$name = $_POST['name'];
$comments = $_POST['comments'];

// insert statement
$statement = "INSERT INTO feedback
(name, comments)
VALUES ('$name', '$comments')";
if (mysqli_query($conn, $statement))
	echo "<p>Thank you for commenting.</p>";
else
	echo "<p>Try again.</p>";
}
elseif (isset($_POST['view']))
{
// select statement
$statement = "SELECT * FROM feedback";
if ($result = mysqli_query($conn, $statement))
	echo "<table border = '1'>";
	while ($row = mysqli_fetch_object($result))
	{
		echo "<tr>";
		echo "<td>$row->name</td>";
		echo "<td>$row->comments</td>";
		echo "</tr>";
	}
	echo "</table>";
}
mysqli_close($conn);
?>
</body>
</html>