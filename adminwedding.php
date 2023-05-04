<?php
// Start the session and include the config file
session_start();
include 'config.php';

// Redirect to login page if not logged in
if(!isset($_SESSION['AdminName'])){
	header('location:login_form.php');
}

// check if a delete button was clicked
if (isset($_POST['delete'])) {
  // get the ID of the row to delete
  $id = $_POST['id'];

  // connect to database
  $conn = new mysqli('localhost', 'root', '', 'db_church');
  if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
  }

  // prepare and execute the delete statement
  $stmt = $conn->prepare("DELETE FROM tbl_groom, tbl_bride WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();

  // check if the delete was successful
  if ($stmt->affected_rows > 0) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $conn->error;
  }

  // close database connection
  $stmt->close();
  $conn->close();
}

// query the database to display all rows
$conn = new mysqli('localhost', 'root', '', 'db_church');
if ($conn->connect_error) {
  die("Connection Failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT tbl_groom.name1, tbl_groom.age1, tbl_groom.number1, tbl_bride.name, tbl_bride.age, tbl_bride.number
                        FROM tbl_groom
                        INNER JOIN tbl_bride ON tbl_groom.id = tbl_bride.id;");

// display the rows and a delete button for each row
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<title>ADMIN-WEDDING</title>

  	<!-- custom css file link -->
  	<link rel="stylesheet" href="admin.css">

</head>
<body>
	
	<div class="container">
		<div class="content">
			<a href="logout.php" class="btn">Logout</a>
		</div>
		<table>
			<tr>
				<th>Name of Groom</th>
				<th>Age</th>
				<th>Contact Number</th>
				<th>Name of Bride</th>
				<th>Age</th>
				<th>Contact Number</th>
				<th>Wedding Date</th>
			</tr>

			<?php while ($row = mysqli_fetch_assoc($result)): ?>
				<tr>
					<td><?php echo $row['name1']; ?></td>
					<td><?php echo $row['age1']; ?></td>
					<td><?php echo $row['number1']; ?></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['age']; ?></td>
					<td><?php echo $row['number']; ?></td>
			</tr>
	
	</div>
<?php endwhile; ?>
<?php
// Close the database connection
mysqli_close($conn);
?>