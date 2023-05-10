<?php
// Start the session and include the config file
session_start();
include 'config.php';

// Redirect to login page if not logged in
if (!isset($_SESSION['AdminName'])) {
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
    $stmt = $conn->prepare("DELETE FROM tbl_groom WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // check if the delete was successful
    if ($stmt->affected_rows > 0) {
      // delete the corresponding row from tbl_bride
      $stmt = $conn->prepare("DELETE FROM tbl_bride WHERE id = ?");
      $stmt->bind_param("i", $id);
      $stmt->execute();

      if ($stmt->affected_rows > 0) {
        echo "Record deleted successfully";
      } else {
        echo "Error deleting record from tbl_bride: " . $conn->error;
      }
    } else {
      echo "Error deleting record from tbl_groom: " . $conn->error;
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

$result = $conn->query("SELECT tbl_groom.id, tbl_groom.name1, tbl_groom.email1, tbl_groom.dob1, tbl_groom.age1, tbl_groom.place1, tbl_groom.citizenship1, tbl_groom.number1, tbl_groom.Religion1, tbl_groom.father1, tbl_groom.mother1, tbl_groom.number1, tbl_bride.name, tbl_bride.email, tbl_bride.dob, tbl_bride.age, tbl_bride.place, tbl_bride.citizenship, tbl_bride.number, tbl_bride.Religion, tbl_bride.father, tbl_bride.mother, tbl_bride.dob2, tbl_bride.time, tbl_bride.verification
                        FROM tbl_groom
                        INNER JOIN tbl_bride ON tbl_groom.id = tbl_bride.id
                        ORDER BY tbl_bride.dob2 ASC, tbl_bride.time ASC;");

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
			<a href="logout.php" class="btn"><b>LOGOUT</b></a>
			<a href="admin1.php" class="btn2"><b>BACK</b></a>
		</div>
		<div class="container my-5">
			<form method="post">
           	 <input type="text" placeholder="Search" name="search">
           	 <button class="btn btn-dark btn-sm" name="submit"> Search </button>
        	</form>
      <form method="get" class= "filter">
             <label for ="dob2"></label>
             <input type = "date" id = "dob2" name = "dob2">
             <button type="submit"> Filter</button>
      </form>

		<table>
    <?php
if (isset($_POST['submit'])) {
  $search = $_POST['search'];

  $sql = "SELECT * FROM tbl_bride WHERE id LIKE '%$search%' OR dob2 LIKE '%$search%'";
  $result = mysqli_query($conn, $sql);

 if ($result) {
    if (mysqli_num_rows($result) > 0) {
      echo '<table>
            <thead>
              <tr>
                <th style="display:none;">ID</th>
                <th>Name of Groom</th>
                <th style="display:none;">Email</th>
                <th style="display:none;">Date of Birth</th>
                <th style="display:none;">Age</th>
                <th style="display:none;">Place of birth</th>
                <th style="display:none;">Citizenship</th>
                <th style="display:none;">Contact Number</th>
                <th style="display:none;">Religion</th>
                <th style="display:none;">Father</th>
                <th style="display:none;">Mother</th>
                <th>Name of Bride</th>
                <th style="display:none;">Email</th>
                <th style="display:none;">Date of Birth</th>
                <th style="display:none;">Age</th>
                <th style="display:none;">Place of birth</th>
                <th style="display:none;">Citizenship</th>
                <th style="display:none;">Contact Number</th>
                <th style="display:none;">Religion</th>
                <th style="display:none;">Father</th>
                <th style="display:none;">Mother</th>
                <th>Date</th>
                <th>Time</th>
                <th>Action</th>
                <th>Verification</th>
              </tr>
            </thead>
            <tbody>';

      while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>
                <td style="display:none;">' . $row['id'] . '</td>
                <td>' . $row['name1'] . '</td>
                <td style="display:none;">' . $row['email1'] . '</td>
                <td style="display:none;">' . $row['dob1'] . '</td>
                <td style="display:none;">' . $row['age1'] . '</td>
                <td style="display:none;">' . $row['place1'] . '</td>
                <td style="display:none;">' . $row['citizenship1'] . '</td>
                <td style="display:none;">' . $row['number1'] . '</td>
                <td style="display:none;">' . $row['Religion1'] . '</td>
                <td style="display:none;">' . $row['father1'] . '</td>
                <td style="display:none;">' . $row['mother1'] . '</td>
                <td>' . $row['name'] . '</td>
                <td style="display:none;">' . $row['email'] . '</td>
                <td style="display:none;">' . $row['dob'] . '</td>
                <td style="display:none;">' . $row['age'] . '</td>
                <td style="display:none;">' . $row['place'] . '</td>
                <td style="display:none;">' . $row['citizenship'] . '</td>
                <td style="display:none;">' . $row['number'] . '</td>
                <td style="display:none;">'. $row['Religion'] . '</td>
                <td style="display:none;">' . $row['father'] . '</td>
                <td style="display:none;">' . $row['mother'] . '</td>
                <td>' . $row['dob2'] . '</td>
                <td>' . $row['time'] . '</td>
                <td>
                  <a href="editwedding.php?id=' . $row['id'] . '" class="edit-btn active">Edit</a>
                  <form method="post">
                    <input type="hidden" name="id" value="' . $row['id'] . '">
                    <button type="submit" name="delete" class="delete-btn active">Delete</button>
                  </form>
                  <a href="wrequirements.php?id=' . $row['id'] . '" class="view-requirements-btn active">View Requirements</a>
                </td>

                <td>';

        if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // rest of the code that uses $id variable
      } else {
        // handle the case where id parameter is not set
      }

      $query = "SELECT id, verification, Verification1, Verification2, Verification3, Verification4, Verification5, Verification6, Verification7, Verification8    FROM tbl_bride WHERE id='$id'";
      if (isset($row['verification']) && $row['verification'] == 1) {
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
        <th>Name of Groom</th>
        <th style="display:none;">Email</th>
        <th style="display:none;">Date of Birth</th>
        <th style="display:none;">Age</th>
        <th style="display:none;">Place of birth</th>
        <th style="display:none;">Citizenship</th>
        <th style="display:none;">Contact Number</th>
        <th style="display:none;">Religion</th>
        <th style="display:none;">Father</th>
        <th style="display:none;">Mother</th>
        <th>Name of Bride</th>
        <th style="display:none;">Email</th>
        <th style="display:none;">Date of Birth</th>
        <th style="display:none;">Age</th>
        <th style="display:none;">Place of birth</th>
        <th style="display:none;">Citizenship</th>
        <th style="display:none;">Contact Number</th>
        <th style="display:none;">Religion</th>
        <th style="display:none;">Father</th>
        <th style="display:none;">Mother</th>
        <th>Date</th>
        <th>Time</th>
        <th>Action</th>
        <th>Verification</th>
      </tr>
  <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td style="display:none;"><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td style="display:none;"><?php echo $row['email']; ?></td>
        <td style="display:none;"><?php echo $row['dob']; ?></td>
        <td style="display:none;"><?php echo $row['age']; ?></td>
        <td style="display:none;"><?php echo $row['place']; ?></td>
        <td style="display:none;"><?php echo $row['citizenship']; ?></td>
        <td style="display:none;"><?php echo $row['number']; ?></td>
        <td style="display:none;"><?php echo $row['Religion']; ?></td>
        <td style="display:none;"><?php echo $row['father']; ?></td>
        <td style="display:none;"><?php echo $row['mother']; ?></td>
        <td><?php echo $row['name1']; ?></td>
        <td style="display:none;"><?php echo $row['email1']; ?></td>
        <td style="display:none;"><?php echo $row['dob1']; ?></td>
        <td style="display:none;"><?php echo $row['age1']; ?></td>
        <td style="display:none;"><?php echo $row['place1']; ?></td>
        <td style="display:none;"><?php echo $row['citizenship1']; ?></td>
        <td style="display:none;"><?php echo $row['number1']; ?></td>
        <td style="display:none;"><?php echo $row['Religion1']; ?></td>
        <td style="display:none;"><?php echo $row['father1']; ?></td>
        <td style="display:none;"><?php echo $row['mother1']; ?></td>
        <td><?php echo $row['dob2']; ?></td>
        <td><?php echo $row['time']; ?></td>
        <td>
          <a href="editwedding.php?id=<?php echo $row['id']; ?>" class="edit-btn active">Edit</a>
          <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button type="submit" name="delete" class="delete-btn active">Delete</button>
          </form>
          <a href="wrequirements.php?id=<?php echo $row['id']; ?>" class="view-requirements-btn active">View Requirements</a>     
      </td>
        <td>
        <?php if ($row['verification'] == 1) {
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




