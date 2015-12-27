<?php
    require_once "conn.php";
	$result = null;
	$name = null;
	if($_POST['sell_type']=='client'){
		$result = mysqli_query($con,"SELECT * FROM clients");
		$name = 'company_name';
	}
	else if($_POST['sell_type']=='staff'){
		$result = mysqli_query($con,"SELECT * FROM staffs");
		$name = 'staff_name';
	}
	else if($_POST['sell_type']=='bank'){
		$result = mysqli_query($con,"SELECT * FROM banks");
		$name = 'bank_name';
	} 
	else if($_POST['sell_type']=='other_expenses'){
		$result = mysqli_query($con,"SELECT * FROM other_expenses");
		$name = 'expense_name';
	} else{}

	//echo "<p>we are here</p>"
	
	if($_POST['sell_type']=='client'){
		echo "<select name=\"company_name\" id=\"company_name\" onchange=\"javascript:ajax_get_jolap_form();\">";
		echo "<option selected=\"selected\">সিলেক্ট</option>";
		while($row = mysqli_fetch_array($result)){
			echo "<option value=\"".$row[$name]."\">".$row[$name]."</option>"; 
		}
		echo "</select>";

		echo "<select name=\"pay_method\" id=\"pay_method\" onclick=\"ajax_post_bank_names();\">
				<option value=\"cash\">ক্যাশ</option>
				<option value=\"check\">ব্যাংক</option>
				</select>";
	} else {
		echo "<select name=\"company_name\">";
		echo "<option selected=\"selected\">সিলেক্ট</option>";
		while($row = mysqli_fetch_array($result)){
			echo "<option value=\"".$row[$name]."\">".$row[$name]."</option>"; 
		}
		echo "</select>";
	
	}
