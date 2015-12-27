<?php 
	$paths = array();
	$pid = $_POST['pids'];
			
			
	$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
	$max_file_size = 1024*2024; //2mb
	$count = 0;
	$message = [];
	//echo "here";
	 //print_r($_FILES['images']);
	if(isset($_FILES['images']) and $_SERVER['REQUEST_METHOD'] == "POST"){
		//print_r($_FILES['images']);
		// Loop $_FILES to exeicute all files
		//echo "here";
		        	//echo "here";
		foreach ($_FILES['images']['name'] as $f => $name) {   
			//echo "here";  
		    /*if ($_FILES['images']['error'][$f] == 4) {
		        continue; // Skip file if any error found
		    }	       
		    if ($_FILES['images']['error'][$f] == 0) {	           
		        if ($_FILES['images']['size'][$f] > $max_file_size) {
		            $message[] = "$name is too large!.";
		            continue; // Skip large files
		        }
				elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
					$message[] = "$name is not a valid format";
					continue; // Skip invalid file formats
				}
		        else{ */
		        	$type=	$_FILES['images']['type'][$f];
		        	$temp=	$_FILES['images']['tmp_name'][$f];
		        	// No error found! Move uploaded files 
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
					$caption = $pid[$f];
					$path= 'img/inventory/' . $caption . $ext;
					$paths[] = $path;
					//echo $temp;
		            move_uploaded_file($temp, $path);
		           
		        //}
		    //}
		}
	}