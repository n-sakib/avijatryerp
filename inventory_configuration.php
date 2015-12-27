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
        <title>জুতার ধরন | অভিযাত্রী সুজ</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
       
        <link href="icomoon/style.css" rel="stylesheet">
        <link rel="icon" type="image/ico" href="img/ico/favicon.ico"></link>
      <!--[if lte IE 7]>
      <script src="css/icomoon-font/lte-ie7.js"></script>
      <![endif]-->
      <link href="css/main.css" rel="stylesheet">
      <link href="css/juta_list.css" rel="stylesheet">

      <!-- Important. For Theming change primary-color variable in main.css  -->

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
          selected('inventory_configuration');
         ?></div>
        <div class="sub-nav">
          <ul>
            <li>
              <a href="#" class="heading">জুতার ধরন</a>
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
                          জুতার বিভিন্ন ধরন
                          
                        </div> 
                    <a class="pull-right label" href="inventory_table/inventory_config_types.php">এডিট</a>
                    
                  </div>
                  <div class="widget-body" >
                    <div class="row-fluid">
                      <div id="container">
                        <div class="div-fix">
                          <h1>জেন্টস</h1>
                         <?php
                          require_once "conn.php";            
                          
                          $result = mysqli_query($con,"SELECT * FROM inventory_config_types WHERE genre = 1");
                          
                          echo "<ul>";
                          while($row = mysqli_fetch_array($result)){
                          echo "<li>$row[type]</li>";
                            
                            }  
                           echo "</ul>";   
                         ?>
                        </div>
                        <div class="div-fix">
                          <h1>লেডিস</h1>
                          <?php
                          require_once "conn.php";            
                          
                          $result = mysqli_query($con,"SELECT * FROM inventory_config_types WHERE genre = 2");
                          echo "<ul";
                          while($row = mysqli_fetch_array($result)){
                             echo "><li>$row[type]</li";
                          } 
                          echo "></ul>";
                         ?>
                        </div>
                        <div class="div-fix">
                          <h1>সু</h1>
                          <?php
                          require_once "conn.php";            
                          
                          $result = mysqli_query($con,"SELECT * FROM inventory_config_types WHERE genre = 3");
                          echo "<ul>";
                          while($row = mysqli_fetch_array($result)){
                          echo "<li>$row[type]</li>";
                            
                            } 
                          echo "</ul>";
                         ?>
                        </div>
                        <div class="div-fix">
                          <h1>বেবি</h1>
                          <?php
                          require_once "conn.php";            
                          
                          $result = mysqli_query($con,"SELECT * FROM inventory_config_types WHERE genre = 4");
                          
                          echo "<ul>";
                          while($row = mysqli_fetch_array($result)){
                          echo "<li>$row[type]</li>";
                            
                            }  
                          echo "</ul>";
                         ?>
                        </div>
                      </div>
                      
                      
                    </div>
                  </div>

                </div>
              </div>
              <div class="span6">
                <div class="widget">
                  <div class="widget-header">
                    <div class="title">
                          জুতার বিভিন্ন কালার
                          
                        </div> 
                    <a class="pull-right label" href="inventory_table/inventory_config_colors.php">এডিট</a>
                    
                  </div>
                  <div class="widget-body">
                    <div class="row-fluid">
                      <div id="container">
                        <div id="col-list">
                          <?php
                          include "convert_number_encoding.php";
                          require_once "conn.php";            
                          
                          $result = mysqli_query($con,"SELECT * FROM inventory_config_colors");
                          echo "<ul class=\"col\">";
                          $count = 1;
                          while($row = mysqli_fetch_array($result)){
                            $index = convertToBanglaNumber($count);
                            echo "<li class=\"col\">$index. $row[color]</li>";
                          $count++;
                          } 
                          echo "</ul>";    
                         ?>
                            
                            
                          
                        <br>
                        </div>
                        
                      </div>
                      
                      
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>           
          </div> 
          
           <div class="left-sidebar">
            
            <div class="row-fluid">
              <div class="span12">
                <div class="widget">
                  <div class="widget-header">
                    <div class="title">
                          নতুন জুতার ধরন
                          
                        </div>
                    
                  </div>
                  <div class="widget-body">

                    <div class="row-fluid">
                      <div id="container">
                        <?php 
      $success = 'success';
      if(isset($_GET['msg'])){
        if ($_GET['msg']== $success){
          echo '<p class="msg"><h3>নতুন তথ্য যুক্ত হয়েছে</h3></p>';
        } else{
          echo '<p class="msg"><h3>নামের ঘরটি পূরণ করুন</h3></p>';
        }}
     ?>
    
                          <form action="inventory_config_post.php" method="post">
                            <label for="">নতুন ধরন যোগ করুন</label>
                            <select name="genre" id="genre" >
                              <option value="0">সিলেক্ট</option>
                              <option value="1" >জেঃ</option> 
                              <option value="2">লেঃ</option>
                               <option value="3">সু</option> 
                               <option value="4">বেঃ</option>
                            </select>
                            <input type="text" name="type" id="type" onchange="javascript:ifDuplicType('type','type','inventory_config_types');" onfocus="checkGenres();" placeholder="ধরন" required="required">
                            <input type="submit" id="submit1" value="যোগ করুন" class="btn btn-info" mouseover="checkGenres();"></form>
                          <form action="inventory_config_post.php" method="post">
                            <label for="">নতুন কালার যোগ করুন</label>
                            <input type="text" name="color" id="color" onchange="javascript:ifDuplicColor('color','color','inventory_config_colors');" placeholder="কালার" required="required">
                            <input type="submit" id="submit2" value="যোগ করুন" class="btn btn-info"></form>
                        </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>           
          </div> 
          
        </div>
        <!--/.fluid-container--> </div>
      <footer>
        <p>&copy; CodeCharley</p>
      </footer>
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.js"></script>
      <script src="js/jquery.scrollUp.js"></script>
      <script src="js/load-image.min.js"></script>
      <script src="js/bootstrap-image-gallery.js"></script>
      <script src="js/bootstrap-image-gallery-main.js"></script>

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

      //Tooltip
      $('a').tooltip('hide');
    </script>
    <script type="text/javascript" src="validate_duplicate_type_ajax.js"></script>
    <script type="text/javascript" src="validate_duplicate_color_ajax.js"></script>
    <script type="text/javascript" src="inventory_configuration.js"></script>
    <script type="text/javascript" src="ignore_key.js"></script>
</body>
    </html>