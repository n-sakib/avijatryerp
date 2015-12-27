<?php include("inventory_check_start.php"); 
include("util.php"); 
?>
<h1>চেক বাকি</h1>
<form action="inventory_check.php" method="post">
  <table id="pack1"class="table table-condensed table-striped table-bordered table-hover">
    <tr>
      <th>আইডি</th>
      <th>বিবরণ</th>
      <th>পরিমাণ</th>      
    </tr>
    <?php 
      //$inventory_check = dbEach("select * from inventory_check");
      $inventory = dbEach("select * from inventory");

      foreach ($inventory as $index => $entry) {
        $pid = $entry["pid"];
        $checked = dbEach("select * from inventory_check where pid = '$pid' limit 1"); 
        if($checked != [])
        {
          unset($inventory[$index]);
        }
        elseif ($entry["total_qty"]<1)
        {
          unset($inventory[$index]);
        }        
      }

      foreach ($inventory as $entry) {
        $description = getDescription($pid);
          echo "<tr>
                  <td>$entry[pid]</td>
                  <td>$description</td>
                  <td>$entry[total_qty]</td>
                </tr>"; 
      }
     ?>
  </table>
  <span id="last-space"></span>
  <textarea name="inputStream"></textarea>
  <input class="btn btn-info pull-right" type="submit" value="যোগ করুন">
</form>
 <!-- <span class="btn btn-info pull-right" onclick="javascript:ajaxPrintPreview();">প্রিন্ট প্রিভিউ</span> -->
<?php include("inventory_check_end.php"); ?>