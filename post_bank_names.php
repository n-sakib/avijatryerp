<?php 
    require_once "conn.php";
	if($_POST['pay_method']=='check'){
		$result = mysqli_query($con,"SELECT * FROM banks");
		echo "ব্যাংক :<select name=\"bank\">";
		echo "<option value=\"0\">সিলেক্ট</option>";
		while($row = mysqli_fetch_array($result)){
			echo "<option value=\"$row[bank_name]\">$row[bank_name]</option>";
		}
		echo "</select> পরিমাণ :";
	}