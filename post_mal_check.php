<?php 
	require_once "conn.php";
	$memo_no = $_POST['memo_no'];
	$pids_arr = $_POST['pids'];
	$pids = explode(',',$pids_arr[0]);
	$qtys_arr = $_POST['qtys'];
	$qty = explode(',',$qtys_arr[0]);
	//print_r($qty);

	$packed_products = array();
	foreach ($pids as $index => $pid) {
		$product = array("pid" => $pid, "qty" =>$qty[$index] );
		$packed_products[] = $product;
	}

	$sold_products = array();
	$sells_result = mysqli_query($con,"SELECT * FROM sells WHERE memo_no='$memo_no'");
	while($sells = mysqli_fetch_array($sells_result)){
		if($sells['total_qty']>0){	
			$product = array("pid" => $sells['pid'], "qty" => $sells['total_qty']);
			$sold_products[] = $product;
		}
	}

	//print_r($sold_products);

	//taking sold qty to calculate on
	$checked = 'ok';//expected value of checked
	foreach ($packed_products as $index => $packed) {

		foreach ($sold_products as $key => $sold) {
			if($packed['pid'] == $sold['pid']){
				if ($sold['qty'] >= $packed['qty']){
					$sold['qty'] = $sold['qty'] - $packed['qty']; //subtracting from sold qty
					$packed['qty'] = 0;
				}else if ($sold['qty'] < $packed['qty']) {
					$checked = 'fail';
					break;
				}
			}
			$sold_products[$key] = $sold;
			$packed_products[$index] = $packed;
		}
	}
	$msg = "\nনিম্নের জুতোগুলো মিলছে না :";
	foreach ($sold_products as $index => $sold){
		if ($sold['qty'] != 0){//  && $checked == 'ok'){
			$checked = 'fail';
			$msg= "$msg\n## $sold[pid] আইডির $sold[qty] টি";
			//echo "চেকিং অসফল ,$sold[pid] আইডির $sold[qty] টি জুতা মিলছে না";
			//break;
		}
	}
	$pack_msg = "\nপ্যাকিং এ নিম্নের জুতোগুলো অবাঞ্ছিত :";
	foreach ($packed_products as $index => $packed){
		if ($packed['qty'] > 0){// != 0  && $checked == 'ok'){
			$checked = 'fail';
			$pack_msg= "$pack_msg\n## $packed[pid] আইডির $packed[qty] টি";
		}
	}
	if ($checked == 'ok'){
		echo "চেকিং সফল";
		mysqli_query($con,"UPDATE sell_memos SET checked = 1 WHERE memo_no = '$memo_no'");
	} else {
		echo "চেকিং অসফল $msg $pack_msg";
	}
