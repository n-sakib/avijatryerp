<!DOCTYPE html>
<!--[if lt IE 7]>

<html class="lt-ie9 lt-ie8 lt-ie7" lang="en">

<![endif]-->
<!--[if IE 7]>

<html class="lt-ie9 lt-ie8" lang="en">

<![endif]-->
<!--[if IE 8]>

<html class="lt-ie9" lang="en">

<![endif]-->
<!--[if gt IE 8]>
<!-->

<html lang="en">
  
  <!--
<![endif]-->
 
<head>
    <meta charset="utf-8">
    <title>
      খাতার তালিকা | অভিযাত্রী সুজ
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link href="icomoon/style.css" rel="stylesheet">
     <link rel="icon" type="image/ico" href="img/ico/favicon.ico"></link>
    <!--[if lte IE 7]>
    <script src="css/icomoon-font/lte-ie7.js">
    </script>
    <![endif]-->
  <link href="css/main.css" rel="stylesheet"> <!-- Important. For Theming change primary-color variable in main.css  -->
  <link href="css/charts-graphs.css" rel="stylesheet">
  </head>
  <body>
    <header>
      <a href="#" class="logo">
        <img src="img/Regainers_final.jpg" alt="Logo" />
      </a>
      <div class="btn-group">
        <button class="btn btn-primary">
          ইউজার
        </button>
        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
          <span class="caret">
          </span>
        </button>
        <ul class="dropdown-menu pull-right">
          <li>
            <a href="#">
              Edit Profile
            </a>
          </li>
          <li>
            <a href="#">
              Account Settings
            </a>
          </li>
          <li>
            <a href="#">
              Logout
            </a>
          </li>
        </ul>
      </div>
      
    </header>
    <div class="container-fluid">
      <div class="dashboard-container">
        <?php 
          include 'top_nav.php';
          selected('baki_khata');
         ?>
        </div>
        <div class="sub-nav">
          <ul>
            <li>
              <a href="#" class="heading">খাতার তালিকা</a>
            </li>
            <li>
              <a href="baki_khata.php">
                বাকি খাতা
              </a>
            </li>
            <li>
              <a href="mohajon_khata.php">
                মহাজন খাতা
              </a>
            </li>
            <li>
              <a href="bikri_khata.php">
                বিক্রি খাতা
              </a>
            </li>
            <li>
              <a href="staff_khata.php">
                স্টাফ খাতা
              </a>
            </li>
            <li>
              <a href="bank_khata.php">
                ব্যাংক খাতা
              </a>
            </li>
            <li>
              <a href="expense_khata.php">
                খরচ খাতা
              </a>
            </li>
          </ul>
        </div> 
        <div class="dashboard-wrapper">
          <div class="left-sidebar">
            
            
            <div class="row-fluid">
              <div class="span12">
                <div class="row-fluid">
                  <div class="span12">
                    <div class="widget">
                      <div class="widget-header">
                        <?php 
                          $day = $_POST['day'];
                          $month = $_POST['month'];
                          $year = $_POST['year'];
                          $date = "$day-$month-$year";
                         ?>
                      	<div class="title">
                          বিক্রি খাতা
                      
                        </div>
                        <span class="mini-title pull-right">
                          <?php echo $date; ?>
                        </span>
                      </div>
                      <div class="widget-body">
                        <div class="row-fluid">
                          
                          <table class="table table-bordered new_table table-striped">
						<tr>
							<th>খাত</th>
              <th>বাবদ</th>
              <th>টাকার পরিমাণ</th>
						</tr>
						 <!-- echo todays transaction -->
						 <?php
						 	require "conn.php";
              $day = $_POST['day'];
              $month = $_POST['month'];
              $year = $_POST['year'];

							$fromdate = "$year-$month-$day 00:00:00" ;
							$todate = "$year-$month-$day 23:59:59" ;

							$total_debit = null;

							//echo date('d');
							//echo $fromdate;

							$result = mysqli_query($con,"SELECT * FROM sell_memos WHERE date_sold BETWEEN '$fromdate' AND '$todate'");
						   	
						   	$curr_cash = 0 ;

						   	while($row = mysqli_fetch_array($result))
						   	{	
						   		if ($row['paid']>0){
                    $curr_cash = $curr_cash + $row['paid'];            
                    echo "<tr><td>".$row['company_name']."</td>";
                    echo "<td>".$row['comment']."</td>";
                    echo "<td>".$row['paid']."</td></tr>";
                    
                    $total_debit = $total_debit + $row['grand_total'] - $row['curr_due'];
                  }
							  }

							echo "<tr><td></td>";  
							echo "<td>--</td>";
							echo "<td>--</td></tr>";

							//getting current cash
							$prev_result = mysqli_query($con,"SELECT * FROM sell_memos WHERE date_sold < '$fromdate'");
                
                $prev_cash = 0 ;

                while($old_row = mysqli_fetch_array($prev_result))
                { 
                  if ($old_row['paid']>0){
                    $prev_cash = $prev_cash + $old_row['paid'];
                  }
                }

							$final_cash = $prev_cash + $curr_cash;
							
							//getting current credit
							$prev_expense = 0; 
							$result = mysqli_query($con,"SELECT * FROM purchase_memos WHERE date_bought < '$fromdate'");
							while($row = mysqli_fetch_array($result)){
								if ($row['paid']>0){
                  $prev_expense = $prev_expense + $row['paid'];
                }
							}
              $curr_expense = 0; 
              $result = mysqli_query($con,"SELECT * FROM purchase_memos WHERE date_bought BETWEEN '$fromdate' AND '$todate'");
              while($row = mysqli_fetch_array($result)){
                if ($row['paid']>0){
                  $curr_expense = $curr_expense + $row['paid'];
                }
              }
							$prev_cash = $prev_cash - $prev_expense;	
							$total_cash = $prev_cash + $curr_cash;
              $final_cash = $total_cash - $curr_expense;
							echo "<tr><td></td>";	
							echo "<td>সাবেক</td>";
							echo "<td>".$prev_cash."</td></tr>";

							echo "<tr><td></td>";
							echo "<td>--</td>";
							echo "<td>--</td></tr>";

							echo "<tr><td></td>";
							echo "<td>মোট</td>";
							echo "<td>".$total_cash."</td></tr>";

							echo "<tr><td></td>";
							echo "<td>খরচ বাদ</td>";
							echo "<td>".$curr_expense."</td></tr>";

							echo "<tr><td></td>";
							echo "<td>ক্যাশ</td>";
							echo "<td>".$final_cash."</td></tr>";

							mysqli_close($con); 
						  ?>

					</table>				 		
				 
                        </div>
                      </div>
                    </div>
                
                  </div>
                </div>
              
              </div>
              <div class="row-fluid">
              <div class="span12">
                <div class="row-fluid">
                  <div class="span12">
                    <div class="widget">
                      <div class="widget-header">
                      	<div class="title">
                          তাগাদা
                      
                        </div>
                        <span class="mini-title pull-right">
                          <?php echo $date; ?>
                        </span>

                        
                      </div>
                      <div class="widget-body">
                        <div class="row-fluid">
                          <table class="table table-bordered no-margin">
                           
                          </table>
                          
					<table class="table table-bordered new_table table-striped">
						<tr>
							<th>খাত</th>
              <th>বাবদ</th>
              <th>টাকার পরিমাণ</th>
						</tr>
							
							<?php
              
              include "util.php";
							require "conn.php";
              $fromdate = "$year-$month-$day 00:00:00" ;
              $todate = "$year-$month-$day 23:59:59" ;
							/*$fromdate = date('2013-01-01 00:00:00') ;
							$todate = date('2013-12-31 23:59:59') ;*/

							//echo date('d');	
							
							$result = mysqli_query($con,"SELECT * FROM purchase_memos WHERE date_bought BETWEEN '$fromdate' AND '$todate'");
						   	
						   	$total_expense = 0 ;
						   	//echo "<tr> <td>Affected rows: " . mysqli_affected_rows($con)." </td></tr>";
						   	while($prch_memo = mysqli_fetch_array($result))
						   	{	
                  if ($prch_memo['paid']>0){
                    $curr_cash = $prch_memo['paid'];            
                    echo "<tr><td>".$prch_memo['factory_name']."</td>
                              <td>$prch_memo[comment]</td>
                              <td>".$curr_cash."</td>
                          </tr>";
                    
                    $total_expense = $total_expense + $prch_memo['paid'];
                  }
							  }
                $companyChecks = dbEach("select * from company_check_log where date BETWEEN '$fromdate' AND '$todate' ");
                foreach ($companyChecks as $check) {
                  # code...
                  if ($check['paid']>0){
                    $curr_cash = $check['paid'];            
                    
                    echo "<tr><td>".$check['factory_name']."</td>
                              <td>কোম্পানি চেক তাগাদা</td>
                              <td>".$curr_cash."</td>
                          </tr>";
                    
                    $total_expense = $total_expense + $check['paid'];
                  }
                }

							  echo "<tr>
							  			<td>মোট</td>
							  			<td>".$total_expense."</td>
                      <td></td>
							  		</tr>"
							 ?>
					</table>

						
					
                        </div>
                      </div>
                    </div>
                
                  </div>
                </div>
              
              </div>
            
            
          </div>
        </div>
      </div>
      <!--/.fluid-container-->
    </div>
    <footer>
      <p>
        &copy; CodeCharley
      </p>
    </footer>
    <script src="js/jquery.min.js">
    </script>
    <script src="js/bootstrap.js">
    </script>
    <script src="js/jquery.scrollUp.js">
    </script>
    
    <script type="text/javascript">
      //ScrollUp
      $(function () {
        $.scrollUp({
          scrollName: 'scrollUp', // Element ID
          topDistance: '300', // Distance from top before showing element (px)
          topSpeed: 300, // Speed back to top (ms)
          animation: 'fade', // Fade, slide, none
          animationInSpeed: 400, // Animation in speed (ms)
          animationOutSpeed: 400, // Animation out speed (ms)
          scrollText: 'Scroll to top', // Text for element
          activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        });
      });
    </script>
    <script language="JavaScript" type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="bikri_khata_ajax.js"></script>
  </body>
</html>