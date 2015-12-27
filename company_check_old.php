<?php
  include "company_check_start.php"; 
  include "util.php";
?>
<script>
  //$("input[name='select']")
</script>
<?php 
// $show = dbEach("select * from company_check where (pending_date between '2014-07-01 23:59:59' and '2014-07-31 00:00:00') ");
// print_r($show);

// $date = date_create();
// echo date_format($date, 'Y-m-d H:i:s') . "\n";
if($_POST)
{
  $factoryName = $_POST["factoryName"];
  $amount = $_POST["amount"]+0;
  $date = $_POST["date"];
  $dateData = explode( '/', $date );
  $dd = @$dateData[0];
  $mm = @$dateData[1];
  $yy = @$dateData[2];


  $date = "$yy:$mm:$dd 01:01:01";
  //db("insert into company_check () values ()");
  //echo "factoryName : $factoryName, date : $date, amount : $amount";
  $msg = "";
  if($factoryName == "")
  {
    $msg =  $msg."<h4 class=\"text-error\">* কারখানার নামটি লিখুন</h4><br>";
  }
  if($amount == 0)
  {
    $msg =  $msg."<h4 class=\"text-error\">* চেকের পরিমান লিখুন</h4><br>";
  }
  if($date == ":: 01:01:01")
  {
    $msg =  $msg."<h4 class=\"text-error\">* তারিখের ঘরটি পুরন করুন</h4><br>";
  }
  if($msg == "")
  {
    echo "<h4 class=\"text-success\">সফল</h4>";
    $factoryEntry = db("select * from company_check where factory_name = '$factoryName' limit 1");
    if($factoryEntry == [])
    {
      db("insert into company_check (factory_name, pending_date, amount) values ('$factoryName','$date','$amount')");
    }
    else
    {
      $index = $factoryEntry["table_index"];
      $prevAmount = $factoryEntry["amount"];

      $newAmount = $amount + $prevAmount;
      //echo "index is $index;";
      //echo "update company_check set pending_date='$date', amount='$newAmount' where table_index='$index'";
      db("update company_check set pending_date='$date', amount='$newAmount' where table_index='$index' ");
    }
  }
  else
  {
    echo $msg;
  }
}
 ?> 

<form action="company_check.php" method="post">
  কারখানা :
  <input type="text" id="factory_name" name="factoryName" list="factories" onchange="checkFactoryName();validateFactoryName();" placeholder="লিখুন">
  <datalist class ="" id="factories" onchange="javascript:checkFactoryName();">
    <?php       
      $result = dbEach("select * from factories");
      foreach($result as $row){
      echo "<option value=\"".$row['factory_name']."\">".$row['factory_name']."</option>";
        }     
    ?>
  </datalist>
    চেক মুল্য:
  <input name="amount" type="text"> 
    তারিখ:
  <input name="date" type="date">
  <br>
  <input type="submit" class="btn" value="সাবমিট">
</form>
<?php include "bikri_khata_end.php"; ?>