<?php 
	require_once "conn.php";
	
	if($_POST['genres'] != '0' && $_POST['types'] != '0' && $_POST['colors'] != '0' && $_POST['inv_state'] == 'আগের মাল' ){
		$result = mysqli_query($con,"SELECT * FROM factories WHERE factory_name = '$_POST[factories]' LIMIT 1");
		$row = mysqli_fetch_array($result);
		$factory_no = $row['table_index'];
		$factory_no = str_pad($factory_no, 3, "0", STR_PAD_LEFT);
		$type_no = str_pad($_POST['types'], 2, "0", STR_PAD_LEFT);
		$color_no = str_pad($_POST['colors'], 2, "0", STR_PAD_LEFT);

		$pid = "$factory_no$_POST[genres]$type_no$color_no$_POST[designs]";
		$design = $_POST['designs'];
		$newdesign = $design+1;
		$newpid = $pid +1;
		$newpid = str_pad($newpid, 3, "0", STR_PAD_LEFT);
		while ($pid != $newpid){
			$result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = '00$newpid' ");
			$pid = $newpid;
			$design = $newdesign;
			if(mysqli_num_rows($result)!=0){
				$newpid = $pid + 1;
				$newdesign = $design +1; 
			} else{}
			//$newpid = str_pad($newpid, 3, "0", STR_PAD_LEFT);	
			//$pid = str_pad($pid, 3, "0", STR_PAD_LEFT);
		}
		//echo "pid $pid";
		echo "$design";
	} else {
		//echo '~~পুনরায় রিনিইউ করুন';
		echo $_POST['designs'];
	}


	

