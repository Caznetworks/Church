<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // connect to database
    $conn = new mysqli('localhost', 'root', '', 'db_church');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // query the database to retrieve the selected row
    $stmt = $conn->prepare("SELECT * FROM tbl_baptism WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // close database connection
    $stmt->close();
    $conn->close();
}

if (isset($_POST['update'])) {
    $Candidate = $_POST['Candidate'];
  	$Birth = date('Y-m-d', strtotime($_POST['Birth'])); // convert date format to yyyy-mm-dd
  	$Place = $_POST['Place'];
  	$Father = $_POST['Father'];
  	$Mother = $_POST['Mother'];
  	$Address = $_POST['Address'];
  	$Godmother = $_POST['Godmother'];
  	$Godfather = $_POST['Godfather'];
  	$Baptism = date('Y-m-d', strtotime($_POST['Baptism'])); // convert date format to yyyy-mm-dd

    // connect to database
    $conn = new mysqli('localhost', 'root', '', 'db_church');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // update the record in the database
		$stmt = $conn->prepare("UPDATE tbl_baptism SET Candidate=?, Birth=?, Place=?, Father=?, Mother=?, Address=?, Godmother=?, Godfather=?, Baptism=? WHERE id=?");
		$stmt->bind_param("sssssssssi", $Candidate, $Birth, $Place, $Father, $Mother, $Address, $Godmother, $Godfather, $Baptism, $id);
		$stmt->execute();


    // close database connection
    $stmt->close();
    $conn->close();

    // redirect back to admin page after update
    header('Location: adminbaptism.php');
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
				$stmt = $conn->prepare("SELECT * FROM tbl_baptism WHERE id = ?");
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
            <label for="Candidate">Candidate:</label>
            <input type="text" id="Candidate" name="Candidate" value="<?php echo $row['Candidate']; ?>">
            <label for="Birth">Date of Birth:</label>
            <input type="date" id="Birth" name="Birth" value="<?php echo $row['Birth']; ?>">
            <label for="Place">Place of Birth:</label>
            <input type="text" id="Place" name="Place" value="<?php echo $row['Place']; ?>">
            <label for="Father">Name of Father:</label>
            <input type="text" id="Father" name="Father" value="<?php echo $row['Father']; ?>">
            <label for="Mother">Name of Mother:</label>
            <input type="text" id="Mother" name="Mother" value="<?php echo $row['Mother']; ?>">
            <label for="Address">Address:</label>
            <input type="text" id="Address" name="Address" value="<?php echo $row['Address']; ?>">
            <label for="Godmother">Godmother:</label>
            <input type="text" id="Godmother" name="Godmother" value="<?php echo $row['Godmother']; ?>">
            <label for="Godfather">Godfather:</label>
            <input type="text" id="Godfather" name="Godfather" value="<?php echo $row['Godfather']; ?>">
            <label for="Baptism">Date of Baptism:</label>
			<input type="date" id="Baptism" name="Baptism" value="<?php echo $row['Baptism']; ?>">
			<button type="submit" name="update">Update</button>
			<a href="adminbaptism.php">Cancel</a>
		</form>

	</div>
</body>
</html>
