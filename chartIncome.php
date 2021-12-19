<?php
include('includes/database.php');
if (strlen($_SESSION['userid']==0)) {
  header('location:logout.php');
  } else{
    ?>
    <?php 
    //   <!-- This file contains code that will fetch data that will be displayed inside doughnut graph
    //   When user chooses Summary by DATE (for Income) 
        
    //   Comments on content of the code found in chartCategory.php-->
			if(isset($_POST['display'])){
				// create session that stores the values entered
				$_SESSION['fromdate'] = $_POST['fromdate'];
				$_SESSION['todate'] = $_POST['todate'];
			}
			$fromdate = $_SESSION['fromdate'];
			$todate = $_SESSION['todate'];
			$userid = $_SESSION['userid'];
			//fetch data and group total amount by category
			$query = sprintf("select category as category, sum(amount) as totalamount from income_expenditure 
			WHERE user_id='$userid' 
			AND transaction_type='income' 
			AND (transaction_date BETWEEN '$fromdate' AND '$todate') GROUP BY category");
			$result=mysqli_query($conn, $query);
			$data = array();
			foreach ($result as $row){
			$data[] = array(
				'category'		=>	$row["category"],
				'totalamount'	=>	$row["totalamount"],
				'color'			=>	'#' . rand(100000, 999999) . ''
			);
			}
			print json_encode($data);
    ?>
<?php mysqli_close($conn); } ?>
