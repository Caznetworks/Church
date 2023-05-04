<?php

SESSION_start();

@include'config.php';

if(isset($_POST['submit'])){
	$Username = isset($_POST['Username']) ? mysqli_real_escape_string($conn, $_POST['Username']) : '';
	$Password = isset($_POST['Password']) ? md5($_POST['Password']) : '';

	if (empty($Username) || empty($Password)) {
		$error[] = 'Please fill all fields!';
	} else {

		$select = "SELECT * FROM tbl_user WHERE Username = '$Username' && Password = '$Password'";

		$result = mysqli_query($conn, $select);

		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_array($result);
			if($row['UserType'] == 'Admin'){
				$_SESSION['AdminName'] = $row['Name'];
				header('location:admin1.php');

			}elseif($row['UserType'] == 'User'){

				$_SESSION['UserName'] = $row['Name'];
				header('location:user.php');
		}
	}else{
		$error[] = 'Incorrect Email or Password!';
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
  	<title>LOGIN FORM</title>
	<?php
		if(isset($error)){
			foreach ($error as $error){
				echo '<span class="error-msg">'.$error.'</span>';
			}; 
		};
	?>
  	<!-- custom css file link -->
  	<link rel="stylesheet" href="admin.css">
</head>
<body>
	<div class="form-container">
		<form action="" method="post">
			<h1> SIGN IN</h1>
			<input type="text" name="Username" required placeholder="Enter Your Username">
			<input type="password" name="Password" id="password" required placeholder="Enter Your Password">
			<input type="submit" name="submit" value="LOGIN" class="form-btn">
			<p>Don't Have an Account? <a href="register_form.php">Register Now</a></p>
		</form>
	</div>



</body>
</html>
