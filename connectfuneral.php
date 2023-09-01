<?php
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

  //Database connection

  $conn = new mysqli('localhost','root','','db_church');
  if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
  }else{
      $stmt = $conn->prepare("INSERT INTO tbl_funeral(lastname, firstname, birth, death, age, spouse,  name_of_kin, relationship_to_deceased, number, mass)values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("ssssisssis",$lastname, $firstname, $birth, $death, $age, $spouse, $name_of_kin, $relationship_to_deceased, $number, $mass);
      $stmt->execute();
      $stmt->close();
      $conn->close();
  }
?>

<!DOCTYPE html>*
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="F APPOINTMENT" href="Image/logo2.jpg" width=100px height=100px>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css.css" media="screen">
  <title>Church Appointment</title>
</head>
<body>
<div class="navbar">
      <div class="logo"><a href="#">FUNERAL  APPOINTMENT</a></div>
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
      <h1>NOTE:</h1>
      <p>Your appointment is for Validation!<br> Kindly submit all the requirements in the office <br> You can see the office Hours in Home section</p>
      <div class="recipt">
      <form action="connectweddingroom.php" method="post" ></form>
      <div class="wrapper">
        <div class="item">
        <?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $birth = date('Y-m-d', strtotime($_POST['birth'])); // convert date format to yyyy-mm-dd
      $death = date('Y-m-d', strtotime($_POST['death']));
      $age = $_POST['age'];
      $spouse = $_POST['spouse'];
      $name_of_kin = $_POST['name_of_kin'];
      $relationship_to_deceased = $_POST['relationship_to_deceased'];
      $number = $_POST['number'];
      $mass = date('Y-m-d', strtotime($_POST['mass'])); // convert date format to yyyy-mm-dd

      echo "<br> <br>";
      echo "<p><strong>REQUIREMENTS </strong></p>";
      echo "<br>";
      echo "<p><strong>*Death Certificate</strong></p>";

      echo "<br> <br>";
			echo "<p><strong>Firstname: </strong> " . $firstname . "</p>";
      echo "<p><strong>Lastname: </strong> " . $lastname . "</p>";
			echo "<p><strong>Date of Birth: </strong> " . $birth . "</p>";
			echo "<p><strong>Date of Birth: </strong> " . $death . "</p>";
			echo "<p><strong>Age of Death: </strong> " . $age . "</p>";
      echo "<p><strong>Name(s) of Parent(s) or Spouse: </strong> " . $spouse . "</p>";
			echo "<p><strong>Contact Person: </strong> " . $name_of_kin . "</p>";
			echo "<p><strong>Relationship to Deceased: </strong> " . $relationship_to_deceased . "</p>";
			echo "<p><strong>Contact Number: </strong> " . $number . "</p>";
      echo "<p><strong>Date of Funeral Mass: </strong> " . $mass . "</p>";
		}
	?>
        </div>
      </div> 
      </div>
      <button> <a href = "Funeral.html" type="submit" onclick="closePopup()"> Done </a></button>
    </div>

    <!--
    <div class="popup" id="popup">
      <img src="Image/icon.png">
      <h1>NOTE:</h1>
      <p>Your appointment is for Validation!<br> Kindly submit all the requirements in the office <br> You can see the office Hours in Home section</p>
      <div class="recipt">
      <?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $birth = date('Y-m-d', strtotime($_POST['birth'])); // convert date format to yyyy-mm-dd
      $death = date('Y-m-d', strtotime($_POST['death']));
      $age = $_POST['age'];
      $spouse = $_POST['spouse'];
      $name_of_kin = $_POST['name_of_kin'];
      $relationship_to_deceased = $_POST['relationship_to_deceased'];
      $number = $_POST['number'];
      $mass = date('Y-m-d', strtotime($_POST['mass'])); // convert date format to yyyy-mm-dd

      echo "<br> <br>";
      echo "<p><strong>REQUIREMENTS </strong></p>";
      echo "<br>";
      echo "<p><strong>*Death Certificate</strong></p>";

      echo "<br> <br>";
			echo "<p><strong>Firstname: </strong> " . $firstname . "</p>";
      echo "<p><strong>Lastname: </strong> " . $lastname . "</p>";
			echo "<p><strong>Date of Birth: </strong> " . $birth . "</p>";
			echo "<p><strong>Date of Birth: </strong> " . $death . "</p>";
			echo "<p><strong>Age of Death: </strong> " . $age . "</p>";
      echo "<p><strong>Name(s) of Parent(s) or Spouse: </strong> " . $spouse . "</p>";
			echo "<p><strong>Contact Person: </strong> " . $name_of_kin . "</p>";
			echo "<p><strong>Relationship to Deceased: </strong> " . $relationship_to_deceased . "</p>";
			echo "<p><strong>Contact Number: </strong> " . $number . "</p>";
      echo "<p><strong>Date of Funeral Mass: </strong> " . $mass . "</p>";
		}
	?>
      </div>
      <button> <a href = "Funeral.html" type="submit" onclick="closePopup()"> Done </a></button>
    </div>
  </div>


<--JAVA SCRIPT-->

<script>
    let popup = document.getElementById("popup");

    function openPopup(){
      popup.classList.add("open-popup");
    }
    function closePopup(){
      popup.classList.remove("open-popup");
    }
  </script>