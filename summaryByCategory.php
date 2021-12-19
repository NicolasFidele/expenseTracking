<!-- This page is called from modal when the user clicks on navbar dropdown menu Summary -> By Category -->
<?php
//connect to database
include('includes/database.php');
//log out if session is empty
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
	<title>Summary Report - Category</title>
	<!-- link to Bootstrap file and CSS-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
			integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type = "text/CSS" href="css/site.css">
	<!-- Boostrap icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"> 
</head>
<body>
<?php
	//Include header to display navigation bar
	require_once 'includes/header.html'; 
?>
<?php 
	// User clicks on Submit (name=display)
	if(isset($_POST['display'])){
		// create session that stores the values entered
		// data stored in session so that page is not lost if user clicks on refresh
		$_SESSION['category'] = $_POST['category'];
		$_SESSION['fromdate'] = $_POST['fromdate'];
		$_SESSION['todate'] = $_POST['todate'];
	}
?>
<div class="container-fluid">
	<div class="row justify-content-center mt-5">
		<div class="col-12 col-lg-8 col-xl-6 my-5"> 
				<?php
					//store session data into variables
					$category = $_SESSION['category'];
					$fromdate = $_SESSION['fromdate'];
					$todate = $_SESSION['todate']; 
				?>
				<h5 class="text-center">
						Summary for <?php echo $category?>
				</h5>
				<table class="table table-sm text-center table-bordered">
					<thead class="bg-success">
					<tr>
					<th>#</th>
					<th>Date</th>
					<th>Category</th>
					<th>Item</th>
					<th>Amount</th>
					<th>Delete</th>
					<th>Edit</th>
					</tr>
				</thead>
				<?php 
					// when user clicks on delete, 'delid' is called and the following method runs
					if(isset($_GET['delid'])){
						//return value of $row['id']
						$id=intval($_GET['delid']);
						//query to delete one line containing the income_expenditure ID
						$query=mysqli_query($conn,"delete from income_expenditure where id='$id'");
						if($query){ //delete from transactions table also
							$query2 = mysqli_query($conn,"delete from transactions where transaction_id='$id' AND user_id='$userid'");
							//display message and refresh page
							echo "<script>alert('Delete Successful');</script>";
							echo "<script>window.location.href='summaryByCategory.php'</script>";
						} 
					}?>
				<?php
					//display summary by category - run query to get all details and query2 to get total amount only
					$userid = $_SESSION['userid'];
					$query = ("select * from income_expenditure where category = '$category' AND user_id = '$userid' 
					AND (transaction_date BETWEEN '$fromdate' AND '$todate')");
					$query2 = ("select sum(amount) as totalamount from income_expenditure 
					WHERE (category = '$category' AND user_id = '$userid')  
					AND (transaction_date BETWEEN '$fromdate' AND '$todate')");    
					$run=mysqli_query($conn, $query);
					$run2=mysqli_query($conn, $query2);
					$count=1; //count variable used as index for table content
					while ($row=mysqli_fetch_array($run)) {
				?>
						<tbody>
							<!-- put date format as dd/mmm/yy -->
							<?php  
								$date = $row['transaction_date']; 
								$newdate = date("d-M-y", strtotime($date));
							?>
							<tr>
								<!-- display fetched data in table rows -->
								<td><?php echo $count; ?></td>
								<td><?php  echo $newdate; ?></td>
								<td><?php  echo $row['category']; ?></td>
								<td><?php  echo $row['item_name']; ?></td>
								<td><?php  echo "Rs ".$row['amount']; ?></td>
								<!-- ?delid -> run GET method when clicking on delete  -->
								<td><a href="summaryByCategory.php?delid=<?php echo $row['id'];?>"
										class="text-danger" onclick="return checkdelete()"><i class="bi bi-trash"></i></a>    
								<!-- Link to edit records -->
								<td><a href="editRecords.php?id=<?php echo $row['id'];?>
										&item=<?php echo $row['item_name'];?>
										&amount=<?php echo $row['amount'];?>" 
										class="text-primary"><i class="bi bi-pencil-square"></i></a></td>      
							</tr>
							<?php
								$count=$count+1; //increment count
							}?>
						</tbody>
			</table>
			<div class="text-muted text-center mt-1">
				<?php               
					while ($row=mysqli_fetch_array($run2)) { 
						echo 'Total '.$category.' : Rs '.'<b>'.$sum=$row['totalamount'].'</b>'.'.';
				}?>
			</div>
		</div>
		<!-- Display Chart next to Table -->
		<div class="col-11 col-lg-6 col-xl-5 mt-5">
			<canvas id="mycanvas" style="width:500px;height:300px;"></canvas>
		</div>
	</div>
</div>
<!-- Links to Chartjs, Jquery and JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0-rc.1/chartjs-plugin-datalabels.min.js" 
	integrity="sha512-+UYTD5L/bU1sgAfWA0ELK5RlQ811q8wZIocqI7+K0Lhh8yVdIoAMEs96wJAIbgFvzynPm36ZCXtkydxu1cs27w==" 
	crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/validation.js"></script>
<script src="js/charts.js"></script>
<!-- bootstrap link for JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
	integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
	crossorigin="anonymous"></script>
</body>
</html>
<?php mysqli_close($conn); } ?>