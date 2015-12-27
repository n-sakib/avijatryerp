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
        <title>খাতার তালিকা | অভিযাত্রী সুজ</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
       
        <link href="icomoon/style.css" rel="stylesheet">
        <link rel="icon" type="image/ico" href="img/ico/favicon.ico"></link>
      <!--[if lte IE 7]>
      <script src="css/icomoon-font/lte-ie7.js"></script>
      <![endif]-->
      <link href="css/main.css" rel="stylesheet">
      <!-- Important. For Theming change primary-color variable in main.css  -->

</head>
<body>
      <header>
        <a href="#" class="logo">
          <img src="img/Regainers_final.jpg" alt="Logo" />
        </a>
        <div class="btn-group">
          <button class="btn btn-primary">ইউজার</button>
          <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu pull-right">
            <li>
              <a href="#">Edit Profile</a>
            </li>
            <li>
              <a href="#">Account Settings</a>
            </li>
            <li>
              <a href="#">Logout</a>
            </li>
          </ul>
        </div>

      </header>
      <div class="container-fluid">
        <div class="dashboard-container">
          <?php 
          include 'top_nav.php';
          selected('baki_khata');
         ?></div>
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
            <li>
              <a href="company_check.php">
                চেক খাতা
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
                      স্টাফ তালিকা
                      <span class="mini-title">স্টাফ প্রোফাইলসমূহ</span>
                    </div>

                  </div>
                  <div class="widget-body">

                    <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                      <tr>
                        <th>ক্রমিক#</th>
                        <th>নাম</th>
                      </tr>
                      <?php
                        require_once "conn.php";            
                        
                        $result = mysqli_query($con,"SELECT * FROM staffs");
                        $serial = 1;
                        while($row = mysqli_fetch_array($result)){
                        echo "<tr>
                                <td>$serial</td>
                                <td>
                                  <a href=\"staff_khata_profile.php?staff=$row[staff_name]\">$row[staff_name]</a>
                                </td>
                              </tr>
                              ";
                          $serial++;
                          }     
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
  <!--/.fluid-container-->
</div>
<footer>
  <p>&copy; CodeCharley</p>
</footer>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.scrollUp.js"></script>
<script src="js/jquery.datanew_staff.js"></script>

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

</body>
</html>