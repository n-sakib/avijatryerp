<?php
include("util.php");

if($_POST)
{
	if($_POST["clear"]=="yes")
	{
		db("truncate table inventory_check");
		header('Location: inventory_check.php');
	}
}
?>