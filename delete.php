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

    // Delete the row with the specified id from the database
    $sql = "DELETE FROM tbl_baptism WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    // Close the database connection
    mysqli_close($conn);

    // Redirect to the adminbaptism page with a success message
    if ($result) {
        header("Location: adminbaptism.php?msg=Data deleted successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
} else {
    // Redirect to the adminbaptism page if the id parameter is not set in the URL
    header("Location: adminbaptism.php");
    exit();
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

</head>
<body>