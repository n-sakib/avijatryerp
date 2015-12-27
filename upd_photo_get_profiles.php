<?php 
	require_once "conn.php";
	$profile = $_POST['profile'];
	$query = '';
	$name = '';
	if($profile == 'clients'){
		$query = "SELECT * FROM clients";
		$name = "company_name";
	}else if($profile == 'factories'){
		$query = "SELECT * FROM factories";
		$name = "factory_name";
	}else if($profile == 'staffs'){
		$query = "SELECT * FROM staffs";
		$name = "staff_name";
	}else if($profile == 'expenses'){
		$query = "SELECT * FROM other_expenses";
		$name = "expense_name";
	}else if($profile == 'inventory'){
		$query = "SELECT * FROM inventory";
		$name = "pid";
		echo "<input type=\"text\" name=\"name_info\">";
	}
	if ($profile != 'inventory'){
		$result = @mysqli_query($con,$query);
		echo "<select name=\"name_info\">";
		echo "<option value=\"0\">সিলেক্ট</option>";
		while($row = mysqli_fetch_array($result)){
			echo "<option value=\"$row[$name]\">$row[$name]</option>";
		}
		echo "</select>";
	}
	