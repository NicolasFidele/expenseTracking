<!-- This page is called when user wants to edit an existing record -->
<?php 
//connect to database
include('includes/database.php'); 
if (strlen($_SESSION['userid']==0)) { //if session is empty, log out
	header('location:logout.php');
	//store data from GET method into variables
	} else{
		$id = trim($_GET['id']);
		$item = trim($_GET['item']);
		$amount = trim($_GET['amount']);
	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Records</title>
	<!-- Bootstrap link for CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
			integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
			crossorigin="anonymous">
	<!-- CSS link -->
	<link rel="stylesheet" type = "text/CSS" href="css/site.css">
</head>
<body>
<?php 
	//Include header to display navigation bar
	require_once 'includes/header.html';
?>
<div class="row justify-content-center mt-5">
	<div class="col-11 col-lg-5 col-xl-4 mb-3"> 
		<div class="card border-0" id="updateRecord"> 
			<div class="card-body text-center" id="updateRecord">
								<!-- Form to edit record - Already contains actual records -->
				<form onsubmit="return editRecords()" action="" method="POST">
					<h3 id="h3-update" class="justify-content-center tw-light">
					Update Record
					</h3>
					<input type="text" class="form-control" id="item" name="item" value= "<?php echo "$item"?>">
					<input type="text" class="form-control my-4" id="amount" name="amount" value= "<?php echo "$amount"?>">
					<div class="form-group my-4">
						<select class="form-select mb-2" id="category1" name="category" aria-label="Default select example">
							<optgroup label="Expenses"> 
							<option value='0'>Choose an option</option>
							<option value="groceries">Groceries</option>
							<option value="bills">Bills</option>
							<option value="transport">Transport</option>
							<option value="clothing">Clothing</option>
							<option value="restaurant">Restaurant</option>
							<option value="loan">Loan</option>
							<option value="other">other</option>
							<optgroup label="Income">
							<option value="salary">Salary</option>
							<option value="bonus">Bonus</option>
							<option value="lottery">Lottery</option>
							<option value="interests">Interests</option>
							<option value="other">Other</option>
						</select>
					</div>
					<div class=div class="text-center">
						<button type="submit" name="update" class="btn btn-success btn-md mx-3" 
							id="btn-update">Update Record</button>
							<button type="button" name="cancel" class="btn btn-danger btn-md mx-3" 
							id="btn-cancel"  onclick="return goback()">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php  
	//Store new record into variables
	if (isset($_POST['update'])) {
		$item = $_POST['item'];
		$amount = $_POST['amount'];
		$category = $_POST['category'];
		//update record in database
		$query = "UPDATE income_expenditure SET item_name = '$item', amount = '$amount', category = '$category'
		WHERE id='$id' ";
		//run query
		mysqli_query($conn, $query);
		mysqli_close($conn); //close connection
		echo '<script>alert("Record Updated.")</script>'; 
?>
<!-- Return to previous page -->
<script>window.location.replace("dashboard.php");</script>
<?php } ?>
<!-- links for Jquery, Chartjs and JS file -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js"></script>
<script src="js/validation.js"></script>
<!-- bootstrap link for JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
<?php mysqli_close($conn); } ?>