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
     <link rel="icon" type="image/ico" href="img/ico/favicon.ico"></link>
    <!--[if lte IE 7]>
    <script src="css/icomoon-font/lte-ie7.js">
    </script>
    <![endif]-->
    <link href="css/main.css" rel="stylesheet"> <!-- Important. For Theming change primary-color variable in main.css  -->
    <link href="css/hover-img.css" rel="stylesheet">
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
                <a href="#" class="heading">ইনভেন্টরি</a>
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
                      <a id="dynamicTable">ইনভেন্টরি</a>

                    </div> 
                    <a class="pull-right label" href="inventory_table/inventory_db.php">এডিট</a>
                  </div>
                  <div class="widget-body">
                <a href="inventory_view.php" class="btn btn-info pull-right">রিফ্রেশ</a>
                    <div id="dt_example" class="example_alt_pagination">
                      <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
                        
                        <thead>
                          <tr>
                            <th style="width:17%">
                              ফ্যাক্টরি
                            </th>
                            <th style="width:20">
                              আইডি
                            </th>
                            <th style="width:16%">
                              বিবরণ     
                            </th>
                            <th style="width:16%" class="hidden-phone">
                              পরিমাণ 
                            </th>
                            <th style="width:16%" class="hidden-phone">
                              গায়ের দাম 
                            </th>
                            <th style="width:16%" class="hidden-phone">
                              ডজনের দাম 
                            </th>
                            <th style="width:16%" class="hidden-phone">
                              মোট দাম 
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            require_once "conn.php";
                            $total_types = 0;
                            $total_pairs = 0;
                            $total_cp = 0;
                            // $ = $ + $ ; //adder format
                            $inventory_res = mysqli_query($con,"SELECT * FROM inventory");
                            while($inv_row = mysqli_fetch_array($inventory_res)){
                              $pid = $inv_row['pid'];
                              $image = $inv_row['image'];
                              //get description
                              //getting design info 
                              $genre_name = '';
                              $genre = substr($pid, 3,1);
                              if ($genre == 1) {
                                $genre_name = 'জেঃ' ;
                              } else if ($genre == 2) {
                                $genre_name = 'লেঃ';
                              } else if ($genre == 3) {
                                $genre_name = 'সু';
                              } else if ($genre == 4) {
                                $genre_name = 'বেবি';
                              } else{}

                              $type_code = substr($pid, 4,2);
                              $type_code = (int)$type_code;
                              $type_result = mysqli_query($con,"SELECT * FROM inventory_config_types WHERE genre = '$genre' AND serial_no = '$type_code' LIMIT 1");                
                              $type_val = mysqli_fetch_array($type_result) ;
                              $type_name = $type_val['type'];

                              $color_code = substr($pid, 6,2);
                              $color_code = (int)$color_code ;
                              $color_result = mysqli_query($con,"SELECT * FROM inventory_config_colors WHERE serial_no = '$color_code' LIMIT 1");               
                              $color_val = mysqli_fetch_array($color_result) ;
                              $color_name = $color_val['color'];

                              $design_code = substr($pid, 8,3);

                              $descr = "$genre_name $type_name $color_name";
                              //echo finally
                              $total_price = $inv_row['cost_price']*$inv_row['total_qty']/12;
                              echo "<tr class=\"gradeX warning\">
                                      <td>
                                        $inv_row[factory_name]
                                      </td>
                                      <td>
                                      <a href=\"$image\" class=\"pids\" id=\"button-$pid\" onclick=\"newPopup('$image');\" onmouseover=\"Controls.init('button-$pid');\">$pid</a>      
                                      </td>
                                      <td>
                                        $descr
                                      </td>
                                      <td class=\"hidden-phone\">
                                        $inv_row[total_qty]
                                      </td>
                                      <td class=\"hidden-phone\">
                                        $inv_row[retail_price]
                                      </td>
                                      <td class=\"hidden-phone\">
                                        $inv_row[cost_price]
                                      </td>
                                      <td class=\"hidden-phone\">
                                        $total_price
                                      </td>
                                    </tr>";
                              $total_cp = $total_cp + $total_price ;
                              $total_pairs = $total_pairs + $inv_row["total_qty"] ;
                              $total_types++;
                            }
                           ?>
                           <!-- commented sample table row
                          <tr class="gradeX warning">
                            <td>
                              December
                            </td>
                            <td>
                              14.7 %
                            </td>
                            <td>
                              31.1 %
                            </td>
                            <td class="hidden-phone">
                              46.9 %
                            </td>
                            <td class="hidden-phone">
                              4.2 %
                            </td>
                          </tr> =-->
                          
                          
                        </tbody>
                      </table>
                       <!-- comment 
                      <div style="position:absolute; top:0; left:0; "><img src="<?php echo $image; ?>" alt="something"></div>
                      -->
                      <div class="clearfix">
                        <div class="widget">
                          <?php echo "<span class=\"btn\">মোট এন্ট্রি : ($total_types) টি </span> <span class=\"btn btn-inverse\"> মোট জোড়া : ($total_pairs) টি </span> <span class=\"btn\">মোট দাম : $total_cp ৳</span>"; ?>
                        </div>
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
    <script src="js/jquery.dataTables.js"></script>
      <script src="imageTooltip.js"></script>
    </body>
    </html>