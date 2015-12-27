<?php 
include "bikri_comm_start.php"; 
include "util.php"; ?> 
<!-- <span class="badge"><a href="bikri_shabek_add.php">পার্টি সাবেক</a></span> -->
<!-- <span class="badge badge-warning"><a href="mf_shabek_add.php">পার্টি মাল ফেরত সাবেক</a></span> -->
<?php 
include "convert_number_encoding.php";
if($_POST)
{
	$company_name = @$_POST["company_name"];
	$total_qty = @(convertToEnglishNumber($_POST["total_qty"])*(-1))+0;
	$grand_total = @(convertToEnglishNumber($_POST["grand_total"])*(-1))+0;
	$total_price = $grand_total;
	$msg = "";
	$client = db("select * from clients where company_name='$company_name' limit 1");
	if($company_name == "" || $total_qty == 0 || $grand_total == 0)
	{
		$msg = "$msg সবগুলো ঘর পুরন করুন<br>";
	}
	if($client == [])
	{
		$msg = "$msg পার্টিটি তালিকাভুক্ত নয়<br>";	
	}
	$last_row = db("select * from sell_memos where company_name = '$company_name' order by table_index desc limit 1");
	$memo_no = $last_row["memo_no"];
	$due = $last_row["due"];
	$newDue = $due + $grand_total; //gt is -ve
	if($msg == "")
	{
		echo "সফল";
		// echo "insert into sells (company_name, memo_no,total_qty,total_price, sell_type) values ('$company_name', '$memo_no','$total_qty','$total_price', 'return')";
			db("insert into sells (company_name, memo_no,total_qty,total_price, sell_type) values ('$company_name', '$memo_no','$total_qty','$total_price', 'return')");
		// echo "insert into sell_memos (company_name, memo_no,total_qty,grand_total, sell_type,checked) values ('$company_name', '$memo_no','$total_qty','$grand_total', 'return','1')";	
			db("insert into sell_memos (company_name, memo_no,total_qty,grand_total, sell_type,checked) values ('$company_name', '$memo_no','$total_qty','$grand_total', 'return','1')");		
			db("update sell_memos set due='$newDue' where memo_no='$memo_no' ");
	}

}
 ?>
 <hr>
<form action="mf_shabek_add.php" method="post">
পার্টি :
<input type="text" name="company_name" list="factories">
<datalist class ="" id="factories">
	<?php       
	  $result = dbEach("select * from clients");
	  foreach ($result as $row) {
	  	echo "<option value=\"".$row['company_name']."\">".$row['company_name']."</option>";
	  }     
	?>
</datalist>
<br>
জোড়া 	:
<input type="text" name="total_qty">
<br>
মাল ফেরত বাবদ:
<input type="text" name="grand_total">
<br>
<input type="submit" value="যোগ করুন">
</form>
<?php include "bikri_khata_end.php"; ?>