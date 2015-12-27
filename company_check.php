<?php 
  include "company_check_start.php"; 
  include "util.php"; ?>
<?php 
if($_POST)
{
  $factoryName = $_POST["factoryName"];
  $amount = $_POST["amount"];
  $date = $_POST["date"];
  $dateData = explode( '/', $date );
  $dd = @$dateData[0];
  $mm = @$dateData[1];
  $yy = @$dateData[2];


  $date = "$yy:$mm:$dd 01:01:01";
  //db("insert into company_check () values ()");
  echo "factoryName : $factoryName, date : $date, amount : $amount";
  echo "<h2 class=\"text-success\">সফল</h2>";
  db("insert into ");
}
 ?> 
<h3 class="label label-info">চেক খাতা</h3>
<br>
<?php 
$rows = dbEach("select * from company_check order by pending_date asc");
$date = date_create();
$todayStart = date_format($date, 'Y-m-d 00:00:00');
$todayEnd = date_format($date, 'Y-m-d 23:59:59');
?>
<table class="table table-condensed table-striped table-bordered table-hover">
  <tr>
    <th>তারিখ</th>
    <th>কারখানা</th>
    <th>মোট পরিমান</th>
    <th>পরিশোধিত</th>
  </tr>
<?php

function parseDateFromTime($timestamp)
{
  $timestampArr = explode( ' ', $timestamp );
  $dateObj = $timestampArr[0];
  $dateData = explode('-', $dateObj);
  //print_r($dateData);
  $date = "$dateData[2] /$dateData[1] /$dateData[0]";
  return $date;
}

$pastRows = dbEach("select * from company_check where pending_date < '$todayStart' order by pending_date asc");
foreach ($pastRows as $row) 
{
  $date = parseDateFromTime($row["pending_date"]);
  echo "<tr>
          <td>$date</td>
          <td><a href=\"check_paid.php?factoryName=$row[factory_name]\">$row[factory_name]</a></td>
          <td>$row[amount]</td>
          <td>$row[payment_clear]</td>
        </tr>";
}
?>
</table>
<div class="badge badge-success">আজকের</div>
<table class="table table-condensed table-striped table-bordered table-hover">
  <tr>
    <th>তারিখ</th>
    <th>কারখানা</th>
    <th>মোট পরিমান</th>
    <th>পরিশোধিত</th>
  </tr>
<?php
$rows = dbEach("select * from company_check where (pending_date between '$todayStart' and '$todayEnd') order by pending_date asc");
foreach ($rows as $row) 
{
  $date = parseDateFromTime($row["pending_date"]);
  echo "<tr>
          <td>$date</td>
          <td><a href=\"check_paid.php?factoryName=$row[factory_name]\">$row[factory_name]</a></td>
          <td>$row[amount]</td>
          <td>$row[payment_clear]</td>
        </tr>";
}
?>
</table>
<?php 
echo "-----------------";
 ?>
<table class="table table-condensed table-striped table-bordered table-hover">
  <tr>
    <th>তারিখ</th>
    <th>কারখানা</th>
    <th>মোট পরিমান</th>
    <th>পরিশোধিত</th>
  </tr>
<?php  
$upcomingRows = dbEach("select * from company_check where pending_date > '$todayEnd' order by pending_date asc");
foreach ($upcomingRows as $row) 
{
  $date = parseDateFromTime($row["pending_date"]);
  echo "<tr>
          <td>$date</td>
          <td><a href=\"check_paid.php?factoryName=$row[factory_name]\">$row[factory_name]</a></td>
          <td>$row[amount]</td>
          <td>$row[payment_clear]</td>
        </tr>";
}
 ?>
</table>
<?php include "bikri_khata_end.php"; ?>