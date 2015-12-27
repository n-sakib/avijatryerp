function addField(){
	var serial = parseInt(document.getElementById("total_serial").value);
		pidId = "pid"+serial; 
		var pid = null;
		if(document.getElementById(pidId)){
			pid = document.getElementById(pidId).value;
		} else {
			pid = 0;
		}
		var priceId = 'price'+serial;
		var qtyId = 'qty'+serial; 
		var subId = 'sub'+serial;
		var currPrice = noNaN(parseInt(toEnglish(document.getElementById(priceId).value)));
		var currQty = noNaN(parseInt(toEnglish(document.getElementById(qtyId).value)));
		
		if (currQty != 0 && currPrice != 0 && pid != "জেনারেট হয়নি"){	
		/*/making prev row to be counted as a valid entry
		document.getElementById("pid").setAttribute("name","pids[]");
		document.getElementById("genre").setAttribute("name","genres[]");
		document.getElementById("types").setAttribute("name","types[]");
		document.getElementById("colors").setAttribute("name","colors[]");
		document.getElementById("designs").setAttribute("name","designs[]");
		document.getElementById("photo_up").setAttribute("name","images[]");*/
		
		document.getElementById(pidId).setAttribute("readonly","1");
		
		document.getElementById("factory_name").setAttribute("disabled","disabled");
		document.getElementById("genre").setAttribute("disabled","disabled");
		document.getElementById("types").setAttribute("disabled","disabled");
		document.getElementById("colors").setAttribute("disabled","disabled");
		document.getElementById("designs").setAttribute("disabled","disabled");
		document.getElementById("renew").setAttribute("disabled","disabled");
	
		document.getElementById("factory_name").removeAttribute("id",0);
		document.getElementById("genre").removeAttribute("id",0);
		document.getElementById("types").removeAttribute("id",0);
		document.getElementById("colors").removeAttribute("id",0);
		document.getElementById("designs").removeAttribute("id",0);
		document.getElementById("design_no").removeAttribute("id",0)
		document.getElementById("renew").removeAttribute("id",0);
		document.getElementById("serial").removeAttribute("id",0);
	
		/*document.getElementById(priceId).setAttribute("name","retail_prices[]");
		document.getElementById(qtyId).setAttribute("name","qtys[]");
		document.getElementById(subId).setAttribute("name","subtotals[]");/*/
		serial++;
		$('<tr id="row'+serial+'a"> <td rowspan="2" ><strong id="serial">'+serial+'</strong></td> <td colspan="5"> আইডি : <input type="text" name="pids[]" id ="pid'+serial+'" onfocus="calcTotal('+serial+');" onblur="setTimeout(function(){calcTotal('+serial+');},100);ajax_post_retail_prices(\'price'+serial+'\',\'pid'+serial+'\');" value="জেনারেট হয়নি"> </td><td></td> <td></td> <td><p id="delrow'+serial+'" onclick="javascript:delRow('+serial+');" class="delbtn">x</p></td> </tr> <tr id="row'+serial+'b"> <td> <input type="text" name="factory_name" id="factory_name" list="factories" autocomplete="off" onchange="validateFactoryName();ajax_post_pid('+serial+');" value="লিখুন"> <datalist id="factories"> </datalist> </td> <td rowspan="1"> <select name="genres[]" id="genre" onChange="genrePipe('+serial+');"> <option value="0"selected="selected">সিলেক্ট</option> <option value="1" >জেঃ</option> <option value="2">লেঃ</option> <option value="3">সু</option> <option value="4">বেঃ</option> </select> </td> <td rowspan="1"> <select name="types[]" id="types" onchange="typesPipe('+serial+');"></select> </td> <td rowspan="1"> <select name="colors[]" id="colors" onChange="colorsPipe('+serial+');"></select> </td> <td rowspan="1"> <p id="design_no"></p> <input type="hidden" name="designs[]" id="designs" value="001" > <input type="button" class="btn btn-info" value="নতুন" id="renew" onclick="renewPipe('+serial+');"> </td> <td rowspan="1"> <input type="text" name="retail_prices[]" id="price'+serial+'" onfocus="calcTotal('+serial+');" onblur="calcTotal('+serial+');"></td> <td rowspan="1"> <input type="text" name="qtys[]" id="qty'+serial+'" onfocus="calcTotal('+serial+');" onblur="calcTotal('+serial+');" value="6"></td> <td rowspan="1"> <input type="text" name="subtotal_prices[]" id="sub'+serial+'" readonly onfocus="javascript:addField();"></td> </tr>').insertBefore('#last_row'); document.getElementById("total_serial").value = serial;
		var last_price = 'price'+serial;
		document.getElementById(last_price).focus();
		ajax_post_factory_names();
		} else {
			alert("দয়া করে আইডি, পরিমানের, গায়ের দামের ঘরগুলো ঠিকভাবে পূরণ করুন");
		}
}

function delRow(serial){
	var total_serial = parseInt(document.getElementById("total_serial").value);
	var confirmed = confirm('আপনি কি '+serial+' নং কলাম ডিলিট করতে চান?'+'(মোট কলাম '+total_serial+')');
	if (confirmed) {
		var rowA = 'row'+serial+'a';
		var rowB = 'row'+serial+'b';
		var rowAElm = document.getElementById(rowA);
		var rowBElm = document.getElementById(rowB);
		rowAElm.parentNode.removeChild(rowAElm);
		rowBElm.parentNode.removeChild(rowBElm);	
		for (var oldSerial = serial+1 ; oldSerial <= total_serial ; oldSerial++){
			var newSerial = oldSerial - 1;
			
			var oldRowAId = 'row'+ oldSerial+'a';
			var oldRowBId = 'row'+ oldSerial+'b';
			var oldPidId = 'pid' + oldSerial;
			var oldPriceId = 'price' + oldSerial;
			var oldQtyId = 'qty'+ oldSerial;
			//var oldCalcFunc = 'javascript:postTotals('+oldSerial+');';
			var oldSubId = 'sub' + oldSerial;
			var oldDelId = 'delrow'+ oldSerial;
			//var oldDelFunc = 'javascript:delRow('+oldSerial+');';

			var newRowAId = 'row'+ newSerial+'a';
			var newRowBId = 'row'+ newSerial+'b';
			var newPidId = 'pid' + newSerial;
			var newPidOnblur = 'setTimeout(function(){calcTotal('+newSerial+');},100);ajax_post_retail_prices(\'price'+newSerial+'\',\'pid'+newSerial+'\');';
			var newPriceId = 'price' + newSerial;
			var newQtyId = 'qty'+ newSerial;
			var newCalcFunc = 'javascript:calcTotal('+newSerial+');';
			var newSubId = 'sub' + newSerial;
			var newDelId = 'delrow'+ newSerial;
			var newDelFunc = 'javascript:delRow('+newSerial+');';

			var currRowElem = '#'+oldRowAId; 
			$(currRowElem).children('td').first().text(newSerial);
			document.getElementById(oldRowAId).setAttribute("id",newRowAId);
			document.getElementById(oldRowBId).setAttribute("id",newRowBId);

			document.getElementById(oldPidId).setAttribute("onblur",newPidOnblur);
			document.getElementById(oldPidId).setAttribute("onfocus",newCalcFunc);
			document.getElementById(oldPidId).setAttribute("id",newPidId);

			document.getElementById(oldPriceId).setAttribute("onblur",newCalcFunc);
			document.getElementById(oldPriceId).setAttribute("onfocus",newCalcFunc);
			document.getElementById(oldPriceId).setAttribute("onchange",newCalcFunc);
			document.getElementById(oldPriceId).setAttribute("id",newPriceId);

			document.getElementById(oldQtyId).setAttribute("onblur",newCalcFunc);
			document.getElementById(oldQtyId).setAttribute("onfocus",newCalcFunc);
			document.getElementById(oldQtyId).setAttribute("onchange",newCalcFunc);
			document.getElementById(oldQtyId).setAttribute("id",newQtyId);

			document.getElementById(oldSubId).setAttribute("id",newSubId);

			document.getElementById(oldDelId).setAttribute("onclick",newDelFunc);
			document.getElementById(oldDelId).setAttribute("id",newDelId);
			//now inspect element on browser to check

		}
		total_serial--;
		var newFactoriesOnchange = 'validateFactoryName();ajax_post_pid('+total_serial+');';
		var newGenreOnchange ="genrePipe("+total_serial+");";
		var newTypesOnchange = "typesPipe("+total_serial+");";
		var newColorsOnchange = "colorsPipe("+total_serial+");";
		var newRenewOnclick = "renewPipe("+total_serial+");";
		document.getElementById("factory_name").setAttribute("onchange",newFactoriesOnchange);
		document.getElementById("genre").setAttribute("onchange",newGenreOnchange);
		document.getElementById("types").setAttribute("onchange",newTypesOnchange);
		document.getElementById("colors").setAttribute("onchange",newColorsOnchange);
		document.getElementById("renew").setAttribute("onclick",newRenewOnclick);
	}	
	
	document.getElementById("total_serial").value = total_serial;

	//updating total in the end
	var last = parseFloat(document.getElementById("total_serial").value);
	var subId = null;
	var subtotal = null;
	var total = 0;
	for ( i = 1; i <= last; i++){
		subId = 'sub'+i;
		subtotal = noNaN(parseFloat(toEnglish(document.getElementById(subId).value)));
		total = total + subtotal;
	}

	document.getElementById("total").value = total;
}
function noNaN(number){
	if(isNaN(number)){
		return 0;
	} else {
		return number;
	}
}

function calcTotal(serial){
	var priceId = 'price'+serial;
	var qtyId = 'qty'+serial;

	var subId = 'sub'+serial;

	var price = parseFloat(toEnglish(document.getElementById(priceId).value));
	var qty = parseFloat(toEnglish(document.getElementById(qtyId).value));
	
	var subtotal = price * qty;
	
	document.getElementById(subId).value = noNaN(subtotal);

	var last = parseFloat(document.getElementById("total_serial").value);

	var total = 0;
	for ( i = 1; i <= last; i++){
		subId = 'sub'+i;
		subtotal = parseFloat(document.getElementById(subId).value);
		total = noNaN(total) + noNaN(subtotal);
	}

	document.getElementById("total").value = total;
	var commsn = noNaN(parseFloat(toEnglish(document.getElementById("comm_perc").value)))*(0.01)*total;
	document.getElementById("comm").value = commsn;
	var grand_total = total - commsn;
	document.getElementById("total_price").value = grand_total;

}
function calcTotals(){
	var last = parseFloat(document.getElementById("total_serial").value);
	var total = 0;
	for ( i = 1; i <= last; i++){
		subId = 'sub'+i;
		subtotal = parseFloat(document.getElementById(subId).value);
		total = noNaN(total) + noNaN(subtotal);
	}

	document.getElementById("total").value = total;
	var commsn = noNaN(parseFloat(toEnglish(document.getElementById("comm_perc").value)))*(0.01)*total;
	document.getElementById("comm").value = commsn;
	var grand_total = total - commsn;
	document.getElementById("total_price").value = grand_total;

}
function checkLastRow(){
	var name = "something";
	var last = parseFloat(document.getElementById("total_serial").value);
	var last_row_lm = document.getElementById("serial");
	//alert(last_row_lm);
	if(last_row_lm){
		name = document.getElementById("factory_name").value;
		var client = document.getElementById("company_name").value;
		var pidId = "pid"+last;
		var PriceId = 'price'+last;
		var qtyId = 'qty'+last; 
		var pid = null;
		pid = noNaN(parseInt(document.getElementById(pidId).value));
		
		var currPrice = noNaN(parseInt(toEnglish(document.getElementById(PriceId).value)));
		var currQty = noNaN(parseInt(toEnglish(document.getElementById(qtyId).value)));
		
		if (currQty != 0 && currPrice != 0 && pid != 0 && client != "লিখুন"){
			var submit = document.getElementById("submit");
			submit.click();
			
		} else {
			if (name == "লিখুন" && pid == 0 && client == "লিখুন"){
				alert("দয়া করে কারখানার নামটি সিলেক্ট করুন");
			}
			alert("দয়া করে শেষের তথ্যটি পূরণ করুন");
		}
		//alert("here");
	}else if (last_row_lm == null && last != 1){
		var submit = document.getElementById("submit");
			submit.click();
	}
}
function checkFactoryName(){
	var name = document.getElementById("company_name").value;
	if (name == factory_name){
		alert("দয়া করে পার্টির নামটি সিলেক্ট করুন");
		document.getElementById("pseudo-submit").setAttribute("disabled","disabled");
	} else{
		document.getElementById("pseudo-submit").removeAttribute("disabled",0);
	}
	
}
function ajax_post_factory_names(){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "get_factory_names.php";
    var nothing = "nothing";
    var vars = "nothing=" + nothing ;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("factories").innerHTML = return_data;//only id exception
            //document.getElementById("memo_hidden_in").value = return_data;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request    
}
function resetDesign(){
	var d = $.Deferred();
	document.getElementById("designs").value = "001";
	d.resolve();
    return d.promise();
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
function renewPipe(serial){
	console.log("renewing");
	$.when(ajax_renew_design())
		.done(function(resRes){
			$.when(renTheDesign(resRes))
				.done(function(){
					$.when(ajax_post_pid(serial))
						.done(function(result){
							console.log("the pid is :"+result);
							$.when(postThePid(result,serial))
								.done(function (){
										$.when(ajax_post_availability())
											.done(function(resultAv){
												getTheAv(resultAv);
											});
								});
						});
				});
		});
}
function colorsPipe(serial){
	console.log("{clicked color $");
	$.when(resetDesign())	
		.done(function(){
			$.when(ajax_post_pid(serial))
				.done(function(result){
					console.log("the pid is :"+result);
					$.when(postThePid(result,serial))
						.done(function (){
								$.when(ajax_post_availability())
									.done(function(resultAv){
										getTheAv(resultAv);
									});
						});
				});
		});
}
function typesPipe(serial){
	resetDesign().pipe(ajax_post_availability).pipe(function(){ajax_post_pid(serial);});
}
function genrePipe(serial){
	resetDesign().pipe(ajax_post_types).pipe(ajax_post_colors).pipe(ajax_post_availability).pipe(function(){ajax_post_pid(serial);});
}
function validateFactoryName(){
	var factoryName = document.getElementById("factory_name").value;
	var vars = "factory="+factoryName;
	var url = "validateFactoryName.php";
	$.ajax({
        url: url,
        type: 'POST',
        data: vars,
        success: function (result){
        	if (result == "invalid"){
        		alert("কারখানার নামটি ভুল");
        		document.getElementById("factory_name").value = "লিখুন";
        	} else{}
        }
    });
}
function validateCompanyName(){
    var client = document.getElementById("company_name").value;
    var vars = "company="+client;
    var url = "validateCompanyName.php";
    $.ajax({
        url: url,
        type: 'POST',
        data: vars,
        success: function (result){
            if (result == "invalid"){
                alert("কারখানার নামটি ভুল");
                document.getElementById("company_name").value = "লিখুন";
            } else{}
        }
    });
}