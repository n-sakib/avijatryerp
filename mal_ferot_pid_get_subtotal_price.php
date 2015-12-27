<?php 
	require_once "conn.php";

	$subtotal_price = $_POST['retail_price']*$_POST['qty']/12;

	echo $subtotal_price;
