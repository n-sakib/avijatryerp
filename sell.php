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
        <title>বিক্রি সম্পর্কিত তথ্য | অভিযাত্রী সুজ</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
       
        <link href="icomoon/style.css" rel="stylesheet">
        <link rel="icon" type="image/ico" href="img/ico/favicon.ico"></link>
      <link href="css/main.css" rel="stylesheet">
      <link href="css/new_table.css" rel="stylesheet">
      <link href="css/sell-delbtn.css" rel="stylesheet">
      
      <!-- Important. For Theming change primary-color variable in main.css  -->
      <!--[if lte IE 7]>
      <script src="css/icomoon-font/lte-ie7.js"></script>
      <![endif]-->
      <link href="css/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet">
      <link href="css/wysiwyg/wysiwyg-color.css" rel="stylesheet">
      <link href="css/charts-graphs.css" rel="stylesheet">
      <link href="css/clockface.css" rel="stylesheet">
      <link href="css/timepicker.css" rel="stylesheet">
      <link href="css/date-fix.css" rel="stylesheet">
      <script type="text/javascript" src="jquery.js"></script>      
      <script type="text/javascript">
        $(window).bind('beforeunload', function(){
          return '>>>>><<<<< \n আপনি কি রিফ্রেশ করতে চান?';
        });
      </script>
    </head>
<body>
  <?php header("Cache-Control: no-cache, no-store, must-revalidate "); ?>
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
          selected('sell');
         ?></div>
        <div class="sub-nav">
          <ul>
            <li>
              <a href="#" class="heading">বিক্রি</a>
            </li>
            <li>
              <a href="sell.php">মাল বিক্রি</a>
            </li>
            <li>
              <a href="new_client.php">নতুন পার্টি যোগ করুন</a>
            </li>

          </ul>
        </div>

        <div class="dashboard-wrapper">
          <div class="left-sidebar">

            <div class="row-fluid">
              <div class="span12">
                <div class="widget">
                  <div class="widget-header">
                    <div class="title">মাল বিক্রি</div>

                  </div>
                  <div class="widget-body">
                    <?php 
    if (isset($_GET['msg']) && $_GET['msg']=='success' ) {
      echo "<p>
              <h1>মাল বিক্রি সফল হয়েছে !!</h1>
            </p>
          ";
    }else{}
   ?>
          

                    <?php 
          require_once "conn.php";

          $result = mysqli_query($con,"SELECT * FROM sell_memos ORDER BY table_index DESC LIMIT 1");             
          $row = mysqli_fetch_array($result);

          $memo_no = null;
          if(mysqli_num_rows($result)!=0){
            $last = $row['memo_no'];
            $memo_no = $last + 1;
          } else{ $memo_no = 1;}
          ?>
                    <form action="sell_preview.php" method="post" id="form">

                      <!-- echo dates -->
                      <div class="new_date">
              <label for="date" class="width_fix">দিন</label>
                              <select name="date" id="date">
                                <?php 
              echo "<option value=\"".date('d')."\" selected=\"selected\">".date('d')."</option>
                            ";
              for($date = 1; $date
                            <= 31 ; $date++){
                $datestring = $date;
                if ($date<10){
                  $date_string = '0'.$date;
                  echo "<option value=\"".$date_string."\">".$date_string."</option>
                            ";
                } else{
                  $date_string = $date;
                  echo "
                            <option value=\"".$date_string."\">".$date_string."</option>
                            ";
                }
              }       
             ?>
                              </select>
                          <label for="month" class="width_fix">মাস</label>
                              <select name="month" id="month">
                                <?php 
              echo "<option value=\"".date('m')."\" selected=\"selected\">".date('m')."</option>
                          ";
              for($month = 1; $month
                          <= 12 ; $month++){
                $datestring = $month;
                if ($month<10){
                  $month_string = '0'.$month;
                  echo "<option value=\"".$month_string."\">".$month_string."</option>
                          ";
                } else{
                  $month_string = $month;
                  echo "
                          <option value=\"".$month_string."\">".$month_string."</option>
                          ";
                }
              }       
             ?>
                              </select>
                          <label for="year" class="width_fix">বছর</label>
                        <select name="year" id="year">
                          <?php 
              echo "<option value=\"".date('Y')."\" selected=\"selected\">".date('Y')."</option>
                        ";
              for($year = 2013; $year
                        <= 2020 ; $year++){     
                echo "<option value=\"".$year."\">".$year."</option>
                        ";
                
              }       
             ?>
                        </select>
                        
                </div>
                <br>

                <!-- main form -->
                <label for="memo_no">
                  নতুন মেমো নং :
                  <?php echo $memo_no; ?></label>
                <input type="hidden" name="memo_no" id="memo_no" value="<?php echo $memo_no; ?>
                ">
                <br>
                <label class="control-label" for="company_name">পার্টির নাম :
                  <input type="text"  id="company_name" name="company_name" list="client" onchange="selectClient();validateCompanyName();ajax_get_khuchra_form();ajax_get_mal_ferot();" value="লিখুন" autocomplete="off">
                  <datalist class="" id="client" onclick="javascript:ajax_get_khuchra_form();ajax_get_mal_ferot();" onchange="selectClient();">
                     <?php       
                        $result = mysqli_query($con,"SELECT * FROM clients");
                        while($row = mysqli_fetch_array($result)){
                        echo "<option value=\"".$row['company_name']."\">".$row['company_name']."</option>
                                ";
                          }   
                      ?>
                  </datalist>
                </label>
                <a href="sell.php" class="btn btn-info pull-right">রিফ্রেশ</a>
                <div id="khuchra_form"></div>
              <br>

              <!-- memo table -->

              <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                <tr>
                  <th style="width:20%">জুতার আইডি</th>
                  <th style="width:30%">পরিমাণ(জোড়া)</th>
                  <th style="width:20%">হিসাব</th>
                </tr>
                <tr>
                  <td>
                    <input tabindex="1"  name="products[]" type="text" id="pid1" onchange="ajaxPostPidInfo(1);">
                  </td>
                  <td>
                    <input tabindex="2" type="number" class="span8" name="qtys[]" value="6" id="qty1" min="1" max="6" step="1">
                  </td>
                  <td>
                    <input tabindex="3" type="text" name="units[]" id="ignored-units" onfocus="javascript:addRow();"readonly>
                    <span id="del-row1" class="del-row" onclick="delRow(1)">x</span>
                  </td>
                </tr>
                <tr id="last_row"></tr>
                <tr>
                  <td><input type="hidden" id="total-row" value="1"></td>
                  <td> <strong>কমিশন (%):</strong>
                  </td>
                  <td>
                    <?php 
        //fetch commission percent
          $result = mysqli_query($con,"SELECT * FROM user_settings WHERE config_name = 'default' LIMIT 1");
          $row = mysqli_fetch_array($result);     
         ?>       <input type="text" id="commission"  name="commission"   placeholder="28" value="28">
                  <!--  <input type="number" min="1" max="100" onchange="numberCheck();" onfocus="numberCheck();" name="commission"   placeholder="<?php //echo $row['commission_percent']; ?>" value="28"> -->
        
                  </td>
                </tr>
              </table>
              <input type="button" class="btn btn-info pull-right" value="নতুন লাইন" onclick="addRow();">
              <input type="button" class="btn btn-info pull-left" id="submit2" value="প্রিভিউ" onclick="checkClient();">
              <span class="btn pull-left" onclick="ajaxReceiptPreview()">মেমো প্রিভিউ</span>
              <input style="visibility:hidden;" type="submit" id="submit" value="প্রিভিউ">
              <br></form>

              <div id="mal-ferot"></div>

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

<script src="js/wysiwyg/wysihtml5-0.3.0.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.scrollUp.js"></script>
<script src="js/wysiwyg/bootstrap-wysihtml5.js"></script>
<script src="js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="js/date-picker/date.js"></script>
<script type="text/javascript" src="js/date-picker/daterangepicker.js"></script>
<script type="text/javascript" src="js/clockface.js"></script>
<script type="text/javascript" src="js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="js/jquery.bootstrap.wizard.js"></script>

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

      //Popover
      $('.popover-pop').popover('hide');

      //Collapse
      $('#myCollapsible').collapse({
        toggle: false
      })

      //Tabs
      $('.myTabBeauty a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
      })

      //Dropdown
      $('.dropdown-toggle').dropdown();

      //wysihtml5
      $('#wysiwyg').wysihtml5();

      //Color picker
      $('.colorpicker').colorpicker();

      //Bootstrap Timepicker
      $('#timepicker1').timepicker();

      $('#timepicker2').timepicker({
        minuteStep: 1,
        secondStep: 5,
        showInputs: false,
        template: 'modal',
        modalBackdrop: true,
        showSeconds: true,
        showMeridian: false
      });

      $('#timepicker3').timepicker({
        minuteStep: 5,
        secondStep: 30,
        showInputs: false,
        showSeconds: true,
        showMeridian: false
      });


      //Time Picker Clockface Plugin
      $(function () {

        $('#time1').clockface({
          format: 'HH:mm',
          trigger: 'manual'
        });

        $('#toggle-btn').click(function (e) {
          e.stopPropagation();
          $('#time1').clockface('toggle');
        });

      });

      //Date picker
      $('.date_picker').daterangepicker({
        opens: 'right'
      });

      //Date Picker

      $('.report_range').daterangepicker({
        ranges: {
          'Today': ['today', 'today'],
          'Yesterday': ['yesterday', 'yesterday'],
          'Last 7 Days': [Date.today().add({
            days: -6
          }), 'today'],
          'Last 30 Days': [Date.today().add({
            days: -29
          }), 'today'],
          'This Month': [Date.today().moveToFirstDayOfMonth(), Date.today().moveToLastDayOfMonth()],
          'Last Month': [Date.today().moveToFirstDayOfMonth().add({
            months: -1
          }), Date.today().moveToFirstDayOfMonth().add({
            days: -1
          })]
        },
        opens: 'right',
        format: 'MM/dd/yyyy',
        separator: ' to ',
        startDate: Date.today().add({
          days: -29
        }),
        endDate: Date.today(),
        minDate: '01/01/2012',
        maxDate: '12/31/2013',
        locale: {
          applyLabel: 'Submit',
          fromLabel: 'From',
          toLabel: 'To',
          customRangeLabel: 'Custom Range',
          daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          firstDay: 1
        },
        showWeekNumbers: true,
        buttonClasses: ['btn-danger']
      },

      function (start, end) {
        $('.report_range span').html(start.toString('MMMM d, yyyy') + ' - ' + end.toString('MMMM d, yyyy'));
      });

      //Set the initial state of the picker label
      $('.report_range span').html(Date.today().add({
        days: -29
      }).toString('MMMM d, yyyy') + ' - ' + Date.today().toString('MMMM d, yyyy'));


      //Wizard Progressbar

      $('#inverse').bootstrapWizard({
        'tabClass': 'nav',
        'debug': false,
        onShow: function (tab, navigation, index) {
          console.log('onShow');
        },
        onNext: function (tab, navigation, index) {
          console.log('onNext');
          if (index == 2) {
            // Make sure we entered the name
            if (!$('#name').val()) {
              alert('You must enter your name');
              $('#name').focus();
              return false;
            }
          }

          // Set the name for the next tab
          $('#inverse-tab3').html('Hello, ' + $('#name').val());

        },
        onPrevious: function (tab, navigation, index) {
          console.log('onPrevious');
        },
        onLast: function (tab, navigation, index) {
          console.log('onLast');
        },
        onTabClick: function (tab, navigation, index) {
          console.log('onTabClick');
          alert('on tab click disabled');
          return false;
        },
        onTabShow: function (tab, navigation, index) {
          console.log('onTabShow');
          var $total = navigation.find('li').length;
          var $current = index + 1;
          var $percent = ($current / $total) * 100;
          $('#inverse').find('.bar').css({
            width: $percent + '%'
          });
        }
      });


      //Wizard Progressbar tabs left

      $('#tabsleft').bootstrapWizard({
        'tabClass': 'nav nav-tabs',
        'debug': false,
        onShow: function (tab, navigation, index) {
          console.log('onShow');
        },
        onNext: function (tab, navigation, index) {
          console.log('onNext');
        },
        onPrevious: function (tab, navigation, index) {
          console.log('onPrevious');
        },
        onLast: function (tab, navigation, index) {
          console.log('onLast');
        },
        onTabClick: function (tab, navigation, index) {
          console.log('onTabClick');

        },
        onTabShow: function (tab, navigation, index) {
          console.log('onTabShow');
          var $total = navigation.find('li').length;
          var $current = index + 1;
          var $percent = ($current / $total) * 100;
          $('#tabsleft').find('.bar').css({
            width: $percent + '%'
          });

          // If it's the last tab then hide the last button and show the finish instead
          if ($current >= $total) {
            $('#tabsleft').find('.pager .next').hide();
            $('#tabsleft').find('.pager .finish').show();
            $('#tabsleft').find('.pager .finish').removeClass('disabled');
          } else {
            $('#tabsleft').find('.pager .next').show();
            $('#tabsleft').find('.pager .finish').hide();
          }

        }
      });


      $('#tabsleft .finish').click(function () {
        alert('Finished!, Starting over!');
        $('#tabsleft').find("a[href*='tabsleft-tab1']").trigger('click');
      });
    </script>
    <script type="text/javascript" src="sell_script.js"></script>
    <script type="text/javascript" src="sell_ajax.js"></script>
    <script type="text/javascript" src="ignore_key.js"></script>
    <script type="text/javascript" src="js/number-polyfill.js"></script>
    <script type="text/javascript" src="receiptPreview.js"></script>


</body>
</html>