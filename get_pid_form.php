<?php 
	if($_POST['return_type'] == 'with_pid'){
		echo "<input type=\"text\" name=\"pids[]\" id=\"pids\" onChange=\"javascript:ajax_post_retail_prices();\">";
	} else { //without pid

	}