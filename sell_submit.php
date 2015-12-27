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
      <!-- Important. For Theming change primary-color variable in main.css  -->
      <!--[if lte IE 7]>
      <script src="css/icomoon-font/lte-ie7.js"></script>
      <![endif]-->
      <link href="css/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet">
      <link href="css/wysiwyg/wysiwyg-color.css" rel="stylesheet">
      <link href="css/charts-graphs.css" rel="stylesheet">
      <link href="css/clockface.css" rel="stylesheet">
      <link href="css/timepicker.css" rel="stylesheet">
      <script type="text/javascript" src="jquery.js"></script>
      <script type="text/javascript" src="sell_script.js"></script>
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
                      <!-- generate memo no -->
  <?php
    include "convert_number_encoding.php"; 
    require_once "conn.php";?>
  <form action="sell_post.php" method="post" id="form">   
    <input type="hidden" name="date_sold" value="<?php echo $_POST['date_sold']; ?>">
    <input type="text" name="date" value="<?php echo $_POST['date']; ?>">
     <input type="text" name="month" value="<?php echo $_POST['month']; ?>">
     <input type="text" name="year" value="<?php echo $_POST['year']; ?>">
     <br>

    <p>মেমো : <?php echo $_POST['memo_no']; ?></p>
    <br>
    <input type="hidden" name="memo_no" value="<?php echo $_POST['memo_no']; ?>">
    <p>পার্টি : <?php echo @$_POST['company_name']; ?></p>
    <input type="hidden" name="company_name" value="<?php echo $_POST['company_name']; ?>">
    <br>
     <!-- echo product prices -->
     <table class="table table-condensed table-striped table-bordered table-hover no-margin">
      <tr>
        <th>জুতার আইডি</th>
        <th>দর</th>
        <th>পরিমান</th>
        <th>মোট পরিমান</th>
        <th>দাম</th>
      </tr>   
    
    <?php
      $memo_no = $_POST['memo_no'];
      $final_qty = 0 ;
      $qty=@$_POST['qtys'];
      $unit = @$_POST['units'];
      $subtotal_price = @$_POST['subtotal_prices'];
      $raw_price = 0;
      $grand_qty = 0;
      $prices = array(); //unnecessary U=necessary
      if(isset($_POST['products'])){
        foreach($_POST['products'] as $index => $product) {
          echo "<tr>";
          $result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = $product LIMIT 1");
          

          if (@mysqli_num_rows($result)!= 0){
            $row = mysqli_fetch_array($result);
            //echoing xxhiddenxx post inputs
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
            $unit_name = '';
            if ($unit[$index]==12){
              $unit_name = 'dozen(s)';
            } else{
              $unit_name = 'pairs(s)';
            }
            echo "<td>".$qty[$index]."</td>";
            //echoing total qty
            $total_qty = $qty[$index];
            echo "<td>".$total_qty."</td>";
            $grand_qty = $grand_qty + $total_qty ;
            echo "<input name=\"qtys[]\" type=\"hidden\" value = \"".$qty[$index]."\" readonly>";
            echo "<input name=\"units[]\" type=\"hidden\" value = \"".$unit[$index]."\" readonly>";
            //echoing sub total price
            //$subtotal_price = $unit[$index]*$row['retail_price'];
            echo "<td>".$subtotal_price[$index]."</td>";

            echo "<input type=\"hidden\" name=\"subtotal_prices[]\" value=\"".$subtotal_price[$index]."\">";
            array_push($prices, "$subtotal_price[$index]");
            $raw_price = $raw_price + $subtotal_price[$index];
          }else{
            echo "<p>ভুল আইডি দেওয়া হয়েছে!!</p>";
          }
          echo "</tr>";
        }
      } 

      //generating total amount
      $total_price = $_POST['total_price'];
      $grand_total = $total_price;
      
      $comm = $raw_price - $total_price;
      echo "<tr>
          <td></td>
          <td>মোট জোড়া</td>
          <td>$grand_qty</td>
          <td>মোট দাম:</td>
          <td>$raw_price</td>
        </tr>"; 
      echo "<tr>
          <td></td>
          <td></td>
          <td></td>
          <td>কমিশন :</td>
          <td> $comm</td>
        </tr>"; 
      echo "<tr>
          <td></td>
          <td></td>
          <td></td>
          <td>কমিশন বাদে মোট বিল :</td>
          <td> $total_price
          <input name=\"total_price\" value=\"".$total_price."\" type=\"hidden\" ></td>
        </tr>";  

      

      //printing extra cost 
            
      if(isset($_POST['extra_cost'])){
        echo "<tr>
            <td></td>
            <td></td>
            <td>এক্সট্রা খরচ</td>
            <td>".$_POST['extra_cost_descr']."</td>
            <td>".convertToEnglishNumber($_POST['extra_cost'])."</td>
          </tr>";       
        //printing subtotal_1
        $subtotal_1 = $total_price - convertToEnglishNumber($_POST['extra_cost']);
        $grand_total = $subtotal_1;
        echo "<tr>
            <td></td>
            <td></td>
            <td></td>
            <td>মোট :</td>
            <td>".$subtotal_1."</td>
          </tr>";
        echo "<input name=\"extra_cost\" value=\"".convertToEnglishNumber($_POST['extra_cost'])."\" type=\"hidden\" >";
        echo "<input name=\"extra_cost_descr\" value=\"".$_POST['extra_cost_descr']."\" type=\"hidden\" >"; 
      }

      //printing previous due
      $prev_due = null;
      if(isset($_POST['company_name'])){
        $client = $_POST['company_name'];
        $sell_memos_res = mysqli_query($con,"SELECT * FROM sell_memos WHERE company_name = '$client' AND sell_type = 'client' ORDER BY table_index DESC LIMIT 1");
        $memo = mysqli_fetch_array($sell_memos_res);
        $prev_due = $memo['due'];
      }
      //calculating ferot
      $ferot_result = mysqli_query($con, "SELECT * FROM sell_memos WHERE memo_no = '$memo_no' AND sell_type = 'return' ");
      $return_qty = 0;
      $return_amount = 0;
      $subtotal_1 = 0 ;
      if ( mysqli_num_rows($ferot_result) != 0){
        
        while ($ferot = mysqli_fetch_array($ferot_result)){
          $return_qty = $return_qty + $ferot['total_qty'];
          $return_amount = $return_amount + $ferot['grand_total'];
        }
        $return_amount = $return_amount*(-1);
        $return_qty = $return_qty*(-1);
        echo "<tr>
          <td></td>
          <td></td>
          <td>ফেরত=</td>
          <td>$return_qty (জোড়া)</td>
          <td>$return_amount</td></tr>";
         $subtotal_1_1 = $grand_total - $return_amount;
         $grand_total = $subtotal_1_1;
        echo "<tr>
              <td></td>
              <td></td>
              <td></td>
              <td>মোট :</td>
              <td>".$subtotal_1_1."</td>
            </tr>";
      }
      //echo "<p> Previous due :".$prev_due."</p>";
      //grand total
      
      //passing posted variables
      echo "<input name=\"raw_total\" value=\"".$_POST['raw_total']."\" type=\"hidden\" >";
      echo "<input name=\"total_price\" value=\"".$_POST['total_price']."\" type=\"hidden\" >";
      echo "<input name=\"commission\" value=\"".$_POST['commission']."\" type=\"hidden\" >";
      $paid_am = convertToEnglishNumber($_POST['paid']);
      if ($paid_am == null){
        $paid_am = 0;
      }
     ?>
    <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>জমা :</td>
            <td><?php echo $paid_am; ?></td>
          </tr>
    <input name="paid" type="hidden" value="<?php echo convertToEnglishNumber($_POST['paid']); ?>">
    <?php 
      
      $subtotal_1_2 = $grand_total - convertToEnglishNumber($_POST['paid']);
      echo "<tr>
            <td></td>
            <td></td>
            <td></td>
            <td>মোট :</td>
            <td>".$subtotal_1_2."</td>
          </tr>";
      //printing carry cost 
      if(isset($_POST['carry_cost'])){
        echo "<tr>
            <td></td>
            <td></td>
            <td></td>
            <td>পাঠানো খরচ :</td>
            <td>".convertToEnglishNumber($_POST['carry_cost'])."</td>
          </tr>";
        //printing subtotal_2
        $subtotal_2 =  $subtotal_1_2 + convertToEnglishNumber($_POST['carry_cost']);
        $grand_total = $subtotal_2;
        echo "<tr>
            <td></td>
            <td></td>
            <td></td>
            <td>মোট :</td>
            <td>".$subtotal_2."</td>
          </tr>"; 
        echo "<input name=\"carry_cost\" value=\"".convertToEnglishNumber($_POST['carry_cost'])."\" type=\"hidden\" >";
      }

      //generate dues & inputs for dues
      $due = $grand_total + $prev_due;
      $curr_due = $grand_total- convertToEnglishNumber($_POST['paid']);
      echo "<tr>
            <td></td>
            <td></td>
            <td></td>
            <td>আগের বাকী :</td>
            <td>".$prev_due."</td>
          </tr>";
     /* echo "<tr>
            <td></td>
            <td></td>
            <td></td>
            <td>বাকী :</td>
            <td>".$curr_due."</td>
          </tr>";*/
      echo "<tr>
            <td>মন্তব্য:</td>
            <td><input type=\"text\" name=\"comment\" value=\"".$_POST['comment']."\" readonly></td>
            <td></td>
            <td>মোট বাকী :</td>
            <td>".$due."</td>
          </tr>";
      echo "<input name=\"due\" value=\"".$due."\" type=\"hidden\" >";
      echo "<input name=\"curr_due\" value=\"".$curr_due."\" type=\"hidden\" >";
      echo "<input name=\"pay_method\" value=\"".$_POST['pay_method']."\" type=\"hidden\" >";
     ?>
     </table>
     <input class="btn btn-info pull-right" type="submit" value="অনুমোদন" onclick="JavaScript:newPopup('receipt.php?memo_no=<?php echo $_POST['memo_no'];?>');">
    
  </form>
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
<script type="text/javascript" src="sell_ajax.js"></script>
<script type="text/javascript" src="print_receipt.js"></script>
</body>
</html>