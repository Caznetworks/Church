<?php
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

  //Database connection

  $conn = new mysqli('localhost', 'root', '', 'db_church');
  if($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
  }else {
      $stmt = $conn->prepare("INSERT INTO tbl_groom1(name1, email1, dob1, age1, place1, citizenship1,  number1, Religion1, father1, mother1) 
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("sssissssss",$name1, $email1, $dob1, $age1, $place1, $citizenship1, $number1, $Religion1, $father1, $mother1);
      $stmt->execute();
      $stmt->close();
      $conn->close();
  }
?>


<?php
 
include
 
'wedd.html'
; 
?>

<!DOCTYPE html>*
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="F APPOINTMENT" href="Image/logo2.jpg" width=100px height=100px>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="designbaptist.css" media="screen">
  <title>Church Appointment</title>
</head>
<body>
<div class="navbar">
      <div class="logo"><a href="#">WEDDING APPOINTMENT</a></div>
      <ul class="links">
        <li><a href="Home.html"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="Wedd.html"><i class="fas fa-church"></i>Wedding</a></li>
        <li><a href="Funeral.html"><i class="fas fa-church"></i>Funeral</a></li>
        <li><a href="Baptist.html"><i class="fas fa-church"></i>Baptism</a></li>
      </ul>
      <div class="toggle_btn">
        <i class="fa-solid fa-bars"></i>
      </div>
    </div>
    <div class="dropdown_menu">
      <li><a href="Home.html"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="Wedd.html"><i class="fas fa-church"></i>Wedding</a></li>
      <li><a href="Funeral.html"><i class="fas fa-church"></i>Funeral</a></li>
      <li><a href="Baptist.html"><i class="fas fa-church"></i>Baptism</a></li>
    </div>
  </header>
    <div class="popup" id="popup">
      <img src="Image/icon.png">
      <h1>NOTE:</h1>
      <p>Your appointment is for Validation!<br> Kindly submit all the requirements in the office <br> You can see the office Hours in Home section</p>
      <div class="recipt">
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

      echo "<br> <br>";
			echo "<p><strong>Name of Groom: </strong> " . $name1 . "</p>";
			echo "<p><strong>Email: </strong> " . $email1 . "</p>";
			echo "<p><strong>Date of Birth: </strong> " . $dob1 . "</p>";
			echo "<p><strong>Age: </strong> " . $age1 . "</p>";
			echo "<p><strong>Place of Birth: </strong> " . $place1 . "</p>";
			echo "<p><strong>Citizenship: </strong> " . $citizenship1 . "</p>";
			echo "<p><strong>Phone Number:</strong> " . $number1 .  "</p>";
			echo "<p><strong>Religion: </strong> " . $Religion1 . "</p>";
      echo "<p><strong>Name of Father: </strong> " . $father1 . "</p>";
      echo "<p><strong>Name of Mother: </strong> " . $mother1 . "</p>";
		}
    ?>
    <form action="connectweddingbride.php" method="post"></form>
