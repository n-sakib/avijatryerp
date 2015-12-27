function addRow(pack){
	/*al
		table id = pack1
		meta row = row1-1
		meta ids = pid1-1, qty1-1
		meta-ref = last-row1
		add-funct = addRow(1)
		relative row no = total-row1
		total packs = total-pack
	 */
	var packId = "total-row"+pack ;

	var serial = parseInt(document.getElementById(packId).value);
	var lastRow = "last-row"+pack;
	//var lastRowId = "#"+lastRow;alert(lastRow);
	var lastRowElm = document.getElementById(lastRow);
	
	//$('<tr><td></td><td>nigga</td></tr>').insertBefore($(lastRowElm));
	//alert(serial);
	var id = 'pid'+pack+'-'+serial;
	var qtyId = 'qty'+pack+'-'+serial;
	var currId = noNaN(parseInt(document.getElementById(id).value));
	var currQty = noNaN(parseInt(toEnglish(document.getElementById(qtyId).value)));
	// alert(currId);
	if (currQty != 0 && currId != 0){	
		serial++;	
		$('<tr id="row'+pack+'-'+serial+'"> <td><input type="text" name="pids[]" id="pid'+pack+'-'+serial+'"></td> <td><input type="text" name="qtys[]" id="qty'+pack+'-'+serial+'" value=6></td> </tr>').insertBefore($(lastRowElm));
		document.getElementById(packId).value = serial;
		var lastId = 'pid'+pack+'-'+serial;
		document.getElementById(lastId).focus();
	} else {
		alert("দয়া করে আইডি ও পরিমাণ দিন");
	}
}
function addPack(){
	var pack = parseInt(document.getElementById("total-pack").value);
	
	var packId = "total-row"+pack ;
	var serial = parseInt(document.getElementById(packId).value);
	
	//alert(serial);
	var id = 'pid'+pack+'-'+serial;
	var qtyId = 'qty'+pack+'-'+serial;
	var currId = noNaN(parseInt(document.getElementById(id).value));
	var currQty = noNaN(parseInt(toEnglish(document.getElementById(qtyId).value)));
	// alert(currId);
	if (currQty != 0 && currId != 0){	
		/*document.getElementById("last-row").innerHTML = '<input type="hidden" name="pack_last[]" id="pack'+pack+'last" value="'+serial+'">';
		document.getElementById("last-row").removeAttribute("id",0);
		serial++;	*/
		var packBtnId ="pack-btn";//+pack;
		var checkBtnId ="check-btn";//+pack;
		var packBtn = document.getElementById(packBtnId);
		var checkBtn = document.getElementById(checkBtnId);
		packBtn.parentNode.removeChild(packBtn);
		checkBtn.parentNode.removeChild(checkBtn);
		pack++;
		$('<span id="pack-name">কারটন নং '+pack+'</span> <table id="pack1"class="table table-condensed table-striped table-bordered table-hover"> <tr> <th>আইডি</th> <th>পরিমাণ</th> </tr> <tr id="row'+pack+'-1"> <td><input type="text" name="pids[]" id="pid'+pack+'-1"></td> <td><input type="text" name="qtys[]" id="qty'+pack+'-1" value=6></td> </tr> <tr id="last-row'+pack+'"> <td><input type="text" onfocus="javascript:addRow('+pack+');" readonly></td> <td><input type="text" readonly> <input type="hidden" id="total-row'+pack+'" name="total-row'+pack+'" value="1"><div id="pack-btn" class="btn pull-right" onclick="javascript:addPack();">নতুন কারটন</div> <div id="check-btn" class="btn btn-info pull-right" onclick="javascript:checkMemo();">চেক</div> </td> </tr> </table>').insertBefore('#last-space');
		var lastId = 'pid'+pack+'-1';
		document.getElementById(lastId).focus();
		document.getElementById("total-pack").value = pack;
	} else {
		alert("দয়া করে আইডি ও পরিমাণ দিন");
	}
}
function checkMemo(){
	var memo_no = noNaN(parseInt(document.getElementById("memo_no").value));
	if(memo_no != 0){
		document.getElementById("check-btn-main").click();
	}else{
		document.getElementById("check-btn").setAttribute("disabled",1);
		alert("অনাকাঙ্ক্ষিত মেমো নাম্বার");
	}
}
function selectMemo(){
	var memo_no = noNaN(parseInt(document.getElementById("memo_no").value));
	if(memo_no != 0){
		document.getElementById("check-btn").removeAttribute("disabled",0);
	}else{
		document.getElementById("check-btn").setAttribute("disabled",1);
		alert("অনাকাঙ্ক্ষিত মেমো নাম্বার");
	}
}
function noNaN(number){
	if(isNaN(number)){
		return 0;
	} else {
		return number;
	}
}

function ajaxPostAndCheck(){
	/*al
		table id = pack1
		meta row = row1-1
		meta ids = pid1-1, qty1-1
		meta-ref = last-row1
		add-funct = addRow(1)
		relative row no = total-row1
		total packs = total-pack
	 */
	var memo_no = document.getElementById("memo_no").value;
	
	

	//preparing the array 
	var pids = [];
	var qtys = [];

	var packs = document.getElementById("total-pack").value ;
	for(var packNo = 1; packNo <= packs; packNo++){
		var totalRowId = 'total-row'+packNo;
		var totalRow = document.getElementById(totalRowId).value ;
		for (var serial = 1 ; serial <= totalRow ; serial++){
			var idId = 'pid'+packNo+'-'+serial;
			var qtyId = 'qty'+packNo+'-'+serial;

			var pid = noNaN(document.getElementById(idId).value);
			var qty = noNaN(toEnglish(document.getElementById(qtyId).value));

			pids.push(pid);
			qtys.push(qty);
		}
	}

///ajax part
	 // Create our XMLHttpRequest object
    var hr1 = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "post_mal_check.php";
    //var vars = "memo_no=" + memo_no+"&pids[]="+pids+"&qtys="+qtys;
    
    var vars = "memo_no=" + memo_no+"&pids[]="+pids+"&qtys[]="+qtys;
    hr1.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr1.onreadystatechange = function() {
        if (hr1.readyState == 4 && hr1.status == 200) {
            var return_data = hr1.responseText;
            alert(return_data);
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr1.send(vars); // Actually execute the request
    //document.getElementById("types").innerHTML = "processing...";
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
/*function ajaxPrintPreview(){
	var memo_no = document.getElementById("memo_no").value;
	
	var lastRow = document.getElementById("total-row").value ;
	var packNo = document.getElementById("total-pack").value ;

	//preparing the array 
	var pids = [];
	var qtys = [];

	for (var serial = 1 ; serial <= last ; serial++){
		var idId = 'pid'+serial;
		var qtyId = 'qty'+serial;

		var pid = noNaN(document.getElementById(idId).value);
		var qty = noNaN(document.getElementById(qtyId).value);

		pids.push(pid);
		qtys.push(qty);
	} 
	var packs = [];
	for (var serial = 1 ; serial < lastPack ; serial++){
		var lastPackId = 'pack'+serial+'last';

		var packLast = noNaN(document.getElementById(lastPackId).value);

		packs.push(packLast);
	} 
	packs.push(lastRow); 

    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "print_packs.php";
    var vars = "pids=" + pids + "&qtys=" + qtys+ "&packs=" + packs + "&pack_no=" + packNo;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            //document.getElementById("pid_form").innerHTML = return_data;
            //document.getElementById("memo_hidden_in").value = return_data;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request    
}*/