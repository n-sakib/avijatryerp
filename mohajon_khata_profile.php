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
      খাতার তালিকা | অভিযাত্রী সুজ
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
  <link href="css/profile_table.css" rel="stylesheet">
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
          selected('baki_khata');
         ?>
        </div>
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
              <div class="span12">
                <div class="row-fluid">
                  <div class="span12">
                    <div class="widget">
                      <div class="widget-header">
                        <div class="header">
                          <?php
                      require_once "conn.php";
                      $factory_name = $_GET['factory'];

                    $query = mysqli_query($con,"SELECT * FROM factories WHERE factory_name = '$factory_name' ");
                      echo"<h2>";  
                      $row = mysqli_fetch_array($query);
                        echo "$row[factory_name]";
                            
                      echo"</h2>";
                      
                       ?></div>
                    <a class="pull-right label label-info" href="mohajon_shabek.php?factory=<?php echo $factory_name ?>">সাবেক যোগ</a> 
                    <a class="pull-right label" href="inventory_table/purchase_memo.php">এডিট</a>
                    <a class="pull-right label label-warning" href="edit_cp.php?factory=<?php echo $factory_name; ?>">এডিট কেনা দাম</a>
                      </div>
                      <div class="widget-body">
                        <div class="thumbnail">
                          <img src="<?php echo mb_convert_encoding($row['photo'], "HTML-ENTITIES", "iso-8859-1"); ?>" alt=<?php echo $factory_name; ?>  onclick="newPopup('<?php echo mb_convert_encoding($row['photo'], "HTML-ENTITIES", "iso-8859-1"); ?>');">
                        </div>
                        <div class="row-fluid">
                          <div class="profile">
                          <table class="head">
                            
                            <tr>
                              <th style=>ঠিকানা</th>
                              <td style=>
                                <?php
                                  require_once "conn.php";
                                  $factory_name = $_GET['factory'];
                                  $query = mysqli_query($con,"SELECT * FROM factories WHERE factory_name = '$factory_name' ");
                                  $row = mysqli_fetch_array($query);
                                  echo "$row[address]";?>
                              </td>
                              
                            </tr>
                            <tr>
                              <th>ফোন/মোবাইল</th>
                              <td >
                                <?php
                                  require_once "conn.php";
                                  $factory_name = $_GET['factory'];
                                  $query = mysqli_query($con,"SELECT * FROM factories WHERE factory_name = '$factory_name' ");
                                  $row = mysqli_fetch_array($query);
                                  echo "$row[phone]";?>
                              </td>
                              
                            </tr>
                            
                          </table>
                        </div>
                          <table class="table table-bordered table-striped new_table">
                            
                              <tr>
                            <th>তারিখ</th>
                            <th>মালের বিবরণ</th>
                            <th>পরিমাণ (জোড়া)</th>
                            <th>গায়ের দাম</th>
                            <th>ডজন দাম</th>
                            <th>মোট দাম</th>
                            <th>তাগাদা</th>
                            <th>ব্যালেন্স</th>
                            <th>মন্তব্য</th>
                          </tr>
                          <?php
                            $factory = $_GET['factory'];
                            require_once "conn.php";
                            

                            $purchase_result = mysqli_query($con,"SELECT * FROM purchase_memos WHERE factory_name = '$factory'");
                            $final_qty =0;
                            $final_cost =0;
                            $final_paid=0;
                            $final_balance=0;



                            while($purchase = mysqli_fetch_array($purchase_result)){

                              //$purchase_type = $purchase["purchase_type"];
                              $count = 0;
                              $comment_string = "";
                              $result = mysqli_query($con,"SELECT * FROM purchases WHERE factory_name = '$factory' AND memo_no = '$purchase[memo_no]'");
                              while($row = mysqli_fetch_array($result)){
                                $count++;
                                $inventory_result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = '$row[pid]' LIMIT 1");               
                                $inventory = mysqli_fetch_array($inventory_result) ;

                                $memo_result = mysqli_query($con,"SELECT * FROM purchase_memos WHERE memo_no = '$row[memo_no]'");               
                                $memo = mysqli_fetch_array($memo_result) ;
                                $comment_string = $memo['comment'];
                                //getting description
                                $genre = '';
                                if ($inventory['genre'] == 1) {
                                  $genre = 'জেন্টস' ;
                                } else if ($inventory['genre'] == 2) {
                                  $genre = 'লেডিস';
                                } else if ($inventory['genre'] == 3) {
                                  $genre = 'সু';
                                } else if ($inventory['genre'] == 4) {
                                  $genre = 'বেবি';
                                } else{}

                                $type_result = mysqli_query($con,"SELECT * FROM inventory_config_types WHERE genre = '$inventory[genre]' AND serial_no = '$inventory[type]' LIMIT 1");                
                                $type = mysqli_fetch_array($type_result) ;
                                $type_name = $type['type'];

                                $color_result = mysqli_query($con,"SELECT * FROM inventory_config_colors WHERE serial_no = '$inventory[color]' LIMIT 1");               
                                $color = mysqli_fetch_array($color_result) ;
                                $color_name = $color['color'];

                                $description = "$genre $type_name $color_name";

                                

                                //echo "<tr>$description</tr>";
                                //echoing table 

                                if($row['qty'] >= 0 || $row["pid"] == "shabek"){  //is a purchase, not return   
                                  //total price
                                  $total_cost = $row['cost_price']*$row['total_qty']/12; 
                                  
                                  $final_qty =$final_qty+$row['total_qty'];
                                  $final_cost =$final_cost+$total_cost;
                                  $final_paid=$final_paid+$row['paid'];   


                                  if($row["pid"] == "shabek") //shabek
                                  {
                                    $description ="সাবেক";
                                    $final_qty =$final_qty-$row['total_qty']; 
                                    $row["total_qty"] = 0;// 1 default
                                    $total_cost = $purchase["grand_total"];

                                    $final_cost =$final_cost+$purchase['grand_total'];
                                    $final_paid =$final_paid+$purchase['paid'];
                                    //final balance from due

                                    $row["paid"] = $purchase["paid"];
                                  }     
                                  echo "<tr>
                                        <td>$row[date_bought]</td>
                                        <td><a href=\"#\" title=\"$row[pid]\">$description</a></td>
                                        <td>$row[total_qty]</td>
                                        <td>$inventory[retail_price]</td>
                                        <td>$row[cost_price]</td>
                                        <td>$total_cost</td>
                                        <td>$row[paid]</td>";
                                 
                                      //<td>$row[due]</td>
                                } else {
                                    echo "<tr>
                                        <td>$row[date_bought]</td>
                                        <td>$description</td>
                                        <td>$row[total_qty]  (ফেরত)</td>
                                        <td></td>
                                        <td></td>
                                        <td>$row[total_price]</td>
                                        <td></td>";
                                  }
                                $rows = mysqli_num_rows($result);

                                //সাবেক
                                // if($purchase_type == "shabek")
                                // {
                                //   echo "<tr>
                                //         <td>$purchase[date_bought]</td>
                                //         <td>সাবেক</td>
                                //         <td></td>
                                //         <td></td>
                                //         <td></td>
                                //         <td>$purchase[grand_total]</td>
                                //         <td></td>";
                                // }

                                if ($count == $rows){
                                  $final_balance=$row['due'];
                                  echo  "<td>$row[due]</td>
                                         <td>$comment_string</td>                
                                       </tr>";
                                } else{
                                  echo  "<td></td>
                                        <td></td>                
                                  </tr>";
                                }
                              /*echo "<tr>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td>কমেন্ট</td>
                                      <td>$purchase[comment]</td>
                                      <td>total</td>
                                      <td>$memo[grand_total]</td> 
                                        <td></td>
                                        <td></td>                 
                                    </tr>";    */
                              } //end of while
                                
                                 
                          /*  echo "<tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>কমেন্ট</td>
                                    <td>$purchase[comment]</td>
                                    <td>total</td>
                                    <td>$memo[grand_total]</td>                 
                                  </tr>";
                            /*echo "<tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>baki</td>
                                    <td>$memo[due]</td>                 
                                  </tr>";*/
                            }   
                            echo "<tr>
                                        <td></td>
                                        <td></td>
                                        <td>মোট=$final_qty</td>
                                        <td></td>
                                        <td></td>
                                        <td>মোট=$final_cost</td>
                                        <td>মোট=$final_paid</td>
                                        <td>মোট=$final_balance</td>
                                        <td></td></tr>";  
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
    </script>
    <script src="popUp.js"></script>
  </body>
</html>