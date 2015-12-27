<?php 
	require_once "conn.php";
	$pid = $_POST['pids'];
	$retail_price = $_POST['retail_prices'];
	$qty = $_POST['qtys'];
	$subtotal =$_POST['subtotal_prices'];
	$raw_total = $_POST['raw_total_price'];
	$total_price = $_POST['total_price'];

	$result = mysqli_query($con,"SELECT * FROM sell_memos WHERE company_name = '$_POST[company_name]' ORDER BY table_index DESC LIMIT 1");
	$row = mysqli_fetch_array($result);
	$due = $row['due'];
	$due = $due - $total_price;

	foreach($_POST['pids'] as $index => $pid) {
		$subtotal_price = (-1)*$subtotal[$index];
		$total_qty = ($qty[$index]);
		//echo "'$_POST[company_name]-$_POST[memo_no]-$pid-$total_qty-$retail_price[$index]-$subtotal-$due-$_POST[return]";
		// iterations inserting into sells
			mysqli_query($con,"INSERT INTO sells (company_name, memo_no, pid, total_qty, retail_price, total_price, due, return_goods) 
     		 VALUES ('$_POST[company_name]','$_POST[memo_no]','$pid','$total_qty','$retail_price[$index]','$subtotal_price','$due','$_POST[return]')");	
		echo "updating sells Affected rows: " . mysqli_affected_rows($con); 
		//updating inventory
			$result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = $pid LIMIT 1");			
			$row = mysqli_fetch_array($result);
			if(mysqli_num_rows($result)!=0){
				$stock = $row['total_qty'];
				//echo $stock;
				//echo " ".$total_qty;
				$new_stock = $stock + $total_qty;

				mysqli_query($con,"UPDATE inventory SET total_qty = $new_stock WHERE pid = $pid");
			} else{
				echo 'inventory';
				mysqli_query($con,"INSERT INTO inventory (factory_name, pid, genre, type, color, total_qty, retail_price, unit_on_retail_price) VALUES ('$_POST[factory_name]','$pid','$genre','$type[$index]','$color[$index]','$total_qty','$retail_price[$index]','12')");
				echo "Affected rows: " . mysqli_affected_rows($con)." ";
			}
			
	}     	   
	//updating sell  memos
	$cash_return = (-1)*$total_price;
	mysqli_query($con,"INSERT INTO sell_memos (company_name, memo_no, due, grand_total, return_goods) 
     		VALUES ('$_POST[company_name]','$_POST[memo_no]','$due','$cash_return','$_POST[return]')");
	echo " updating sell memos Affected rows: " . mysqli_affected_rows($con);

	//updating accounts
	$result = mysqli_query($con,"SELECT * FROM accounts LIMIT 1");
	$row = mysqli_fetch_array($result);

	//$prev_credit =  $row['credit'];
	//$credit = $prev_credit + ($_POST['curr_due']);

	$prev_debit = $row['debit'];
	$debit = $prev_debit - ($total_price);

	mysqli_query($con,"UPDATE accounts SET debit = $debit WHERE table_index = 1");

	mysqli_close($con);
	//echo "we are here";
header('Location: mal_ferot.php');