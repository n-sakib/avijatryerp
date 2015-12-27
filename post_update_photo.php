<?php
	if($_POST){
		//echo "posted";
		// File Variables
		$name=	$_FILES['image']['name'];
		//$name = mb_convert_encoding($name, "utf8");
		//$name =utf8_decode($name);
		//echo $name;
		$temp=	$_FILES['image']['tmp_name'];
		$type=	$_FILES['image']['type'];
		$size=	$_FILES['image']['size'];
		
		$ext =null;
		// Recognizing the extension
		switch( $type ){
			
			// Image/Jpeg
			case 'image/jpeg':
				$ext= '.jpg';
			break;
			
			// Image/png
			case 'image/png':
				$ext= '.png';
			break;
			
			// Image/gif
			case 'image/gif':
				$ext= '.gif';
			break;
			
		}
		
		// Upload Variables
		/*$file_name = utf8_encode($_POST['company_name']);
		$file_name = iconv("UTF-8","cp437", $file_name);*/
		$file_name = utf8_encode($_POST['name_info']);
		if ($_POST['prof_type']!='shoe'){
			$file_name = $_POST['name_info'];			
		}
		//echo $file_name;
		//echo $name;
		$path= 'img/'.$_POST['prof_type'].'/' . $file_name . $ext;
		//$data= $name . '<br />' . $temp . '<br />' . $type . '<br />' . $size . '<br />' . $path . '<br /> <a href="index.php">Go Back</a>';
		//echo $path;
		//echo $temp;
		// Check for the Image post.
		if( $_POST ){
		
			// Got into the POST check.
		
			if( $_FILES ){
			
				// Got into the FILES check.
				move_uploaded_file( $temp, $path );
				
				//echo $data;
				//echo 'here';
			}
		
		}
		require_once "conn.php";
		$profile = $_POST['prof_type'];
		$query = '';
		$name = $_POST['name_info'] ;
		if($profile == 'clients'){
			$query = "UPDATE clients SET photo = '$path' WHERE company_name = '$name' ";
		}else if($profile == 'factories'){
			$query = "UPDATE factories SET photo = '$path' WHERE factory_name = '$name' ";
		}else if($profile == 'staffs'){
			$query = "UPDATE staffs SET photo = '$path' WHERE staff_name = '$name' ";
		}else if($profile == 'expenses'){
			$query = "UPDATE other_expenses SET photo = '$path' WHERE expense_name = '$name' ";
		}else if($profile == 'inventory'){
			$query = "UPDATE inventory SET image = '$path' WHERE pid = '$name' ";
		}
		mysqli_query($con,$query);
		echo "<h2>সফল</h2>";
	}