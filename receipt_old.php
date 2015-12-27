<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>রসিদ | অভিযাত্রী সুজ</title>
  <link href="css/receipt_table.css" rel="stylesheet">
  <link href="css/receipt_print.css" rel="stylesheet">
</head>
<body>
  <div class="table">
    <div>
      <?php 
        $memo_no = $_GET['memo_no'];
        include 'print_receipt_memo_info.php';

        $date_sold = substr("$date_sold", 0,10);
        $month = substr("$date_sold", 6,7);
        $date = substr("$date_sold", 9,10);

        //$date_sold = "$date:$month:$year";
       ?>
      <table class="head">
        <tr>
          <th style="width: 132.30px;"><div class="invisible"> </div></th>
          <th style="width:330px;"><div class="invisible"></div><?php echo $client_name; ?></th>
          <th style="width: 100px;"></th>
          <th style="width: 56px;"></th>
          <th style="width: 85px;"><?php echo $memo_no; ?></th>
        </tr>
        <tr>
          <th style="width:132.30px;"><div class="invisible"> </div></th>
          <th style="width:330px;"><div class="invisible"></div><?php echo $client_addr; ?></th>
          <th style="width: 100px;"></th>
          <td style="width: 56px;"><div id="date"> </div></td>
          <th style="width: 85px;"><div class="invisible"></div><?php echo $date_sold; ?></th>
        </tr>
      </table>
    </div>
    <div>
      <table class="body">
        <tr>
          <th style="width: 37.8px;"><div class="invisible"></div></th>
          <th style="width: 264.57px;"><div class="invisible"></div></th>
          <th style="width: 86.93px;"></th>
          <th style="width: 86.93px;"><div class="invisible"></div></th>
          <th style="width: 94.50px;"><div class="invisible"></div></th>
          <th style="width: 132.30px;"><div class="invisible"></div></th>
        </tr>
       <?php  
          include 'print_receipt.php';
         ?>
      </table>
       
      <input id="print-btn" type="button" value="print" onclick="javascript:window.print();">
      <div><a id="gen-btn" style="background-color:cyan;" href="receipt.php?memo_no=<?php echo $memo_no; ?>">জেনারেট</a></div>
    </div>
  </div>
   
</body>
</html>