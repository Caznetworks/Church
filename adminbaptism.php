<?php 
session_start();
include 'config.php';

// Redirect to login page if not logged in
if (!isset($_SESSION['AdminName'])) {
    header('location:login_form.php');
    exit();
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


$search = ""; // Initialize the $search variable

if (isset($_POST['submit'])) {
    $search = $_POST['search'];

    // Rest of the code...
}

$BaptismFilter = '';

if (isset($_GET['filter'])) {
   $BaptismFilter = $_GET['Baptism'];
}

$sql = "SELECT * FROM tbl_baptism";

if (!empty($search)) {
    $sql .= " WHERE id like '%$search%' OR Candidate like '%$search%' OR Birth like '%$search%' OR Place like '%$search%' OR Father like '%$search%' OR Mother like '%$search%' OR Godmother like '%$search%' OR Godfather like '%$search%' OR Baptism like '%$search%'";
}

if (!empty($BaptismFilter)) {
    if (empty($search)) {
        $sql .= " WHERE";
    } else {
        $sql .= " AND";
    }
    $sql .= " Baptism = '$BaptismFilter'";
}

$sql .= " ORDER BY Baptism ASC";

$result = $conn->query($sql);
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

</head>
<body>
<section class="title">
    <form class="name">
        <h1>BAPTISM SCHEDULES</h1>
    </form>
</section>
<div class="container">
    <div class="content">
        <a href="logout.php" class="btn"><b>LOGOUT</b></a>
        <a href="admin1.php" class="btn2"><b>BACK</b></a>
    </div>
    <div class="search-bar">
    <form method="post">
        <input type="text" placeholder="Search" name="search" value="<?php echo $search; ?>">
        <button class="btn btn-dark btn-sm" name="submit">Search</button>
        <button class="reset-button" type="submit" name="reset">Reset</button>
    </form>
</div>
<div class="filter">
    <form method="get" class="filter">
        <input type="date" id="mass" name="mass" value="<?php echo $massFilter; ?>">
        <button type="submit" name="submit">Filter</button>
    </form>
</div>

<!-- ... -->

<?php
if (isset($_POST['reset'])) {
    $search = '';
    $massFilter = '';
    header("Location: adminfuneral.php");
    exit();
}
?>

        <table>
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
            <?php endwhile; ?>
        </table>
    </div>
</div>

<?php
// Close the database connection
mysqli_close($conn);
?>
</body>
</html>
