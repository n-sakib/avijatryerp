<?php 
	$con=mysqli_connect("localhost","root","","avijatry");
	//set bangla
	mysqli_query($con,"SET CHARACTER SET utf8");
	mysqli_query($con,"SET SESSION collation_connection='utf8_general_ci'") or die(mysqli_connect_error());
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }