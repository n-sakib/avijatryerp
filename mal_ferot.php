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
      <link href="css/delbtn_mal_ferot.css" rel="stylesheet">
<body>
      <?php 
    header("Cache-Control: no-cache, no-store, must-revalidate ");
   ?>
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
              <a href="mal_ferot.php" >মাল ফেরতের হিসাব</a>
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
                      <div class="widget-header">
                        <div class="title">
                      মাল ফেরতের হিসাব করুন 
                      
                    </div>
                      
                      </div>
                      <div class="widget-body">
                        <?php 
                          if (isset($_GET['msg']) && $_GET['msg']=='success' ) {
                            echo "<p>
                                    <h1>মাল ফেরত তালিকাভুক্তি হয়েছে !!</h1>
                                  </p>
                                ";
                          }else{}
                         ?>
                        <div class="row-fluid">
                          <form action="mal_ferot_unified_post.php" method="post">
                            <span>পার্টি :</span>
                            <input type="text"  id="company_name" name="company_name" list="client" onchange="checkFactoryName();validateCompanyName();" value="লিখুন" autocomplete="off">
                            <datalist id="client"  onchange="javascript:checkFactoryName();">
                              <?php 
                              require_once "conn.php";
                              $result = mysqli_query($con,"SELECT * FROM clients"); 
                              while($row = mysqli_fetch_array($result)){
                                echo "<option value=\"$row[company_name]\">$row[company_name]</option>
                                          ";
                              } 
                             ?>
                          </datalist>
                          <a href="mal_ferot.php" class="btn btn-info pull-right">রিফ্রেশ</a>
                          <table class="table-condensed table-striped table-bordered table-hover no-margin new_table">
                            <tr class="">
                              <th rowspan="2">ক্রমিক</th>
                              <th colspan="5">বিবরন/বারকোড</th>
                              <th rowspan="2">গায়ের দাম/জোড়া</th>
                              <th rowspan="2">পরিমাণ(জোড়া)</th>
                              <th rowspan="2">মোট দাম</th>
                            </tr>
                            <tr>
                              <th rowspan="1">ফ্যাক্টরি</th>
                              <th rowspan="1">জুতা</th>
                              <th rowspan="1">ধরন</th>
                              <th rowspan="1">রং</th>
                              <th rowspan="1">ডিজাইন</th>
                            </tr>
                            
                            <tr id="row1a">
                              <td rowspan="2" ><strong id="serial">1</strong></td>
                              <td colspan="5">
                                আইডি :
                                <input type="text" name="pids[]" id ="pid1" value="জেনারেট হয়নি" onchange="calcTotal(1);" onblur="javascript:ajax_post_retail_prices('price1','pid1');setTimeout(function(){calcTotal(1);},100);" >
                              </td><td></td>
                              <td></td>
                              <td><p id="delrow1" onclick="javascript:delRow(1);" class="delbtn">x</p></td>
                            </tr>
                            <tr id="row1b">
                              <td>
                                <input type="text" name="factory_name" id="factory_name" list="factories" autocomplete="off" onchange="validateFactoryName();ajax_post_pid(1);" value="লিখুন">
                                <datalist id="factories">
                                </datalist>
                              </td>
                              <td rowspan="1">
                                <select name="genres[]" id="genre" onChange="genrePipe(1);">
                                  <option value="0"selected="selected">সিলেক্ট</option>
                                  <option value="1" >জেঃ</option>
                                  <option value="2">লেঃ</option>
                                  <option value="3">সু</option>
                                  <option value="4">বেঃ</option>
                                </select>
                              </td>
                              <td rowspan="1">
                                <select name="types[]" id="types" onclick="typesPipe(1);"></select>
                              </td>
                              <td rowspan="1">
                                <select name="colors[]" id="colors" onChange="colorsPipe(1);"></select>
                              </td>
                              <td rowspan="1">
                                <p id="design_no"></p>
                                <input type="hidden" name="designs[]" id="designs" value="001" >
                                <input type="button" class="btn btn-info" value="নতুন" id="renew" onclick="renewPipe(1);">
                              </td>
                              <td rowspan="1">
                                <input type="text" name="retail_prices[]" id="price1" onfocus="calcTotal(1);" onblur="calcTotal(1);"></td>
                              <td rowspan="1">
                                <input type="text" name="qtys[]" id="qty1" onfocus="calcTotal(1);" onblur="calcTotal(1);" value="6"></td>
                              <td rowspan="1">
                                <input type="text" name="subtotal_prices[]" id="sub1" readonly onfocus="javascript:addField();"></td>
                            </tr>
                            <tr id="last_row"></tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>মোট দাম</td>
                              <td>
                                <input type="text" name="raw_total_price" id="total" value="0" readonly>
                              <input type="hidden" id="total_serial" value="1">
                            </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td ></td>
                              <td>কমিশন %</td>
                              <td>
                                <input type="text" id="comm_perc" value="28" onChange="javascript:calcTotals();"></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td ></td>
                              <td>কমিশন এর পরিমাণ</td>
                              <td>
                                <input type="text" id="comm" readonly></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td ></td>
                              <td>সর্বমোট মূল্য</td>
                              <td>
                                <input type="text" name="total_price" id="total_price" readonly></td>
                            </tr>
                          </table>
                          
                        <input type="button" class="btn btn-info pull-right" value="নতুন লাইন" onclick="addField();">
                        <input class="btn btn-info pull-left span3"type="button" value="সাবমিট" id="pseudo-submit"onclick="javascript:checkLastRow();checkFactoryName();">
                        <input type="submit" id="submit" style="visibility:hidden;">
                        </form>
                        </div>
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
    <script type="text/javascript" src="mal_ferot_unified_ajax.js"></script>
    <script type="text/javascript" src="mal_ferot_ajax.js"></script>
    <script type="text/javascript" src="ignore_key.js"></script>
    <script type="text/javascript" src="mal_ferot_script_v2.js"></script>  
    <script type="text/javascript">
      ajax_post_factory_names();
    </script>  
</body>
  </html>