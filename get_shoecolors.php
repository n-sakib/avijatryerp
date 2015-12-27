<?php 
	require_once "conn.php";
	$result = mysqli_query($con,"SELECT * FROM inventory_config_colors");
	echo "<option value=\"0\" selected=\"selected\" >সিলেক্ট</option>";
	while($row = mysqli_fetch_array($result)){
		echo "<option value=\"".$row['serial_no']."\" >".$row['color']."</option>";
	}