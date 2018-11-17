<?php include "../Controller/DB.php";
include "../Controller/Employers.php";
// session_start();
?>
<?php 
if(deleteJob()) {
	// header("Location :Dashboard_employer.php?view_my_job_postings=");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard Employer</title>
</head>
<body>
	<h1>
		<?php
		echo "Welcome " . $_SESSION['name'];
		?>
		
	</h1>
	<form action = "Dashboard_employer.php">
		<button type = "submit" name = "view_my_job_postings">View My Job Postings</button>
		<button type = "submit" name = "view_my_schedule">View My Schedule</button>
		<button type = "submit" name = "view_my_connection">View My Connection</button>
		<button type = "submit" name = "view_my_reviews">View My Reviews</button>
	</form>

	<?php
	if(isset($_GET['view_my_job_postings'])) {
		$query = "SELECT * FROM postedjob ";
		$query .= "WHERE Employer_SIN = \"" . $_SESSION['sin'] . "\"";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		}
		echo "<form action =\"Dashboard_employer.php\" method =\"post\">";
		echo "<table>"; // start a table tag in the HTML
		echo "<tr><td>" . "JobID" . "</td><td>" . 'CompanyName' . "</td><td>" . 'Requirements' . "</td><td>" . 'Description' . "</td><td>" . 'Location' . "</td><td>" . 'Type' . "</td><td>" . 'Salary' . "</td></tr>"; 
		while($row = mysqli_fetch_assoc($result)){   
			echo "<tr><td>" . $row['JobID'] . "</td><td>" . $row['CompanyName'] . "</td><td>" . $row['Requirements'] . "</td><td>" . $row['Description'] . "</td><td>" . $row['Location'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['Salary'] . "</td>";
			echo "<td><button type = \"submit\" name = \"modify_job\" value = ". $row['JobID'] . ">Modify</button></td></td>"; 
			echo "<td><button type = \"submit\" name = \"delete_job\" value = ". $row['JobID'] . ">Delete</button></td></tr>"; 
		}
		echo "</table>"; //Close the table in HTML 
		echo "</form>";
		echo "<form action =\"post_job.php\" method =\"post\">";
		echo "<button type = \"submit\" name = \"post_new_job\" value = ". $row['JobID'] . ">Post a New Job</button>";
		echo "</form>";
	}
	if (isset($_GET["view_my_schedule"])) {
		$query = "SELECT * FROM evaluation NATURAL JOIN application NATURAL JOIN postedjob";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Query Failed" . mysqli_error($connection));
		}
		echo "<table>"; // start a table tag in the HTML
		echo "<tr><td>" . 'Job ID' . "</td><td>" . 'Company Name' . "</td><td>" . 'Date' . "</td><td>" . 'Time' . "</td><td>" . 'Length' . "</td><td>" . 'Type' . "</td><td>";
		$row = mysqli_fetch_assoc($result);
		//if (isset($row))
		echo 'Type' . "</td><td>" . 'Date' . "</td></tr>"; 
		while($row = mysqli_fetch_assoc($result)){   
			echo "<tr><td>" . $row['ApplicationID'] . "</td><td>" . $row['JobID'] . "</td><td>" . $row['CompanyName'] . "</td><td>" . $row['Contact_Info'] . "</td><td>" . "Null" . "</td>";
			echo "<td><button type = \"submit\" name = \"cancel_job\" value = ". $row['ApplicationID'] . ">Cancel</button></td></tr>"; 
		}
		echo "</table>"; //Close the table in HTML
		echo "</form>";
	}

	?>


</body>
</html>