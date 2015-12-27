<?php 
	
	function is_listed($expense_name){
		require "conn.php";
		$expense_result = mysqli_query($con,"SELECT * FROM other_expenses WHERE expense_name = '$expense_name' AND report = 1 ");
		if(mysqli_num_rows($expense_result)==0){
			return false;
		} else {
			return true;
		}
	}