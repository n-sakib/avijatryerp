<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>রসিদ | অভিযাত্রী সুজ</title>
  <link href="css/receipt_table.css" rel="stylesheet">
  <link href="css/receipt_print.css" rel="stylesheet">
  <link href="css/table-bordered.css" rel="stylesheet">
  <!-- <link href="css/page-setup.css" rel="stylesheet"> -->
</head>
<body>
  <div class="table">
    <div>
      <?php 
        $memo_no = trim($_GET['memo_no']);
        include 'print_receipt_memo_info_prev.php';

        $date_sold = substr("$date_sold", 0,10);
        $month = substr($date_sold, 5,2);
        $date = substr($date_sold, 8,2);
        $year = substr($date_sold, 0,4);
        $date_sold = "$date/$month/$year";
       ?>
      <table class="head">
        <tr>
          <th style="width: 132.30px; text-align:center;">মেসার্স :</th>
          <th style="width:330px;"><div class="invisible"></div><?php echo $client_name; ?></th>
          <th style="width: 80px;"></th>
          <th style="width: 86px;text-align:center;">মেমো :</th>
          <th style="width: 85px;"><?php echo $memo_no; ?></th>
        </tr>
        <tr>
          <th style="width:132.30px;text-align:center;">ঠিকানা :</th>
          <th style="width:330px;"><div class="invisible"></div><?php echo $client_addr; ?></th>
          <th style="width: 80px;"></th>
          <td style="width: 6px;text-align:center;"><strong>তারিখ :</strong></td>
          <th style="width: 85px;"><div class="invisible"></div><?php echo $date_sold; ?></th>
        </tr>
      </table>
    </div>
    <div>
      <table class="body table-bordered">
        <tr>
           <!-- <div class="invisible"></div> -->
          <th style="width: 48px; padding:0;">ক্রমিক</th>
          <th style="width: 394.57px;">বিবরণ</div></th>
           <!-- comment <th style="width: 86.93px;"></th> comment -->
          <th style="width: 76.93px;">জোড়া</th>
          <th style="width: 94.50px;">দর</th>
          <th style="width: 92.30px;">মুল্য</th>
        </tr>
       <?php  
          include 'printReceiptPreview.php';
         ?>
      </table>
       <div style="position:relative; left:30px; top:68px; width:120px;">_____________</div> <div style="position:relative; left:650px; top:47px;width:110px;">_____________</div>
       <div style="position:relative; left:30px; top:48px;width:120px;">ক্রেতার স্বাক্ষর</div> <div style="position:relative; left:650px; top:22px;width:110px;">বিক্রেতার স্বাক্ষর</div>
      <!--<input id="print-btn" type="button" value="print" onclick="javascript:window.print();">
      <div><a id="gen-btn" style="background-color:cyan;" href="receipt.php?memo_no=<?php echo $memo_no; ?>">জেনারেট</a></div>-->
    </div>
  </div>
   
</body>
</html>