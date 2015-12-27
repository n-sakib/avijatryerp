<?php 
	require_once "conn.php";
	include "convert_number_encoding.php";
	$sell_type =$_POST['sell_type'];
	$client = $_POST['company_name'];
	$amount = convertToEnglishNumber($_POST['amount']);
	$comment = $_POST['comment'];
	$due = null;
	$memo_no = null;
	$pay_method = null;
	
	$sell_memos_res = mysqli_query($con,"SELECT * FROM sell_memos ORDER BY table_index DESC LIMIT 1");
	$the = mysqli_fetch_array($sell_memos_res);
	$memo_no = $the['memo_no']+1;
	if($sell_type == 'client')
	{
		$pay_m = $_POST['pay_method'];
		//$bank = $_POST['bank'];
		$result = mysqli_query($con,"SELECT * FROM sells WHERE company_name = '$client' ORDER BY table_index DESC LIMIT 1");
		$row = mysqli_fetch_array($result);
		$memo_result = mysqli_query($con,"SELECT * FROM sell_memos WHERE company_name = '$client' ORDER BY table_index DESC LIMIT 1");
		$memo_row = mysqli_fetch_array($memo_result);
		//$memo_no = $row['memo_no']+1;
		echo $amount;
		$due = $memo_row['due'] - ($amount);
		echo "due $due";
		//updating accounts
		$result = mysqli_query($con,"SELECT * FROM accounts LIMIT 1");
		$row = mysqli_fetch_array($result);

		$prev_debit =  $row['debit'];
		$debit = $prev_debit + ($amount);
		$cash = $row['cash'] + ($amount);

		mysqli_query($con,"UPDATE accounts SET debit = $debit , cash = $cash WHERE table_index = 1");

	}
	else if ($sell_type == 'bank'){
		//updating accounts
		$result = mysqli_query($con,"SELECT * FROM banK_log WHERE bank_name = '$client' ORDER BY table_index DESC LIMIT 1");
		$row = mysqli_fetch_array($result);

		$balance =  $row['balance'] + 0;
		$balance = $balance - ($amount);


		mysqli_query($con,"INSERT INTO banK_log (bank_name,withdrawn,balance,comment) VALUES('$client','$amount','$balance','$comment')");
		//updating accounts
		$result = mysqli_query($con,"SELECT * FROM accounts LIMIT 1");
		$row = mysqli_fetch_array($result);

		$cash =  $row['cash'];
		$cash = $cash + ($amount);

		mysqli_query($con,"UPDATE accounts SET cash = $cash WHERE table_index = 1");	
	}
	else if ($sell_type == 'staff') { //staff
		//updating accounts
			$haulad = (-1)*$amount;
			mysqli_query($con,"INSERT INTO staff_log (staff_name,amount,comment) VALUES('$client','$haulad','$comment')");
		//updating accounts
		$result = mysqli_query($con,"SELECT * FROM accounts LIMIT 1");
		$row = mysqli_fetch_array($result);

		$cash =  $row['cash'];
		$cash = $cash + ($amount);

		mysqli_query($con,"UPDATE accounts SET cash = $cash WHERE table_index = 1");	
	}
	else if ($sell_type == 'other_expenses') { //staff
		//updating accounts
			$haulad = (-1)*$amount;
			mysqli_query($con,"INSERT INTO other_expense_log (expense_name,amount,comment) VALUES('$client','$haulad','$comment')");
		//updating accounts
		$result = mysqli_query($con,"SELECT * FROM accounts LIMIT 1");
		$row = mysqli_fetch_array($result);

		$cash =  $row['cash'];
		$cash = $cash + ($amount);

		mysqli_query($con,"UPDATE accounts SET cash = $cash WHERE table_index = 1");	
	}

	//updating sell memos
	if(isset($_POST['bank'])){
		$comment = "ব্যাংক জমা : $_POST[bank] ,$comment";
		mysqli_query($con,"INSERT INTO sell_memos (company_name, memo_no, due, paid, sell_type, comment,pay_method) 
     		VALUES ('$client','$memo_no','$due','$amount','$sell_type','$comment','$pay_method')");
		mysqli_query($con,"INSERT INTO purchase_memos (factory_name, paid, purchase_type, comment) 
     		VALUES ('$_POST[bank]','$amount','$sell_type','$comment')");
		
		$result = mysqli_query($con, "SELECT * FROM bank_log WHERE bank_name = '$_POST[bank]' ORDER BY table_index DESC LIMIT 1");
		$row = mysqli_fetch_array($result);
		$balance = $row['balance']+$amount;
		mysqli_query($con,"INSERT INTO bank_log (bank_name, deposited,comment,balance) 
			VALUES ('$_POST[bank]','$amount','$comment','$balance')");


	} else {

		mysqli_query($con,"INSERT INTO sell_memos (company_name, memo_no, due, paid, sell_type, comment,pay_method) 
     		VALUES ('$client','$memo_no','$due','$amount','$sell_type','$comment','$pay_method')");
	}

	mysqli_close($con);

	header('Location: bikri_khata.php');