<?php include("inventory_check_start.php"); 
include("util.php"); 
if($_POST)
{

  $inputStream = $_POST["inputStream"];

  $streamArray = explode( "\r\n", $inputStream );
  foreach ($streamArray as $entry) {
    $parseEntry = explode( "\t", $entry );
    $pid = @$parseEntry[0];
    $checked = @$parseEntry[1];//checked qty

    //$pidLen = strlen($pid);
    //$padLength = 11-$pidLen;
    //echo "pid length is $padLength --";
    $pid = str_pad($pid, 11, "0", STR_PAD_LEFT);;
    echo "$pid $checked <br>";

    if (ifExists($pid))
    {
      $inv = db("select * from inventory_check where pid = '$pid' limit 1");   
      $prevQty = $inv["checked"];
      $checked = $checked + $prevQty;
      db("update inventory_check set checked = '$checked' where pid = '$pid' ");
    }
    else
    {
      db("insert into inventory_check (pid, checked) values ('$pid', '$checked')"); 
    }
  }


}
?>

<form action="inventory_check.php" method="post">
  <table id="pack1"class="table table-condensed table-striped table-bordered table-hover">
    <tr>
      <th>আইডি</th>
      <th>বিবরণ</th>
      <th>এন্ট্রি</th>
      <th>পরিমাণ</th>      
      <th></th>
      <th>চেক বাকি</th>
    </tr>
    <?php 
      $inventory = db("select * from inventory_check");
      foreach ($inventory as $entry) {
        $pid = $entry["pid"];
        $checked = $entry["checked"];
        $stock = db("select * from inventory where pid = '$pid' limit 1");
        $invQty = @$stock["total_qty"];

        $unChecked = $invQty - $checked;
        $description = getDescription($pid);
        
        if ($unChecked != 0)
        {
          echo "<tr>
                <td>$pid</td>
                <td>$description</td>
                <td>$checked</td>
                <td>$invQty</td>
                <td></td>
                <td>$unChecked</td>
              </tr>";
        }
        // echo "<tr>
        //         <td>$pid</td>
        //         <td>$description</td>
        //         <td>$checked</td>
        //         <td>$invQty</td>
        //         <td></td>
        //         <td>$unChecked</td>
        //       </tr>";
      }
     ?>
  </table>
  <span id="last-space"></span>
  <textarea name="inputStream"></textarea>
  <input class="btn btn-info pull-right" type="submit" value="যোগ করুন">
</form>
<button class="btn btn-default pull-right pseudoClear" >ক্লিয়ার করুন</button>
<form action="inventory_check_clear.php" method="post">
  <input type="hidden" name="clear" value="yes">
  <input type="submit" vlaue="clear" class="hidden" id="submitBtn">
</form>
 <!-- <span class="btn btn-info pull-right" onclick="javascript:ajaxPrintPreview();">প্রিন্ট প্রিভিউ</span> -->

<?php include("inventory_check_end.php"); ?>