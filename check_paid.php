<?php 
  include "company_check_start.php"; 

  include "convert_number_encoding.php";
  include "util.php"; ?>
  <!-- specific factory checks -->
<?php 
if($_POST || $_GET)
{
  $factoryName = "";
  if($_POST)
  {
    $factoryName = $_POST["factoryName"];
  }
  $paid = @convertToEnglishNumber($_POST["paid"]);
  
  $dateObj = date_create();
  $dateStart = date_format($dateObj, 'Y-m-d 0:00:00');
  $dateEnd = date_format($dateObj, 'Y-m-d 23:59:59');
  if($_GET)
  {
    $factoryName = $_GET["factoryName"];
    $factoryData = dbEach("select * from company_check_log where factory_name = '$factoryName' ");
    
    if($factoryData != [])
    {
      $factoryEntry = db("select * from company_check where factory_name = '$factoryName' limit 1");
    
    //$checkLog = db("select * from company_check_log where factory_name = '$factoryName' limit 1");
    
      if($factoryEntry == [])
      {
        echo "<h4 class=\"text-error\">* চেক পাওনা নেই</h4><br>";
      }
      else
      {
        $checkLogs = dbEach("select * from company_check_log where factory_name = '$factoryName' ");
        if($checkLogs == [])
        {
          //echo "শূন্য";
        }
        else
        {
          $date = parseDateFromTime($factoryEntry["pending_date"]);
          $cPaid = 0;
          $cOwe = $factoryEntry["amount"];
          ?>
          <div class="span6">
          <table class="table table-condensed table-striped table-bordered table-hover">
            <tr>
              <th>তারিখ</th>
              <th>তাগাদা</th>
            </tr>
          <?php
          foreach ($checkLogs as $checkLog) 
          {
            
            $timestamp = $checkLog["date"];      
            $date = parseDateFromTime($timestamp);

            echo "<tr>
                    <td>$date</td>
                    <td>$checkLog[paid]</td>
                  </tr>";
            $cPaid = $cPaid + $checkLog["paid"] ; 
          }
  ?>
</table>
</div>
<div class="span6">
<table class="table table-condensed table-striped table-bordered table-hover">
  <tr>
    <th>বিবরণ</th>
    <th>হিসাব</th>
  </tr>
  <?php
          $datePending = @parseDateFromTime($factoryEntry["pending_date"]);
          $issueDate = @parseDateFromTime($row["issue_date"]);
           
          echo    "<tr>
                    <td>ইস্যু তারিখ</td><td>$issueDate</td>
                  </tr>";  
          echo   "<tr>
                    <td>মোট পাওনা</td><td>$cOwe</td>
                  </tr>";
          echo    "<tr>
                    <td>পাওনা তারিখ</td><td>$datePending</td>
                  </tr>"; 
          echo    "<tr>
                    <td>পরিশোধিত</td><td>$cPaid</td>
                  </tr>";         
          $checkDue = $cOwe - $cPaid;

          echo    "<tr>
                    <td>বাকি</td><td>$checkDue</td>
                  </tr>";       

        }
      }    
    }
  }
  ?>
</table>
</div>
  <?php
  $msg = "";
  if($factoryName == "")
  {
    $msg =  $msg."<h4 class=\"text-error\">* কারখানার নামটি লিখুন</h4><br>";
  }
  if($paid == 0)
  {
    $msg =  $msg."<h4 class=\"text-error\">* চেকের পরিমান লিখুন</h4><br>";
  }
  $hasCheck = db("select * from company_check where factory_name = '$factoryName' ");
  if($hasCheck == [])
  {
    $msg =  $msg."<h4 class=\"text-error\">* চেক ইস্যু নেই</h4><br>";
  }
  if($msg == "" && $_POST)
  {    
    db("insert into company_check_log (factory_name,paid) values ('$factoryName','$paid')");
    echo "<h4 class=\"text-success\">সফল</h4>";
    
    $factoryEntry = db("select * from company_check where factory_name = '$factoryName' limit 1");    
    $index = $factoryEntry["table_index"];
    //print_r($factoryEntry);
    //$checkLog = db("select * from company_check_log where factory_name = '$factoryName' limit 1");
    
    if($factoryEntry == [])
    {
      echo "<h4 class=\"text-error\">* চেক পাওনা নেই</h4><br>";
    }
    else
    {
      $checkLogs = dbEach("select * from company_check_log where factory_name = '$factoryName' ");
      if($checkLogs == [])
      {
        echo "শূন্য";
      }
      else
      {
        $date = parseDateFromTime($factoryEntry["pending_date"]);
        echo "পাওনা তারিখ : $date <br>";
        $cPaid = 0;
        $cOwe = $factoryEntry["amount"];
        foreach ($checkLogs as $checkLog) 
        {
          // $dateObj = $factoryEntry;
          // $amount = $factoryEntry["amount"];
          $timestamp = $checkLog["date"];
          $timestampArr = explode( ' ', $timestamp );
          $dateObj = $timestampArr[0];
          $dateData = explode('-', $dateObj);
          //print_r($dateData);
          $date = "$dateData[2] / $dateData[1] / $dateData[0]";
          $cPaid = $cPaid  + $checkLog["paid"];
          echo "তারিখ :$date; জমা:$checkLog[paid]<br>";
        }
        $datePending = parseDateFromTime($factoryEntry["pending_date"]);
        echo "মোট পাওনা : $cOwe <br>";
        echo "পাওনা তারিখ : $datePending <br>";
        echo "পরিশধিত: $cPaid <br>";
        $checkDue = $cOwe - $cPaid;
        echo "বাকি: $checkDue <br>";

        if($checkDue == 0 )
        {
          db("update company_check set payment_clear ='yes' where table_index = '$index' ");
        }      
      }      
    }  
  }
  else
  {
    echo $msg;
  }
}
function parseDateFromTime($timestamp)
{
  $timestampArr = explode( ' ', $timestamp );
  $dateObj = $timestampArr[0];
  $dateData = explode('-', $dateObj);
  //print_r($dateData);
  $date = "$dateData[2] /$dateData[1] /$dateData[0]";
  return $date;
}

 ?> 
<h3 class="label label-info">চেক পাওনা</h3>
<form action="check_paid.php" method="post">
  কারখানা :
  <?php 
    // $res = db("select * from factories");
    // print_r($res);
   ?>
  <input type="text" id="factory_name" name="factoryName" list="factories" placeholder="লিখুন">
  <datalist class ="" id="factories" onchange="javascript:checkFactoryName();">
    <?php       
      $result = dbEach("select * from factories");//cannot use capital letters
      foreach ($result as $row) {
      echo "<option value=\"".$row['factory_name']."\">".$row['factory_name']."</option>";
        }     
    ?>
  </datalist>
  তাগাদা :
  <input type="text" name="paid">
  <br>
  <input type="submit" class="btn" value="সাবমিট">
</form>
<?php include "bikri_khata_end.php"; ?>