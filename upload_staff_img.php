<?php 
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
	$file_name = $_POST['staff_name'];
	echo $file_name;
	//echo $name;
	$path= 'img/staffs/' . $file_name . $ext;
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
			echo 'here';
		}
	
	}