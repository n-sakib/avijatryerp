<?php
    require_once "conn.php";
	$result = null;
	$name = null;
	if($_POST['purchase_type']=='factory'){
		$result = mysqli_query($con,"SELECT * FROM factories");
		$name = 'factory_name';
	}
	else if($_POST['purchase_type']=='staff'){
		$result = mysqli_query($con,"SELECT * FROM staffs");
		$name = 'staff_name';
	}
	else if($_POST['purchase_type']=='bank'){
		$result = mysqli_query($con,"SELECT * FROM banks");
		$name = 'bank_name';
	}
	else if($_POST['purchase_type']=='other_expenses'){
		$result = mysqli_query($con,"SELECT * FROM other_expenses");
		$name = 'expense_name';
	} else{}

	//echo "<p>we are here</p>"
	echo "<select name=\"name\">
			<option value=\"0\" selected=\"selected\">সিলেক্ট</option>";
	while($row = mysqli_fetch_array($result)){
		echo "<option value=\"".$row[$name]."\">".$row[$name]."</option>"; 
	}
	echo "</select>";

