<?php
session_start();
include 'config.php';

if (isset($_POST['submit'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $select = "SELECT * FROM tbl_user WHERE username = '$username'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

            if ($row['UserType'] == 'admin') {
                $_SESSION['admin_name'] = $row['name'];
                header('Location: 456.php');
                exit();
            } else if ($row['UserType'] == 'user') {
                $_SESSION['user_name'] = $row['name'];
                header('Location: user_page.php');
                exit();
            }
        } else {
            $error[] = 'Incorrect email or password!';
        }
    } else {
        $error[] = 'Incorrect email or password!';
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style3.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="username" name="username" required placeholder="Enter your username">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="submit" name="submit" value="LOGIN" class="form-btn">
      <p>Don't have an account? <a href="register_form.php">Register</a></p>
   </form>

</div>

</body>
</html>