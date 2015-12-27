function addField(){

	var serial = parseInt(document.getElementById("total_serial").value);
	var pidId = "pid"+serial;
	var pid = document.getElementById(pidId).value;

	var rPriceId = 'rprice'+serial;
	var qtyId = 'qty'+serial; 
	var subId = 'sub'+serial;
	var currPrice = noNaN(parseInt(toEnglish(document.getElementById(rPriceId).value)));
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

	document.getElementById("genre").setAttribute("disabled","disabled");
	document.getElementById("types").setAttribute("disabled","disabled");
	document.getElementById("colors").setAttribute("disabled","disabled");
	document.getElementById("designs").setAttribute("disabled","disabled");
	//document.getElementById("photo_up").setAttribute("disabled","disabled");
	document.getElementById("renew").setAttribute("disabled","disabled");

	document.getElementById("genre").removeAttribute("id",0);
	document.getElementById("types").removeAttribute("id",0);
	document.getElementById("colors").removeAttribute("id",0);
	document.getElementById("designs").removeAttribute("id",0);
	document.getElementById("design_no").removeAttribute("id",0);
	document.getElementById("photo_up").removeAttribute("id",0);
	document.getElementById("renew").removeAttribute("id",0);
	document.getElementById("serial").removeAttribute("id",0);

	/*document.getElementById(priceId).setAttribute("name","retail_prices[]");
	document.getElementById(qtyId).setAttribute("name","qtys[]");
	document.getElementById(subId).setAttribute("name","subtotals[]");/*/
	serial++;
	$('<tr id="row'+serial+'a"> <td id="serial" rowspan="2">'+serial+'</td> <td colspan="4">আইডি <input type="text" name="pids[]" id ="pid'+serial+'" value="জেনারেট হয়নি" onchange="javascript:ajax_post_prices('+serial+');setTimeout(function(){calcTotal('+serial+');},100);"></td> <td></td> <td></td> <td></td> <td></td> <td><p id="delrow'+serial+'" onclick="javascript:delRow('+serial+');" class="delbtn">x</p></td> </tr> <tr id="row'+serial+'b"> <td rowspan="1"> <select style=""name="genres[]" id="genre" onChange="genrePipe('+serial+');" onclick="javascript:checkFactoryName();"> <option class="new" value="0" selected="selected">সিলেক্ট</option> <option value="1" >জেঃ</option> <option value="2">লেঃ</option> <option value="3">সু</option> <option value="4">বেবি</option> </select> </td> <td rowspan="1"> <select name="types[]" id="types" onchange="typesPipe('+serial+');"> <option value="" selected="selected">সিলেক্ট</option> </select> </td> <td rowspan="1"> <select name="colors[]" id="colors" onChange="colorsPipe('+serial+');"> <option value="" selected="selected">সিলেক্ট</option> </select> </td> <td rowspan="1"> <p id="design_no"></p> <input type="hidden" name="designs[]" id="designs" value="001" >  <input class="new button btn btn-info" type="button" value="নতুন" id="renew" onclick="renewPipe('+serial+');" > </td> <td rowspan="1"> <input class="new button btn btn-info" name="images[]" id="photo_up" type="file" title="ছবি দিন"  style="width: 60%;" value="ছবি দিন"> </td> <td rowspan="1"> <input type="text" name="qtys[]" value="6" id="qty'+serial+'" onchange="calcTotal('+serial+');" onfocus="calcTotal('+serial+');"> </td> <td rowspan="1"> <input type="text" name ="retail_prices[]" id="rprice'+serial+'"> </td> <td rowspan="1"> <input type="text" name="cost_prices[]" id="cprice'+serial+'" onchange="calcTotal('+serial+');"> </td> <td><input type="text" readonly id="sub'+serial+'" onfocus="addField();"></td> </tr>').insertBefore('#last_row'); 
	document.getElementById("total_serial").value = serial;
	var last_price = 'cprice'+serial;
	document.getElementById(last_price).focus();
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
			
			var oldPidId = "pid"+oldSerial;

			var oldRowAId = 'row'+ oldSerial+'a';
			var oldRowBId = 'row'+ oldSerial+'b';
			var oldPriceId = 'cprice' + oldSerial;
			var oldRetPrId = 'rprice' + oldSerial;
			var oldQtyId = 'qty'+ oldSerial;
			//var oldCalcFunc = 'javascript:postTotals('+oldSerial+');';
			var oldSubId = 'sub' + oldSerial;
			var oldDelId = 'delrow'+ oldSerial;
			//var oldDelFunc = 'javascript:delRow('+oldSerial+');';

			var newPidId = "pid"+newSerial;
			var newPidOnchange = "javascript:ajax_post_prices("+newSerial+");setTimeout(function(){calcTotal("+newSerial+");},100);"
			var newRowAId = 'row'+ newSerial+'a';
			var newRowBId = 'row'+ newSerial+'b';
			var newPriceId = 'cprice' + newSerial;
			var newRetPrId = 'rprice' + newSerial;
			var newQtyId = 'qty'+ newSerial;
			var newCalcFunc = 'javascript:calcTotal('+newSerial+');';
			var newSubId = 'sub' + newSerial;
			var newDelId = 'delrow'+ newSerial;
			var newDelFunc = 'javascript:delRow('+newSerial+');';

			var currRowElem = '#'+oldRowAId; 
			$(currRowElem).children('td').first().text(newSerial);

			document.getElementById(oldPidId).setAttribute("onchange",newPidOnchange);
			document.getElementById(oldPidId).setAttribute("id",newPidId);

			document.getElementById(oldRowAId).setAttribute("id",newRowAId);
			document.getElementById(oldRowBId).setAttribute("id",newRowBId);

			document.getElementById(oldPriceId).setAttribute("onfocus",newCalcFunc);
			document.getElementById(oldPriceId).setAttribute("onchange",newCalcFunc);
			document.getElementById(oldPriceId).setAttribute("id",newPriceId);
			document.getElementById(oldRetPrId).setAttribute("id",newRetPrId);

			document.getElementById(oldQtyId).setAttribute("onfocus",newCalcFunc);
			document.getElementById(oldQtyId).setAttribute("onchange",newCalcFunc);
			document.getElementById(oldQtyId).setAttribute("id",newQtyId);

			document.getElementById(oldSubId).setAttribute("id",newSubId);

			document.getElementById(oldDelId).setAttribute("onclick",newDelFunc);
			document.getElementById(oldDelId).setAttribute("id",newDelId);
			//now inspect element on browser to check

		}
		total_serial--;
		var genreOnchange = "genrePipe("+total_serial+");";
		var typesOnchange = "typesPipe("+total_serial+");";
		var colorsOnchange = "colorsPipe("+total_serial+");";
		var renewOnclick = "renewPipe("+total_serial+");";
		document.getElementById("genre").setAttribute("onchange",genreOnchange);
		document.getElementById("types").setAttribute("onchange",typesOnchange);
		document.getElementById("colors").setAttribute("onchange",colorsOnchange);
		document.getElementById("renew").setAttribute("onclick",renewOnclick);
	}	
	
	document.getElementById("total_serial").value = total_serial;

	//updating total in the end
	var last = parseFloat(document.getElementById("total_serial").value);
	var subId = null;
	var subtotal = null;
	var total = 0;
	for ( i = 1; i <= last; i++){
		subId = 'sub'+i;
		subtotal = noNaN(parseFloat(document.getElementById(subId).value));
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
	var priceId = 'cprice'+serial;
	var qtyId = 'qty'+serial;

	var subId = 'sub'+serial;

	var price = parseFloat(toEnglish(document.getElementById(priceId).value));
	var qty = parseFloat(toEnglish(document.getElementById(qtyId).value));
	
	var subtotal = price * qty /12;
	
	document.getElementById(subId).value = noNaN(subtotal);

	var last = parseFloat(document.getElementById("total_serial").value);

	var total = 0;
	for ( i = 1; i <= last; i++){
		subId = 'sub'+i;
		subtotal = parseFloat(document.getElementById(subId).value);
		total = noNaN(total) + noNaN(subtotal);
	}

	document.getElementById("total").value = total;

}
function checkLastRow(){
	var last_row_lm = document.getElementById("serial");
	var last = parseFloat(document.getElementById("total_serial").value);
	/*if(last_row_lm == null){
		alert('null');	
	}*/
	var confirmed = confirm('আপনি কি প্রিভিউ করতে চান ?');
	if (confirmed){	
		if (last_row_lm){
			var name = document.getElementById("factory_name").value;
			var pidId = "pid"+last;
			var pid = noNaN(parseInt(toEnglish(document.getElementById(pidId).value)));

			var rPriceId = 'rprice'+last;
			var qtyId = 'qty'+last; 
			var currPrice = noNaN(parseInt(toEnglish(document.getElementById(rPriceId).value)));
			var currQty = noNaN(parseInt(toEnglish(document.getElementById(qtyId).value))); 
			//alert("qty: "+currQty+", price: "+currPrice+ ", pid :"+pid);
			if (currQty != 0 && currPrice != 0 && pid != 0 && name != 'লিখুন'){
				var submit = document.getElementById("submit");
				submit.click();
			}
			else {
				if (name == "লিখুন" && pid == null){
					alert("দয়া করে কারখানার নামটি সিলেক্ট করুন");
				}
				alert("দয়া করে শেষের তথ্যটি পূরণ করুন");
			}
		}else if (last_row_lm == null && last != 1){
			var submit = document.getElementById("submit");
				submit.click();
		}
	}
}
function checkFactoryName(){
	var name = document.getElementById("factory_name").value;
	if (name == "লিখুন" ){
		alert("দয়া করে কারখানার নামটি সিলেক্ট করুন");
		if(document.getElementById("genre")){
			document.getElementById("genre").setAttribute("disabled","disabled");
		}
	} else{
		if (document.getElementById("genre")){	
			document.getElementById("genre").removeAttribute("disabled",0);
		}
	}
	
}
function resetDesign(){
    var d = $.Deferred();
    console.log("{started resetting");
	document.getElementById("designs").value = "001";
	console.log("end of resetting}");
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
	//ajax_renew_design().pipe(function(){ajax_post_pid(serial);}).pipe(function(){setTimeout(function(){ajax_post_availability();},0);}).pipe(function(){ajax_post_pid(serial);}).pipe(function(){console.log("finished renew click");});
	//$.when(function(){ajax_renew_design()}).pipe(function(){ajax_post_pid(serial);}).pipe(function{setTimeout(function(){ajax_post_availability();},500);}).pipe(function(){ajax_post_pid(serial);}).pipe(function(){console.log("finished renew click");});
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
/*function colorsPipe(serial){
	console.log("{clicked color $");
	resetDesign().pipe(function(){ajax_post_pid(serial);}).pipe(function(){ajax_post_availability();}).pipe(function(){console.log("out of the color process}");});
}*/
function colorsPipe(serial){
	console.log("{clicked color $");
	//var postPid = function(){ajax_post_pid(serial);}
	//resetDesign().pipe(function(){ajax_post_pid(serial);}).pipe(function(){ajax_post_availability();}).pipe(function(){console.log("out of the color process}");});
	//$.when(ajax_post_pid(serial)).done(function(result){console.log("pid is "+result)}).done(resetDesign).done(function(){ ajax_post_pid(serial);}).done(function(result){console.log("pid is "+result);}).done(function(){setTimeout(function(){ajax_post_availability();},0);});
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
		});//postThePid(result,serial);});});
}
function typesPipe(serial){
	resetDesign().pipe(ajax_post_availability).pipe(function(){ajax_post_pid(serial);});
	colorsPipe(serial);
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