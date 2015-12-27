<?php include("inventory_check_start.php"); 
require_once 'util.php';
?>

  <table id="pack1"class="table table-condensed table-striped table-bordered table-hover">
    <tr>
      <th>আইডি</th>
      <th>বিবরণ</th>
      <th>এন্ট্রি</th>
      <th>পরিমাণ</th>      
      <th></th>
      <th>চেক বাকি</th>      
      <th></th>
    </tr>
    <?php 
      $pids = dbEach("select * from inventory_check");
      foreach ($pids as $pidData) {
        $entry = $pidData["checked"];
        $pid = $pidData["pid"];
        $descr = getDescription($pid);
        $found = db("select * from inventory where pid='$pid' limit 1");
        $qty = @$found["total_qty"];
        $rem = $qty - $entry;
        if($rem != 0)
        {
          echo "<tr class=\"product-col\">
                  <td class=\"pid\">$pid</td>
                  <td class=\"descr\">$descr</td>
                  <td class=\"entry\">$entry</td>
                  <td class=\"qty\">$qty</td>
                  <td></td>
                  <td class=\"rem\">$rem</td>
                  <td class=\"\"><span class=\"pull-right del\">x</span></td>
                </tr>";
        }
      }
     ?>
    <tr class="last-row"></tr>
  </table>
  <span id="last-space"></span>
  আইডি : 
  <input tabindex="1" type="text" id="pid">
  পরিমান :
  <input tabindex="2" type="text" id="qty">
  <!-- js submission ajax -->
  <button tabindex="3" class="btn btn-info add pull-right">যোগ করুন</button>
  <hr>
<div  class="btn btn-default pull-left" ><a href="inventory_unchecked.php">মাল বাকি </a></div>
<button class="btn btn-default pull-right pseudoClear" >ক্লিয়ার করুন</button>
<hr>
<form action="inventory_check_clear.php" method="post">
  <input type="hidden" name="clear" value="yes">
  <input type="submit" vlaue="clear" class="hidden" id="submitBtn">
</form>
 <!-- <span class="btn btn-info pull-right" onclick="javascript:ajaxPrintPreview();">প্রিন্ট প্রিভিউ</span> -->

<script src="js/jquery.min.js">
</script>
<script src="inventory_check_new.js"></script>
<?php include("inventory_check_end.php"); ?>