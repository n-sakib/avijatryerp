<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<title>pid table</title>
	<link href="css/custom_pid_table.css" rel="stylesheet">
	<link href="css/custom_pid_print.css" rel="stylesheet">
</head>
<body>
	<div>
		<table class="pid_table">
			<?php 
				header("Cache-Control: no-cache, no-store, must-revalidate "); 
				for($row = 1; $row < 13 ; $row++){
					echo
						"<tr>
						<td><div class=\"des\" id=\"des$row"."1\"></div><p class=\"bc\" id=\"bc$row"."1\"></p><input type=\"text\" id=\"in$row"."1\" onchange=\"javascript:ajax_show_barcode($row"."1);\"></td>
						<td><div class=\"des\" id=\"des$row"."2\"></div><p class=\"bc\" id=\"bc$row"."2\"></p><input type=\"text\" id=\"in$row"."2\" onchange=\"javascript:ajax_show_barcode($row"."2);\"></td>
						<td><div class=\"des\" id=\"des$row"."3\"></div><p class=\"bc\" id=\"bc$row"."3\"></p><input type=\"text\" id=\"in$row"."3\" onchange=\"javascript:ajax_show_barcode($row"."3);\"></td>
						<td><div class=\"des\" id=\"des$row"."4\"></div><p class=\"bc\" id=\"bc$row"."4\"></p><input type=\"text\" id=\"in$row"."4\" onchange=\"javascript:ajax_show_barcode($row"."4);\"></td></tr>";
				}
			 ?>
		</table>
	</div>
	<input type="button" id="print-btn" value="print" onclick="printIt();">
	<script src="jquery.js"></script>
	<script type="text/javascript" src="show_pid_ajax.js"></script>
	<script>
		function printIt(){
				var inputs= document.getElementsByTagName("input");
				//var rowBElm = document.getElementById(rowB);
				//alert(inputs);
				for (index = inputs.length - 1; index >= 0; index--) {
				    inputs[index].parentNode.removeChild(inputs[index]);
				}
				window.print();
		}
	</script>
</body>
</html>