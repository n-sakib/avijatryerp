<?php
	if($_POST['company_name']=='khuchra'){
		echo   "<label for=\"khuchra_name\">নাম :</label><input id=\"khuchra_name\"name=\"khuchra_name\" type=\"text\" onchange=\"javascript:ajax_gen_comment();\">
				<br>
				<label for=\"khuchra_address\">ঠিকানা</label><input id=\"khuchra_address\" name=\"khuchra_address\" type=\"text\" onchange=\"javascript:ajax_gen_comment();\">
				<br>
				<label for=\"khuchra_phone\">ফোন</label><input type=\"text\"  name=\"khuchra_phone\" id=\"khuchra_phone\" onchange=\"javascript:ajax_gen_comment();\">
				<input type=\"hidden\"  name=\"comment\" id=\"comment\">";
	} else {
		echo "<br>";
	}
