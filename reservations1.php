<!DOCTYPE html>
<html>
<meta charset = "utf-8">
<title>Reservations1</title>
</head>
<body>
<?php
//set up connection.
$conn = mysqli_connect('localhost','root','');
//send feedback if connection set up successfull.
if($conn)
{
	echo "<p>Connection set up successfull</p>";
}
mysqli_query($conn, 'DROP DATABASE IF EXISTS hotel');
//Create a database called hotel.
$statementDB = "CREATE DATABASE hotel";
//execute the statement
$myDBquery = mysqli_query($conn, $statementDB);
//send feedback if database created successfully.
if($myDBquery)
{
	echo "<p>Database created successfully</p>";
}
// Select the hotel database to add a table.
mysqli_select_db($conn, "hotel");
//Create a table called reservation
$statementTBL = "CREATE TABLE reservation
(
id INT(7) NOT NULL AUTO_INCREMENT,
name VARCHAR(150) NOT NULL,
checkIn DATE NOT NULL,
checkOut DATE NOT NULL,
type ENUM ('Standard Smoking', 'Standard Non-smoking', 'Double Smoking', 'Double Non-smoking') NOT NULL,
confirm INT(9),
PRIMARY KEY (id)
)";
//execute the statement
$myTBLquery = mysqli_query($conn, $statementTBL);
//send feedback if table created successfully.
if($myTBLquery)
{
	echo "<p>Table created successfully.</p>";
}
//close the connection.
mysqli_close($conn);
?>
</body>
</html>