<?php 
	
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
		$stmt = $conn->prepare("DELETE FROM tbl_funeral WHERE id = ?");
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
	  
	  $result = $conn->query("SELECT * FROM tbl_funeral");
	  
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<title>ADMIN-FUNERAL</title>

  	<!-- custom css file link -->
  	<link rel="stylesheet" href="admin.css">

</head>
<body>
	
	<div class="container">
		<div class="content">
			<a href="logout.php" class="btn">Logout</a>
			<a href="admin1.php" class="btn2"><b>BACK</b></a>
		</div>
		<table>
			<tr>
				<th>ID</th>
				<th>Name of the Deceased</th>
				<th> </th>
				<th>Date of Birth</th>
				<th>Date of Death</th>
				<th>Age</th>
				<th>Name(s) of Parent(s) or Spouse</th>
				<th>Contact Person</th>
				<th>Relationship to the Deceased</th>
				<th>Contact Number</th>
				<th>Date of Funeral Mass</th>
							</tr>

			<?php while ($row = mysqli_fetch_assoc($result)): ?>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['lastname']; ?></td>
					<td><?php echo $row['firstname']; ?></td>
					<td><?php echo $row['birth']; ?></td>
					<td><?php echo $row['death']; ?></td>
					<td><?php echo $row['age']; ?></td>
					<td><?php echo $row['spouse']; ?></td>
					<td><?php echo $row['name_of_kin']; ?></td>
					<td><?php echo $row['relationship_to_deceased']; ?></td>
					<td><?php echo $row['number']; ?></td>
					<td><?php echo $row['mass']; ?></td>

					<td><a href="editfuneral.php?id=<?php echo $row['id']; ?>" class="edit-btn active">Edit</a></td>
					<td> <form method="post">
    						<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    						<button type="submit" name="delete" class="delete-btn active">Delete</button>
 						  </form>
          			</td>
			</tr>

<?php endwhile; ?>
<?php
// Close the database connection
mysqli_close($conn);
?>
