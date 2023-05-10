<?php
session_start();

@include 'config.php';

if (isset($_POST['submit'])) {
    $Username = isset($_POST['Username']) ? mysqli_real_escape_string($conn, $_POST['Username']) : '';
    $Password = isset($_POST['Password']) ? $_POST['Password'] : '';

    if (empty($Username) || empty($Password)) {
        $error[] = 'Please fill all fields!';
    } else {
        // Retrieve user from the database based on the provided username
        $select = "SELECT * FROM tbl_user WHERE Username = '$Username'";
        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $hashedPassword = $row['Password'];

            // Verify the provided password with the hashed password from the database
            if (password_verify($Password, $hashedPassword)) {
                if ($row['UserType'] == 'Admin') {
                    $_SESSION['AdminName'] = $row['Name'];
                    header('location:admin1.php');
                    exit();
                } elseif ($row['UserType'] == 'User') {
                    $_SESSION['UserName'] = $row['Name'];
                    header('location:user.php');
                    exit();
                }
            } else {
                $error[] = 'Incorrect Password!';
            }
        } else {
            $error[] = 'Incorrect Username!';
        }
    }
}
if (isset($_SESSION['password_reset_success']) && $_SESSION['password_reset_success'] === true) {

    unset($_SESSION['password_reset_success']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="LOGIN.css">
    <title>LOGIN FORM</title>
   
    <!-- custom css file link -->
    <link rel="stylesheet" href="LOGIN.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <section>
                <div class="signin">
                    <div class="content">
                        <h2>Sign In</h2>
                        <div class="form">
                            <div class="inputBx">
                                <input type="text" name="Username" required>
                                <i>Username</i>
                            </div>
                            <div class="inputBx">
                                <input type="password" name="Password" id="password" required>
                                <i>Password</i>
                            </div>
                            <div class="links">
                                <p><a href="forgetpass.php">Forgot Password</a></p>
                                <p><a href="register_form.php">Sign Up</a></p>
                            </div>
                            <div class="inputBx">
                                <input type="submit" name="submit" value="LOGIN" class="form-btn">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
</body>
</html>
``
