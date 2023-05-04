<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // connect to database
    $conn = new mysqli('localhost', 'root', '', 'db_church');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    $conn = new mysqli('localhost', 'root', '', 'db_church');
    if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT tbl_groom.name1, tbl_groom.age1, tbl_groom.number1, tbl_bride.name, tbl_bride.age, tbl_bride.number
                FROM tbl_groom
                INNER JOIN tbl_bride ON tbl_groom.id = tbl_bride.id WHERE id = ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();

// display the rows and a delete button for each row
}


if (isset($_POST['update'])) {
    $name1 = $_POST['name1'];
    $age1 = $_POST['age1'];
    $number1 = $_POST['number1'];
    $age = $_POST['age'];
    $number = $_POST['number'];
  	
    // connect to database
    $conn = new mysqli('localhost', 'root', '', 'db_church');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }
// Assume that the variables $newName1, $newAge1, $newNumber1, $newName, $newAge, and $newNumber contain the new values for the fields you want to update.

// Update tbl_groom
$updateGroomQuery = "UPDATE tbl_groom SET name1 = '$newName1', age1 = '$newAge1', number1 = '$newNumber1' WHERE id = {ID_VALUE}";

// Update tbl_bride
$updateBrideQuery = "UPDATE tbl_bride SET name = '$newName', age = '$newAge', number = '$newNumber' WHERE id = {ID_VALUE}";

// Execute both queries
if ($conn->query($updateGroomQuery) === TRUE && $conn->query($updateBrideQuery) === TRUE) {
    echo "Update successful";
} else {
    echo "Error updating records: " . $conn->error;
}

    // update the record in the database
    $stmt = $conn->prepare("UPDATE tbl_groom g INNER JOIN tbl_bride b ON g.id = b.id SET g.name1 = ?, g.age1 = ?, g.number1 = ?, b.name = ?, b.age = ?, b.number = ? WHERE g.id = ?");
    $stmt->bind_param("siisiii", $name1, $age1, $number1, $name, $age, $number, $id);
    $stmt->execute();
    


    // close database connection
    $stmt->close();
    $conn->close();

    // redirect back to admin page after update
    header('Location: adminwedding.php');
    exit();
}
?>



<html>
<head>
    <title>Edit Record</title>
<link rel="stylesheet" href="edit_record.css">

</head>
<body>
	<div class="container">
		<div class="content">
			<a href="logout.php" class="btn">Log Out</a>
		</div>

		<!-- check if an ID was passed in the URL -->
		<?php
			if (isset($_GET['id'])) {
				$id = $_GET['id'];

				// connect to database
				$conn = new mysqli('localhost', 'root', '', 'db_church');
				if ($conn->connect_error) {
					die("Connection Failed: " . $conn->connect_error);
				}

				// query the database to retrieve the selected row
				$stmt = $conn->prepare("SELECT tbl_groom.name1, tbl_groom.age1, tbl_groom.number1, tbl_bride.name, tbl_bride.age, tbl_bride.number
                FROM tbl_groom
                INNER JOIN tbl_bride ON tbl_groom.id = tbl_bride.id WHERE id = ?");
				$stmt->bind_param("i", $id);
				$stmt->execute();
				$result = $stmt->get_result();
				$row = $result->fetch_assoc();

				// close database connection
				$stmt->close();
				$conn->close();
			}
		?>

		<!-- display the form to edit the selected record -->
		<form method="post">
		<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="name1">Name of Groom:</label>
            <input type="text" id="name1" name="name1" value="<?php echo $row['name1']; ?>">
            <label for="age1">Age:</label>
            <input type="text" id="age1" name="age1" value="<?php echo $row['age1']; ?>">
            <label for="number1">Contact Number:</label>
            <input type="text" id="number1" name="number1" value="<?php echo $row['number1']; ?>">
            <label for="name">Name of Bride:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
            <label for="age1">Age:</label>
            <input type="text" id="age" name="age" value="<?php echo $row['age']; ?>">
            <label for="number1">Contact Number:</label>
            <input type="text" id="number" name="number" value="<?php echo $row['number']; ?>">
			<button type="submit" name="update">Update</button>
			<a href="adminwedding.php">Cancel</a>
		</form>

	</div>
</body>
</html>
