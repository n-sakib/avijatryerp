<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>কেনা দাম এডিট</title>
	<link rel="stylesheet" href="css/edit-cp.css">
	<link rel="stylesheet" href="css/table-simple.css">
</head>
<body>
	<?php header("Cache-Control: no-cache, no-store, must-revalidate "); ?>
	<p class="name"><?php $factory = $_GET['factory']; echo $factory ?></p>
	<?php 
		require_once "conn.php";
		$factory_res = mysqli_query($con, "SELECT * FROM `factories` WHERE `factory_name`= '$factory' "); 
		$factory = mysqli_fetch_array($factory_res);
		$vendor_code = str_pad($factory['table_index'], 3, "0", STR_PAD_LEFT);
		$prod_res = mysqli_query($con, "SELECT * FROM `inventory` WHERE `pid` LIKE '$vendor_code%' "); 
		echo "<table class=\"table-bordered\">
				<tr>
					<th>ক্রমিক</th>
					<th>তারিখ</th>
					<th>আইডি</th>
					<th>জোড়া</th>
					<th>গায়ের দাম</th>
					<th>ডজন দাম</th>
				</tr>";
		$serial = 1;
		while($prod = mysqli_fetch_array($prod_res)){
			echo "<tr>
					<td>$serial</td>
					<td>$prod[date_added]</td>
					<td><input id=\"pid$serial\" value=\"$prod[pid]\"></td>
					<td>$prod[total_qty]</td>
					<td>$prod[retail_price]</td>
					<td><input id=\"$serial\" value=\"$prod[cost_price]\" readonly=\"1\">
		                <button onclick=\"edit($serial)\">এডিট</button>
		                <button onclick=\"save($serial)\">সেভ</button>
						</td>
				  </tr>";
			$serial++;
		}
	?>
	<script src="jquery.js"></script>
	<script src="editCp.js"></script>
</body>
</html>