<?php 
	require_once "conn.php";
	$pid = $_POST['pid'];
	$serial = $_POST['serial'];
	$result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = '$pid' LIMIT 1");
	$row = mysqli_fetch_array($result);

	$tabindex = ($serial*3)-1;

	if(mysqli_num_rows($result) == 0){
		echo "<input tabindex=\"$tabindex\"name=\"qtys[]\" id=\"qty$serial\" type=\"text\" value=\"ভুল আইডি\" readonly>";
		
	} else if($row['total_qty'] == 0) {
		//echo "<input name=\"qtys[]\" id=\"qty1\" type=\"text\" value=\"অপেক্ষা করুন\" readonly>";
		//echo "অপেক্ষা করুন";
		echo "<input tabindex=\"$tabindex\"class=\"span8\" name=\"qtys[]\" id=\"qty$serial\" type=\"text\" value=\"স্টক নেই\" readonly><h2 class=\"label label-important stock-stat\">স্টক:$row[total_qty]টি</h2>"; 
	} else if($row['total_qty'] < 6 ) {
		echo "<input tabindex=\"$tabindex\"class=\"span8\" type=\"number\" name=\"qtys[]\" value=\"$row[total_qty]\" id=\"qty$serial\" min=\"1\" max=\"$row[total_qty]\" step=\"1\" onchange=\"numberCheck();\" onfocus=\"numberCheck();\"><h2 class=\"label label-info stock-stat\">স্টক:$row[total_qty]টি</h2>"; 
	} else if($row['total_qty'] >= 6 ) {
		echo "<input tabindex=\"$tabindex\"class=\"span8\" type=\"number\" name=\"qtys[]\" value=\"6\" id=\"qty$serial\" min=\"1\" max=\"$row[total_qty]\" step=\"1\" onchange=\"numberCheck();\" onfocus=\"numberCheck();\"><h2 class=\"label label-info stock-stat\">স্টক:$row[total_qty]টি</h2>"; 
	}