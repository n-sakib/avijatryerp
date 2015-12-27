function edit(serial){
	//alert(document.getElementById(serial).getAttribute("readonly"));
	if(document.getElementById(serial).getAttribute("readonly") == "1"){
		document.getElementById(serial).removeAttribute("readonly", "0");	
	} else {
		document.getElementById(serial).setAttribute("readonly" , "1");
	}
	
}
function save(serial){
	var pidId = "pid"+serial;
	var pid = document.getElementById(pidId).value;
	var cp = document.getElementById(serial).value;
	var vars = "pid="+pid + "&cp="+cp;

	var url = "editCpAjax.php";
	$.ajax({
        url: url,
        type: 'POST',
        data: vars,
        success: function(msg){
        	alert(msg);
        	document.getElementById(serial).setAttribute("readonly","1");
        }
    });
}