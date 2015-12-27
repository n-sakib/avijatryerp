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
                      	<div class="title">
                          বিক্রি খাতা
                      
                        </div>
                        
                      </div>
                      <div class="widget-body">
                        <div class="row-fluid">
                          
                          <table class="table table-bordered new_table">
						<tr>
							<th>খাত</th>
              <th>বাবদ</th>
              <th>টাকার পরিমাণ</th>
						</tr>
						 <!-- echo todays transaction -->
						 <?php
						 	require "conn.php";
							$fromdate = date('Y-m-d 00:00:00') ;
							$todate = date('Y-m-d 23:59:59') ;

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
							$result = mysqli_query($con,"SELECT * FROM accounts LIMIT 1");
							$row = mysqli_fetch_array($result);

							$final_cash = $row['cash'] + 0;
							
							//getting current credit
							$curr_expense = 0; 
							$result = mysqli_query($con,"SELECT * FROM purchase_memos WHERE date_bought BETWEEN '$fromdate' AND '$todate'");
							while($row = mysqli_fetch_array($result)){
								if ($row['paid']>0){
                  $curr_expense = $curr_expense + $row['paid'];
                }
							}

							$prev_cash = $final_cash - $curr_cash + $curr_expense;	
							$total_cash = $final_cash + $curr_expense;

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
				 
				 <div class="bikri">
				 	<form action="bikri_add.php" method="post">
				 		<table class="table table-bordered new_table">
				 			<tr>
				 				<th>খাত</th>
				 				<th>নাম</th>
				 				<th>টাকার পরিমাণ</th>
				 				 <th>মন্তব্য</th>
				 			</tr>
							<tr>
								<td>
									<select name="sell_type" id="sell_type" onChange="javascript:ajax_get_bikri_names();">
										<option value="" selected="selected">সিলেক্ট</option>
										<option value="client">পার্টি</option>
										<option value="bank">ব্যাংক</option>
										<option value="staff">স্টাফ</option>
                    <option value="other_expenses">অন্যান্য খরচ</option>
									</select>
								</td>
								<td id="sell_name">
									 <!-- generated dynamically -->
								</td>
								<td>
                   <span id="gen_bank_name"></span>
                   <input type="text" name="amount"></td>
								<td id ="jolap_row"><input type="text"  name="comment" placeholder="মন্তব্য"></td>							
							</tr>
							</table>
							<input class="btn btn-info pull-right" type="submit" value="অনুমোদন">

				 	</form>
				 </div>
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
                        
                      </div>
                      <div class="widget-body">
                        <div class="row-fluid">
                          <table class="table table-bordered no-margin">
                           
                          </table>
                          
					<table class="table table-bordered new_table">
						<tr>
							<th>খাত</th>
              <th>বাবদ</th>
              <th>টাকার পরিমাণ</th>
						</tr>
							
							<?php
							require "conn.php";
							$fromdate = date('Y-m-d 00:00:00');
							$todate = date('Y-m-d 23:59:59');
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

							  echo "<tr>
							  			<td>মোট</td>
							  			<td>".$total_expense."</td>
                      <td></td>
							  		</tr>"
							 ?>
					</table>

						<table class="table table-bordered new_table">
							<tr>
								<th>খরচ</th>
								<th>নাম</th>
								<th>পরিমাণ</th>
                <th>মন্তব্য</th>
							</tr>
						
						<form action="bikri_tagada.php" method="post">
							<tr>
								<td>
									<select name="purchase_type" id="purchase_type" onChange="javascript:ajax_credit_types();">
										<option value="" selected="selected">সিলেক্ট</option>
										<option value="factory">কারখানা</option>
										<option value="staff">স্টাফ</option>
										<option value="bank">ব্যাংক</option>
                    <option value="other_expenses">অন্যান্য খরচ</option>
										
									</select>
								</td>
								<td>
									<!-- generate names with ajax -->
									<select name="name" id="names"></select>
								</td>
								<td>
									<label for="">পরিমাণ</label>
									<input type="text" name="amount">
								</td>
                <td>
                   <input type="text" name="comment">
                </td>
							</tr>						
							</table>
							<input class="btn btn-info pull-right" type="submit" value="অনুমোদন">
						</form>
					
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