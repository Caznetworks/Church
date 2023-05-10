<?php
@include 'config.php';

if (isset($_POST['submit'])) {
    $Name = isset($_POST['Name']) ? mysqli_real_escape_string($conn, $_POST['Name']) : '';
    $Username = isset($_POST['Username']) ? mysqli_real_escape_string($conn, $_POST['Username']) : '';
    $Password = isset($_POST['Password']) ? $_POST['Password'] : '';
    $CPassword = isset($_POST['CPassword']) ? $_POST['CPassword'] : '';
    $UserType = isset($_POST['UserType']) ? mysqli_real_escape_string($conn, $_POST['UserType']) : '';

    if (empty($Name) || empty($Username) || empty($Password) || empty($CPassword) || empty($UserType)) {
        $error[] = 'Please fill all fields!';
    } else {
        // Password requirements
        $errors = array();

        if (strlen($Password) < 8) {
            $errors[] = 'Password must be at least 8 characters long.';
        }

        if (!preg_match('/[A-Z]/', $Password)) {
            $errors[] = 'Password must contain at least one uppercase letter.';
        }

        if (!preg_match('/[a-z]/', $Password)) {
            $errors[] = 'Password must contain at least one lowercase letter.';
        }

        if (!preg_match('/\d/', $Password)) {
            $errors[] = 'Password must contain at least one number.';
        }

        if (!preg_match('/[^A-Za-z\d]/', $Password)) {
            $errors[] = 'Password must contain at least one special character.';
        }

        if ($Password != $CPassword) {
            $errors[] = 'Password Not Matched!';
        }

        if (count($errors) === 0) {
            $select = "SELECT * FROM tbl_user WHERE Username = '$Username'";
            $result = mysqli_query($conn, $select);

            if (mysqli_num_rows($result) > 0) {
                $errors[] = 'User Already Exists!';
            } else {
                // Encrypt the password
                $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

                $insert = "INSERT INTO tbl_user(Name,Username, Password, UserType) VALUES ('$Name', '$Username', '$hashedPassword', '$UserType')";
                mysqli_query($conn, $insert);
                header('location: login_form.php');
                exit();
            }
        }

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo '<span class="error-msg">' . $error . '</span>';
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
    <title>REGISTER FORM</title>

    <!-- custom css file link -->
    <link rel="stylesheet" href="LOGIN.css">

</head>

<body>
	<div class="form-container">
		<form action="" method="post">
			<section>
				<div class="signin">
					<div class="content">
						<h2>SIGN UP</h2>
						<div class="form">
							<div class="inputBx">
            <?php
            if (isset($errors)) {
                foreach ($errors as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
            }
            ?>
            					<input type="text" name="Name" required>
            					<i>Name</i>
							</div>
							<div class="inputBx">
            					<input type="text" name="Username" required>
            					<i>Username</i>
            				</div>
            				<div class="inputBx">
            					<input type="password" name="Password" required>
            					<i>Password</i>
            				</div>
            				<div class="inputBx">
            					<input type="password" name="CPassword" required>
            					<i>Confirm Password</i>
            				</div>
            				<div class="inputBx">
            					<select name="UserType">
                					<option value="Admin">Admin</option>
            					</select>
            				</div>
            				<div class="inputBx">
            					<input type="submit" name="submit" value="Register Now" class="form-btn">
            				</div>	
            				<div class="links">
            					<p>Already Have an Account? <a href="login_form.php">Login Now</a></p>
            				</div>
        </form>
    </div>
</body>
</html>
