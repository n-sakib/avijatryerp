<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>মাল চেক</title>
</head>
<body>
	<?php 
		$pid_val = $_POST['pids'];
		$qty = $_POST['qtys']; 
		$rows = $_POST['total-row'];
		$packs = $_POST['total-pack'];

		$last_pack = array();
		if (isset($_POST['pack_last'])){
			$last_pack = $_POST['pack_last'];
		} else {
		}
		array_push($last_pack, "$rows");
		$start_carton =0;
		for ( $carton_no = 0 ; $carton_no < $packs ; $carton_no++) { //last pack index starts from 0
			$carton = $carton_no +1;
			echo " <p> কারটন নং $carton </p>
					<table> 
					<tr> <th> বিবরণ </th>
						<th> পরিমাণ </th>
					</tr>";
					//print_r($pid_val);
			for ($index = $start_carton ; $index < $last_pack[$carton_no] ; $index++){
				require_once "conn.php";
				$pid = $pid_val[$index];
				
				$inventory_result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = '$pid' LIMIT 1");               
				$inventory = mysqli_fetch_array($inventory_result) ;

				//getting description
				$genre = '';
				if ($inventory['genre'] == 1) {
				$genre = 'জেন্টস' ;
				} else if ($inventory['genre'] == 2) {
				$genre = 'লেডিস';
				} else if ($inventory['genre'] == 3) {
				$genre = 'সু';
				} else if ($inventory['genre'] == 4) {
				$genre = 'বেবি';
				} else{}

				$type_result = mysqli_query($con,"SELECT * FROM inventory_config_types WHERE genre = '$inventory[genre]' AND serial_no = '$inventory[type]' LIMIT 1");                
				$type = mysqli_fetch_array($type_result) ;
				$type = $type['type'];

				$color_result = mysqli_query($con,"SELECT * FROM inventory_config_colors WHERE serial_no = '$inventory[color]' LIMIT 1");               
				$color = mysqli_fetch_array($color_result) ;
				$color = $color['color'];

				$description = "$genre $type $color";
				// if ($description != " "){
				// 	echo $description;	
				// } else{
				// 	echo 'পাওয়া যায়নি';
				// }
				echo "<tr> 
						<td>$description</td>
						<td>$qty[$index]</td>	
					</tr>";
			}

			echo "</table>";
			$start_carton = $last_pack[$carton_no];
		}
	 ?>
	<input type="button" value="প্রিন্ট" onclick="javascript:window.print();">
</body>
</html>