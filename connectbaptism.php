<?php
  $Candidate = $_POST['Candidate'];
  $Birth = date('Y-m-d', strtotime($_POST['Birth'])); // convert date format to yyyy-mm-dd
  $Place = $_POST['Place'];
  $Father = $_POST['Father'];
  $Mother = $_POST['Mother'];
  $Address = $_POST['Address'];
  $Godmother = $_POST['Godmother'];
  $Godfather = $_POST['Godfather'];
  $Baptism = date('Y-m-d', strtotime($_POST['Baptism'])); // convert date format to yyyy-mm-dd

  //Database connection

  $conn = new mysqli('localhost', 'root', '', 'db_church');
  if($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
  }else {
      $stmt = $conn->prepare("INSERT INTO tbl_baptism(Candidate, Birth, Place, Father, Mother, Address,  Godmother, Godfather, Baptism) 
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("sssssssss",$Candidate, $Birth, $Place, $Father, $Mother, $Address,  $Godmother, $Godfather, $Baptism);
  // Get the auto-generated ID
      $last_id = $conn->insert_id;
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
      <div class="logo"><a href="#">BAPTIST  APPOINTMENT</a></div>
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
  <div class="pic" id="pic">
    <img src="Image/icon.png">
    </div>
    <div class="popup" id="popup">
      <h1>NOTE:</h1>
      <p>Your appointment is for Validation!<br> Kindly submit all the requirements in the office <br> You can see the office Hours in Home section</p>
      <div class="recipt">
      <form action="connectweddingroom.php" method="post" ></form>
      <div class="wrapper">
        <div class="item">
        <?php
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $Candidate = $_POST['Candidate'];
          $Birth = date('Y-m-d', strtotime($_POST['Birth'])); // convert date format to yyyy-mm-dd
          $Place = $_POST['Place'];
          $Father = $_POST['Father'];
          $Mother = $_POST['Mother'];
          $Address = $_POST['Address'];
          $Godmother = $_POST['Godmother'];
          $Godfather = $_POST['Godfather'];
          $Baptism = date('Y-m-d', strtotime($_POST['Baptism'])); // convert date format to yyyy-mm-dd

          echo "<br> <br>";
          echo "<p><strong>REQUIREMENTS </strong></p>";
          echo "<br>";
          echo "<p><strong>*Submit Completed Baptism Registration Form</strong></p>";
          echo "<br>";
          echo "<p><strong>*Submit a copy of your child’s birth certificate</strong></p>";
          echo "<br>";
          echo "<p><strong>*Submit Godparent Affidavit(s)or Letter(s) of Good Standing</strong></p>";
          echo "<br>";
          echo "<p><strong>*Parents will need to attend an Infant baptism class</strong></p>";
          echo "<br>";
          echo "<p><strong>*Final Step is Parental Meeting with Deacon</strong></p>";

      echo "<br> <br>";
			echo "<p><strong>Name of Candidate: </strong> " . $Candidate . "</p>";
      echo "<p><strong>Date of Birth: </strong> " . $Birth . "</p>";
			echo "<p><strong>Place of Birth: </strong> " . $Place . "</p>";
			echo "<p><strong>Name of Father: </strong> " . $Father. "</p>";
			echo "<p><strong>Name of Mother: </strong> " . $Mother . "</p>";
			echo "<p><strong>Parent's Address: </strong> " . $Address . "</p>";
      echo "<p><strong>Sponsors: </strong> " . $Godmother . "</p>";
			echo "<p><strong>Sponsors: </strong> " . $Godfather . "</p>";
			echo "<p><strong>Date of Baptism: </strong> " . $Baptism . "</p>";
		}	?>
        </div>
      </div> 
      </div>
      <button> <a href = "Baptist.html" type="submit" onclick="closePopup()"> Done </a></button>
    </div>



  
<script
 
src
=
"https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"
>
</script>

	
<script>
  $(document).ready(function() {
			
// When delete button is clicked

			$("input[name='myDelete']").click(function() {
				var id = $(this).attr("id");				
        if(confirm("Are you sure you want to delete this record?")) {
					
// Send a request to delete the record from the database
$.ajax({url: "connectbaptism.php",method: "POST",						
  data: { id: id },						
  success: function(response) {							
if
(response == "success") {	alert("Record deleted successfully");
								
// Redirect to previous page
window.history.back();} 
else
 {alert ("Error deleting record");}}});}});

			
// When update button is clicked
$("input[name='myAdd']").click(function() {
				
// Redirect to previous page
window.history.back();			});		});
	
</script>
</head>
<body>			
<form>
				
<!-- Your input fields here -->

			
			
</form>		
</div>	
</div>


<!-- JAVA SCRIPT-->
<script>
    let popup = document.getElementById("popup");

    function openPopup(){
      popup.classList.add("open-popup");
    }
    function closePopup(){
      popup.classList.remove("open-popup");
    }
  </script>
  <!--script>
    let popup = document.getElementById("popup");

    function openPopup(){
      popup.classList.add("open-popup");
    }
    function closePopup(){
      popup.classList.remove("open-popup");
    }
  </!--script>
      <script>

        //console.log(JSON.parse(localStorage.getItem('myObject')));
        //const Candidate = localStorage.getItem('Candidate');
        //const Birth = localStorage.getItem('Birth');
        //const Place = localStorage.getItem('Place');
        //const Father = localStorage.getItem('Father');
        //const Mother = localStorage.getItem('Mother');
        //const Address = localStorage.getItem('Address');
        //const Godmother = localStorage.getItem('Godmother');
        //const Godfather = localStorage.getItem('Godfather');
        //const Baptism = localStorage.getItem('Baptism');

        //document.getElementById('Candidate').textContent = Candidate;
        //document.getElementById('Birth').textContent = Birth;
        //document.getElementById('Place').textContent = Place;
        //document.getElementById('Father').textContent = Father;
        //document.getElementById('Mother').textContent = Mother;
        //document.getElementById('AdAddress').textContent =Address;
        //document.getElementById('Godmother').textContent = Godmother;
        //document.getElementById('Godfather').textContent = Godfather;
        //document.getElementById('Baptism').textContent = Baptism;
      </script>
      <button type="Button">Done</button>
    </div>
    
  </div>
</body>
</html>

</body>
</html>