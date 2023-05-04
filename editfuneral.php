<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // connect to database
    $conn = new mysqli('localhost', 'root', '', 'db_church');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // query the database to retrieve the selected row
    $stmt = $conn->prepare("SELECT * FROM tbl_funeral WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // close database connection
    $stmt->close();
    $conn->close();
}

if (isset($_POST['update'])) {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $birth = date('Y-m-d', strtotime($_POST['birth'])); // convert date format to yyyy-mm-dd
    $death = date('Y-m-d', strtotime($_POST['death'])); // convert date format to yyyy-mm-dd
    $age = $_POST['age'];
    $spouse = $_POST['spouse'];
    $name_of_kin = $_POST['name_of_kin'];
    $relationship_to_deceased = $_POST['relationship_to_deceased'];
    $number = $_POST['number'];
    $mass = date('Y-m-d', strtotime($_POST['mass'])); // convert date format to yyyy-mm-dd
    // connect to database
    $conn = new mysqli('localhost', 'root', '', 'db_church');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // update the record in the database
        $stmt = $conn->prepare("UPDATE tbl_funeral SET lastname=?, firstname=?, birth=?, death=?, age=?, spouse=?,  name_of_kin=?, relationship_to_deceased=?, number=?, mass=? WHERE id=?");
		$stmt->bind_param("ssssisssisi",$lastname, $firstname, $birth, $death, $age, $spouse, $name_of_kin, $relationship_to_deceased, $number, $mass, $id);
		$stmt->execute();


    // close database connection
    $stmt->close();
    $conn->close();

    // redirect back to admin page after update
    header('Location: adminfuneral.php');
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
				$stmt = $conn->prepare("SELECT * FROM tbl_funeral WHERE id = ?");
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
            <label for="lastname">Name:</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo $row['lastname']; ?>">
            <label for="firstname"></label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $row['firstname']; ?>">
            <label for="birth">Date of Birth:</label>
            <input type="date" id="birth" name="birth" value="<?php echo $row['birth']; ?>">
            <label for="death">Date of Death:</label>
            <input type="date" id="death" name="death" value="<?php echo $row['death']; ?>">
            <label for="age">Age of Death:</label>
            <input type="text" id="age" name="age" value="<?php echo $row['age']; ?>">
            <label for="spouse">Name(s) of Parent(s) or Spouse:</label>
            <input type="text" id="spouse" name="spouse" value="<?php echo $row['spouse']; ?>">
            <label for="name_of_kin">Contact Person / Next of Kin</label>
            <input type="text" id="name_of_kin" name="name_of_kin" value="<?php echo $row['name_of_kin']; ?>">
            <label for="relationship_to_deceased">Relationship to Deceased:</label>
            <input type="text" id="relationship_to_deceased" name="relationship_to_deceased" value="<?php echo $row['relationship_to_deceased']; ?>">
            <label for="number">Contact Number:</label>
            <input type="text" id="number" name="number" value="<?php echo $row['number']; ?>">
            <label for="mass">Date of Funeral Mass:</label>
            <input type="date" id="mass" name="mass" value="<?php echo $row['mass']; ?>">
			<button type="submit" name="update">Update</button>
			<a href="adminfuneral.php">Cancel</a>
		</form>

	</div>
</body>
</html>
