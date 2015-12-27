<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<title>pid table</title>
	<link href="css/pid_table.css" rel="stylesheet">
	<link href="css/pid_print.css" rel="stylesheet">
</head>
<body>
		<?php
			require "conn.php";
			$memo_no = $_GET['memo_no'];

			$result = mysqli_query($con,"SELECT * FROM purchases WHERE memo_no = '$memo_no'");

			$tags = array();
			//echo mysqli_num_rows($result);
			while($row = mysqli_fetch_array($result)){
	          $pid = $row['pid'];

	          $qty = $row['total_qty']+0;
	          //echo "pid $pid <br>";
	          //echo "qty $qty <br>";

			  //getting description
			  $inventory_result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = '$pid' LIMIT 1");               
              $inventory = mysqli_fetch_array($inventory_result);
              //echo "Affected rows: " . mysqli_affected_rows($con);	
              $memo_result = mysqli_query($con,"SELECT * FROM purchase_memos WHERE memo_no = '$memo_no'");               
              $memo = mysqli_fetch_array($memo_result) ;
              //echo "Affected rows: " . mysqli_affected_rows($con);
              $genre = '';
              if ($inventory['genre'] == 1) {
                $genre = 'জেঃ' ;
              } else if ($inventory['genre'] == 2) {
                $genre = 'লেঃ';
              } else if ($inventory['genre'] == 3) {
                $genre = 'সু';
              } else if ($inventory['genre'] == 4) {
                $genre = 'বেবি';
              } else{}
              //echo "genre : $genre $inventory[genre] <br> $inventory[genre]";
              $type_result = mysqli_query($con,"SELECT * FROM inventory_config_types WHERE genre = '$inventory[genre]' AND serial_no = '$inventory[type]' LIMIT 1");                
              $type = mysqli_fetch_array($type_result) ;
              //echo " rows: " . mysqli_affected_rows($con);
              $type_name = $type['type'];
              //echo "type $type_name";

              $color_result = mysqli_query($con,"SELECT * FROM inventory_config_colors WHERE serial_no = '$inventory[color]' LIMIT 1");               
              $color = mysqli_fetch_array($color_result) ;
              //echo "Affected rows: " . mysqli_affected_rows($con);
              $color_name = $color['color'];

              $description = "$genre $type_name $color_name";
              //echo "$qty <br>";
              $pid = "*".$pid."*";
              //ini_set('memory_limit', '128M');
              //ini_set('memory_limit', '-1');
              //echo $qty;
              //echo " $description" ;
              for ($i = $qty; $i > 0 ; $i--){
              	//echo $i;
              	$barcode = array( "descr" => "$description", "pid" => "$pid" );
              	$tags[] = $barcode	;
              }
              
			}
			//print_r($tags);
			$serial = 1;
			$size = sizeof($tags);
			echo "<table>";
			foreach ($tags as $index => $tag) {
			
				if($serial == 1){
					echo "<tr><td id=\"c1\"> <p class=\"des\">".$tag['descr']."</p><p class=\"bc\">".$tag['pid']."</p> </td>";  
				} else if ($serial == 2){
					echo "<td id=\"c2\"> <p class=\"des\">".$tag['descr']."</p><p class=\"bc\">".$tag['pid']."</p> </td>";
				} else if ($serial == 3){
					echo "<td id=\"c3\"> <p class=\"des\">".$tag['descr']."</p><p class=\"bc\">".$tag['pid']."</p> </td>";
				} else if($serial ==4){
					echo "<td id=\"c4\"> <p class=\"des\">".$tag['descr']."</p><p class=\"bc\">".$tag['pid']."</p> </td></tr>";
					$serial = 0;
				}	
				$serial++;
			}
			if ($size % 4 != 0 ){
				echo "</tr>";
			}
			echo "</table>";
		 ?>
	<input id="print-btn" type="button" value="প্রিন্ট" onclick="javascript:window.print();">
	<a id="gen-btn" style="background-color:cyan;" href="pid_print.php?memo_no=<?php echo $memo_no; ?>">জেনারেট</a>
</body>
</html>