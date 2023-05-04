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

    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'db_church');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // Get the row with the specified id from the database
    $sql = "SELECT * FROM tbl_baptism WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    // Close the database connection
    mysqli_close($conn);

    // Check if a row was found
    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        // Redirect to the adminbaptism page if no row was found
        header("Location: adminbaptism.php");
        exit();
    }
} else {
    // Redirect to the adminbaptism page if the id parameter is not set in the URL
    header("Location: adminbaptism.php");
    exit();
}

// Handle the form submission
if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $candidate = $_POST['Candidate'];
    $birth = $_POST['Birth'];
    $place = $_POST['Place'];
    $father = $_POST['Father'];
    $mother = $_POST['Mother'];
    $address = $_POST['Address'];
    $godmother = $_POST['Godmother'];
    $godfather = $_POST['Godfather'];
    $baptism = $_POST['Baptism'];

    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'db_church');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // Update the row in the database
    $sql = "UPDATE tbl_baptism SET Candidate='$candidate', Birth='$birth', Place='$place', Father='$father', Mother='$mother', Address='$address', Godmother='$godmother', Godfather='$godfather', Baptism='$baptism' WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    // Close the database connection
    mysqli_close($conn);

    if($result) {
        // Redirect to the adminbaptism page with a success message
        header("Location: adminbaptism.php?msg=Data updated successfully");
        exit();
    } else {
        echo "Failed: " . mysqli_error($conn);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN-BAPTISM</title>

    <!-- custom css file link -->
    <link rel="stylesheet" href="admin.css">

        <div class="form-container">
        <h2>Edit Baptism Record</h2>
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="candidate">Candidate:</label>
            <input type="text" id="candidate" name="candidate" value="<?php echo $row['Candidate']; ?>">
            <label for="birth">Date of Birth:</label>
            <input type="date" id="birth" name="birth" value="<?php echo $row['Birth']; ?>">
            <label for="place">Place of Birth:</label>
            <input type="text" id="place" name="place" value="<?php echo $row['Place']; ?>">
            <label for="father">Name of Father:</label>
            <input type="text" id="father" name="father" value="<?php echo $row['Father']; ?>">
            <label for="mother">Name of Mother:</label>
            <input type="text" id="mother" name="mother" value="<?php echo $row['Mother']; ?>">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $row['Address']; ?>">
            <label for="godmother">Godmother:</label>
            <input type="text" id="godmother" name="godmother" value="<?php echo $row['Godmother']; ?>">
            <label for="godfather">Godfather:</label>
            <input type="text" id="godfather" name="godfather" value="<?php echo $row['Godfather']; ?>">
            <label for="baptism">Date of Baptism:</label>
            <input type="date" id="baptism" name="baptism" value="<?php echo $row['Baptism']; ?>">
            <input type="submit" value="Save">
        </form>
    </div>
</div>


</head>
<body>