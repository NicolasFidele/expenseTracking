<!-- Home page when user logs in
Displays two graphs containing expenses and income for the ACTUAL month
Displays two forms to enter NEW EXPENSES and NEW INCOME -->
<?php
//Connect to database
include('includes/database.php');
// log out if session is empty - so that no one can access site when clicking on dashboard link
if (strlen($_SESSION['userid']==0)) {
  header('location:logout.php');
  } else{
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
	<!-- Bootstrap link for CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    	integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- CSS link -->
    <link rel="stylesheet" type = "text/CSS" href="css/site.css">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php  require_once 'includes/header.html';  ?>
<!-- Intro message to be displayed as user logs in - contains user's name -->
<div class="container-fluid">
	<div class="row justify-content-center align-items-center">
		<div class="col-md-5 text-center">
			<div class="display-6" id="display-title">Welcome</div>
				<h2><i class="fa fa-user"></i></h2>
			<div class="display-6 text-muted" id="display-title1">
				<?php
					$userid = $_SESSION['userid'];
					//query name from database according to user id
					$query = "SELECT name FROM users where user_id='$userid' LIMIT 1";
					$run=mysqli_query($conn, $query); //run query
					//return result
					$result = mysqli_fetch_array($run);
					//store username into variable
					$name = $result['name'];
					echo $name;
				?>
			</div>
		</div>
	</div>
	<!-- Display Expenses chart for actual month -->
	<div class="row justify-content-center">
			<div class="col-11 col-lg-5 col-xl-4 my-1"> 
				<div class="doughnutChart mb-2 justify-content-center">	
						<canvas id="indexCanvas" style="height: 75px; width:100px"></canvas>
					<div class="text-danger text-center mt-1">
						<?php  
							$month = date("m"); //Variable that will keep actual month only
							//fetch data for actual month
							$queryTotal = ("select sum(amount) as totalamount from income_expenditure 
							WHERE user_id='$userid' 
							AND transaction_type='expenses' 
							AND MONTH(transaction_date) = '$month'");
							$runTotal=mysqli_query($conn, $queryTotal);
							while ($row=mysqli_fetch_array($runTotal)) {
								echo 'Total Expenses : Rs '.'<b>'.$total=$row['totalamount'].'</b>'.'.'; 
						}?>
						<br>
						<!-- this button will open a modal window containing tabular details of actual month expenses -->
						<button type="button" class="btn btn-primary my-1" data-bs-toggle="modal" 
						data-bs-target="#viewExpenses">View Details</button>
					</div>
				</div> 
			</div>
		<!-- Display Income chart for actual month -->
		<div class="col-11 col-lg-5 col-xl-4 my-1"> 
			<div class="doughnutChart mb-2 justify-content-center">
				<canvas id="indexCanvas2" style="height: 75px; width:100px"></canvas>
				<div class="text-primary text-center mt-1">
					<?php  
						$month = date("m");
						// fetch total for the month
						$queryTotal = ("select sum(amount) as totalamount from income_expenditure 
						WHERE user_id='$userid' 
						AND transaction_type='income' 
						AND MONTH(transaction_date) = '$month'");
						$runTotal=mysqli_query($conn, $queryTotal);
						while ($row=mysqli_fetch_array($runTotal)) {
							echo 'Total Income : Rs '.'<b>'.$total=$row['totalamount'].'</b>'.'.'; 
					}?>  
					<br>     
					<!-- this button will open a modal window containing tabular details of actual month income -->        
					<button id="btn-1" type="button" class="btn btn-primary my-1" data-bs-toggle="modal" 
					data-bs-target="#viewIncome">View Details</button>
				</div>
				</div>				
		</div>
	</div>
	<!-- MODAL to view EXPENSES for the month in a table-->
	<div class="modal fade" id="viewExpenses" tabindex="-1" role="dialog" aria-label="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Actual Month Expenses</h5>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<table class="table table-bordered">
					<thead class="bg-primary">
						<tr>
						<th>#</th>
						<th>Date</th>
						<th>Item</th>
						<th>Category</th> 
						<th>Amount</th>                
						</tr>
					</thead>
					<?php
						$userid = $_SESSION['userid']; //store session content to variable userid
						$type = 'expenses';
						$month = date("m");
						//fetch data(expenses) for the current month
						$query = ("select * from income_expenditure where user_id='$userid' 
						AND transaction_type='$type' AND MONTH(transaction_date) = '$month' ");
						$run=mysqli_query($conn, $query);
						$count=1; //variable used as index in table, incremented at each added record
						while ($row=mysqli_fetch_array($run)) { 
					?>
							<tbody>
								<!-- change date format to be displayed as dd/mmm/yy -->
								<?php  
									$date = $row['transaction_date']; 
									$newdate = date("d-M-y", strtotime($date));
								?>
								<!-- fetch data from database table and display inside web page table -->
								<tr>
									<td><?php echo $count;?></td>
									<td><?php  echo $newdate;?></td>
									<td><?php  echo $row['item_name'];?></td>
									<td><?php  echo $row['category'];?></td>
									<td><?php  echo "Rs ".$row['amount'];?></td>
								</tr>
								<?php 
									//increment count variable
									$count=$count+1;
								}?>
							</tbody>
				</table>
				<!-- Display total expenses for the month -->
				<div class="text-muted text-center">
					<?php  
						//fetch total for the month
						$queryTotal = ("select sum(amount) as totalamount from income_expenditure 
						WHERE user_id='$userid' 
						AND transaction_type='expenses' 
						AND MONTH(transaction_date) = '$month'");
						$runTotal=mysqli_query($conn, $queryTotal);
						while ($row=mysqli_fetch_array($runTotal)) {
							echo 'Total Expenses : Rs '.'<b>'.$total=$row['totalamount'].'</b>'.'.'; 
					}?>  
				</div>
			</div>
		</div>
	</div>  
	<!-- MODAL to view INCOME for the month in a table-->
	<div class="modal fade" id="viewIncome" tabindex="-1" role="dialog" aria-label="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Actual Month Income</h5>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<table class="table">
				<thead class="bg-success">
					<tr>
						<th>#</th>
						<th>Date</th>
						<th>Item</th>
						<th>Category</th>
						<th>Amount</th>                
					</tr>
				</thead>
				<?php
					$userid = $_SESSION['userid']; //store session content to variable userid
					$type = 'income';
					$month = date("m");
					//fetch data (income) for current month
					$query = ("select * from income_expenditure where user_id='$userid' 
					AND transaction_type='$type' AND MONTH(transaction_date) = '$month' ");
					$run=mysqli_query($conn, $query);
					$count=1; //count variable incremented at each added record
					while ($row=mysqli_fetch_array($run)) {
				?>
				<tbody>
					<!-- change date format to be displayed as dd/mmm/yy -->
					<?php  
						$date = $row['transaction_date']; 
						$newdate = date("d-M-y", strtotime($date));
					?>
					<!-- fetch data from database table and display inside web page table -->
					<tr>
						<td><?php echo $count;?></td>
						<td><?php  echo $newdate;?></td>
						<td><?php  echo $row['item_name'];?></td>
						<td><?php  echo $row['category'];?></td>
						<td><?php  echo "Rs ".$row['amount'];?></td>
					</tr>
					<?php 
						$count=$count+1; //increment count variable
					}?>
				</tbody>
				</table>
				<!-- display total income for actual month -->
				<div class="text-muted text-center">
					<?php  
						$queryTotal = ("select sum(amount) as totalamount from income_expenditure 
						WHERE user_id='$userid' 
						AND transaction_type='income' 
						AND MONTH(transaction_date) = '$month'");
						$runTotal=mysqli_query($conn, $queryTotal);
						while ($row=mysqli_fetch_array($runTotal)) {
							echo 'Total Income : Rs '.'<b>'.$total=$row['totalamount'].'</b>'.'.'; 
					}?>  
				</div>
			</div>
		</div>
	</div>  
	<!-- 
		The following shows the two forms that will be displayed so that the user 
		can add new expenses and income.
	-->
	<div class="row justify-content-center" id="income-expenditure">
		<div class="col-11 col-lg-5 col-xl-4 mb-3"> 
			<h3>
				New Expenses
			</h3>
			<!-- Bootstrap card to contain element of the form -->
			<div class="card border-0">
				<div class="card-body text-center">
					<!-- call function dashboard to display errors if fields left empty 
					ADD EXPENSES-->
					<form onsubmit="return dashboard()" id="add_exp" action="#" method="POST">
						<input type="text" class="form-control" id="expenseName" name="name" placeholder="Item Name">
						<input type="text" class="form-control mb-4" id="expenseAmount" name="amount" placeholder="Enter Amount">	
						<!-- radio buttons to choose the category -->
						<div class="form-check mb-2">
							<p>Category:
							<input type="radio" class="btn-check mt-5" name="options" value="groceries" id="option1">
							<label class="btn btn-outline-success" for="option1" style="color:#FFF;">groceries</label>

							<input type="radio" class="btn-check" name="options" value="bills" id="option2">
							<label class="btn btn-outline-success" for="option2" style="color:#FFF;">bills</label>

							<input type="radio" class="btn-check" name="options" value="transport" id="option3">
							<label class="btn btn-outline-success" for="option3" style="color:#FFF;">transport</label><br><br>

							<input type="radio" class="btn-check" name="options" value="clothing" id="option4">
							<label class="btn btn-outline-success mb-2" for="option4" style="color:#FFF;">clothing</label>

							<input type="radio" class="btn-check" name="options" value="restaurant" id="option5">
							<label class="btn btn-outline-success mb-2" for="option5" style="color:#FFF;">restaurant</label>

							<input type="radio" class="btn-check" name="options" value="loan" id="option6">
							<label class="btn btn-outline-success mb-2" for="option6" style="color:#FFF;">loan</label>

							<input type="radio" class="btn-check" name="options" value="other_exp" id="option7">
							<label class="btn btn-outline-success mb-2" for="option7" style="color:#FFF;">other</label></p>
						</div>
						<div class="mb-3 d-grid gap-2">
							<button type="submit" name="add_expenses" class="btn btn-primary">Add Expenses</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- ADD INCOME-->
		<div class="col-11 col-lg-5 col-xl-4 mb-3"> 
			<h3>
				New Income
			</h3>
			<div class="card border-0">
				<div class="card-body text-center">
					<!-- call function dashboard to display errors if fields left empty  -->
					<form  onsubmit="return dashboard1()" id="add_income" action="#" method="POST">
						<input type="text" class="form-control" id="incomeName" name="name" placeholder="Item Name">
						<input type="text" class="form-control mb-4" id="incomeAmount" name="amount" placeholder="Enter Amount">

						<div class="form-check mb-2">
							<p>Category:
							<input type="radio" class="btn-check mt-5" name="options1" value="salary" id="option8">
							<label class="btn btn-outline-success" for="option8" style="color:#FFF;">salary</label>

							<input type="radio" class="btn-check" name="options1" value="bonus" id="option9">
							<label class="btn btn-outline-success" for="option9" style="color:#FFF;">bonus</label>

							<input type="radio" class="btn-check" name="options1" value="lottery" id="option10">
							<label class="btn btn-outline-success" for="option10" style="color:#FFF;">lottery</label><br><br>

							<input type="radio" class="btn-check" name="options1" value="interests" id="option11">
							<label class="btn btn-outline-success mb-2" for="option11" style="color:#FFF;">interests</label>

							<input type="radio" class="btn-check" name="options1" value="other_inc" id="option12">
							<label class="btn btn-outline-success mb-2" for="option12" style="color:#FFF;">other</label>
						</div>
						<div class="mb-3 d-grid gap-2">
							<button type="submit" name="add_income" class="btn btn-primary">Add Income</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- PHP code to add records to the database-->
<?php  
	//as user clicks on submit button for Expenses form, store data in following variables
    if (isset($_POST['add_expenses'])) {
		$userid = $_SESSION['userid'];
		$name = trim($_POST['name']);
		$amount = trim($_POST['amount']);
		$category = trim($_POST['options']);
		$type = trim('expenses');
		$date = date('y-m-d');
		//add data to database
        $query = "INSERT INTO income_expenditure (user_id, item_name, amount, category, transaction_type, transaction_date) 
		VALUES ('$userid', '$name', '$amount', '$category', '$type', '$date')";
		//run query
        mysqli_query($conn, $query);
		$last_id = mysqli_insert_id($conn); //retrieve ID of last transaction from income_expenditure table
		//add user_id and transaction_id to transactions table
		$query2 = "INSERT INTO `transactions` (`user_id`, `transaction_id`) VALUES ('$userid', '$last_id');";
		mysqli_query($conn, $query2);
        mysqli_close($conn); //close connection
?>
	<!-- Display recently added record in alert message -->
	<script type="text/javascript">
		var itemname ="<?php echo $name ?>";
		var amount = "<?php echo $amount ?>";
		var category = "<?php echo $category ?>"; 
		var date = "<?php echo date("d-M-y", strtotime($date))?>"; 
		alert("NEW EXPENSE ADDED.\n"+ "\nItem: "+itemname+"\nAmount: Rs"+amount+"\nCategory: "+category+"\nDate: "+date);
		window.location.replace("dashboard.php");
	</script>
<?php }
		//as user clicks on submit button for Income form, store data in following variables
		if (isset($_POST['add_income'])) {
			$userid = $_SESSION['userid'];
			$name = trim($_POST['name']);
			$amount = trim($_POST['amount']);
			$category = trim($_POST['options1']);
			$type = trim('income');
			$date = date('y-m-d');
			//add data to database
			$query = "INSERT INTO income_expenditure (user_id, item_name, amount, category, transaction_type, transaction_date) 
			VALUES ('$userid', '$name', '$amount', '$category', '$type', '$date')";
			//run query
			mysqli_query($conn, $query);
			$last_id = mysqli_insert_id($conn);
			$query2 = "INSERT INTO `transactions` (`user_id`, `transaction_id`) VALUES ('$userid', '$last_id');";
			mysqli_query($conn, $query2);
			mysqli_close($conn); //close connection
	?>
		<!-- Display recently added record in alert message -->
		<script type="text/javascript">
			var itemname ="<?php echo $name ?>";
			var amount = "<?php echo $amount ?>";
			var category = "<?php echo $category ?>"; 
			var date = "<?php echo date("d-M-y", strtotime($date))?>"; 
			alert("NEW INCOME ADDED.\n"+ "\nItem: "+itemname+"\nAmount: Rs"+amount+"\nCategory: "+category+"\nDate: "+date);
			window.location.replace("dashboard.php");
		</script>
	<?php } ?>
<!-- links for Jquery, Chartjs and JS file -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0-rc.1/chartjs-plugin-datalabels.min.js" 
integrity="sha512-+UYTD5L/bU1sgAfWA0ELK5RlQ811q8wZIocqI7+K0Lhh8yVdIoAMEs96wJAIbgFvzynPm36ZCXtkydxu1cs27w==" 
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/validation.js"></script>
<script src="js/charts.js"></script>
<!-- bootstrap link for JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
<?php mysqli_close($conn); } ?>


