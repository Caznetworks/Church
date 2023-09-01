<?php
session_start();
include 'config.php';

// Redirect to login page if not logged in
if (!isset($_SESSION['AdminName'])) {
    header('location:login_form.php');
    exit;
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
    $stmt = $conn->prepare("DELETE FROM tbl_funeral WHERE id = ?");
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

$search = '';

if (isset($_POST['submit'])) {
    $search = $_POST['search'];
}

$massFilter = '';

if (isset($_GET['mass'])) {
    $massFilter = $_GET['mass'];
}

$sql = "SELECT * FROM tbl_funeral";

if (!empty($search)) {
    $sql .= " WHERE id LIKE '%$search%' OR lastname LIKE '%$search%' OR firstname LIKE '%$search%' OR birth LIKE '%$search%' OR death LIKE '%$search%' OR age LIKE '%$search%' OR spouse LIKE '%$search%' OR name_of_kin LIKE '%$search%' OR number LIKE '%$search%' OR mass LIKE '%$search%'";
}

if (!empty($massFilter)) {
    if (empty($search)) {
        $sql .= " WHERE";
    } else {
        $sql .= " AND";
    }
    $sql .= " mass = '$massFilter'";
}

$sql .= " ORDER BY mass ASC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN-FUNERAL</title>

    <!-- custom css file link -->
    <link rel="stylesheet" href="admin.css">

</head>

<body>
    <section class="title">
        <form class="name">
            <h1>FUNERAL MASS SCHEDULES</h1>
        </form>
    </section>
    <div class="container">
        <div class="content">
            <a href="logout.php" class="btn">Logout</a>
            <a href="admin1.php" class="btn2"><b>BACK</b></a>
        </div>

        <div class="search-bar">
            <form method="post">
                <input type="text" placeholder="Search" name="search" value="<?php echo $search; ?>">
                <button class="btn btn-dark btn-sm" name="submit">Search</button>
                <button class="reset-button">Reset</button>
            </form>
          </div>
          <div class = "filter">
            <form method="get" class="filter">
                <input type="date" id="mass" name="mass" value="<?php echo $massFilter; ?>">
                <button type="submit" name="submit">Filter</button>
            </form>
          </div>
            <table>
                <thead>
                    <tr>
                        <th style="display:none;">ID</th>
                        <th>Name of the Deceased</th>
                        <th></th>
                        <th>Date of Birth</th>
                        <th>Date of Death</th>
                        <th>Age</th>
                        <th>Name of Parent or Spouse</th>
                        <th>Contact Person</th>
                        <th>Relationship to the Deceased</th>
                        <th>Contact Number</th>
                        <th>Date of Funeral Mass</th>
                        <th>Action</th>
                        <th>Verification</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>
                                        <td style="display:none;">' . $row['id'] . '</td>
                                        <td>' . $row['lastname'] . '</td>
                                        <td>' . $row['firstname'] . '</td>
                                        <td>' . $row['birth'] . '</td>
                                        <td>' . $row['death'] . '</td>
                                        <td>' . $row['age'] . '</td>
                                        <td>' . $row['spouse'] . '</td>
                                        <td>' . $row['name_of_kin'] . '</td>
                                        <td>' . $row['relationship_to_deceased'] . '</td>
                                        <td>' . $row['number'] . '</td>
                                        <td>' . $row['mass'] . '</td>
                                        <td>
                                            <a href="editfuneral.php?id=' . $row['id'] . '" class="edit-btn active">Edit</a>
                                            <form method="post">
                                                <input type="hidden" name="id" value="' . $row['id'] . '">
                                                <button type="submit" name="delete" class="delete-btn active">Delete</button>
                                            </form>
                                            <a href="frequirements.php?id=' . $row['id'] . '" class="view-requirements-btn active">View Requirements</a>
                                        </td>
                                        <td>';
                                if ($row['death_certificate'] == 1) {
                                    echo "&#x2713;"; // check mark entity
                                } else {
                                    echo "&#x2717;"; // x mark entity
                                }

                                echo '</td>
                                      </tr>';
                            }
                        } else {
                            echo '<tr><td colspan="13" class="text-danger">DATA NOT FOUND</td></tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
