<?php 
include "bikri_khata_start.php"; 
include "util.php"; ?> 
<?php 
    @$client = $_GET['client'];
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

        // echo "<tr>
        //       <td>$sell_memos[date_sold]</td>
        //       <td><a href=\"receipt.php?memo_no=$sell_memos[memo_no]\">$sell_memos[memo_no]</a></td>
        //       <td>$sell_memos[total_qty]</td>
        //       <td>$total_rprice</td>
        //       <td>$sell_memos[grand_total]</td>
        //       <td>$sell_memos[carry_cost]</td>
        //       <td></td>
        //       <td></td>
        //       <td>$sell_memos[extra_cost] ($sell_memos[extra_cost_descr])</td>
        //       <td>$sell_memos[paid]</td>
        //       <td>$sell_memos[due]</td>
        //       <td>$sell_memos[comment]</td>
        //     </tr>";
        //     
        // @$debtRatio = ($sell_memos['grand_total']/$total_rprice)+0;
        // if($debtRatio<= 0.61 && $debtRatio!= 0 )
        // {
        //   //echo "debt is $sell_memos[grand_total]/$total_rprice <br>";
        // }
        // else
        // {
          $thisCom = $total_rprice - $sell_memos["grand_total"];
          //echo "debt is $sell_memos[grand_total]/$thisCom & $total_rprice <br>";

          $gayer_dam_mot = $gayer_dam_mot + $total_rprice;      
          $commGivenHere = $gayer_dam_mot - $grand_price;                
          $grand_price = $grand_price + $sell_memos['grand_total'] ;
          //echo "debt is $sell_memos[grand_total]/$thisCom & $total_rprice && commGiven $commGivenHere<br>";
        // }
        $grand_due = $sell_memos['due'];
        $grand_qty =$grand_qty + $sell_memos['total_qty'];
        $grand_paid = $grand_paid + $sell_memos['paid'];
        $due_perce_num = $due_perce_num + $sell_memos['paid'] + $sell_memos['extra_cost'];
        $due_perce_den = $due_perce_den + $sell_memos['grand_total'] + $sell_memos['carry_cost'];

      } else if ($sell_memos['sell_type']=='return'){
        $return_qty = (-1)*$sell_memos['total_qty'];
        $return_amount = (-1)*$sell_memos['grand_total'];
        $return_memo = $sell_memos['return_goods'];
        // echo "<tr>
        //        <td>$sell_memos[date_sold]</td>
        //        <td></td>
        //        <td></td>
        //        <td></td>
        //        <td></td>
        //        <td></td>
        //        <td>$return_qty</td>
        //        <td><a href=\"return_memo.php?memo_no=$return_memo\">$return_amount</a></td>
        //        <td></td>
        //        <td></td>
        //        <td>$sell_memos[due]</td>
        //        <td></td>
        //      </tr>";
        $due_perce_den = $due_perce_den - $return_amount;
        $grand_price = $grand_price - $return_amount;
      } 
    }


    @$due_perce = 100*($due_perce_num/$due_perce_den);
    // /echo "<tr>
    //            <td></td>
    //            <td></td>
    //            <td>=$grand_qty</td>
    //            <td>=$gayer_dam_mot</td>
    //            <td>=$grand_price (মাল ফেরত বাদে)</td>
    //            <td></td>
    //            <td></td>
    //            <td></td>
    //            <td></td>
    //            <td>=$grand_paid</td>
    //            <td>=$due_perce %</td>
    //            <td></td>
    //          </tr>";

   ?>
   <div>
   	<div class="btn">
   	গায়ের দামে মোট (ছাড় মাল, মাল ফেরত বাদে): <span class="totalSp"><?php echo $gayer_dam_mot ?></span>
   </div>
   <?php 
   	$commGiven = $gayer_dam_mot - $grand_price;
    ?>
   <div class="btn">
   	কমিশন দেওয়া মোট : <span class="commGiven"><?php echo $commGiven ?></span>
   </div>
   <br>
   <div class="btn btn-primary">
   	<?php 
    $comm30 = $gayer_dam_mot*(0.30);

    $if30 = $comm30 - $commGiven;
   	 ?>
   	30% কমিশনে বাকি : <span class="comm30"><?php echo $if30 ?></span>
   </div>
   <br>
   <div class="btn">
   	<?php 
    $comm30 = $gayer_dam_mot*(0.32);

    $if30 = $comm30 - $commGiven;
   	 ?>
   	32% কমিশনে বাকি : <span class="comm32"><?php echo $if30 ?></span>
   </div>
    <br>
    <div class="btn btn-warning">
    <input type="text" name="customCom" class="customCom">% কমিশনে বাকি : <span class="customComRem"></span>
   </div>
   </div>
<script src="js/jquery.min.js"></script>
<script>
  $(".customCom").on("change input keyup",function(){
    gayerDamMot = $(".totalSp").html();
    commGiven = $(".commGiven").html();

    customCom = (0.01)*gayerDamMot*($(this).val());
    customComRem = customCom - commGiven;
    //console.log($(this).val());
    //console.log("gayerDamMot :"+gayerDamMot+"&commGiven :"+commGiven+"&customCom :"+customCom+"&customComRem :"+customComRem)
    $(".customComRem").html(customComRem);
  });
</script>
<?php include "bikri_khata_end.php"; ?>