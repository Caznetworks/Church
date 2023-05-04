<?php
require_once 'config.php';

if (isset($_POST['submit'])) {
  $id = $_GET['id'];
  $death_certificate = isset($_POST['death_certificate']) ? 1 : 0;

  $query = "UPDATE tbl_funeral SET death_certificate='$death_certificate' WHERE id='$id'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    header('Location: adminfuneral.php');
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}

$id = $_GET['id'];
$query = "SELECT * FROM tbl_funeral WHERE id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Requirements</title>
  <link rel="stylesheet" type="text/css" href="adminrequirement.css">
</head>
<body>
  <div class="container">
    <h2>View Requirements</h2>
    <form method="post">
      <div class="input-group">
        <input type="checkbox" name="death_certificate" <?php if ($row['death_certificate'] == 1) {echo "checked";} ?>>
        <label>Death Certificate</label>
      </div>
      <button type="submit" name="submit" class="btn">Submit</button>
      <a href="adminfuneral.php" class="btn">Back</a>
    </form>
  </div>
</body>
</html>
