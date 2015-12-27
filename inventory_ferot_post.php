<?php 
	require "conn.php";	
	include "convert_number_encoding.php";
	//negative purchase
	//generate_pid
	$get_res = mysqli_query($con,"SELECT * FROM purchase_memos ORDER BY table_index DESC LIMIT 1");
	$get = mysqli_fetch_array($get_res);
	$memo_no = $get['memo_no']+1;
	echo "memo_no $memo_no";
	$qty = $_POST['qtys'];
	$cost_price = $_POST['cost_prices'];
	$subtotals = $_POST['subtotal_prices'];
	$total_price = $_POST['total_price'];
	
	$result = mysqli_query($con,"SELECT * FROM purchases ORDER BY table_index DESC LIMIT 1");
	$row = mysqli_fetch_array($result);	
	$due = $row['due'] - $total_price;
	$total_price = $total_price*(-1);
	//inserting into purchases log
	foreach($_POST['pids'] as $index => $pid) {	
		$cost_price[$index] = $cost_price[$index] *(-1); 
		$qty[$index] = convertToEnglishNumber(trim($qty[$index])) *(-1);
		$subtotal = $subtotals[$index]*(-1);
		
		//fetching factory name
		$result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = '$pid' LIMIT 1");
		$row = mysqli_fetch_array($result);
		$factory = $row['factory_name'];
		//$retail_price = $row['retail_price'];
		//getting total qty /dozen is default	
		$total_qty = convertToEnglishNumber(trim($qty[$index]));

		// iterations inserting into purchases
		
		echo 'here';
			mysqli_query($con,"INSERT INTO purchases (factory_name, memo_no, pid, total_qty,cost_price, total_price, due) 
 		VALUES ('$factory','$memo_no','$pid','$total_qty','$cost_price[$index]','$subtotal','$due')");		
	
		//updating inventory
			$result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = '$pid' LIMIT 1");			
			$row = mysqli_fetch_array($result);
			if(mysqli_num_rows($result)!=0){
				$stock = $row['total_qty'];
				//echo $stock;
				//echo " ".$total_qty;
				$new_stock = $stock + $total_qty;

				mysqli_query($con,"UPDATE inventory SET total_qty = $new_stock WHERE pid = $pid");
			} else{}		
	}
	//updating purchase  memos
		mysqli_query($con,"INSERT INTO purchase_memos (factory_name, memo_no, due, grand_total, paid, purchase_type) 
	    	VALUES ('$factory','$memo_no','$due','$total_price','$total_price','return')");
	
	//updating accounts
	$result = mysqli_query($con,"SELECT * FROM accounts LIMIT 1");
	$row = mysqli_fetch_array($result);

	$prev_debit = $row['debit'];
	$debit = $prev_debit + ($total_price);


	/*$cash = $row['cash']; //payment method is always cash
	$cash = $cash + $_POST['total_price']; ,// cash = $cash*/

	mysqli_query($con,"UPDATE accounts SET debit = $debit WHERE table_index = 1");

	mysqli_close($con);
	//echo "we are here";
header('Location: inventory_ferot.php?msg=success');