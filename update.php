<?php 
session_start();
include 'config.php';

// Redirect to login page if not logged in
if(!isset($_SESSION['AdminName'])){
    header('location:adminbaptism.php');
}

// Check if the id parameter is set in the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'db_church');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

// update baptism record
$id = $_POST['id'];
$candidate = $_POST['candidate'];
$birth = $_POST['birth'];
$place = $_POST['place'];
$father = $_POST['father'];
$mother = $_POST['mother'];
$address = $_POST['address'];
$godmother = $_POST['godmother'];
$godfather = $_POST['godfather'];
$baptism = $_POST['baptism'];

$sql = "UPDATE baptism SET 
        Candidate='$candidate',
        Birth='$birth',
        Place='$place',
        Father='$father',
        Mother='$mother',
        Address='$address',
        Godmother='$godmother',
        Godfather='$godfather',
        Baptism='$baptism'
        WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    echo "Baptism record updated successfully";
} else {
    echo "Error updating baptism record: " . mysqli_error($conn);
}

mysqli_close($conn);

// redirect to adminbaptism.php
header("Location: adminbaptism.php");
exit;
}
?>