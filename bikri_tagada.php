<?php 
	require "conn.php";
	include "convert_number_encoding.php";
	include "util.php";
	$comment = $_POST['comment'];
	$amount = convertToEnglishNumber($_POST['amount']);

	$purchase_memos_res = mysqli_query($con,"SELECT * FROM purchase_memos ORDER BY table_index DESC LIMIT 1");
	$the = mysqli_fetch_array($purchase_memos_res);
	$memo_no = $the['memo_no']+1;
	echo "memo_no $memo_no";
	if($_POST['purchase_type'] == 'factory'){
		if (isset($_POST['payCheck'])) 
		{
			    $factoryName = $_POST["name"];
				  //$amount = $_POST["amount"]+0;
				  $dateString = $_POST["date"];
				  $dateData = explode( '/', $dateString );
				  $dd = @$dateData[0];
				  $mm = @$dateData[1];
				  $yy = @$dateData[2];


				  $date = "$yy:$mm:$dd 01:01:01";

				  $dateString = $_POST["dateIssued"];
				  $dateData = explode( '/', $dateString );
				  $dd = @$dateData[0];
				  $mm = @$dateData[1];
				  $yy = @$dateData[2];


				  $issue_date = "$yy:$mm:$dd 01:01:01";



				  //db("insert into company_check () values ()");
				  //echo "factoryName : $factoryName, date : $date, amount : $amount";
				  $msg = "";
				  if($factoryName == "")
				  {
				    $msg =  $msg."<h4 class=\"text-error\">* কারখানার নামটি লিখুন</h4><br>";
				  }
				  if($amount == 0)
				  {
				    $msg =  $msg."<h4 class=\"text-error\">* চেকের পরিমান লিখুন</h4><br>";
				  }
				  if($date == ":: 01:01:01")
				  {
				    $msg =  $msg."<h4 class=\"text-error\">* তারিখের ঘরটি পুরন করুন</h4><br>";
				  }
				  if($issue_date == ":: 01:01:01")
				  {
				    $msg =  $msg."<h4 class=\"text-error\">* তারিখের ঘরটি পুরন করুন</h4><br>";
				  }
				  if($msg == "")
				  {
				    echo "<h4 class=\"text-success\">সফল</h4>";
				    $factoryEntry = db("select * from company_check where factory_name = '$factoryName' limit 1");
				    if($factoryEntry == [])
				    {
				    	//$comment = "$commment চেক বাবদ";
				    	$comment = "চেক বাবদ";
				      db("insert into company_check (factory_name, pending_date,issue_date, amount) values ('$factoryName','$date','$issue_date','$amount')");
				    }
				    else
				    {
				      $index = $factoryEntry["table_index"];
				      $prevAmount = $factoryEntry["amount"];

				      $newAmount = $amount + $prevAmount;
				      //echo "index is $index;";
				      //echo "update company_check set pending_date='$date', amount='$newAmount' where table_index='$index'";
				      db("update company_check set pending_date='$date', issue_date	= '$issue_date', amount='$newAmount' where table_index='$index' ");
				    }
				  }
				  else
				  {
				    echo $msg;
				  }
		}
		$result = mysqli_query($con,"SELECT * FROM purchase_memos WHERE factory_name = '$_POST[name]' ORDER BY table_index DESC LIMIT 1");
		$row = mysqli_fetch_array($result);
		$due = $row['due'] - $amount;

		mysqli_query($con,"INSERT INTO purchase_memos (factory_name, paid, purchase_type, memo_no, due,comment) 
			VALUES ('$_POST[name]','$amount','$_POST[purchase_type]','$memo_no','$due','$comment')");	

		mysqli_query($con,"INSERT INTO purchases (factory_name, paid, memo_no, due) 
			VALUES ('$_POST[name]','$amount','$memo_no','$due')");
		//updating accounts
		$result = mysqli_query($con,"SELECT * FROM accounts LIMIT 1");
		$row = mysqli_fetch_array($result);

		$prev_credit =  $row['credit'];
		$credit = $prev_credit - ($amount);
		$prev_cash =  $row['cash'];
		$cash = $prev_cash - ($amount);

		mysqli_query($con,"UPDATE accounts SET credit = $credit , cash = $cash WHERE table_index = 1");
	}
	else if($_POST['purchase_type'] == 'staff'){
		mysqli_query($con,"INSERT INTO staff_log (staff_name, amount,comment) 
			VALUES ('$_POST[name]','$amount','$comment')");
			echo "Affected rows staff: " . mysqli_affected_rows($con)." ";
		mysqli_query($con,"INSERT INTO purchase_memos (memo_no,factory_name, paid, purchase_type,comment) 
			VALUES ('$memo_no','$_POST[name]','$amount','$_POST[purchase_type]','$comment')");

		//updating accounts
		$result = mysqli_query($con,"SELECT * FROM accounts LIMIT 1");
		$row = mysqli_fetch_array($result);

		$prev_debit =  $row['debit'];
		$debit = $prev_debit - ($amount);
		$prev_cash =  $row['cash'];
		$cash = $prev_cash - ($amount);

		mysqli_query($con,"UPDATE accounts SET debit = $debit , cash = $cash WHERE table_index = 1");


	}
	else if($_POST['purchase_type'] == 'other_expenses'){
		mysqli_query($con,"INSERT INTO other_expense_log (expense_name, amount,comment) 
			VALUES ('$_POST[name]','$amount','$comment')");
		echo "Affected rows: " . mysqli_affected_rows($con)." ";
		mysqli_query($con,"INSERT INTO purchase_memos (memo_no,factory_name, paid, purchase_type,comment) 
			VALUES ('$memo_no','$_POST[name]','$amount','$_POST[purchase_type]','$comment')");

		//updating accounts
		$result = mysqli_query($con,"SELECT * FROM accounts LIMIT 1");
		$row = mysqli_fetch_array($result);

		$prev_debit =  $row['debit'];
		$debit = $prev_debit - ($amount);
		$prev_cash =  $row['cash'];
		$cash = $prev_cash - ($amount);

		mysqli_query($con,"UPDATE accounts SET debit = $debit , cash = $cash WHERE table_index = 1");


	}
	else if($_POST['purchase_type'] == 'bank'){
		$result = mysqli_query($con, "SELECT * FROM bank_log WHERE bank_name = '$_POST[name]' ORDER BY table_index DESC LIMIT 1");
		$row = mysqli_fetch_array($result);
		$balance = $row['balance']+0; //    			 ->  $balance = $row['balance']+$amount;
		$balance = $balance + $amount; // expanded from |
		mysqli_query($con,"INSERT INTO bank_log (bank_name, deposited,comment,balance) 
			VALUES ('$_POST[name]','$amount','$comment','$balance')");

		mysqli_query($con,"INSERT INTO purchase_memos (memo_no,factory_name, paid, purchase_type,comment) 
			VALUES ('$memo_no','$_POST[name]','$amount','$_POST[purchase_type]','$comment')");
		echo "Affected rows: " . mysqli_affected_rows($con)." ";
		//updating accounts
		$result = mysqli_query($con,"SELECT * FROM accounts LIMIT 1");
		$row = mysqli_fetch_array($result);

		$prev_debit =  $row['debit'];
		$debit = $prev_debit - ($amount);
		$prev_cash =  $row['cash'];
		$cash = $prev_cash - ($amount);

		mysqli_query($con,"UPDATE accounts SET debit = $debit , cash = $cash WHERE table_index = 1");		
	} else{}
	//check each input scene using header off 
	header('Location: bikri_khata.php');