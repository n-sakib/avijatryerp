<?php 
	require_once "conn.php";
	$client = $_POST['company_name'];
	//$client = 'রাফা';

	$mal_ferot_memo_result = mysqli_query($con,"SELECT * FROM mal_ferot_memos WHERE company_name = '$client' AND checked = 0");								
	while($memo = mysqli_fetch_array($mal_ferot_memo_result))
	{	
		$ferot_memo = $memo['memo_no'];
		echo "<table class=\"table table-condensed table-striped table-bordered table-hover\">";
		echo "<tr>
				<th>আইডি</th>
				<th>গায়ের দাম</th>
				<th>পরিমান</th>
				<th>মোট দাম
					<span class=\"btn btn-info pull-right\"id=\"ferot-btn\" onclick=\"javascript:ajaxFerotConfirm('$ferot_memo');\">ফেরত নিন</span>
					<span class=\"btn  pull-right\"id=\"ferot-cancel\" onclick=\"javascript:ajaxFerotCancel('$ferot_memo');\">বাতিল</span>
				</th> 
				</tr>";
		$mal_ferot_result = mysqli_query($con,"SELECT * FROM mal_ferot WHERE memo_no = '$ferot_memo'");								
		while($ferot = mysqli_fetch_array($mal_ferot_result))
		{
			$pid = $ferot['pid'];
			$retail_price = $ferot['retail_price'];
			$total_qty = (-1)*$ferot['total_qty'];
			$total_price = (-1)*$ferot['total_price'];
			
			echo "<tr>
					<th>$pid</th>
					<th>$retail_price</th>
					<th>$total_qty</th>
					<th>$total_price</th> 
					</tr>";
		}
		$final_qty = (-1)*$memo['total_qty'];
		$final_amount = (-1)*$memo['grand_total'];
		echo "<tr>
				<th></th>
				<th></th>
				<th>মোট পরিমান : $final_qty</th>
				<th>ফেরত বাবদ : $final_amount</th> 
				</tr>";
		echo "</table>";
	}

	print_r($memo);


