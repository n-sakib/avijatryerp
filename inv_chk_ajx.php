<?php 
	require_once 'util.php';
	$function = @$_POST['function'];

	if($function == "inventoryHas")
	{
		$pid = $_POST["pid"];

		$found = db("select * from inventory where pid='$pid' limit 1");
		if($found == [])
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	if($function == "getQtyOf")
	{
		$pid = $_POST["pid"];
		$entry = @$_POST["qty"];
		$descr = getDescription($pid);
		$found = db("select * from inventory where pid='$pid' limit 1");

		if (ifExists($pid))
	    {
	      // $inv = db("select * from inventory_check where pid = '$pid' limit 1");   
	      // $prevQty = $inv["checked"];
	      // $entry = $entry + $prevQty;
	      // db("update inventory_check set checked = '$entry' where pid = '$pid' ");
	    }
	    else
	    {
	      db("insert into inventory_check (pid, checked) values ('$pid', '$entry')"); 
	    }
		// db("insert into inventory_check (pid, checked) values ('$pid', '$entry')");
		$qty = $found["total_qty"];
		$rem = $qty - $entry;
		echo "<tr class=\"product-col\">
				<td class=\"pid\">$pid</td>
				<td class=\"descr\">$descr</td>
				<td class=\"entry\">$entry</td>
				<td class=\"qty\">$qty</td>
				<td></td>
				<td class=\"rem\">$rem</td>
                <td class=\"\"><span class=\"pull-right del\">x</span></td>
		 	</tr>";
		// echo $found["total_qty"];
	}
	if($function == "updateInfo")
	{
		$pid = $_POST["pid"];
		$entry = @$_POST["qty"];
		//$descr = getDescription($pid);
		$found = db("select * from inventory_check where pid='$pid' limit 1");
		$qty = $found["checked"];
		$entry = $qty + $entry;
		db("update inventory_check set checked = '$entry' where pid = '$pid')");
		echo $entry;
		// echo $found["total_qty"];
	}
	if($function == "updateDb")
	{
		$pid = $_POST["pid"];
		$newEntry = @$_POST["newEntry"];

		db("update inventory_check set checked = '$newEntry' where pid = '$pid'");
		echo "update inventory_check set checked = '$newEntry' where pid = '$pid'";
	}
	if($function == "deleteFromDb")
	{
		$pid = $_POST["pid"];

		db("delete from inventory_check where pid = '$pid'");
		echo "delete from inventory_check where pid = '$pid'";
	}
	if($function == "inventoryHasThe")
	{
		echo "ajax success";
	}
 ?>