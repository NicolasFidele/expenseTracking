<?php
include('includes/database.php');
if (strlen($_SESSION['userid']==0)) {
  header('location:logout.php');
  } else {
		?>
		<?php 
		//   <!-- This file contains code that will fetch data(Expenses) that will be displayed inside pie chart
		//   on the summary by month (expenses) page.
			
		//   Comments on content of the code found in chartCategory.php-->
			if(isset($_POST['display'])){
				// create session that stores the values entered
				$_SESSION['month'] = $_POST['month'];
			}
			$userid = $_SESSION['userid'];
			$month = $_SESSION['month'];
			$year = date("Y");
			//fetch data and group total amount by category
			$query = sprintf("select category as category, sum(amount) as totalamount from income_expenditure 
			WHERE user_id='$userid' 
			AND transaction_type='expenses' 
			AND MONTH(transaction_date) = '$month' 
			AND YEAR(transaction_date) = '$year'
			GROUP BY category");
			$result=mysqli_query($conn, $query);
			$data = array();
			foreach ($result as $row){
			$data[] = array(
				'category'	=>	$row["category"],
				'totalamount'	=>	$row["totalamount"],
				'color'		=>	'#' . rand(100000, 999999) . ''
			);
			}
			print json_encode($data);
		?>
<?php mysqli_close($conn); } ?>