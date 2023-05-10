<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // connect to the database
    $conn = new mysqli('localhost', 'root', '', 'db_church');
        if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }
    
    $stmt = $conn->prepare("SELECT tbl_groom.id, tbl_groom.name1,tbl_groom.email1, tbl_groom.dob1, tbl_groom.age1, tbl_groom.place1, tbl_groom.citizenship1, tbl_groom.number1, tbl_groom.Religion1, tbl_groom.father1, tbl_groom.mother1,tbl_groom.number1, tbl_bride.name, tbl_bride.email,tbl_bride.dob, tbl_bride.age, tbl_bride.place, tbl_bride.citizenship, tbl_bride.number, tbl_bride.Religion, tbl_bride.father, tbl_bride.mother, tbl_bride.dob2, tbl_bride.time
                        FROM tbl_groom
                        INNER JOIN tbl_bride ON tbl_groom.id = tbl_bride.id WHERE tbl_groom.id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // close database connection
    $stmt->close();
    $conn->close();
}


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name1 = $_POST['name1'];
    $email1 = $_POST['email1'];
    $dob1 = date('Y-m-d', strtotime($_POST['dob1'])); // convert date format to yyyy-mm-dd
    $age1 = $_POST['age1'];
    $place1 = $_POST['place1'];
    $citizenship1 = $_POST['citizenship1'];
    $number1 = $_POST['number1'];
    $Religion1 = $_POST['Religion1'];
    $father1 = $_POST['father1'];
    $mother1 = $_POST['mother1'];

    $name = $_POST['name'];
    $email = $_POST['email'];
    $dob = date('Y-m-d', strtotime($_POST['dob'])); // convert date format to yyyy-mm-dd
    $age = $_POST['age'];
    $place = $_POST['place'];
    $citizenship = $_POST['citizenship'];
    $number = $_POST['number'];
    $Religion = $_POST['Religion'];
    $father = $_POST['father'];
    $mother = $_POST['mother'];
    $dob2 = date('Y-m-d', strtotime($_POST['dob2'])); // convert date format to yyyy-mm-dd
    $time = $_POST['time'];
    
    // connect to database
    $conn = new mysqli('localhost', 'root', '', 'db_church');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // Update tbl_groom
    $updateGroomQuery = "UPDATE tbl_groom SET name1 = ?, email1 = ?, dob1 = ?, age1 = ?, place1 = ?, citizenship1 = ?, number1 = ?, Religion1 = ?, father1 = ?, mother1 = ? WHERE id = ?";
    $stmt = $conn->prepare($updateGroomQuery);
        $stmt->bind_param("sssissssssi", $name1, $email1, $dob1, $age1, $place1, $citizenship1, $number1, $Religion1, $father1, $mother1, $id);
    $stmt->execute();
    
    // Update tbl_bride
    $updateBrideQuery = "UPDATE tbl_bride SET name = ?, email = ?, dob = ?, age = ?, place = ?, citizenship = ?, number = ?, Religion = ?, father = ?, mother = ?, dob2 = ?, time = ? WHERE id = ?";
    $stmt = $conn->prepare($updateBrideQuery);
    $stmt->bind_param("sssissssssssi", $name, $email, $dob, $age, $place, $citizenship, $number, $Religion, $father, $mother, $dob2, $time, $id);
    $stmt->execute();
    
    // Close database connection
    $stmt->close();
    $conn->close();

    // Redirect to the page displaying the updated details
    header("Location: adminwedding.php?id=" . $id);
    exit();
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Edit Record</title>
    <link rel="stylesheet" href="edit_record.css">
</head>
<body>
    <div class="container">
		

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
    $stmt = $conn->prepare("SELECT tbl_groom.id, tbl_groom.name1, tbl_groom.email1, tbl_groom.dob1, tbl_groom.age1, tbl_groom.place1, tbl_groom.citizenship1, tbl_groom.number1, tbl_groom.Religion1, tbl_groom.father1, tbl_groom.mother1, tbl_bride.name, tbl_bride.email, tbl_bride.dob, tbl_bride.age, tbl_bride.place, tbl_bride.citizenship, tbl_bride.number, tbl_bride.Religion, tbl_bride.father, tbl_bride.mother, tbl_bride.dob2, tbl_bride.time
                FROM tbl_groom
                INNER JOIN tbl_bride ON tbl_groom.id = tbl_bride.id WHERE tbl_groom.id = ?");
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
    <div style="display: flex; gap: 20px;">
        <!-- Groom Info -->
        <div>
            <h2>Groom Info</h2>
            <label for="name1">Name of Groom:</label>
            <input type="text" id="name1" name="name1" value="<?php echo $row['name1']; ?>">
            <label for="email1">Email:</label>
            <input type="text" id="email1" name="email1" value="<?php echo $row['email1']; ?>">
            <label for="dob1">Date of Birth:</label>
            <input type="date" id="dob1" name="dob1" value="<?php echo $row['dob1']; ?>">
            <label for="age1">Age:</label>
            <input type="text" id="age1" name="age1" value="<?php echo $row['age1']; ?>">
            <label for="place1">Place of Birth:</label>
            <input type="text" id="place1" name="place1" value="<?php echo $row['place1']; ?>">
            <label for="citizenship1">Citizenship:</label>
            <input type="text" id="citizenship1" name="citizenship1" value="<?php echo $row['citizenship1'];?>">
            <label for="number1">Contact Number:</label>
            <input type="text" id="number1" name="number1" value="<?php echo $row['number1']; ?>"oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="11">
            <label for="Religion1">Religion:</label>
            <input type="text" id="Religion1" name="Religion1" value="<?php echo $row['Religion1']; ?>">
            <label for="father1">Name of Father:</label>
            <input type="text" id="father1" name="father1" value="<?php echo $row['father1']; ?>">
            <label for="mother1">Name of Mother:</label>
            <input type="text" id="mother1" name="mother1" value="<?php echo $row['mother1']; ?>">
        </div>
             <!-- Bride Info -->
        <div>
            <h2>Bride Info</h2>
            <label for="name">Name of Bride:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>">
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" value="<?php echo $row['dob']; ?>">
            <label for="age">Age:</label>
            <input type="text" id="age" name="age" value="<?php echo $row['age']; ?>">
            <label for="place">Place of Birth:</label>
            <input type="text" id="place" name="place" value="<?php echo $row['place']; ?>">
            <label for="citizenship">Citizenship:</label>
            <input type="text" id="citizenship" name="citizenship" value="<?php echo $row['citizenship'];?>">
            <label for="number">Contact Number:</label>
            <input type="text" id="number" name="number" value="<?php echo $row['number']; ?>"oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="11">
            <label for="Religion">Religion:</label>
            <input type="text" id="Religion" name="Religion" value="<?php echo $row['Religion']; ?>">
            <label for="father">Name of Father:</label>
            <input type="text" id="father" name="father" value="<?php echo $row['father']; ?>">
            <label for="mother">Name of Mother:</label>
            <input type="text" id="mother" name="mother" value="<?php echo $row['mother']; ?>">
              </div>
            </div>

            <label for="dob2">Wedding Date:</label>
            <input type="date" id="dob2" name="dob2" value="<?php echo $row['dob2'] ?? ''; ?>">
            <label for="time">Time:</label>
            <select name="time" id="time" required>
                <option value="">Select an Option</option>
                <option value="9AM">9AM</option>
                <option value="10AM">10AM</option>
                <option value="11AM">11AM</option>
                <option value="3PM">3PM</option>
                <option value="4PM">4PM</option>
            </select>

            <button type="submit" class="btn" name="update">Update</button>
            <a href="adminwedding.php">Cancel</a>
        </form>

	</div>
</body>
</html>
