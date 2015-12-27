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
        <title>মাল ফেরতের হিসাব | অভিযাত্রী সুজ</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
       
        <link href="icomoon/style.css" rel="stylesheet">
        <link rel="icon" type="image/ico" href="img/ico/favicon.ico"></link>
      <link href="css/new_table.css" rel="stylesheet">
      <link href="css/main.css" rel="stylesheet">
      <!-- Important. For Theming change primary-color variable in main.css  -->
      <!--[if lte IE 7]>
      <script src="css/icomoon-font/lte-ie7.js"></script>
      <![endif]-->
      <link href="css/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet">
      <link href="css/wysiwyg/wysiwyg-color.css" rel="stylesheet">
      <link href="css/charts-graphs.css" rel="stylesheet">
      <link href="css/clockface.css" rel="stylesheet">
      <link href="css/timepicker.css" rel="stylesheet">
      <link href="css/alertify.core.css" rel="stylesheet" id="toggleCSS"></head>
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
            selected('mal_ferot');
           ?>
         </div>
        <div class="sub-nav">
          <ul>
            <li>
              <a href="#" class="heading">মাল ফেরত</a>
            </li>
            <li>
              <a href="mal_ferot.php">মাল ফেরতের হিসাব</a>
            </li>
            <li>
              <a href="inventory_ferot.php">
                গোডাউন ফেরত
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
                      <div class="widget-header">গোডাউন থেকে মাল ফেরত 
                        <a href="inventory_ferot.php" class="btn btn-info pull-right">রিফ্রেশ</a></div>
                      <div class="widget-body">
                        <?php 
                          if (isset($_GET['msg']) && $_GET['msg']=='success' ) {
                            echo "<p>
                                    <h1>কারখানা ফেরত তালিকাভুক্তি হয়েছে !!</h1>
                                  </p>
                                ";
                          }else{}
                         ?>
                        <form action="inventory_ferot_post.php" method="post">
                          <table class="table-condensed table-striped table-bordered table-hover no-margin new_table">
                            <tr>
                              <th style="width:5%;">ক্রমিক নং</th>
                              <th>আইডি</th>
                              <th>কেনা দাম</th>
                              <th>পরিমাণ(জোড়া)</th>
                              <th>মূল্য</th>
                            </tr>
                            <tr>
                              <td id="serial">1</td>
                              <td>
                                <input type="text" name="pids[]" id="pids" onblur="javascript:ajax_post_cost_prices();"></td>
                              <td>
                                <p id="prices_cell"></p>
                                <input type="hidden" name="cost_prices[]" id="prices"></td>
                              <td>
                                <input type="text" name="qtys[]" id="qtys" onblur="javascript:ajax_post_subtotal_prices();"></td>
                              <td>
                                <p id="subtotal_prices_cell"></p>
                                <input type="hidden" name="subtotal_prices[]" id="subtotal_prices"></td>
                            </tr>
                            <tr id="last_row">
                              <td></td>
                              <td><input type="text" onblur="javascript:addField();" id="last_pid"></td>
                              <td></td>
                              <td><input type="text"></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td ></td>
                              <td>সর্বমোট দাম</td>
                              <td>
                                <p id="total_price_cell"></p>
                                <input type="hidden" name="total_price" id="total_price" value="0"></td>
                            </tr>
                          </table>                      
                          <input class="btn btn-info pull-right" type="submit" value="অনুমোদন"></form>
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

    <script type="text/javascript" src="js/alertify.min.js"></script>

    <script type="text/javascript">
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


      //Alertify JS
      $ = function (id) {
        return document.getElementById(id);
      },
      reset = function () {
        $("toggleCSS").href = "css/alertify.core.css";
        alertify.set({
          labels: {
            ok: "OK",
            cancel: "Cancel"
          },
          delay: 5000,
          buttonReverse: false,
          buttonFocus: "ok"
        });
      };

      // Standard Dialogs
      $("alert").onclick = function () {
        reset();
        alertify.alert("This is an alert Dialog");
        return false;
      };

      $("confirm").onclick = function () {
        reset();
        alertify.confirm("This is a confirm dialog", function (e) {
          if (e) {
            alertify.success("You've clicked OK");
          } else {
            alertify.error("You've clicked Cancel");
          }
        });
        return false;
      };

      $("prompt").onclick = function () {
        reset();
        alertify.prompt("This is a prompt dialog", function (e, str) {
          if (e) {
            alertify.success("You've clicked OK and typed: " + str);
          } else {
            alertify.error("You've clicked Cancel");
          }
        }, "Default Value");
        return false;
      };

      // Standard Dialogs
      $("notification").onclick = function () {
        reset();
        alertify.log("Standard log message");
        return false;
      };

      $("success").onclick = function () {
        reset();
        alertify.success("Success log message");
        return false;
      };

      $("error").onclick = function () {
        reset();
        alertify.error("Error log message");
        return false;
      };

      // Custom Properties
      $("delay").onclick = function () {
        reset();
        alertify.set({
          delay: 10000
        });
        alertify.log("Hiding in 10 seconds");
        return false;
      };

      $("forever").onclick = function () {
        reset();
        alertify.log("Will stay until clicked", "", 0);
        return false;
      };

      //Alertify JS end
    </script>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.scrollUp.js"></script>
    <script type="text/javascript">
      //ScrollUp
      $(document).ready(function () {
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
    <script language="JavaScript" type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="inventory_ferot_script.js"></script>
<script type="text/javascript" src="inventory_ferot_ajax.js"></script>
<script type="text/javascript" src="ignore_key.js"></script>
</body>
  </html>