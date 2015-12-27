<?php 
	require "conn.php";

	$products = $_POST['products'];
	$price = $_POST['prices'];
	$qty=$_POST['qtys'];
	$unit = $_POST['units'];
	$total_price = $_POST['subtotal_prices'];
	$commissioned = 1- ($_POST['commission']*.01);
	$timestamp = "$_POST[year]-$_POST[month]-$_POST[date]";

	$final_qty = 0;
	//inserting into sell log
	foreach($products as $index => $pid) {
		$total_qty = $qty[$index];
		$actual_price = $total_price[$index]*$commissioned;
		//saving misc variables 
		$unit_=$unit[$index];
		$qty_=$qty[$index];
		$price_=$price[$index];
		$total_price_=$total_price[$index];
		//echo "we are here";
		echo "<br> $index <br>"; 
		//echo "$timestamp and ".date('d-m-Y')."<br>";
		//echo "$_POST[company_name] , $_POST[memo_no] , $pid , $unit[$index] , $qty[$index] , $total_qty , $price[$index] , $total_price[$index] , $_POST[commission] , $actual_price , $_POST[paid] , $_POST[curr_due] , $_POST[due] , $_POST[carry_cost] , $_POST[extra_cost] , $_POST[pay_method]";
		//echo "$_POST[company_name] , $_POST[memo_no] , $pid , $unit[$index] , $qty[$index] , $total_qty , $price[$index] , $total_price[$index] , $_POST[commission] , $actual_price , $_POST[paid] , $_POST[curr_due] , $_POST[due] , $_POST[pay_method]";
	
		if ($timestamp == date('Y-m-d') ){

			if ( $index == 0 && ($_POST['extra_cost'] !=null || $_POST['carry_cost'] !=null || $_POST['extra_cost_descr'] !=null || $_POST['date_sold'] !=null) ){
			echo "here1";
			mysqli_query($con,"INSERT INTO sells (company_name, memo_no, pid, unit, qty, total_qty, retail_price, total_price, commission, actual_price, paid, curr_due, due, carry_cost, extra_cost, extra_cost_descr, pay_method,sell_type) 
				VALUES ('$_POST[company_name]','$_POST[memo_no]','$pid','$unit_','$qty_','$total_qty','$price_','$total_price_','$_POST[commission]','$actual_price','$_POST[paid]','$_POST[curr_due]','$_POST[due]','$_POST[carry_cost]','$_POST[extra_cost]','$_POST[extra_cost_descr]','$_POST[pay_method]','client')");
			
			echo "Affected rows: " . mysqli_affected_rows($con)." ";
	    	}	else {
	    			$date_sold = "$timestamp 00:00:00";
					mysqli_query($con,"INSERT INTO sells (company_name, memo_no, pid, unit, qty, total_qty, retail_price, total_price, commission, actual_price, paid, curr_due, due, pay_method,sell_type, date_sold) 
		     		VALUES ('$_POST[company_name]','$_POST[memo_no]','$pid','$unit_','$qty_','$total_qty','$price_','$total_price_','$_POST[commission]','$actual_price','$_POST[paid]','$_POST[curr_due]','$_POST[due]','$_POST[pay_method]','client','$date_sold')");					
					echo 'in else';
					echo "<br> Affected rows: " . mysqli_affected_rows($con)." ";
				}	
		} else {
			if ($index == 0 && ($_POST['extra_cost'] !=null || $_POST['carry_cost'] !=null || $_POST['extra_cost_descr'] !=null || $_POST['date_sold'] !=null) ){
				mysqli_query($con,"INSERT INTO sells (company_name, memo_no, pid, unit, qty, total_qty, retail_price, total_price, commission, actual_price, paid, curr_due, due, carry_cost, extra_cost, extra_cost_descr, pay_method,sell_type) 
					VALUES ('$_POST[company_name]','$_POST[memo_no]','$pid','$unit_','$qty_','$total_qty','$price_','$total_price_','$_POST[commission]','$actual_price','$_POST[paid]','$_POST[curr_due]','$_POST[due]','$_POST[carry_cost]','$_POST[extra_cost]','$_POST[extra_cost_descr]','$_POST[pay_method]','client')");
			}	else {
					mysqli_query($con,"INSERT INTO sells (company_name, memo_no, pid, unit, qty, total_qty, retail_price, total_price, commission, actual_price, paid, curr_due, due, pay_method,sell_type) 
		     		VALUES ('$_POST[company_name]','$_POST[memo_no]','$pid','$unit_','$qty_','$total_qty','$price_','$total_price_','$_POST[commission]','$actual_price','$_POST[paid]','$_POST[curr_due]','$_POST[due]','$_POST[pay_method]','client')");
					echo "<br> Affected rows: " . mysqli_affected_rows($con)." ";
				}
		}
		
			

	// updating inventory
		$result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = $pid LIMIT 1");
		$row = mysqli_fetch_array($result);
		$stock = $row['total_qty'];
		//echo $stock;
		//echo " ".$total_qty;
		$remaining_stock = $stock - $total_qty;
		mysqli_query($con,"UPDATE inventory SET total_qty = $remaining_stock WHERE pid = $pid");
     	
     	$final_qty = $final_qty + $qty_;
	}
	//updating sell memos
	mysqli_query($con,"INSERT INTO sell_memos (company_name, memo_no, curr_due, due, grand_total, extra_cost, extra_cost_descr, carry_cost, paid, sell_type,comment,total_qty)
		VALUES ('$_POST[company_name]','$_POST[memo_no]','$_POST[curr_due]','$_POST[due]','$_POST[total_price]','$_POST[extra_cost]','$_POST[extra_cost_descr]','$_POST[carry_cost]','$_POST[paid]','client','$_POST[comment]','$final_qty')");
	echo "<br> updating memos Affected rows: " . mysqli_affected_rows($con)." ";
	//updating accounts
	$result = mysqli_query($con,"SELECT * FROM accounts LIMIT 1");
	$row = mysqli_fetch_array($result);

	//$prev_credit =  $row['credit'];
	//$credit = $prev_credit + ($_POST['curr_due']);

	$prev_debit = $row['debit'];
	$debit = $prev_debit + ($_POST['paid']);

	$cash = $row['cash']; //payment method is always cash
	$cash = $cash + $_POST['paid'];

	$due_pay = $row['due_pay'];
	$due_pay = $due_pay + $_POST['curr_due'];

	mysqli_query($con,"UPDATE accounts SET debit = $debit , cash = $cash , due_pay = $due_pay WHERE table_index = 1");


	mysqli_close($con);
	echo "we are here";
	header('Location: sell.php?msg=success');