
<?php
$conn = mysqli_connect('localhost', 'root', '');
if ($conn)
	echo "<p>Connection set up successfully.</p>";
if (mysqli_query($conn, "CREATE DATABASE scaliseDB"))
	echo "<p>Database created successfully.</p>";
mysqli_select_db($conn, "scaliseDB");
$myStatement = "CREATE TABLE feedback
(
	name VARCHAR(32) NOT NULL,
	comments VARCHAR(255) NOT NULL,
	PRIMARY KEY (name)
)";
if (mysqli_query($conn, $myStatement))
	echo "<p>Table created sucessfully.</p>";
mysqli_close($conn);
?>