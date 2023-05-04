<?php
require_once 'config.php';

if (isset($_POST['submit'])) {
  $id = $_GET['id'];
  $Verification1 = isset($_POST['Verification1']) ? 1 : 0;
  $Verification2 = isset($_POST['Verification2']) ? 1 : 0;
  $Verification3 = isset($_POST['Verification3']) ? 1 : 0;

  // Check if all verifications are checked
  if ($Verification1 && $Verification2 && $Verification3) {
    $Verification = 1;
  } else {
    $Verification = 0;
  }

  $query = "UPDATE tbl_baptism SET Verification='$Verification', Verification1='$Verification1', Verification2='$Verification2', Verification3='$Verification3' WHERE id='$id'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    header('Location: adminbaptism.php');
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}



$id = $_GET['id'];
$query = "SELECT * FROM tbl_baptism WHERE id='$id'";
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
  <div>
    <input type="checkbox" name="Verification1" <?php if (isset($row['Verification1']) && $row['Verification1'] == 1) {echo "checked";} ?>>
    <label for="baptism_registration">Submit Completed Baptism Registration Form</label>
  </div>
  <div>
    <input type="checkbox" name="Verification2" <?php if (isset($row['Verification2']) && $row['Verification2'] == 1) {echo "checked";} ?>>
    <label for="birth_certificate">Submit a copy of your child’s birth certificate</label>
  </div>
  <div>
    <input type="checkbox" name="Verification3" <?php if (isset($row['Verification3']) && $row['Verification3'] == 1) {echo "checked";} ?>>
    <label for="godparent_affidavit">Submit Godparent Affidavit(s) or Letter(s) of Good Standing</label>
  </div>
  <div>
          <button type="submit" name="submit" class="btn">Submit</button>
      <a href="adminfuneral.php" class="btn">Back</a>
  </div>
</form>

