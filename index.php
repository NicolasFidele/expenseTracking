<!-- Login Page  -->
<!-- verify credentials in database before logging user -->
<?php 
//connect to database
require_once('includes/database.php');
if(isset($_POST['submit'])){
	//get values input by user and store into username and password variables
	//sanitise email and password input
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$pwd = md5($password); //encrypt password
	//read username and password and query into database
	$query = "SELECT user_id FROM users where email='$email' AND password='$pwd' LIMIT 1";
	$run=mysqli_query($conn, $query); //run query
	//return result
	$result = mysqli_fetch_array($run);
	if(mysqli_num_rows($run)==1){ // if values entered match a record in database
		$_SESSION['userid'] = $result['user_id']; //store user id into session to be used in dashboard.php
		header('location: dashboard.php?success=logged'); //load index.php with success message in url
	} else { //if wrong user name or password, message pop up and reload login page
		echo '<script>alert("Wrong email or password!\nPlease try again.")</script>';?>
		<script>window.location.replace("index.php");</script>
		<?php
	} 
} 
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<!-- boostrap link for css -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
			integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- CSS -->
	<link rel="stylesheet" type = "text/CSS" href="css/site.css">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<!-- container will have all elements of the login form -->
<div class="container-sm text-center">
	<div class="text-center">
		<!-- put logo of the app and heading-->
		<img class="mt-4 mb-4" src="images/piggy.jpg" height="80" alt="site logo">
		<h1>OU Expense Tracker</h1>
		<h2>Log In</h2>
	</div>
		<!-- size of form will vary upon size of browser/device -->
	<div class="row justify-content-center text-center my-3">
		<div class="col-lg-6"> 
			<!-- call function reg_validate to cater for empty fields -->
			<form onsubmit="return reg_validate()" id="signin" action="#" method="POST">
				<label id="mylabel" for="email">Email</label>
				<input type="email" class="form-control mb-3" id="email" name="email" 
				placeholder="&#xf0e0; Enter your Email address" style="font-family:Arial, FontAwesome" autofocus>
				<label id="mylabel1" for="password">Password</label>
				<input type="password" class="form-control mb-4" id="password1" name="password" 
				placeholder="&#xf023; Enter your password" style="font-family:Arial, FontAwesome">	
				<div class="mb-3 d-grid gap-2">
					<button type="submit" name="submit" id="login-btn" class="btn btn-primary">Sign In</button>
				</div>
				<div class="mb-3 text-center">
					<p id="p-index"><b>No Account?</b></p>
					<a href="register.php" class="btn btn-md btn-success" id="login-btn1">Register</a>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- link for JS -->
<script src="js/validation.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- bootstrap link for JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>