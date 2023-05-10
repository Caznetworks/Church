<?php
session_start();

@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the name and new password are submitted
    if (isset($_POST['Username']) && isset($_POST['new_password'])) {
        $Username = $_POST['Username'];
        $newPassword = $_POST['new_password'];

        // Validate the name and perform necessary checks
        // ...

        // Validate the new password
        $errors = [];
        if (strlen($newPassword) < 8) {
            $errors[] = "Password must be at least 8 characters long.";
        }
        if (!preg_match('/[A-Z]/', $newPassword)) {
            $errors[] = "Password must contain at least one uppercase letter.";
        }
        if (!preg_match('/\d/', $newPassword)) {
            $errors[] = "Password must contain at least one number.";
        }
        if (!preg_match('/[^A-Za-z\d]/', $newPassword)) {
            $errors[] = "Password must contain at least one special character.";
        }

        if (count($errors) === 0) {
            // Update the user's password in the database with the new encrypted password
            $conn = new mysqli('localhost', 'root', '', 'db_church');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Encrypt the password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Prepare and execute the update statement
            $stmt = $conn->prepare("UPDATE tbl_user SET Password = ? WHERE Username = ?");
            $stmt->bind_param("ss", $hashedPassword, $Username);
            $stmt->execute();

            // Check if the update was successful
            if ($stmt->affected_rows > 0) {
                $_SESSION['password_reset_success'] = true;
                header('Location: login_form.php');
                exit();
            } else {
                echo 'Failed to update password. Please check your name and try again.';
            }

            $stmt->close();
            $conn->close();
        } else {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>FORGOT PASSWORD</title>
    <link rel="stylesheet" href="LOGIN.css">
</head>
<body>
  <div class="form-container">
    <form action="" method="post">
      <section>
        <div class="signin">
          <div class="content">
            <h2>FORGET PASSWORD</h2>
            <div class="form">
              <div class="inputBx">
                <input type="text" name="Username" required>
                <i>Username</i>
              </div>
              <div class="inputBx">
                <input type="password" name="new_password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z\d]).{8,}" title="Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.">
                <i>New Password</i>
              </div>
              <div>
                <div class="inputBx">
                <input type="submit" name="submit" value="RESET PASSWORD" class="form-btn">
              </div>
                
</form>

</div>
</body>
</html>
