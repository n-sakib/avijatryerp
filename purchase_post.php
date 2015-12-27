<?php 
	require "conn.php";
	include "convert_number_encoding.php";
	//generate_pid

	$genres = $_POST['genres'];
	$type = $_POST['types'];
	$color = $_POST['colors'];
	$design = $_POST['designs'];
	$pid = $_POST['pids'];
	$image = $_POST['images'];
	$qty = $_POST['qtys'];
	$retail_price = $_POST['retail_prices'];
	$cost_price = $_POST['cost_prices'];
	$total_price = $_POST['subtotals'];
    $grand_total = 0;	

	//inserting into purchases log
	foreach($genres as $index => $genre) {
		

		//getting total qty /dozen is default	
				//$total_qty =$qty[$index]*$unit[$index];
		$total_qty =convertToEnglishNumber($qty[$index]);

		$grand_total = $grand_total + convertToEnglishNumber($total_price[$index]);
		// iterations inserting into purchases
			if($index == 0){
				mysqli_query($con,"INSERT INTO purchases (factory_name, memo_no, pid, qty, total_qty, retail_price, cost_price, total_price, curr_due, due) 
     		VALUES ('$_POST[factory_name]','$_POST[memo_no]','$pid[$index]','$total_qty', '$total_qty','$retail_price[$index]','$cost_price[$index]','$total_price[$index]','$_POST[curr_due]','$_POST[due]')");		
			}else{
				mysqli_query($con,"INSERT INTO purchases (factory_name, memo_no, pid, qty, total_qty, retail_price, cost_price, total_price, curr_due, due) 
     		VALUES ('$_POST[factory_name]','$_POST[memo_no]','$pid[$index]','$total_qty', '$total_qty','$retail_price[$index]','$cost_price[$index]','$total_price[$index]','$_POST[curr_due]','$_POST[due]')");
			}	
		//updating inventory
			$result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = '$pid[$index]' LIMIT 1");			
			$row = mysqli_fetch_array($result);
			if(mysqli_num_rows($result)!=0){
				$stock = $row['total_qty'];
				//echo $stock;
				//echo " ".$total_qty;
				$new_stock = $stock + $total_qty;

				mysqli_query($con,"UPDATE inventory SET total_qty = $new_stock WHERE pid = '$pid[$index]' ");
			} else{
				//echo 'inventory';
				mysqli_query($con,"INSERT INTO inventory (factory_name, pid, genre, type, color, design, image, total_qty, retail_price, cost_price, unit_on_retail_price) VALUES ('$_POST[factory_name]','$pid[$index]','$genre','$type[$index]','$color[$index]','$design[$index]','$image[$index]','$total_qty','$retail_price[$index]','$cost_price[$index]','1')");
				//echo "Affected rows: " . mysqli_affected_rows($con);
			}
	}

	
	//updating purchase  memos
	mysqli_query($con,"INSERT INTO purchase_memos (factory_name, memo_no, curr_due, due, grand_total, paid, purchase_type) 
     		VALUES ('$_POST[factory_name]','$_POST[memo_no]','$_POST[curr_due]','$_POST[due]','$grand_total','$_POST[paid]','factory')");
	//echo "Affected rows: " . mysqli_affected_rows($con)." ";

	//updating accounts
	$result = mysqli_query($con,"SELECT * FROM accounts LIMIT 1");
	$row = mysqli_fetch_array($result);

	$prev_credit =  $row['credit'];
	$credit = $prev_credit + ($_POST['curr_due']);

	$cash = $row['cash']; //payment method is always cash
	$cash = $cash - ($_POST['paid']);

	$capital = $row['capital'] + $grand_total;

	mysqli_query($con,"UPDATE accounts SET credit = $credit , cash = $cash ,capital = $capital WHERE table_index = 1");

	mysqli_close($con);
	
	//echo "end of the line";	
	header('Location: purchase.php?msg=success');