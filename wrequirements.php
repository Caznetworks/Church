<?php
require_once 'config.php';

if (isset($_POST['submit'])) {
  $id = $_GET['id'];
  $Verification1 = isset($_POST['Verification1']) ? 1 : 0;
  $Verification2 = isset($_POST['Verification2']) ? 1 : 0;
  $Verification3 = isset($_POST['Verification3']) ? 1 : 0;
  $Verification4 = isset($_POST['Verification4']) ? 1 : 0;
  $Verification5 = isset($_POST['Verification5']) ? 1 : 0;
  $Verification6 = isset($_POST['Verification6']) ? 1 : 0;
  $Verification7 = isset($_POST['Verification7']) ? 1 : 0;
  $Verification8 = isset($_POST['Verification8']) ? 1 : 0;

  // Check if all verifications are checked
  if ($Verification1 && $Verification2 && $Verification3 && $Verification4 && $Verification5 && $Verification6 && $Verification7 && $Verification8) {
    $verification = 1;
  } else {
    $verification = 0;
  }

  $query = "UPDATE tbl_bride SET verification='$verification', Verification1='$Verification1', Verification2='$Verification2', Verification3='$Verification3', Verification4='$Verification4', Verification5='$Verification5', Verification6='$Verification6', Verification7='$Verification7', Verification8='$Verification8' WHERE id='$id'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    header('Location: adminwedding.php');
    exit();
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}

$id = $_GET['id'];
$query = "SELECT * FROM tbl_bride WHERE id='$id'";
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
    <form method="post" action="">
      <div class="input-group">
  <div>
    <input type="checkbox" name="Verification1" <?php if (isset($row['Verification1']) && $row['Verification1'] == 1) {echo "checked";} ?>>
    <label>At least two valid IDs of the couple during their personal appearance</label>
  </div>
  <div>
    <input type="checkbox" name="Verification2" <?php if (isset($row['Verification2']) && $row['Verification2'] == 1) {echo "checked";} ?>>
    <label>Certificate of Attendance in Pre-Marriage Counseling</label>
  </div>
  <div>
    <input type="checkbox" name="Verification3" <?php if (isset($row['Verification3']) && $row['Verification3'] == 1) {echo "checked";} ?>>
    <label>PSA Birth Certificate</label>
  </div>
  <div>
    <input type="checkbox" name="Verification4" <?php if (isset($row['Verification4']) && $row['Verification4'] == 1) {echo "checked";} ?>>
    <label>Certificate of No Marriage</label>
  </div>
  <div>
    <input type="checkbox" name="Verification5" <?php if (isset($row['Verification5']) && $row['Verification5'] == 1) {echo "checked";} ?>>
    <label>Marriage License Application Form</label>
  </div>
  <div>
    <input type="checkbox" name="Verification6" <?php if (isset($row['Verification6']) && $row['Verification6'] == 1) {echo "checked";} ?>>
    <label>Barangay Certificate</label>
  </div>
  <div>
    <input type="checkbox" name="Verification7" <?php if (isset($row['Verification7']) && $row['Verification7'] == 1) {echo "checked";} ?>>
    <label>Community Tax Certificate</label>
  </div>
  <div>
    <input type="checkbox" name="Verification8" <?php if (isset($row['Verification8']) && $row['Verification8'] == 1) {echo "checked";} ?>>
    <label>1×1 picture</label>
  </div>
  <div>
          <button type="submit" name="submit" class="btn">Submit</button>
      <a href="adminwedding.php" class="btn">Back</a>
  </div>
</form>

