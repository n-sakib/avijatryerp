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
      গোডাউন সম্পর্কিত তথ্য | অভিযাত্রী সুজ
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
  <link href="css/new_table.css" rel="stylesheet">
  <link href="css/charts-purchase.css" rel="stylesheet">
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
          //getting posted values
          $genres = $_POST['genres'];
          $type = $_POST['types'];
          $color = $_POST['colors'];
          $qty = $_POST['qtys'];
          $design = $_POST['designs'];
          $pid = $_POST['pids'];
          //$avaiable = @$_POST['available'];
          $image = $_POST['images'];
          $retail_price = $_POST['retail_prices'];
          $cost_price = $_POST['cost_prices'];

          include 'top_nav.php';
          selected('purchase');
         ?>
       </div>
       <?php 

    require_once "conn.php";

    $result = mysqli_query($con,"SELECT * FROM purchase_memos ORDER BY table_index DESC LIMIT 1");
    $memo_no = null;
    if(mysqli_num_rows($result)!=0){
      $row = mysqli_fetch_array($result);
      $last = $row['memo_no'];
      $memo_no = $last + 1;
    } else{ $memo_no = 1;}?>
        <div class="sub-nav">
          <ul>
            <li>
              <a href="#" class="heading">গোডাউন</a>
            </li>
            <li>
              <a href="purchase.php">
                মাল ক্রয়
              </a>
            </li>
            <li>
              <a href="new_factory.php">
                নতুন কারখানা যোগ করুন
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
                      নতুন মালের তালিকা তৈরি করুন 
                      <span class="mini-title">
                        নতুন মালের সাধারণ ফরম
                      </span>
                    </div>
                    
                  </div>
                  <div class="widget-body">
                    <form action="purchase_post.php" method="post">
        <label for="memo_no">মেমো :<?php echo $_POST['memo_no']; ?></label>
        <input name="memo_no" type="hidden" value="<?php echo $_POST['memo_no']; ?>">
        <br>
        <label for="factory_name">কারখানা : <?php echo $_POST['factory_name']; ?></label>
        <input name="factory_name" type="hidden" value="<?php echo $_POST['factory_name']; ?>"
        <!-- table of products -->
        <div class="table">
          <table  cellpadding="1" class="table-condensed table-striped table-bordered table-hover no-margin new table">
            <tr>
              <th style="width:4%;">ক্রমিক#</th>
              <th>বিবরণ</th>
              <th>পরিমাণ(জোড়া)</th>
              <th>গায়ের দাম</th>
              <th>মূল্য</th>
              <th>সাব টোটাল</th>
            </tr>

            <?php 
              require "conn.php"; 
              //getting posted values
              $genres = $_POST['genres'];
              $type = $_POST['types'];
              $color = $_POST['colors'];
              $qty = $_POST['qtys'];
              $design = $_POST['designs'];
              $pid = $_POST['pids'];
              $image = $_POST['images'];
              $retail_price = $_POST['retail_prices'];
              $cost_price = $_POST['cost_prices'];
              
              $prices = array();
              $raw_total = null;
              foreach($genres as $index =>
                    $genre){
                $serial = $index+1;
                $subtotal = $cost_price[$index]*$qty[$index]/12;

                //getting design info 
                $genre_name = '';
                if ($genre == 1) {
                  $genre_name = 'জেঃ' ;
                } else if ($genre == 2) {
                  $genre_name = 'লেঃ';
                } else if ($genre == 3) {
                  $genre_name = 'সু';
                } else if ($genre == 4) {
                  $genre_name = 'বেবি';
                } else{}

                $type_result = mysqli_query($con,"SELECT * FROM inventory_config_types WHERE genre = '$genre' AND serial_no = '$type[$index]' LIMIT 1");                
                $type_val = mysqli_fetch_array($type_result) ;
                $type_name = $type_val['type'];

                $color_result = mysqli_query($con,"SELECT * FROM inventory_config_colors WHERE serial_no = '$color[$index]' LIMIT 1");               
                $color_val = mysqli_fetch_array($color_result) ;
                $color_name = $color_val['color'];

                $description = "$genre_name $type_name $color_name";
                //echo "<tr>$description</tr>";
                //echoing row
                 echo "
                    <tr>
                      <td>".$serial."</td>
                      <td>
                        $description
                        <input type=\"hidden\" name=\"genres[]\" value =\"".$genre."\">
                        <input type=\"hidden\" name=\"types[]\"  value =\"".$type[$index]."\">
                        <input type=\"hidden\" name=\"colors[]\"  value =\"".$color[$index]."\">
                        <input type=\"hidden\" name=\"designs[]\"  value =\"".$design[$index]."\">
                        <input type=\"hidden\" name=\"pids[]\"  value =\"".$pid[$index]."\">
                        <input type=\"hidden\" name=\"images[]\"  value =\"".@$image[$index]."\"></td>
                      <td>
                        <label>$qty[$index]</label>
                        <input type=\"hidden\" name=\"qtys[]\"  value =\"".$qty[$index]."\"></td>
                      <td>
                        <label>$retail_price[$index]</label>
                        <input type=\"hidden\" name=\"retail_prices[]\"  value =\"".$retail_price[$index]."\"></td>
                      <td>
                        <label>$cost_price[$index]</label>
                        <input type=\"hidden\" name=\"cost_prices[]\"  value =\"".$cost_price[$index]."\"></td>
                      <td>
                        <label>$subtotal</label>
                        <input type=\"hidden\" name=\"subtotals[]\"  value =\"".$subtotal."\"></td>
                    </tr>
                    ";
                    array_push($prices, "$subtotal");
              }
              //calculating total
              foreach ($prices as $price) {
                $raw_total = $raw_total + $price;
              }
              ?>
            <!-- post calculations -->
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>মোট</td>
              <td>
                <label><?php echo $raw_total; ?></label>
                <input type="hidden" name="subtotals[]"  value ="<?php echo $raw_total; ?>"></td>
            </tr>
            <?php 
              require_once "conn.php";
                //printing previous due
              $prev_due = null;
              if(isset($_POST['factory_name'])){
                $client = $_POST['factory_name'];
                $result = mysqli_query($con,"SELECT * FROM purchases WHERE factory_name = '$client'  ORDER BY table_index DESC LIMIT 1");
                $row = @mysqli_fetch_array($result);
                $prev_due = $row['due'];
              }
                  $total_amount= $raw_total+$prev_due;
               ?>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>সাবেক</td>
              <td>
                <?php echo $prev_due; ?></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>সাবেক সহ মোট</td>
              <td>
                <?php echo $total_amount; ?></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>জমা</td>
              <td>
                <?php echo $_POST['paid']; ?>
                <input type="hidden" name="paid" value="<?php echo $_POST['paid']; ?>"></td>
            </tr>
            <?php 
                //calculating dues
                $curr_due = $raw_total - $_POST['paid'];
                $due = $curr_due + $prev_due;
               ?>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>বাকি</td>
              <td>
                <?php echo $due; ?>
                <input type="hidden" name="due" value="<?php echo $due; ?>">
                <input type="hidden" value="<?php echo $curr_due ; ?>" name="curr_due" >
              </td>
            </tr>
            </table>
        </div>

        <input class="btn btn-info pull-right" type="submit" value="অনুমোদন" onclick="javascript:newPopup('pid_print.php?memo_no=<?php echo $memo_no; ?>');">

        <div>
          <p id="type"></p>
        </div>
      </form>                    
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
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
    
    <!-- Google Visualization JS -->
    <script type="text/javascript" src="https://www.google.com/jsapi">
    </script>
    
    <!-- Easy Pie Chart JS -->
    <script src="js/jquery.easy-pie-chart.js">
    </script>
    
    <!-- Sparkline JS -->
    <script src="js/jquery.sparkline.js">
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

      $(document).ready(function () {
        pie_chart();
        sparkline_purchase();
      });

      function pie_chart() {
        $(function () {
          //create instance
          $('.chart1').easyPieChart({
            animate: 2000,
            barColor: '#74b749',
            trackColor: '#dddddd',
            scaleColor: '#74b749',
            size: 180,
            lineWidth: 5,
          });
          //update instance after 5 sec
          setTimeout(function () {
            $('.chart1').data('easyPieChart').update(50);
          }, 5000);
          setTimeout(function () {
            $('.chart1').data('easyPieChart').update(70);
          }, 10000);
          setTimeout(function () {
            $('.chart1').data('easyPieChart').update(30);
          }, 15000);
          setTimeout(function () {
            $('.chart1').data('easyPieChart').update(90);
          }, 19000);
          setTimeout(function () {
            $('.chart1').data('easyPieChart').update(40);
          }, 32000);
        });

        $(function () {
          //create instance
          $('.chart2').easyPieChart({
            animate: 2000,
            barColor: '#ed6d49',
            trackColor: '#dddddd',
            scaleColor: '#ed6d49',
            size: 180,
            lineWidth: 5,
          });
          //update instance after 5 sec
          setTimeout(function () {
            $('.chart2').data('easyPieChart').update(90);
          }, 10000);
          setTimeout(function () {
            $('.chart2').data('easyPieChart').update(40);
          }, 18000);
          setTimeout(function () {
            $('.chart2').data('easyPieChart').update(70);
          }, 28000);
          setTimeout(function () {
            $('.chart2').data('easyPieChart').update(50);
          }, 32000);
          setTimeout(function () {
            $('.chart2').data('easyPieChart').update(80);
          }, 40000);
        });

        $(function () {
          //create instance
          $('.chart3').easyPieChart({
            animate: 2000,
            barColor: '#0daed3',
            trackColor: '#dddddd',
            scaleColor: '#0daed3',
            size: 180,
            lineWidth: 5,
          });
          //update instance after 5 sec
          setTimeout(function () {
            $('.chart3').data('easyPieChart').update(20);
          }, 9000);
          setTimeout(function () {
            $('.chart3').data('easyPieChart').update(59);
          }, 20000);
          setTimeout(function () {
            $('.chart3').data('easyPieChart').update(38);
          }, 35000);
          setTimeout(function () {
            $('.chart3').data('easyPieChart').update(79);
          }, 49000);
          setTimeout(function () {
            $('.chart3').data('easyPieChart').update(96);
          }, 52000);
        });

        $(function () {
          //create instance
          $('.chart4').easyPieChart({
            animate: 2000,
            barColor: '#ffb400',
            trackColor: '#dddddd',
            scaleColor: '#ffb400',
            size: 180,
            lineWidth: 5,
          });
          //update instance after 5 sec
          setTimeout(function () {
            $('.chart4').data('easyPieChart').update(40);
          }, 6000);
          setTimeout(function () {
            $('.chart4').data('easyPieChart').update(67);
          }, 14000);
          setTimeout(function () {
            $('.chart4').data('easyPieChart').update(43);
          }, 23000);
          setTimeout(function () {
            $('.chart4').data('easyPieChart').update(80);
          }, 36000);
          setTimeout(function () {
            $('.chart4').data('easyPieChart').update(66);
          }, 41000);
        });


        $(function () {
          //create instance
          $('.chart5').easyPieChart({
            animate: 3000,
            barColor: '#F63131',
            trackColor: '#dddddd',
            scaleColor: '#F63131',
            size: 180,
            lineWidth: 5,
          });
          //update instance after 5 sec
          setTimeout(function () {
            $('.chart5').data('easyPieChart').update(30);
          }, 9000);
          setTimeout(function () {
            $('.chart5').data('easyPieChart').update(87);
          }, 19000);
          setTimeout(function () {
            $('.chart5').data('easyPieChart').update(28);
          }, 27000);
          setTimeout(function () {
            $('.chart5').data('easyPieChart').update(69);
          }, 39000);
          setTimeout(function () {
            $('.chart5').data('easyPieChart').update(99);
          }, 47000);
        });


      }


      function sparkline_purchase() {
        $(function () {
          $('#stock-graph').sparkline('html', {
            type: 'bar',
            barColor: '#0daed3',
            barWidth: 7,
            height: 38,
          });
        });
      }


      google.load("visualization", "1", {
        packages: ["corechart"]
      });

      $(document).ready(function () {
        drawChart1();
        drawChart2();
        drawChart3();
        drawChart4();
      })

      function drawChart1() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Google+', 'Facebook'],
          ['2009', 4000, 900],
          ['2010', 970, 1460],
          ['2011', 1660, 520],
          ['2012', 1030, 540]
        ]);

        var options = {
          width: 'auto',
          lineWidth: 1,
          height: '160',
          backgroundColor: 'transparent',
          colors: ['#74b749', '#0daed3', '#ed6d49', '#ffb400', '#f63131'],
          tooltip: {
            textStyle: {
              color: '#666666',
              fontSize: 11
            },
            showColorCode: true
          },
          legend: {
            textStyle: {
              color: 'black',
              fontSize: 12
            }
          },
          chartArea: {
            left: 40,
            top: 10,
            height: "80%"
          }
        };

        var chart = new google.visualization.AreaChart(document.getElementById('area_chart'));
        chart.draw(data, options);
      }




      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Week', 'Visitors', 'Orders'],
          ['Sun', 9709, 761],
          ['Mon', 1367, 8631],
          ['Tue', 6792, 971],
          ['Wed', 1267, 7491],
          ['Thu', 9539, 1792],
          ['Fri', 670, 9367],
          ['Sat', 9761, 709]
        ]);

        var options = {
          width: 'auto',
          height: '160',
          backgroundColor: 'transparent',
          colors: ['#ed6d49', '#0daed3'],
          tooltip: {
            textStyle: {
              color: '#666666',
              fontSize: 11
            },
            showColorCode: true
          },
          legend: {
            textStyle: {
              color: 'black',
              fontSize: 12
            }
          },
          chartArea: {
            left: 100,
            top: 10
          },
          focusTarget: 'category',
          hAxis: {
            textStyle: {
              color: 'black',
              fontSize: 12
            }
          },
          vAxis: {
            textStyle: {
              color: 'black',
              fontSize: 12
            }
          },
          pointSize: 6,
          chartArea: {
            left: 60,
            top: 10,
            height: '80%'
          },
          lineWidth: 1,
        };

        var chart = new google.visualization.LineChart(document.getElementById('line_chart'));
        chart.draw(data, options);
      }


      function drawChart3() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Visitors', 'Orders', 'Income', 'Expenses'],
          ['2007', 300, 800, 900, 300],
          ['2008', 1170, 860, 1220, 564],
          ['2009', 260, 1120, 2870, 2340],
          ['2010', 1030, 540, 3430, 1200],
          ['2011', 200, 700, 1700, 770],
          ['2012', 1170, 2160, 3920, 800], ]);

        var options = {
          width: 'auto',
          height: '160',
          backgroundColor: 'transparent',
          colors: ['#ed6d49', '#0daed3', '#ffb400', '#74b749', '#f63131'],
          tooltip: {
            textStyle: {
              color: '#666666',
              fontSize: 11
            },
            showColorCode: true
          },
          legend: {
            textStyle: {
              color: 'black',
              fontSize: 12
            }
          },
          chartArea: {
            left: 60,
            top: 10,
            height: '80%'
          },
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('column_chart'));
        chart.draw(data, options);
      }

      function drawChart4() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Eat', 2],
          ['Work', 10],
          ['Commute', 2],
          ['Read', 2],
          ['Sleep', 8]
        ]);

        var options = {
          width: 'auto',
          height: '160',
          backgroundColor: 'transparent',
          colors: ['#ed6d49', '#74b749', '#0daed3', '#ffb400', '#f63131'],
          tooltip: {
            textStyle: {
              color: '#666666',
              fontSize: 11
            },
            showColorCode: true
          },
          legend: {
            position: 'left',
            textStyle: {
              color: 'black',
              fontSize: 12
            }
          },
          chartArea: {
            left: 0,
            top: 10,
            width: "100%",
            height: "100%"
          }
        };

        var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
        chart.draw(data, options);
      }
    </script>
    <script language="JavaScript" type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript" src="purchase_script.js"></script>
  <script type="text/javascript" src="purchase_ajax.js"></script>
  <script type="text/javascript" src="print_receipt.js"></script>
  <script type="text/javascript">
    setTimeout(location.reload(1),2000);
    setTimeout(funtion(){console.log("something");},2000);
  </script>
  </body>
</html>