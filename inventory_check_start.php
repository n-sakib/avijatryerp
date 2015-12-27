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
      ইনভেন্টরি চেক | অভিযাত্রী সুজ
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="icomoon/style.css" rel="stylesheet">
     <link rel="icon" type="image/ico" href="img/ico/favicon.ico"></link>
    <link href="css/main.css" rel="stylesheet"> <!-- Important. For Theming change primary-color variable in main.css  -->
    <!--[if lte IE 7]>
    <script src="css/icomoon-font/lte-ie7.js">
    </script>
    <![endif]-->
  <link href="css/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet">
  <link href="css/wysiwyg/wysiwyg-color.css" rel="stylesheet">
  <link href="css/charts-graphs.css" rel="stylesheet">
  <link href="css/clockface.css" rel="stylesheet">
  <link href="css/timepicker.css" rel="stylesheet">
  
  </head>
  <body>
    <?php 
    header("Cache-Control: no-cache, no-store, must-revalidate ");
   ?>
    <header>
      <a href="#" class="logo">
        <img src="img/Regainers_final.jpg" alt="Logo"/>
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
          selected('mal_check');
         ?>
        </div>
        <div class="sub-nav">
          <ul>
            <li>
              <a href="#" class="heading">মাল চেক</a>
            </li>
            <li>
              <a href="update_photo.php">
                ছবি পরিবর্তন
              </a>
            </li>
            <li>
              <a href="inventory_check.php">
                ইনভেন্টরি চেক এক্সেল
              </a>
            </li>
            <li>
              <a href="inventory_unchecked.php">
                চেক বাকি
              </a>
            </li>
            <li>
              <a href="inventory_check_new.php">
                ইনভেন্টরি চেক
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
                      ইনভেন্টরি চেক
                    </div>
                    
                  </div>
                  <div class="widget-body">
                      <!-- <select name="memo_no" id="memo_no" onchange="selectMemo();">
                        <option value="0" selected="selected">সিলেক্ট</option> -->
                        <?php 
                          require_once "conn.php";
                          $result = mysqli_query($con,"SELECT * FROM sell_memos WHERE checked = 0 AND total_qty > 0");
                          while($row = mysqli_fetch_array($result)){
                            //echo "<option value=\"$row[memo_no]\">$row[memo_no] ($row[company_name])</option>";
                          }
                         ?>  
                      <!-- </select> -->