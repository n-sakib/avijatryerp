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
      রিপোর্ট ও প্রোফাইল | অভিযাত্রী সুজ
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="icomoon/style.css" rel="stylesheet">
    <link href="css/modal-window.css" rel="stylesheet">
     <link rel="icon" type="image/ico" href="img/ico/favicon.ico"></link>
    <!--[if lte IE 7]>
    <script src="css/icomoon-font/lte-ie7.js">
    </script>
    <![endif]-->
    <link href="css/main.css" rel="stylesheet"> <!-- Important. For Theming change primary-color variable in main.css  -->
    
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
          selected('reports');
         ?>
        </div>
        <div class="sub-nav">
          <ul>
            <li>
                <a href="inventory_view.php" class="heading">ইনভেন্টরি</a>
            </li>
            <li>
              <a href="new_staff.php">
                স্টাফ তালিকাভুক্তি
              </a>
            </li>
            <li>
              <a href="new_bank.php">
                ব্যাংক তালিকাভুক্তি
              </a>
            </li>
            <li>
              <a href="new_expenses.php">
                অন্যান্য খরচ তালিকাভুক্তি
              </a>
            </li>
             <li>
              <a href="reports.php">
                মাসিক রিপোর্ট
              </a>
            </li>
            <li>
              <a href="annual_report.php">
                বাৎসরিক রিপোর্ট
              </a>
            </li>
            <li>
              <a href="custom_report.php">
                কাস্টম রিপোর্ট
              </a>
            </li>
          </ul>
        </div>  
        <div class="dashboard-wrapper">
          <div class="left-sidebar">
            
            
            <div class="row-fluid">
              <div class="span12">
                <div class="widget">
                  <div class="widget-header">
                    <div class="title">
                      <a id="dynamicTable">বাৎসরিক রিপোর্ট</a>
                    </div>
                    <span class="tools">
                      <a class="fs1" aria-hidden="true" data-icon="&#xe090;" href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'"></a>
                    </span>
                  </div>
                  <div class="widget-body">
                                     
                      <table class="table table-condensed table-striped table-hover table-bordered" >
                        
                        <thead>
                          <tr>
                            <th>মাস</th>
                            <th>বিক্রি </th>
                            <th>তাগাদা</th>
                            <th>ব্যাংক জমা</th>
                            <?php 
                              require_once "conn.php";
                              //making room for marked entries
                              $listed_categ = array();
                              $categ_exp = array();
                              $expense_listed = mysqli_query($con,"SELECT * FROM other_expenses WHERE report = 1");
                              while($listed = mysqli_fetch_array($expense_listed)){
                                echo "<th>$listed[expense_name]</th>";
                                $listed_categ[] = $listed['expense_name'];
                                $categ_exp[] = 0;
                              }
                             ?>
                          <!--  <th>স্টাফ খরচ</th> -->
                            <th>বিবিধ</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            include 'reports_functions.php';
                            include "monthName.php";
                            require_once "conn.php";
                            $month = date('m');
                            if(isset($_POST['month'])){
                              $month = $_POST['month'];
                            }
                            $next_month = $month + 1;
                            if($month==12){
                              $next_month = 01;
                            }
                            $next_month = str_pad($next_month, 2, "0", STR_PAD_LEFT);
                            //echo $next_month;
                            
                            $fromYear = date('Y');
                            $toYear = date('Y');

                            //integrating custom reports
                            $fromMonth = 1;
                            $toMonth = 12;
                            $fromDay = 1;
                            $toDay = 31;

                            if(isset($_POST['fromDay'])){
                              $fromDay = $_POST['fromDay'];  
                            }
                            if(isset($_POST['toDay'])){
                              $toDay = $_POST['toDay'];
                            }
                            if(isset($_POST['fromMonth'])){
                              $fromMonth = $_POST['fromMonth'];
                            }
                            if(isset($_POST['toMonth'])){
                              $toMonth = $_POST['toMonth'];
                            }
                            if(isset($_POST['fromYear'])){
                              $fromYear = $_POST['fromYear'];
                            }
                            if(isset($_POST['toYear'])){
                              $toYear = $_POST['toYear'];
                            }
                            for($month = $fromMonth ; $month <= $toMonth ; $month++){
                              $month = str_pad($month, 2, "0", STR_PAD_LEFT);
                              $bikri = 0;
                              $tagada = 0;
                              $bank_joma = 0;
                              $staff_exp = 0 ;
                              $other_exp = 0 ;
                              $categ_exp_count = 0;
                              for($day = $fromDay; $day <= $toDay ; $day++){
                                $day = str_pad($day, 2, "0", STR_PAD_LEFT);
                                /* $fromdate = "$year-$month-01 00:00:00";//for annual report
                                $todate = "$year-$next_month-01 00:00:00";*/
                                $fromdate = "$fromYear-$month-$day 00:00:00";
                                $todate = "$toYear-$month-$day 23:59:59";
                                $sell_memos_result = mysqli_query($con, "SELECT * FROM sell_memos WHERE date_sold BETWEEN '$fromdate' AND '$todate'");
                                while($sell_memos = mysqli_fetch_array($sell_memos_result)){
                                  if ($sell_memos['sell_type'] == "client" || $sell_memos['sell_type'] == "return" ){
                                    $bikri = $bikri + $sell_memos['paid'] ;//$sell_memos['grand_total'] - $sell_memos['extra_cost'] + $sell_memos['carry_cost'];
                                  }
                                }

                                $purchase_memos_result = mysqli_query($con, "SELECT * FROM purchase_memos WHERE date_bought BETWEEN '$fromdate' AND '$todate'");
                                
                                while($purchase_memos = mysqli_fetch_array($purchase_memos_result)){
                                  if ($purchase_memos['purchase_type'] == 'factory' ){//|| $purchase_memos['purchase_type'] == 'return' ){ //gotta ask if returned money from factories should be included
                                    $tagada = $tagada + $purchase_memos['paid'];
                                  }else if ($purchase_memos['purchase_type'] == 'client'){
                                    $bank_joma = $bank_joma + $purchase_memos['paid'];
                                  }else if ($purchase_memos['purchase_type'] == 'staff'){// && is_listed("$purchase_memos[factory_name]") == false ){
                                    $staff_exp = $staff_exp + $purchase_memos['paid'];
                                  }else if ($purchase_memos['purchase_type'] == 'other_expenses' && is_listed("$purchase_memos[factory_name]") == false ){
                                    $other_exp = $other_exp + $purchase_memos['paid'];
                                  }
                                  foreach ($listed_categ as $index => $categ) {
                                    if ($purchase_memos['factory_name'] == $categ){
                                      $categ_exp_count++;
                                      $categ_exp[$index]=$categ_exp[$index]+ $purchase_memos['paid'];
                                    }
                                  }
                                }
                              }
                              $bikri = $bikri - $bank_joma; //reducing the bank joma from general sells
                              if($bikri != 0 || $tagada != 0 || $staff_exp != 0 || $categ_exp_count){
                                  $monthName= monthName($month);
                                  echo "<tr>
                                          <td>$monthName</td>
                                          <td>$bikri</td>
                                          <td>$tagada</td>
                                          <td>$bank_joma</td>
                                          <td>$staff_exp</td>";
                                  //make room for marked items
                                  foreach ($listed_categ as $index => $categ) {
                                    echo "<td>$categ_exp[$index]</td>";
                                  }
                                  echo   "<td>$other_exp</td>
                                        </tr>";
                                }
                            }
                            ?>
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
              
            </div>
            <div id="light" class="white_content"><a class=pull-right href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">[X]</a>
                <form action="post_categ_list.php" method="post">
                  <h3>রিপোর্টে দেখানোর জন্যে টিক চিহ্ন দিন</h3>
                  <?php 
                    $all_expenses = mysqli_query($con,"SELECT * FROM other_expenses");
                    while($expenses = mysqli_fetch_array($all_expenses)){
                      if($expenses['report']==1){
                        echo "<p><input name=categs[] value=$expenses[expense_name] type=\"checkbox\" checked><span id=name-tag>$expenses[expense_name]</span></p>";
                      } else{
                        echo "<p><input name=categs[] value=$expenses[expense_name] type=\"checkbox\"><span id=name-tag>$expenses[expense_name]</span></p>";
                      }
                      
                    }
                   ?>
                  <input type="submit" class="btn-info btn" value="সেভ">
                </form>
            </div>
            <div id="fade" class="black_overlay"></div>
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
    <script src="js/jquery.datanew_staff.js">
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

      //Tooltip
      $('a').tooltip('hide');

      //Data new_staff
      $(document).ready(function () {
        $('#data-table').dataTable({
          "sPaginationType": "full_numbers"
        });
      });

      jQuery('.delete-row').click(function () {
        var conf = confirm('Continue delete?');
        if (conf) jQuery(this).parents('tr').fadeOut(function () {
          jQuery(this).remove();
        });
          return false;
        });
      </script>
    </script>
    </body>
    </html>