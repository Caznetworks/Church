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
		$stmt = $conn->prepare("DELETE FROM tbl_baptism WHERE id = ?");
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
		// query the database to display all rows in ascending order of the 'Baptism' date
			$result = $conn->query("SELECT * FROM tbl_baptism ORDER BY Baptism ASC");

	  

	
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
			<a href="logout.php" class="btn"><b>LOGOUT</b></a>
			<a href="admin1.php" class="btn2"><b>BACK</b></a>
		</div>
		<div class="container my-5">
			<form method="post">
           	 <input type="text" placeholder="Search" name="search">
           	 <button class="btn btn-dark btn-sm" name="submit"> Search </button>
        	</form>
		<table>
			<?php
if (isset($_POST['submit'])) {
  $search = $_POST['search'];

  $sql = "SELECT * FROM tbl_baptism WHERE id like '%$search%' OR Candidate like '%$search%' OR Birth like '%$search%' OR Place like '%$search%' OR Father like '%$search%' OR Mother like '%$search%' OR Godmother like '%$search%' OR Godfather like '%$search%' OR Baptism like '%$search%'";
  $result = mysqli_query($conn, $sql);

if ($result) {
  if (mysqli_num_rows($result) > 0) {
    echo '<table>
          <thead>
            <tr>
              <th style="display:none>ID</th>
              <th>Candidate</th>
              <th>Date of Birth</th>
              <th>Place of Birth</th>
              <th>Name of Father</th>
              <th>Name of Mother</th>
              <th>Number</th>
              <th>Sponsors</th>
              <th>Date of Baptism</th>
              <th>Action</th>
              <th>Verification</th>
            </tr>
          </thead>
          <tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>
              <td style="display:none>' . $row['id'] . '</td>
              <td>' . $row['Candidate'] . '</td>
              <td>' . $row['Birth'] . '</td>
              <td>' . $row['Place'] . '</td>
              <td>' . $row['Father'] . '</td>
              <td>' . $row['Mother'] . '</td>
              <td>' . $row['number'] . '</td>
              <td>' . $row['Godmother'] . '</td>
              <td>' . $row['Baptism'] . '</td>
              <td>
                <a href="editbaptism.php?id=' . $row['id'] . '" class="edit-btn active">Edit</a>
                <form method="post">
                  <input type="hidden" name="id" value="' . $row['id'] . '">
                  <button type="submit" name="delete" class="delete-btn active">Delete</button>
                </form>
                <a href="brequirements.php?id='.$row['id'].'" class="view-requirements-btn active">View Requirements</a>
              </td>
              <td>';

      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // rest of the code that uses $id variable
      } else {
        // handle the case where id parameter is not set
      }

      $query = "SELECT id, Verification, Verification1, Verification2, Verification3, Verification4, Verification5 FROM tbl_baptism WHERE id='$id'";
      if (isset($row['Verification']) && $row['Verification'] == 1) {
        echo "&#x2713;"; // check mark entity
      } else {
        echo "&#x2717;"; // x mark entity
      }
      echo '</td>
            </tr>';
    }
    echo '</tbody>
          </table>';
  } else {
    echo '<h2 class="text-danger">DATA NOT FOUND</h2>';
  }
}
}
?>

			<tr>
				<th style="display:none;">ID</th>
				<th>Candidate</th>
				<th>Date of Birth</th>
				<th>Place of Birth</th>
				<th>Name of Father</th>
				<th>Name of Mother</th>
				<th>Number</th>
				<th>Sponsors</th>
				<th> </th>
				<th>Date of Baptism</th>
				<th>Action</th>
				<th>Verification</th>
			</tr>

			<?php while ($row = mysqli_fetch_assoc($result)): ?>
				<tr>
					<td style="display:none;"><?php echo $row['id']; ?></td>
					<td><?php echo $row['Candidate']; ?></td>
					<td><?php echo $row['Birth']; ?></td>
					<td><?php echo $row['Place']; ?></td>
					<td><?php echo $row['Father']; ?></td>
					<td><?php echo $row['Mother']; ?></td>
					<td><?php echo $row['number']; ?></td>
					<td><?php echo $row['Godmother']; ?></td>
					<td><?php echo $row['Godfather']; ?></td>
					<td><?php echo $row['Baptism']; ?></td>

					<td>
        <a href="editbaptism.php?id=<?php echo $row['id']; ?>" class="edit-btn active">Edit</a>
        <form method="post">
          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
          <button type="submit" name="delete" class="delete-btn active">Delete</button>
        </form>
        <a href="brequirements.php?id=<?php echo $row['id']; ?>" class="view-requirements-btn active">View Requirements</a>     
      </td>
				<td>
  			<?php if ($row['Verification'] == 1) {
          echo "&#x2713;"; // check mark entity
      } else {
          echo "&#x2717;"; // x mark entity
      } ?>

      </td>
				</tr>
		</div>
<?php endwhile; ?>
<?php
// Close the database connection
mysqli_close($conn);
?>
