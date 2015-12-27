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

      <link href="css/date-fix.css" rel="stylesheet">
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
              <div class="span6">
                <div class="widget">
                  <div class="widget-header">
                    <div class="title">
                      কাস্টম মাসিক রিপোর্ট
                    </div>
                  </div>
                  <div class="widget-body">
                      <form action="annual_report.php" method="post">
                            <div class="new_date">
                            <label for="date" class="width_fix">দিন</label>
                            <select name="fromDay" id="date">
                              <?php 
                                echo "<option value=\"".date('d')."\" selected=\"selected\">".date('d')."</option>";
                                for($date = 1; $date <= 31 ; $date++){
                                  $datestring = $date;
                                  if ($date<10){
                                    $date_string = '0'.$date;
                                    echo "<option value=\"$date_string\">$date_string</option>
                                              ";
                                  } else{
                                    $date_string = $date;
                                    echo "<option value=\"$date_string\">$date_string</option>";
                                  }
                                }       
                               ?>
                            </select>
                            <label for="month" class="width_fix">মাস</label>
                            <select name="fromMonth" id="month">
                            <?php 
                              echo "<option value=\"".date('m')."\" selected=\"selected\">".date('m')."</option>
                                      ";
                              for($month = 1; $month <= 12 ; $month++){
                                $datestring = $month;
                                if ($month<10){
                                  $month_string = '0'.$month;
                                  echo "<option value=\"$month_string\">$month_string</option>";
                                } else{
                                  $month_string = $month;
                                  echo "<option value=\"".$month_string."\">".$month_string."</option>";
                                }
                              }       
                             ?>
                            </select>
                            <label for="year" class="width_fix">বছর</label>
                            <select name="fromYear" id="year">
                            <?php 
                              echo "<option value=\"".date('Y')."\" selected=\"selected\">".date('Y')."</option>";
                              for($year = 2013; $year<= 2020 ; $year++){     
                                echo "<option value=\"$year\">$year</option>";
                              }       
                              ?>
                            </select>
                            <br><br>
                            <strong class="badge badge-inverse">থেকে</strong>
                            <br><br>
                            <label for="date" class="width_fix">দিন</label>
                            <select name="toDay" id="date">
                              <?php 
                                echo "<option value=\"".date('d')."\" selected=\"selected\">".date('d')."</option>";
                                for($date = 1; $date <= 31 ; $date++){
                                  $datestring = $date;
                                  if ($date<10){
                                    $date_string = '0'.$date;
                                    echo "<option value=\"$date_string\">$date_string</option>
                                              ";
                                  } else{
                                    $date_string = $date;
                                    echo "<option value=\"$date_string\">$date_string</option>";
                                  }
                                }       
                               ?>
                            </select>
                            <label for="month" class="width_fix">মাস</label>
                            <select name="toMonth" id="month">
                            <?php 
                              echo "<option value=\"".date('m')."\" selected=\"selected\">".date('m')."</option>
                                      ";
                              for($month = 1; $month <= 12 ; $month++){
                                $datestring = $month;
                                if ($month<10){
                                  $month_string = '0'.$month;
                                  echo "<option value=\"$month_string\">$month_string</option>";
                                } else{
                                  $month_string = $month;
                                  echo "<option value=\"".$month_string."\">".$month_string."</option>";
                                }
                              }       
                             ?>
                            </select>
                            <label for="year" class="width_fix">বছর</label>
                            <select name="toYear" id="year">
                            <?php 
                              echo "<option value=\"".date('Y')."\" selected=\"selected\">".date('Y')."</option>";
                              for($year = 2013; $year<= 2020 ; $year++){     
                                echo "<option value=\"$year\">$year</option>";
                              }       
                              ?>
                            </select>
                            <input type="submit" class="btn btn-info pull-right" value="দেখুন">
                            </div>
                          </form>             
                  </div>
                </div>
              </div>
            </div>

            <div class="row-fluid">
              <div class="span6">
                <div class="widget">
                  <div class="widget-header">
                    <div class="title">
                      কাস্টম বাৎসরিক রিপোর্ট
                    </div>
                  </div>
                  <div class="widget-body">
                      <form action="annual_report.php" method="post">
                            <div class="new_date">
                            <label for="date" class="width_fix">দিন</label>
                            <select name="fromDay" id="date">
                              <?php 
                                echo "<option value=\"".date('d')."\" selected=\"selected\">".date('d')."</option>";
                                for($date = 1; $date <= 31 ; $date++){
                                  $datestring = $date;
                                  if ($date<10){
                                    $date_string = '0'.$date;
                                    echo "<option value=\"$date_string\">$date_string</option>
                                              ";
                                  } else{
                                    $date_string = $date;
                                    echo "<option value=\"$date_string\">$date_string</option>";
                                  }
                                }       
                               ?>
                            </select>
                            <label for="month" class="width_fix">মাস</label>
                            <select name="fromMonth" id="month">
                            <?php 
                              echo "<option value=\"".date('m')."\" selected=\"selected\">".date('m')."</option>
                                      ";
                              for($month = 1; $month <= 12 ; $month++){
                                $datestring = $month;
                                if ($month<10){
                                  $month_string = '0'.$month;
                                  echo "<option value=\"$month_string\">$month_string</option>";
                                } else{
                                  $month_string = $month;
                                  echo "<option value=\"".$month_string."\">".$month_string."</option>";
                                }
                              }       
                             ?>
                            </select>
                            <label for="year" class="width_fix">বছর</label>
                            <select name="fromYear" id="year">
                            <?php 
                              echo "<option value=\"".date('Y')."\" selected=\"selected\">".date('Y')."</option>";
                              for($year = 2013; $year<= 2020 ; $year++){     
                                echo "<option value=\"$year\">$year</option>";
                              }       
                              ?>
                            </select>
                            <br><br>
                            <strong class="badge badge-inverse">থেকে</strong>
                            <br><br>
                            <label for="date" class="width_fix">দিন</label>
                            <select name="toDay" id="date">
                              <?php 
                                echo "<option value=\"".date('d')."\" selected=\"selected\">".date('d')."</option>";
                                for($date = 1; $date <= 31 ; $date++){
                                  $datestring = $date;
                                  if ($date<10){
                                    $date_string = '0'.$date;
                                    echo "<option value=\"$date_string\">$date_string</option>
                                              ";
                                  } else{
                                    $date_string = $date;
                                    echo "<option value=\"$date_string\">$date_string</option>";
                                  }
                                }       
                               ?>
                            </select>
                            <label for="month" class="width_fix">মাস</label>
                            <select name="toMonth" id="month">
                            <?php 
                              echo "<option value=\"".date('m')."\" selected=\"selected\">".date('m')."</option>
                                      ";
                              for($month = 1; $month <= 12 ; $month++){
                                $datestring = $month;
                                if ($month<10){
                                  $month_string = '0'.$month;
                                  echo "<option value=\"$month_string\">$month_string</option>";
                                } else{
                                  $month_string = $month;
                                  echo "<option value=\"".$month_string."\">".$month_string."</option>";
                                }
                              }       
                             ?>
                            </select>
                            <label for="year" class="width_fix">বছর</label>
                            <select name="toYear" id="year">
                            <?php 
                              echo "<option value=\"".date('Y')."\" selected=\"selected\">".date('Y')."</option>";
                              for($year = 2013; $year<= 2020 ; $year++){     
                                echo "<option value=\"$year\">$year</option>";
                              }       
                              ?>
                            </select>
                            <input type="submit" class="btn btn-info pull-right" value="দেখুন">
                            </div>
                          </form>  
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