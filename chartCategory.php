<?php
//Connect to database
include('includes/database.php');
// <!-- This file contains code that will fetch data that will be displayed inside bar chart
// When user chooses Summary by CATEGORY -->
//log out if session doesn't contain any user_id
if (strlen($_SESSION['userid']==0)) {
  header('location:logout.php');
  }else {
    ?>
    <?php 
      //As used clicks on submit in Category Modal
      if(isset($_POST['display'])){
        // create session that stores the values for category
        $_SESSION['category'] = $_POST['category'];
      }
      $category = $_SESSION['category'];
      $userid = $_SESSION['userid'];
      $fromdate = $_SESSION['fromdate'];
      $todate = $_SESSION['todate']; 
      //fetch data to be displayed, grouping total amount by transaction date
      $query1 = sprintf("select transaction_date, sum(amount) as totalamount from income_expenditure 
        WHERE category = '$category' AND user_id = '$userid' 
        AND (transaction_date BETWEEN '$fromdate' AND '$todate') group by transaction_date");
      $result=mysqli_query($conn, $query1);
      //create array that will be used to store the data fetched (associative array)
      $data = array();
      foreach ($result as $row){
        $data[] = array(
          'transaction_date'		=>	date("d-M-y", strtotime($row["transaction_date"])),
          'totalamount'			=>	$row["totalamount"],
          'color'			=>	'#' . rand(100000, 999999) . '' //random colours for the bars
        );
      }
    print json_encode($data); //use json_encode to encode data inside the associative array 
    ?>
<?php mysqli_close($conn); } ?>