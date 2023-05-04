<?php
@include'config.php';

if(isset($_POST['submit'])){
	$Name = isset($_POST['Name']) ? mysqli_real_escape_string($conn, $_POST['Name']) : '';
	$Username = isset($_POST['Username']) ? mysqli_real_escape_string($conn, $_POST['Username']) : '';
	$Password = isset($_POST['Password']) ? md5($_POST['Password']) : '';
	$CPassword = isset($_POST['CPassword']) ? md5($_POST['CPassword']) : '';
	$UserType = isset($_POST['UserType']) ? mysqli_real_escape_string($conn, $_POST['UserType']) : '';

	if(empty($Name) || empty($Username) || empty($Password) || empty($CPassword) || empty($UserType)) {
		$error[] = 'Please fill all fields!';
	} else {

		$select = "SELECT * FROM tbl_user WHERE Username = '$Username' && Password = '$Password'";

		$result = mysqli_query($conn, $select);

		if(mysqli_num_rows($result) > 0){
			$error[] = 'User Already Exist!';
		} else {
			if($Password != $CPassword){
				$error[] = 'Password Not Matched!';
			} else {
				$insert = "INSERT INTO tbl_user(Name,Username, Password, UserType) VALUES ('$Name', '$Username', '$Password', '$UserType')";
				mysqli_query($conn,$insert);
				header('location:login_form.php');
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
  	<link rel="stylesheet" href="admin.css">

</head>
<body>
	<div class="form-container">
		<form action="" method="post">
			<h1> Register Now </h1>
			<?php
			if(isset($error)){
				foreach ($error as $error){
					echo '<span class="error-msg">'.$error.'</span>';

				}; 
					// code...
				
			};
			?>
			<input type="text" name="Name" required placeholder="Enter Your Name"> 
			<input type="text" name="Username" required placeholder="Enter Your Username">
			<input type="password" name="Password" required placeholder="Enter Your Password">
			<input type="password" name="CPassword" required placeholder="Confirm Your Password">
			<select name="UserType">
				<option value="Admin">Admin</option>
			</select>
			<input type="submit" name="submit" value="Register Now" onclick="window.location.href='login_form.php'" class="form-btn">
			<p>Already Have an Account? <a href="login_form.php">Login Now</a></p>
		</form>
	</div>
</body>
</html>