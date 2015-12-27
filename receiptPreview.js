function ajaxReceiptPreview(){
	var url = 'receiptPreview.php';
	//preparing vars
	var memo_no = parseInt(document.getElementById("memo_no").value);
	var client = document.getElementById("company_name").value;
	var commission = noNaN(toEnglish(document.getElementById("commission").value));

	//preparing the array 
	var pids = [];
	var qtys = [];

	var totalRow = document.getElementById("total-row").value ;
	for(var serial = 1; serial <= totalRow; serial++){
		var idId = 'pid'+serial;
		var qtyId = 'qty'+serial;

		var pid = noNaN(document.getElementById(idId).value);
		var qty = noNaN(toEnglish(document.getElementById(qtyId).value));

		pids.push(pid);
		qtys.push(qty);
	}
	var vars = "memo_no="+memo_no + "&client="+client + "&pids[]="+pids + "&qtys[]="+qtys + "&totalRow="+totalRow + "&commission="+commission;
	
	$.ajax({
        url: url,
        type: 'POST',
        data: vars,
        success: function(){
				    newPopup('receiptPreview.php?'+vars);
				}
    });
    newPopup('receiptPreview.php?'+vars);
}


// Popup window code
function newPopup(url){
	popupWindow = window.open(url,'popUpWindow','height=500,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes');
}
function noNaN(number){
	if(isNaN(number)){
		return 0;
	} else {
		return number;
	}
}
function toEnglish(number){
    var englishNumber = number;
	
	englishNumber = englishNumber.replaceAll('০', '0');
	englishNumber = englishNumber.replaceAll('১', '1');
	englishNumber = englishNumber.replaceAll('২', '2');
	englishNumber = englishNumber.replaceAll('৩', '3');
	englishNumber = englishNumber.replaceAll('৪', '4');
	englishNumber = englishNumber.replaceAll('৫', '5');
	englishNumber = englishNumber.replaceAll('৬', '6');
	englishNumber = englishNumber.replaceAll('৭', '7');
	englishNumber = englishNumber.replaceAll('৮', '8');
	englishNumber = englishNumber.replaceAll('৯', '9');
	return englishNumber;
}
String.prototype.replaceAll = function(str1, str2, ignore) 
{
	return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g,"\\$&"),(ignore?"gi":"g")),(typeof(str2)=="string")?str2.replace(/\$/g,"$$$$"):str2);
};