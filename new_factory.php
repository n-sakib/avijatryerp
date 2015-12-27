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
          include 'top_nav.php';
          selected('purchase');
         ?>
       </div>
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
                      নতুন কারখানার প্রোফাইল তৈরি করুন 
                      <span class="mini-title">
                        নতুন প্রোফাইলের সাধারণ ফরম
                      </span>
                    </div>
                    <a class="pull-right label" href="inventory_table/factories.php">এডিট</a>
                    
                  </div>
                  <div class="widget-body">
                    <?php 
      $success = 'success';
      if(isset($_GET['msg'])){
        if ($_GET['msg']== $success){
          echo '<p class="msg"><h1>কারখানার নাম যুক্ত হয়েছে</h1></p>';
        } else{
          echo '<p class="msg"><h1>নামের ঘরটি পূরণ করুন</h1></p>';
        }}
     ?>
                    
                    <form class="form-horizontal no-margin" action="add_new_factory.php" method="post" enctype="multipart/form-data">
                      <div class="control-group">
                        <label class="required control-label" for="factory_name">
                          কারখানার নাম
                        </label>
                        <div class="controls controls-row">
                          <input name="factory_name" class="span6" type="text" id="factory_name" onchange="javascript:ifDuplic('factory_name','factory_name','factories');" placeholder="কারখানার নাম দিন">
                          
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label" for="address">
                          ঠিকানা
                        </label>
                        <div class="controls">
                          <input type="text" name="address" class="span6"   />
                          <span class="help-inline ">
                            ঠিকানা দিন
                          </span>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label" for="photo">
                          ছবি
                        </label>
                        <div class="controls">
                          <input class="btn btn-info" type="file" name="image" class="span6"  />
                          <span class="help-inline ">
                            ছবি আপলোড করুন
                          </span>
                        </div>
                      </div>
                      <div class="control-group">
                      <label class="control-label" for="phone">
                          ফোন/মোবাইল
                        </label>
                        <div class="controls">
                          <input type="text" name="phone" class="span6"   />
                          <span class="help-inline ">
                            কন্টাক্ট নং দিন
                          </span>
                        </div>
                      </div>
                      
                      

                      
                      
                      
                      <div class="form-actions no-margin">
                        <button type="submit" class="button btn btn-info pull-right" id="submit">
                          প্রোফাইল অনুমোদন
                        </button>
                        <div class="clearfix">
                        </div>
                      </div>
                      
                    </form>
                    
                  </div>
                  <?php 
    require_once 'conn.php';
    $result = mysqli_query($con,"SELECT * FROM clients");
   ?>
   <div>
    
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
          scrollText: 'উপরে যান', // Text for element
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
    <script type="text/javascript" src="validate_duplicate_ajax.js"></script>
  </body>
</html>