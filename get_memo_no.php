<?php 
	require_once "conn.php";
	$client_result = mysqli_query($con,"SELECT * FROM sell_memos WHERE company_name = '$_POST[company_name]' ORDER BY table_index DESC LIMIT 1");							
	$client = mysqli_fetch_array($client_result);
	$all_result = mysqli_query($con,"SELECT * FROM sell_memos ORDER BY table_index DESC LIMIT 1");							
	$all = mysqli_fetch_array($all_result);

	$memo_no = 1;
	$adv = null;

	if($_POST['return'] == 'adv'){  //return has two states adv, yes
		$memo_no = $all['memo_no']+1;
	} 
	else if ($_POST['return'] == 'yes') {
		$memo_no = $client['memo_no'];
	}								
	echo "Memo no : $memo_no";		
	echo "<input type=\"hidden\" name=\"memo_no\" value=\"$memo_no\">";													
?>