<?php
	if($_POST['company_name']=='jolap'){
		echo   "<label for=\"jolap_name\">নাম :</label><input id=\"jolap_name\"name=\"jolap_name\" type=\"text\" onchange=\"javascript:ajax_gen_comment();\">
				<br>
				<label for=\"jolap_address\">ঠিকানা</label><input id=\"jolap_address\" name=\"jolap_address\" type=\"text\" onchange=\"javascript:ajax_gen_comment();\">
				<br>
				<label for=\"jolap_phone\">ফোন</label><input type=\"text\"  name=\"jolap_phone\" id=\"jolap_phone\" onchange=\"javascript:ajax_gen_comment();\">
				<input type=\"hidden\"  name=\"comment\" id=\"comment\">";
	} else {
		echo "<input type=\"text\"  name=\"comment\" id=\"comment\" value=\"\" >";
	}
