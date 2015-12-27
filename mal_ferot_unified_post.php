<?php
	require_once "conn.php";
	include "convert_number_encoding.php";
	$pid = $_POST['pids'];
	$retail_price = $_POST['retail_prices'];
	$qty = $_POST['qtys'];
	$subtotal =$_POST['subtotal_prices'];
	$raw_total = $_POST['raw_total_price'];
	$total_price = $_POST['total_price'];

	$memo_result = mysqli_query( $con, "SELECT * FROM mal_ferot ORDER BY table_index DESC LIMIT 1" );
	$mal_ferot_last = mysqli_fetch_array( $memo_result );
	$memo_no = null;
	if ( mysqli_num_rows($memo_result)!=0 ) 
	{
		$memo_no = $mal_ferot_last['memo_no'] + 1;
	} else {
		$memo_no = 1;}

	$final_qty = 0;	
	foreach ( $_POST['pids'] as $index =>	$pid ) 
	{	
		$design = substr("$pid", 8,3);
			echo "design $design";
		$subtotal_price = ( -1 )*$subtotal[$index];
		$total_qty = (-1)* convertToEnglishNumber($qty[$index]) ;
		$final_qty = $final_qty + $total_qty;
		//echo "'$_POST[company_name]-$_POST[memo_no]-$pid-$total_qty-$retail_price[$index]-$subtotal-$due-$_POST[return]";
		// iterations inserting into mal_ferot (sells)
		mysqli_query( $con, "INSERT INTO mal_ferot (company_name, memo_no, pid, total_qty, retail_price, total_price, sell_type)
	     		 VALUES ('$_POST[company_name]','$memo_no','$pid','$total_qty','".convertToEnglishNumber($retail_price[$index])."','$subtotal_price','return')" );
		echo "updating mal_ferot Affected rows: " . mysqli_affected_rows( $con );
		//updating inventory
		$result = mysqli_query( $con, "SELECT * FROM inventory WHERE pid = $pid LIMIT 1" );
		$row = mysqli_fetch_array( $result );
		if ( mysqli_num_rows( $result )!=0 ) {
			$stock = $row['total_qty'];
			//echo $stock;
			//echo " ".$total_qty;
			$new_stock = $stock + ((-1)*$total_qty); //total qty is already negative

			mysqli_query( $con, "UPDATE inventory SET total_qty = $new_stock WHERE pid = $pid" );
		} else {
			/*$pid = substr("$pid", 0,11);
			echo "pid $pid";*/
			$genre = substr("$pid", 3,1);
			echo "genre $genre";
			$type = substr("$pid", 4,2);
			echo "type $type";
			$color = substr("$pid", 6,2);
			echo "color $color";
			$design = substr("$pid", 8,3);
			echo "design $design";
			echo 'inventory';
			$stock = (-1)*$total_qty;
			mysqli_query( $con, "INSERT INTO inventory (factory_name, pid, genre, type, color,design, total_qty, retail_price, unit_on_retail_price) VALUES ('$_POST[factory_name]','$pid','$genre','$type','$color','$design','$stock','$retail_price[$index]','1')" );
			echo "Affected rows: " . mysqli_affected_rows( $con )." ";
		}

	}
	//updating mal_ferot_memos (sell  memos)
	$cash_return = ( -1 )*$total_price;
	mysqli_query( $con, "INSERT INTO mal_ferot_memos (company_name, memo_no, grand_total, sell_type,total_qty)
	     		VALUES ('$_POST[company_name]','$memo_no','$cash_return','return','$final_qty')" );
	echo " updating  memos Affected rows: " . mysqli_affected_rows( $con );

	//updating accounts
	$result = mysqli_query( $con, "SELECT * FROM accounts LIMIT 1" );
	$row = mysqli_fetch_array( $result );

	//$prev_credit =  $row['credit'];
	//$credit = $prev_credit + ($_POST['curr_due']);

	$prev_debit = $row['debit'];
	$debit = $prev_debit - ( $total_price );

	mysqli_query( $con, "UPDATE accounts SET debit = $debit WHERE table_index = 1" );

	mysqli_close( $con );
	//echo "we are here";
	header( 'Location: mal_ferot.php?msg=success' );