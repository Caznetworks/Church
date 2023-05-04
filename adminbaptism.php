<?php 
	
session_start();
include 'config.php';

// Redirect to login page if not logged in
if(!isset($_SESSION['AdminName'])){
    header('location:login_form.php');
}

// Check if the id parameter is set in the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // query the database to display all rows
$conn = new mysqli('localhost', 'root', '', 'db_church');
if ($conn->connect_error) {
  die("Connection Failed: " . $conn->connect_error);
}
}
$result = $conn->query("SELECT * FROM tbl_baptism");

?>

<!--?php
// Start the session and include the config file
session_start();
include 'config.php';

// Redirect to login page if not logged in
if(!isset($_SESSION['AdminName'])){
	header('location:login_form.php');
}

$id = $_GET["id"];
$sql = "DELETE FROM `tbl_baptism` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: adminbaptism.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);


  // close database connection
  $stmt->close();
  $conn->close();
}

// query the database to display all rows
$conn = new mysqli('localhost', 'root', '', 'db_church');
if ($conn->connect_error) {
  die("Connection Failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM tbl_baptism");

// display the rows and a delete button for each row
?-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<title>ADMIN-BAPTISM</title>

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
				<th>ID</th>
				<th>Candidate</th>
				<th>Date of Birth</th>
				<th>Place of Birth</th>
				<th>Name of Father</th>
				<th>Name of Mother</th>
				<th>Address</th>
				<th>Sponsors</th>
				<th> </th>
				<th>Date of Baptism</th>
							</tr>

			<?php while ($row = mysqli_fetch_assoc($result)): ?>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['Candidate']; ?></td>
					<td><?php echo $row['Birth']; ?></td>
					<td><?php echo $row['Place']; ?></td>
					<td><?php echo $row['Father']; ?></td>
					<td><?php echo $row['Mother']; ?></td>
					<td><?php echo $row['Address']; ?></td>
					<td><?php echo $row['Godmother']; ?></td>
					<td><?php echo $row['Godfather']; ?></td>
					<td><?php echo $row['Baptism']; ?></td>
					<td>
  <form method="post" action="edit.php?id=<?php echo $row["id"] ?>">
    <button type="submit" class="btn btn-primary">Edit</button>
  </form>
  <form method="post" action="delete.php?id=<?php echo $row["id"] ?>" onsubmit="return confirm('Are you sure you want to delete this record?')">
    <button type="submit" class="btn btn-danger">Delete</button>
  </form>
</td>

			</tr>

<?php endwhile; ?>
<?php
// Close the database connection
mysqli_close($conn);
?>
