<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<title>pid table</title>
	<link href="css/pid_table.css" rel="stylesheet">
</head>
<body>
	<div>
		<table class="table">
			<?php 
				for($row=1; $row<13 ; $row++){
					echo 
					"<tr><td><p id=\"des1$row\"></p><p id=\"bc1$row\"></p><input type=\"text\" id=\"bc1$row\"></td>
					<td><p id=\"des2$row\"></p><p id=\"bc2$row\"></p><input type=\"text\" id=\"bc2$row\"></td>
					<td><p id=\"des3$row\"></p><p id=\"bc3$row\"></p><input type=\"text\" id=\"bc3$row\"></td>
					<td><p id=\"des4$row\"></p><p id=\"bc4$row\"></p><input type=\"text\" id=\"bc4$row\"></td></tr>
					";
				}
			 ?>
		</table>
	</div>
</body>
</html>