<?php
include('includes/database.php');
if (strlen($_SESSION['userid']==0)) {
  header('location:logout.php');
  } else {
		?>
		<?php 
			//  <!-- This file contains code that will fetch data(Income) that will be displayed inside bar chart
			//  on the Home page (dashboard) when user logs in. It displays the data for the actual month.
				
			//  Comments on content of the code found in chartCategory.php-->
			$userid = $_SESSION['userid'];
			$month = date("m");
			//fetch data and group total amount by category
			$query = sprintf("select category as category, sum(amount) as totalamount from income_expenditure 
			WHERE user_id='$userid' 
			AND transaction_type='income' 
			AND MONTH(transaction_date) = '$month' GROUP BY category");
			$result=mysqli_query($conn, $query);
			$data = array();
			foreach ($result as $row){
			$data[] = array(
				'category'		=>	$row["category"],
				'totalamount'	=>	$row["totalamount"],
				'color'	        =>	'#' . rand(100000, 999999) . ''
			);
			}
			print json_encode($data);
		?>
<?php mysqli_close($conn); } ?>