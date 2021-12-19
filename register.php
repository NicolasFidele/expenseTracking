<!--register users to the database -->
<?php 
//connect to database
require_once('includes/database.php');
if (isset($_POST['submit'])) {  //as user clicks on submit
	//Obtain values input by the user in the form and store in the variables
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	//check to see if the email entered in the form does not already exist in the database
	//using sql SELECT statement
	$verify_query = "SELECT email FROM users WHERE email ='$email' LIMIT 1"; //return 1 record only
	//$conn is the variable used in database.php to create connection to the database using mysqli_connect
	$result = mysqli_query($conn, $verify_query);  
	$user = mysqli_fetch_assoc($result);  //return associative array corresponding to the fetched row (email)
	//return error message if email already exists (in the associative array)
	if($user){
		if ($user['email'] === $email) {
			// display message if email already exists
			echo '<script>alert("This email is already associated with another account. Please try again!")</script>';
		}
	} else{
		//Register user into database if no errors are found
		$pwd = md5($password);  //password encrypted before saving into database
		$query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$pwd')";

		mysqli_query($conn, $query);  //run query into database
		//use $_SESSION to store user email
		mysqli_close($conn);
		// display success message
		echo '<script>alert("REGISTRATION SUCCESS. \nUse your email and password to sign in.")</script>';
		?>
		<!-- re-route user to login page -->
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
	<title>Register</title>
	<!-- boostrap link for css -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
	integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- CSS -->
	<link rel="stylesheet" type = "text/CSS" href="css/site.css">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<!-- container will contain all elements of the register form -->
<div class="container-lg text-center">
	<div class="text-center">
		<!-- put logo of the app and heading-->
		<img class="mt-4 mb-4" src="images/piggy.jpg" height="100" alt="site logo">
		<h1>OU &nbsp; Expense Tracker</h1>
		<h2>Create an Account</h2>
	</div>
	<div class="row justify-content-center text-center my-3">
		<!-- size of form will vary upon size of browser/device -->
		<div class="col-lg-6 col-md-6"> 
			<form onsubmit="return reg_validate()" id="form" action="#" method="POST" name="myform">
				<input type="text" class="form-control mb-3" id="name" 
				name="name" placeholder="&#xf007; Enter your full name" style="font-family:Arial, FontAwesome" required autofocus>
				<input type="email" class="form-control mb-3" id="email" name="email" 
				placeholder="&#xf0e0; Enter your Email address" style="font-family:Arial, FontAwesome" required>
				<input type="password" class="form-control mb-3" id="password" name="password" 
				placeholder="&#xf023; Enter your Password" style="font-family:Arial, FontAwesome">
				<input type="password" class="form-control mb-3" id="confirmpassword" name="confirmpassword" 
				placeholder="&#xf023; Confirm password" style="font-family:Arial, FontAwesome">
				<!-- create button for submit  -->
				<div class="mb-3 d-grid gap-2">
					<button type="submit" name="submit" class="btn btn-primary" id="login-btn" >Create Account</button>
				</div>
				<!-- Return to login page -->
				<div class="mb-3 text-center">
					<p>Already have an account?</p>
					<a href="index.php" class="btn btn-md btn-success" id="login-btn1" >Login</a>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- link to JS -->
<script src="js/validation.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- bootstrap link for JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>