<?php 
//	
//	follow this sequence
//	
//	raw cost price [gayer dame]
//	(-)commission []
//	= raw cost - commision [commission baade]
//	(-) mal ferot
//	(-) extra khoroch (will it be added or subtracted from due) 
//	(+) pathano khoroch
//	(+)prev due
//	(+)paid
//	== total due [mot]$grand_total
require "conn.php";
	
	$result = mysqli_query($con,"SELECT * FROM sells WHERE memo_no = $memo_no AND sell_type='client'");             
	
	//.............................
	// generating product list
	//.............................
	//make a clone fetched array, where pid shows description
	
	$products = array();
	while($row = mysqli_fetch_array($result)){
		//getting description
		$pid_val = trim($row['pid']);
		$inventory_result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = '$pid_val' LIMIT 1");								
	$inventory = mysqli_fetch_array($inventory_result) ;
	
	$genre = '';	
	if ($inventory['genre'] == 1) {
		$genre = 'জেঃ' ;
	} else if ($inventory['genre'] == 2) {
		$genre = 'লেঃ';
	} else if ($inventory['genre'] == 3) {
		$genre = 'সু';
	} else if ($inventory['genre'] == 4) {
		$genre = 'বেঃ';
	} else{}

	$type_result = mysqli_query($con,"SELECT * FROM inventory_config_types WHERE genre = '$inventory[genre]' AND serial_no = '$inventory[type]' LIMIT 1");								
	$type = mysqli_fetch_array($type_result) ;
	$type_name = $type['type'];
	$products_update = $row;
	array_push($products_update, "$genre"); //index 21 -> due to db update, its 22 now
	array_push($products_update, "$type_name");  // index 22 -> 23
	$products[] = $products_update;
		//print_r($products_update);
	}
	
	//refactoring similar products
	foreach ($products as $index_a => $product_a) {
		//product a 
		
		foreach ($products as $index_b => $product_b) {
			if($index_a < $index_b && $product_a['retail_price'] == $product_b['retail_price'] && $product_a['22'] == $product_b['22']){
		
				//re re factor the type (ud)
				$prod_types = explode(' + ',$product_a['23']);
				$type_match = false;
				foreach ($prod_types as $index => $type) {
					if ($type == $product_b['23']){
						$type_match = true;		
						break;
					}
				}
				$product_type = $product_a['23'];

				if ($type_match != true){
					$product_type = "$product_a[23] + $product_b[23]";
				 } 
				$product_a['23'] = $product_type ;

				$product_a['total_qty'] = $product_a['total_qty'] + $product_b['total_qty'];
				$product_a['total_price'] = $product_a['total_price'] + $product_b['total_price'];
				$products[$index_a] = $product_a;

				$products[$index_b] = null ;          						
			} else{}
		}
		
	}
	
	//final printing
		$serial= 1;
		$raw_total = 0;	//sum of all the subtotal sp (sp*qty)
		$price_woc = 0; //price without commission

		$ija = array();
		$ijaV = 0;
		$ijaC =1;
		$rowC = 1;
		

		$grand_qty = 0;
		$grand_total = 0; //Mot

		foreach ($products as $index => $product) {
			
			if($product != null){
				echo "<tr>  
						<td>$serial</td>
						<td>$product[22] $product[23]</td>
						<td>$product[total_qty]</td>
						<td>$product[retail_price]</td>
						<td>$product[total_price]</td> 
					</tr>";
				
				$raw_total = $raw_total + $product['total_price'];
				$price_woc = $price_woc + $product['actual_price'];
				$ijaV = $ijaV +$product['retail_price'];
				$serial++;
				$grand_qty = $grand_qty + $product['total_qty'];
			}
			$rowC++;
		}
		echo "<tr>  
				<td></td>
				<td></td>
				<td>= $grand_qty</td>
				<td></td>
				<td></td> 
			  </tr>
			</tbody>";
		$result = mysqli_query($con,"SELECT * FROM sell_memos WHERE memo_no = '$memo_no' ORDER BY table_index DESC LIMIT 1");
		$row = mysqli_fetch_array($result) ;
		
		$comm_result = mysqli_query($con,"SELECT * FROM sells WHERE memo_no = '$memo_no' ORDER BY table_index DESC LIMIT 1");
		$comm = mysqli_fetch_array($comm_result) ;
		echo "<tbody class=\"calc\" <tr><td></td>
				<td></td>
				<td></td>
				<td>গায়ের দামে</td>
				<td>$raw_total</td> </tr>";
		$com = $raw_total*$comm['commission']*(0.01);
		echo "<tr><td></td>
				<td></td>
				<td></td>
				<td>কমিশন</td>
				<td>$com</td> </tr>";
		$price_woc = $raw_total - $com;
		echo "<tr><td></td>
				<td></td>
				<td> </td>
				<td>কমিশন বাদে</td>
				<td>$price_woc</td> </tr>";

		$grand_total = $price_woc;
	
		 //calculating ferot
		$ferot_result = mysqli_query($con, "SELECT * FROM sell_memos WHERE memo_no = '$memo_no' AND sell_type = 'return' ");
		$return_qty = 0;
		$return_amount = 0;
		if ( mysqli_num_rows($ferot_result) != 0){
			
			while ($ferot = mysqli_fetch_array($ferot_result)){
				$return_qty = $return_qty + $ferot['total_qty'];
				$return_amount = $return_amount + $ferot['grand_total'];
			}
			$return_amount = $return_amount*(-1);
       		$return_qty = $return_qty*(-1);
			echo "<tr><td></td>
				<td></td>
				<td>ফেরত</td>
				<td>$return_qty (জোড়া)</td>
				<td>$return_amount</td></tr>";  

        $grand_total = $grand_total - $return_amount;
        echo "<tr><td></td>
				<td></td>
				<td></td>
				<td>মোট</td>
				<td>$grand_total</td> </tr>";		
		}

		// echo "<tr><td></td>
		// 		<td></td>
		// 		<td></td>
		// 		<td>জমা</td>
		// 		<td>$row[paid]</td> </tr>";
	    //$subtotal = $grand_total - $row['paid'];
	 //    echo "<tr><td></td>
		// 		// <td></td>
		// 		// <td></td>
		// 		// <td>মোট</td>
		// 		// <td>$subtotal</td> </tr>";
		if ( $row['extra_cost'] != 0){
			echo "<tr><td></td>
				<td></td>
				<td>এক্সট্রা খরচ</td>
				<td>$row[extra_cost_descr]</td>
				<td>$row[extra_cost]</td></tr>";
			//$subtotal = $subtotal - $row['extra_cost'];
			$grand_total = $grand_total - $row['extra_cost'];
	    	echo "<tr><td></td>
					<td></td>
					<td></td>
					<td>মোট</td>
					<td>$grand_total</td> </tr>";
		}
		if ( $row['carry_cost'] != 0){
			echo "<tr><td></td>
				<td></td>
				<td> </td>
				<td>পাঠানো খরচ</td>
				<td>$row[carry_cost]</td> </tr>";
			$grand_total = $grand_total + $row['carry_cost'];
	    	echo "<tr><td></td>
					<td></td>
					<td></td>
					<td>মোট</td>
					<td>$grand_total</td> </tr>";
		}
		/*$final_result = mysqli_query($con,"SELECT * FROM sell_memos WHERE memo_no = $memo_no ORDER BY table_index DESC LIMIT 1");   
		$final = mysqli_fetch_array($final_result);*/
		$prev_due = 0;
		$sell_memos_res = mysqli_query($con,"SELECT * FROM sell_memos WHERE company_name = '$client_name' AND sell_type = 'client' AND memo_no < '$memo_no' ORDER BY table_index DESC LIMIT 1");
        $memo = mysqli_fetch_array($sell_memos_res);
        $prev_due = @$memo['due'];
		
		//$prev_due = $row['due']-$return_amount; //due def is updated
		if($prev_due>0){
			echo "<tr><td></td>
					<td></td>
					<td></td>
					<td>সাবেক</td>
				<td>$prev_due</td> </tr>";	
			
			//$subtotal = $prev_due + $price_woc;
			//
			$grand_total = $grand_total + $prev_due;
			echo "<tr><td></td>
					<td></td>
					<td></td>
					<td>মোট</td>
					<td>$grand_total</td> </tr>";
		}
		echo "<tr><td></td>
				<td></td>
				<td></td>
				<td>জমা</td>
				<td>$row[paid]</td> </tr>";
		echo "<tr><td></td>
				<td></td>
				<td></td>
				<td>মোট বাকী</td>
				<td>$row[due]</td> </tr> </tbody>";		
	