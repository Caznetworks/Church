<?php
// Start the session and include the config file
session_start();
include 'config.php';

// Redirect to login page if not logged in
if(!isset($_SESSION['admin_name'])){
	header('location:123.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<title>ADMIN PAGE</title>

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
				<th>Name</th>
				<th>Age</th>
				<th>Address</th>
				<th>Phone</th>
				<th>Service</th>
				<th>Date</th>
				<th>Time</th>
				<th>Message</th>
							</tr>

			<?php while ($row = mysqli_fetch_assoc($result)): ?>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['age']; ?></td>
					<td><?php echo $row['address']; ?></td>
					<td><?php echo $row['phone']; ?></td>
					<td><?php echo $row['service']; ?></td>
					<td><?php echo $row['date']; ?></td>
					<td><?php echo $row['time']; ?></td>
					<td><?php echo $row['message']; ?></td>
			</tr>

<?php endwhile; ?>
<?php
// Close the database connection
mysqli_close($conn);
?>
</html>
