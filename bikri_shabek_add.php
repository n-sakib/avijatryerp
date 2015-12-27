<?php 
include "bikri_comm_start.php"; 
include "util.php"; ?> 
<span class="badge"><a href="bikri_shabek_add.php">পার্টি সাবেক</a></span>
<span class="badge badge-warning"><a href="mf_shabek_add.php">পার্টি মাল ফেরত সাবেক</a></span>
<?php 
if($_POST)
{
	db("insert into sells (company_name, memo_no, pid, unit, qty, total_qty, retail_price, total_price, commission, actual_price, paid, curr_due, due, pay_method,sell_type, date_sold) 
				     		VALUES ('$_POST[company_name]','$_POST[memo_no]','$pid','$unit_','$qty_','$total_qty','$price_','$total_price_','$_POST[commission]','$actual_price','$_POST[paid]','$_POST[curr_due]','$_POST[due]','$_POST[pay_method]','client','$date_sold')");
}
 ?>
 <hr>
<form action="bikri_shabek_add.php" method="post">
পার্টি :
<input type="text" name="company_name">
<br>
জোড়া 	:
<input type="text" name="total_qty">
<br>
গায়ের দামে:
<input type="text" name="total_price">
<br>
কমিশন বাদে দাম:
<input type="text" name="grand_total">
<br>
পাঠানো খরচ:
<input type="text" name="carry_cost">
<br>
এক্সট্রা খরচ:
<input type="text" name="extra_cost">
<br>
এক্সট্রা খরচ বাবদ:
<input type="text" name="extra_cost_descr">
<br>
জমা:
<input type="text" name="paid">
<hr>
<input type="submit" value="যোগ করুন">
</form>
<?php include "bikri_khata_end.php"; ?>