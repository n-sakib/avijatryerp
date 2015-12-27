<?php  
	require_once "conn.php";
	$pid = $_POST['pid'];
	$cp = $_POST['cp'];
	//change cp in inventory
	$invRes = mysqli_query($con, " SELECT * FROM inventory WHERE pid = '$pid' LIMIT 1 ");
	$inv = mysqli_fetch_array($invRes);
	$oldCp = $inv['cost_price'];
	$qty = $inv["total_qty"];
	$priceChange = $cp - $oldCp; //indicating increase in new price, we will add this val later
	$increament = $priceChange*$qty;

	mysqli_query($con, "UPDATE inventory SET cost_price = '$cp' WHERE pid='$pid' LIMIT 1");

	/*
		change cp in the last entry of purchase
		hence change the balance (cp change = new cp - last cp)
			SELECT *
			FROM `purchases`
			WHERE pid = '00630201002'
			ORDER BY table_index DESC
			LIMIT 1 
	*/
	$purchaseRes = mysqli_query($con, " SELECT * FROM purchases WHERE pid = '$pid' ORDER BY table_index DESC LIMIT 1  ");
	$purchase = mysqli_fetch_array($purchaseRes);
	$memo_no = $purchase['memo_no'];
	$factory = $purchase['factory_name'];
	$newTotal = $purchase["total_price"]+$increament;
	mysqli_query($con, "UPDATE purchases set cost_price='$cp', total_price='$newTotal' WHERE pid = '$pid' ORDER BY table_index DESC LIMIT 1");

	//change balance in the last purchase memo 
	$purchase_memo_res = mysqli_query($con,"SELECT * FROM purchase_memos WHERE factory_name = '$factory' AND memo_no >= $memo_no ");
	while ($purch_memo = mysqli_fetch_array($purchase_memo_res)){
		$grand_total = $purch_memo['grand_total']+$increament;
		$due = $purch_memo['due']+$increament;
		$due = $purch_memo['due']+$increament;
		$memo = $purch_memo['memo_no'];
		$memoIndex = $purch_memo['table_index'];
		mysqli_query($con,"UPDATE purchase_memos SET grand_total = $grand_total, due = $due WHERE table_index = $memoIndex");

		$purch_res = mysqli_query($con,"SELECT * FROM purchases WHERE factory_name = '$factory' AND memo_no = $memo");
		while($purchases = mysqli_fetch_array($purch_res)){
			$purchDue = $purchases['due']+$increament;
			$purchIndex = $purchases['table_index'];
			mysqli_query($con,"UPDATE purchases SET due = $purchDue WHERE table_index = $purchIndex");
		}
	}

echo "$pid আইডিটির দাম $oldCp থেকে $cp তে পরিবর্তন করা হয়েছে";