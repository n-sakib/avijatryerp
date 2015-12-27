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
      বিক্রি সম্পর্কিত তথ্য | অভিযাত্রী সুজ
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
         ?>
        </div>
        <div class="sub-nav">
          <ul>
            <li>
              <a href="#" class="heading">বিক্রি</a>
            </li>
            <li>
              <a href="sell.php">
                মাল বিক্রি
              </a>
            </li>
            <li>
              <a href="new_client.php">
                নতুন পার্টি যোগ করুন
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
                      নতুন পার্টির প্রোফাইল তৈরি করুন 
                      <span class="mini-title">
                        নতুন প্রোফাইলের সাধারণ ফরম
                      </span>
                    </div>
                    
                  </div>
                  <div class="widget-body">
                  <?php 
    require_once "conn.php";?>
                    <div class="row-fluid">
                      
                      <form class="form-horizontal no-margin" action="sell_submit.php" method="post" id="form"> 
     <!-- generating timestamp -->
     <label class="control-label" for="">তারিখ : </label>
     <input class="in span3" type="text" name="date" value="<?php echo $_POST['date']; ?>">
     <input class="in span3" type="text" name="month" value="<?php echo $_POST['month']; ?>">
     <input class="in span3" type="text" name="year" value="<?php echo $_POST['year']; ?>">
    <?php 
      $date_sold = "$_POST[year]"."-"."$_POST[month]"."-"."$_POST[date]"." 00:00:00";
     ?> 

     <input class="span3" type="hidden" name="date_sold" value="<?php echo $date_sold; ?>">

    <p>মেমো নং  <?php echo $_POST['memo_no'] ?></p>
    <?php
      require_once "conn.php"; 
      //calculte memo no
      $result = mysqli_query($con,"SELECT * FROM sells WHERE company_name = '$_POST[company_name]' ORDER BY table_index DESC LIMIT 1");             
      $row = mysqli_fetch_array($result);

      $memo_no = null;
      if($row['return_goods'] == 'adv'){
        $memo_no = $row['memo_no'];
      } else{ $memo_no = 1;}
     ?>

    <input class="span3" type="hidden" name="memo_no" value="<?php echo $_POST['memo_no']; ?>">
    <p>পার্টির নাম : <?php echo @$_POST['company_name']; ?></p>
    <input class="span3" type="hidden" name="company_name" value="<?php echo $_POST['company_name']; ?>">
    <a href="sell.php" class="btn btn-info pull-right">নতুন মেমো</a>
     <!-- echo product prices -->
    <table class="table table-condensed table-striped table-bordered table-hover no-margin">
       <tr>
        <th>স্টক</th>
        <th>জুতার আইডি</th>
        <th>দর</th>
        <th>পরিমাণ(জোড়া)</th>
        <th>দাম</th>
      </tr>
    <?php
      include "convert_number_encoding.php";

      $product_count = 0;
      $final_qty = 0;
      $overload = 0; //tells if the requested amount of qty is more than the stock

      $qty=$_POST['qtys'];
      $unit = $_POST['units'];
      $prices = array();
      if(isset($_POST['products'])){
        foreach($_POST['products'] as $index => $product) {
          echo "<tr>";
          $result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = $product LIMIT 1");
          
          if (@mysqli_num_rows($result)!= 0){
            $product_count++;
            $row = mysqli_fetch_array($result);
            //inventory check
            $total_qty = convertToEnglishNumber($qty[$index]);
            $qty[$index] = convertToEnglishNumber($qty[$index]);
            if($total_qty > $row['total_qty']){
              $overload++;
              echo "<td>পর্যাপ্ত পরিমান নেই, $row[total_qty] টি আছে </td>";
            } else{
              echo "<td>আছে</td>";              
            }

            //echoing retail price per specific unit
            echo "<td><input name=\"products[]\" type=\"text\" value = \"".$product."\" placeholder=\"".$product."\" readonly> </td>";
            echo "<td><input name=\"prices[]\" type=\"text\" value = \"".$row['retail_price']."\" placeholder=\"".$row['retail_price']."\" readonly>";

            $invn_unit_name = '';

            if ($row['unit_on_retail_price']==12){
              $invn_unit_name = 'dozen(s)';
            } else{
              $invn_unit_name = 'pairs(s)';
            }             
            echo "</td>";

            //generating unit name dozen/pair
            /*$unit_name = '';
            if ($unit[$index]==12){
              $unit_name = 'dozen(s)';
            } else{
              $unit_name = 'pairs(s)';
            }*/
            echo "<td>".$total_qty."</td>";
            //calculating total price
            $eqv_retail_price= null;  
            /*  //$eqv_price_per_unit= null;  
            if($row['unit_on_retail_price']==$unit[$index]){
              $eqv_retail_price=$row['retail_price'];
            }else{
              $eqv_retail_price=$row['retail_price']*$unit[$index];
            }   */
            //echoing total qty
            //echo "<td></td>";
            $final_qty = $final_qty + $total_qty;
            echo "<input name=\"qtys[]\" type=\"hidden\" value = \"".$qty[$index]."\">";
            //echo "<input name=\"units[]\" type=\"hidden\" value = \"".$unit[$index]."\">";
            
            //echoing sub total price
            $subtotal_price = $total_qty*$row['retail_price'];
            echo "<td>".$subtotal_price."</td>";
            echo "<input type=\"hidden\" name=\"subtotal_prices[]\" value=\"".$subtotal_price."\">";
            array_push($prices, "$subtotal_price");
          }else{
            echo "<td>ভুল আইডি দেওয়া হয়েছে</td>";
          }
          echo "</tr>";
        }
      }
      //generating total amount
      $raw_total = null;
      foreach ($prices as $price) {
        $raw_total = $raw_total + $price ;
      }
      echo "<tr>
          <td></td>
          <td></td>
          <td>মোট জোড়া</td>
          <td>$final_qty</td>
          <td></td>
        </tr>";
      echo "<tr>
          <td></td>
          <td></td>
          <td></td>
          <td>মোট দাম :</td>
          <td>".$raw_total."</td>
        </tr>";

      //commission
      $commissioned = 1 - convertToEnglishNumber($_POST['commission']*0.01);
      $total_commission = $raw_total*convertToEnglishNumber($_POST['commission'])*0.01;
      $total_price = $raw_total*$commissioned;

      echo "
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td>মোট কমিশন</td>
          <td>".$total_commission."</td>
        </tr>";

      echo "<tr>
          <td></td>
          <td></td>
          <td></td>
          <td>কমিশন ছাড়া দাম</td>
          <td>".$total_price."</td>
        </tr>";
      echo "<input name=\"total_price\" value=\"".$total_price."\" type=\"hidden\" >";
      echo "<input name=\"raw_total\" value=\"".$raw_total."\" type=\"hidden\" >";
      echo "<input name=\"commission\" value=\"".convertToEnglishNumber($_POST['commission'])."\" type=\"hidden\" >";
      
      //printing previous due
      $prev_due = null;
      if(isset($_POST['company_name'])){
        $client = $_POST['company_name'];
        $result = mysqli_query($con,"SELECT * FROM sell_memos WHERE company_name = '$client'  ORDER BY table_index DESC LIMIT 1");
        $row = mysqli_fetch_array($result);
        $prev_due = $row['due'];
      }
          echo "<tr>
          <td></td>
          <td></td>
          <td></td>
          <td>সাবেক বাকি</td>
          <td>".$prev_due."</td>
        </tr>";

          $total_amount= $total_price+$prev_due;
          echo "<tr>
          <td></td>
          <td></td>
          <td></td>
          <td>মোট পরিমাণ</td>
          <td>".$total_amount."</td>
        </tr>";
      echo "<tr>
          <td></td>
          <td></td>
          <td>এক্সট্রা খরচ</td>
          <td><input name=\"extra_cost_descr\" type=\"text\"placeholder=\"মালের বিবরণ\"></td>
          <td><input name=\"extra_cost\" type=\"text\"placeholder=\"টাকার পরিমাণ\"></td>
        </tr>";
      echo "<tr>
          <td></td>
          <td></td>
          <td></td>
          <td>পাঠানো খরচ</td>
          <td><input name=\"carry_cost\" type=\"text\"></td>
        </tr>";
      echo "<tr>
          <td></td>
          <td></td>
          <td></td>
          <td>জমা</td>
          <td><input name=\"paid\" type=\"text\"></td>
        </tr>";
      if(isset($_POST['comment'])){
        echo "<tr>
            <td>commment</td>
            <td><input name=\"jolap_comment\" id=\"jolap_comment\" type=\"text\" placeholder=\"comment here\" onblur=\"javascript:ajax_post_jolap_comment();\">
              <input type=\"hidden\"  name=\"comment\" id=\"comment\" value=\"$_POST[comment]\">
            </td>
            <td></td>
            <td></td>
            <td></td>
          </tr>";
      }else{
        echo "<tr>
            <td>মন্তব্য</td>
            <td><input name=\"comment\" type=\"text\" placeholder=\"মন্তব্য করুন\"></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>"; 
      }
      
     ?>
    
    </table>
    <input class="span3" type="hidden" name="pay_method" value="ক্যাশ">
    <?php 
        if($product_count != 0 && $overload == 0){
         echo '<input class="btn btn-info pull-right" type="submit" value="প্রিভিউ" id="new">';
         //print_r($_POST['products']);
        } else {
          echo '<input class="btn btn-info pull-right" type="submit" value="প্রিভিউ" disabled="disabled">';
        }
     ?>
  </form>

   
    
  <script type="text/javascript" src="sell_ajax.js"></script>
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
    
    <script src="js/wysiwyg/wysihtml5-0.3.0.js">
    </script>
    <script src="js/jquery.min.js">
    </script>
    <script src="js/bootstrap.js">
    </script>
    <script src="js/jquery.scrollUp.js">
    </script>
    <script src="js/wysiwyg/bootstrap-wysihtml5.js">
    </script>
    <script src="js/bootstrap-colorpicker.js">
    </script>
    <script type="text/javascript" src="js/date-picker/date.js">
    </script>
    <script type="text/javascript" src="js/date-picker/daterangepicker.js">
    </script>
    <script type="text/javascript" src="js/clockface.js">
    </script>
    <script type="text/javascript" src="js/bootstrap-timepicker.js">
    </script>
    <script type="text/javascript" src="js/jquery.bootstrap.wizard.js">
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
  </body>
</html>