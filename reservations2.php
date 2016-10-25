<?php
//set up connection with the hotel database
$conn = mysqli_connect('localhost', 'root', '', 'hotel');
if(!$conn) //if connection failed
{
	die ("Unable to connect to database: ".mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset = "utf-8">
<title>Reservations</title>
</head>
<body>

<?php
if(isset($_POST['submit'])) //if the submit button is clicked
{
	//define five variables to accept four values from the Web form.
	//and generate a random confimation number.
	$name = $_POST['name'];
	$checkIn = $_POST['checkIn'];
	$checkOut = $_POST['checkOut'];
	$room = $_POST['room'];
	$confirm = rand(0, 10000);
	
	//write teh reservation data to the table
	$statement = "INSERT INTO reservation (name, checkIn, checkOut, type, confirm) VALUES ('$name', '$checkIn', '$checkOut', '$room', '$confirm')";
	
	//if the record is sucessfully added
	if(mysqli_query($conn, $statement))
	{
		echo "Thank you for your reservation.";
		echo "Your confirmation number is ".$confirm;
		echo "<br/><a href = 'reservations.html'>Reserve another one.</a>";
	}
	else
	{
		echo "There was a problem saving your data.";
		echo "<br/><a href= 'reservations.html'>Try again.</a>";
		echo "Or come back another time.";
	}
}

if(isset($_POST['change'])) //if the change button is clicked.
{
	//echo the whole block
	echo<<<MYFORM
	<form action= "$_SERVER[PHP_SELF]" method= "POST">
	<p>Please enter your confirmation number:
	<input type= "text" size= "9" name= "cfNumber" maxlength= "9"/>
	<br/>
	<table border = "1">
	<tr>
	<td>New Check in Date:</td>
	<td><input type="text" name="checkIn" size="8" maxlength="16"/>(yyyy-mm-dd)</td>
	</tr>
	<tr>
	<td>New Check out Date:</td>
	<td><input type="text" name="checkOut" size="8" maxlength="16"/>(yyyy-mm-dd)</td>
	</tr>
	<tr>
	<td>New Room type:</td>
	<td><select name="room" size="1">
	<option value='Standard Smoking'>Standard Smoking</option>
	<option value='Standard Non-smoking'>Standard Non-smoking</option>
	<option value='Double Smoking'>Double Smoking</option>
	<option value='Double Non-smoking'>Double Non-smoking</option>
	</select>
	</td>
	</tr>
	</table>
	</p>
	<input type="submit" name="modify" value="Make the change"/>
	</form>
MYFORM;
}

elseif(isset($_POST['modify'])) //if the modify button is clicked.
{
	//collect new data from the customer.
	$cfNumber = $_POST['cfNumber'];
	$newCheckIn = $_POST['checkIn'];
	$newCheckOut = $_POST['checkOut'];
	$newType = $_POST['room'];
	
	//check if the confirmation number matches the one in database
	if(mysqli_num_rows(mysqli_query($conn, "SELECT confirm from reservation WHERE confirm = '$cfNumber'")))
	{
		//Update the table
		$statement = "UPDATE reservation SET checkIn = '$newCheckIn', checkOut = '$newCheckOut', type = '$newType' WHERE confirm = '$cfNumber'";
		
		//if the record is successfully updated
		if($result = mysqli_query($conn, $statement))
		{
			echo "One record modified.";
		}
		else
		{
			echo "There was a problem updating your data.";
		}
	}
	else
	{
		echo "No reservation found. Check your number and <a href='reservations.html'>Try again.</a>";
	}
}

if(isset($_POST['delete'])) //If the delete button is clicked
{
	//echo the whole block
	echo<<<MYFORM
	<form action= "$_SERVER[PHP_SELF]" method= "POST">
	<p>Please enter your confirmation number to delete your reservation:
	<input type="text" size="9" name="cfNumber" maxlength="9"/>
	<input type="submit" name="realDelete" value="Delete My Reservation"/>
	</form>
MYFORM;
}

elseif(isset($POST['realDelete'])) //if the realDelete button is clicked.
{
	//collect the confirmation number.
	$cfNumber = $_POST['cfNumber'];
	
	//Delete the record form the table
	$statement= "DELETE FROM reservation WHERE confirm = $cfNumber";
	if($result = mysqli_query($conn, $statement))
	{
		echo "Your record has been deleted.";
	}
	else
	{
		echo "There is a problem deleting the record.";
	}
}

elseif(isset($_POST['manager'])) //If you are a manager.
{
	if($_POST['name'] == "CISS298")
	{
		//Show all records from the table.
		$statement = "SELECT * FROM reservation";
		if($result = mysqli_query($conn, $statement))
		{
			echo "All records in the table: <table border='1'>";
			echo "<tr><th>Name</th>";
			echo "<th>Check In</th>";
			echo "<th>Check Out</th>";
			echo "<th>Room type</th>";
			echo "<th>Confirm</th>";
			
			while($row = mysqli_fetch_object($result))
			{
				echo "<tr>";
				echo "<td>$row->name</td>";
				echo "<td>$row->checkIn</td>";
				echo "<td>$row->checkOut</td>";
				echo "<td>$row->type</td>";
				echo "<td>$row->confirm</td>";
				echo "</tr>";
			}
			
			echo "</table>";
			echo "<br/><a href= 'reservations.html'>Back to reservation page.</a>";
		}
		else
		{
			echo "There was a problem retrieving records.";
		}
	}
	else
	{
		echo "You must be a manager to see all records.";
	}
}

mysqli_close($conn); //close the connection.
?>
</body>
</html>