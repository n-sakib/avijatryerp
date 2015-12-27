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
                      $client_name = $_GET['client'];

                    $query = mysqli_query($con,"SELECT * FROM clients WHERE company_name = '$client_name' LIMIT 1");
                      echo"<h2>";
                      $row = mysqli_fetch_array($query);
                        echo "$row[company_name]";
                            
                      echo"</h2>";
                      
                       ?>
                      
                          </div> 
                    <a class="pull-right label" href="inventory_table/sell_memo.php">এডিট</a>
                        
                      </div>
                      <div class="widget-body">
                        <div class="thumbnail">
                          <img src="<?php echo mb_convert_encoding($row['photo'], "HTML-ENTITIES", "iso-8859-1"); ?>"alt="<?php echo $client_name; ?>" onclick="newPopup('<?php echo mb_convert_encoding($row['photo'], "HTML-ENTITIES", "iso-8859-1"); ?>');">
                          <!--<img alt="250x150" src="img/clients/<?php $some = utf8_encode($client_name);utf8_decode($some);echo $some ?>                        
                          .jpg">
                          <div class="caption">
                            <a href="#" data-type="text" data-pk="1" data-original-title="Edit your Nick Name" class="editable editable-click inputText" style="margin-bottom: 10px;">
                              <?php echo $_GET['client']; ?></a>

                          </div>-->
                        </div>
                        
                        <div class="profile">
                          <table class="head">
                
                              
                          
                            <tr>
                              <th>ঠিকানা</th>
                              <td><?php
                      require_once "conn.php";
                      $client_name = $_GET['client'];

                    $query = mysqli_query($con,"SELECT * FROM clients WHERE company_name = '$client_name' ");
                        
                      $row = mysqli_fetch_array($query);
                        echo "$row[address]";
                            
                      
                      
                       ?></td>
                              
                            </tr>
                            <tr>
                              <th>ফোন/মোবাইল</th>
                              <td><?php
                      require_once "conn.php";
                      $client_name = $_GET['client'];

                    $query = mysqli_query($con,"SELECT * FROM clients WHERE company_name = '$client_name' ");
                        
                      $row = mysqli_fetch_array($query);
                        echo "$row[phone]";
                            
                      
                      
                       ?></td>
                              
                            </tr>
                            <tr>
                              <th>চেক নং</th>
                              <td><?php
                      require_once "conn.php";
                      $client_name = $_GET['client'];

                    $query = mysqli_query($con,"SELECT * FROM clients WHERE company_name = '$client_name' ");
                        
                      $row = mysqli_fetch_array($query);
                        echo "$row[check_no]";
                            
                      
                      
                       ?></td>
                              
                            </tr>
                            <tr>
                              <th>স্ট্যাম্প নং</th>
                              <td><?php
                      require_once "conn.php";
                      $client_name = $_GET['client'];

                    $query = mysqli_query($con,"SELECT * FROM clients WHERE company_name = '$client_name' ");
                        
                      $row = mysqli_fetch_array($query);
                        echo "$row[stamp_no]";
                            
                      
                      
                       ?></td>
                              
                            </tr>
                            <tr>
                              <th>জাতীয় পরিচয়পত্র নং</th>
                              <td><?php
                      require_once "conn.php";
                      $client_name = $_GET['client'];

                    $query = mysqli_query($con,"SELECT * FROM clients WHERE company_name = '$client_name' ");
                        
                      $row = mysqli_fetch_array($query);
                        echo "$row[n_id]";
                            
                      
                      
                       ?></td>
                              
                            </tr>
                          </table>
                        </div>
                      
                          <table class="table table-striped table-bordered no-margin new_table">
                              <tr>
                                <th>তারিখ</th>
                                <th>মেমো</th>
                                <th>জোড়া</th>
                                <th>গায়ের দামে</th>
                                <th>কমিশন বাদে দাম</th>
                                <th>পাঠানো খরচ</th>
                                <th>মাল ফেরত</th>
                                <th>ফেরত বাবদ</th>
                                <th>এক্সট্রা খরচ</th>
                                <th>জমা</th>
                                <th>ব্যালেন্স</th>
                                <th>মন্তব্য</th>
                              </tr>
                              <?php 
                                $client = $_GET['client'];
                                require_once "conn.php";

                                $gayer_dam_mot=0;

                                $grand_price = 0;
                                $grand_qty = 0;
                                $grand_due = 0;
                                $grand_paid = 0;
                                $due_perce_num = 0;
                                $due_perce_den = 0;
                                $sell_memos_result = mysqli_query($con,"SELECT * FROM sell_memos WHERE company_name = '$client' ");
                                
                                while($sell_memos = mysqli_fetch_array($sell_memos_result)){
                                  
                                  //getting some datas from sells
                                  $total_rprice = 0;
                                  $sells_result = mysqli_query($con,"SELECT * FROM sells WHERE memo_no = '$sell_memos[memo_no]' ");
                                  while($sells = mysqli_fetch_array($sells_result)){
                                    $total_rprice = $total_rprice + $sells['total_price'];
                                  }
                                  if ($sell_memos['sell_type']=='client'){

                                    $gayer_dam_mot = $gayer_dam_mot + $total_rprice;
                                    $editSp = "";
                                    if($sell_memos["comment"]=="সাবেকের জন্য তাগাদা")
                                    {
                                      $editSp = "<span class=\"pull-right\"><a href=\"edit_sp.php?memo_no=$sell_memos[memo_no]\">~</a></span>";
                                    }
                                    echo "<tr>
                                          <td>$sell_memos[date_sold]</td>
                                          <td><a href=\"receipt.php?memo_no=$sell_memos[memo_no]\">$sell_memos[memo_no]</a></td>
                                          <td>$sell_memos[total_qty]</td>
                                          <td>$total_rprice $editSp</td>
                                          <td>$sell_memos[grand_total]</td>
                                          <td>$sell_memos[carry_cost]</td>
                                          <td></td>
                                          <td></td>
                                          <td>$sell_memos[extra_cost] ($sell_memos[extra_cost_descr])</td>
                                          <td>$sell_memos[paid]</td>
                                          <td>$sell_memos[due]</td>
                                          <td>$sell_memos[comment]</td>
                                        </tr>";
                                        
                                  $grand_price = $grand_price + $sell_memos['grand_total'] ;
                                  $grand_due = $sell_memos['due'];
                                  $grand_qty =$grand_qty + $sell_memos['total_qty'];
                                  $grand_paid = $grand_paid + $sell_memos['paid'];
                                  $due_perce_num = $due_perce_num + $sell_memos['paid'] + $sell_memos['extra_cost'];
                                  $due_perce_den = $due_perce_den + $sell_memos['grand_total'] + $sell_memos['carry_cost'];
                                  } else if ($sell_memos['sell_type']=='return'){
                                    $return_qty = (-1)*$sell_memos['total_qty'];
                                    $return_amount = (-1)*$sell_memos['grand_total'];
                                    $return_memo = $sell_memos['return_goods'];
                                    echo "<tr>
                                           <td>$sell_memos[date_sold]</td>
                                           <td></td>
                                           <td>-$return_qty</td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td>$return_qty</td>
                                           <td><a href=\"return_memo.php?memo_no=$return_memo\">$return_amount</a></td>
                                           <td></td>
                                           <td></td>
                                           <td>$sell_memos[due]</td>
                                           <td></td>
                                         </tr>";

                                  $grand_qty =$grand_qty + $sell_memos['total_qty'];
                                    $due_perce_den = $due_perce_den - $return_amount;
                                    $grand_price = $grand_price - $return_amount;
                                  } 
                                }


                                @$due_perce = 100*($due_perce_num/$due_perce_den);
                                echo "<tr>
                                           <td></td>
                                           <td></td>
                                           <td>=$grand_qty</td>
                                           <td>=$gayer_dam_mot</td>
                                           <td>=$grand_price (মাল ফেরত বাদে)</td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td>=$grand_paid</td>
                                           <td>=$due_perce %</td>
                                           <td></td>
                                         </tr>";
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