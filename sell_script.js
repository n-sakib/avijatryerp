function addRow(){
	serial = parseInt(document.getElementById("total-row").value);

    tabindex1 = (serial*3)+1;
    tabindex2 = (serial*3)+2;
    tabindex3 = (serial*3)+3;

	pidId = "pid"+serial;
	qtyId = "qty"+serial;
    var qtyVal = noNaN(parseInt(toEnglish(document.getElementById(qtyId).value)));
    var pidVal = noNaN(parseInt(toEnglish(document.getElementById(pidId).value)));
    
    var duplic = false;
    if(serial > 1){
    	for (var prevIndex = 1 ; prevIndex < serial ; prevIndex++){
    		prevPid = "pid"+prevIndex;
    		prevPidVal = noNaN(parseInt(document.getElementById(prevPid).value));
    		if(pidVal == prevPidVal){
    			duplic = true;
    			//alert("একই আইডি দু'বার প্রদান করা হয়েছে"+pidVal+"ager"+prevPidVal+"serial"+serial);
    			alert("একই আইডি দু'বার প্রদান করা হয়েছে");
    			document.getElementById(pidId).value = "";
    			break;
    		}
       	}
    }
    //alert("qtyval :"+qtyVal+", pidVal :"+pidVal);
    if (qtyVal != 0 && pidVal != 0 && duplic == false){
        $(document).ready(function(){
        	/*document.getElementById("qty").removeAttribute("id",0);
        	document.getElementById("pid").removeAttribute("id",0);
            only static id*/
            document.getElementById("ignored-units").removeAttribute("onfocus",0);
            document.getElementById("ignored-units").removeAttribute("id",0);
            document.getElementById(pidId).setAttribute("readonly",1);
        	serial++;
           $('<tr> <td> <input tabindex="'+tabindex1+'" name="products[]" type="text" id="pid'+serial+'" onchange="ajaxPostPidInfo('+serial+');"> </td> <td> <input tabindex="'+tabindex2+'" type="number" class=\"span8\" name="qtys[]" value="6" id="qty'+serial+'" min="1" max="6" step="1"> </td> <td> <input tabindex="'+tabindex3+'" type="text" name="units[]" id="ignored-units" onfocus="javascript:addRow();"readonly> <span id="del-row'+serial+'" class="del-row" onclick="delRow('+serial+')">x</span></td> </tr>').insertBefore('#last_row'); });
    	document.getElementById("total-row").value =serial;
    	var lastPid = "pid"+serial;
    	document.getElementById(lastPid).focus();
        // tabindex1++;
        // tabindex2++;
        // tabindex3++;
    } else{ alert("দয়া করে আইডি ও পরিমাণের ঘরগুলো পূরণ করুন");}       
}
function delRow(serial){
    var total_serial = parseInt(document.getElementById("total-row").value);
    var confirmed = confirm('আপনি কি '+serial+' নং কলাম ডিলিট করতে চান?'+'(মোট কলাম '+total_serial+')');
    if(confirmed){
        var delRowId = "del-row"+serial;
        var rowLm = document.getElementById(delRowId).parentNode.parentNode;
        rowLm.parentNode.removeChild(rowLm);
        for (var oldSerial = serial+1 ; oldSerial <= total_serial ; oldSerial++){
            var newSerial = oldSerial -1;
            var oldPidId = "pid"+oldSerial;
            var oldQtyId = "qty"+oldSerial;
            var oldDelId = "del-row"+oldSerial;

            var newPidOnchange = "ajaxPostPidInfo("+newSerial+");";
            var newPidId = "pid"+newSerial;
            var newQtyId = "qty"+newSerial;
            var newDelOnclick = "delRow("+newSerial+")";
            var newDelId = "del-row"+newSerial;

            document.getElementById(oldPidId).setAttribute("onchange",newPidOnchange);
            document.getElementById(oldPidId).setAttribute("id",newPidId);

            document.getElementById(oldQtyId).setAttribute("id",newQtyId);

            document.getElementById(oldDelId).setAttribute("onclick",newDelOnclick);
            document.getElementById(oldDelId).setAttribute("id",newDelId);
        }
        total_serial--;
        document.getElementById("total-row").value = total_serial;
    }else{}
}
function noNaN(number){
	if(isNaN(number)){
		return 0;
	} else {
		return number;
	}
}
function checkClient(){
    var name = document.getElementById("company_name").value;
    serial = parseInt(document.getElementById("total-row").value);
    var lastRow = document.getElementById("ignored-units");
    var duplic = false;
    pidId = "pid"+serial;
    qtyId = "qty"+serial;
    var qtyVal = noNaN(parseInt(toEnglish(document.getElementById(qtyId).value)));
    var pidVal = noNaN(parseInt(toEnglish(document.getElementById(pidId).value)));
    if(serial > 1){
        for (var prevIndex = 1 ; prevIndex < serial ; prevIndex++){
            prevPid = "pid"+prevIndex;
            prevPidVal = noNaN(parseInt(document.getElementById(prevPid).value));
            if(pidVal == prevPidVal){
                duplic = true;
                //alert("একই আইডি দু'বার প্রদান করা হয়েছে"+pidVal+"ager"+prevPidVal+"serial"+serial);
                alert("একই আইডি দু'বার প্রদান করা হয়েছে");
                document.getElementById(pidId).value = "";
                break;
            }
        }
    }
    if(duplic!= true){
        var confirmed = confirm('আপনি কি প্রিভিউ করতে চান');
    }
    if (confirmed && lastRow) {

        if (name === "লিখুন"){
            alert("দয়া করে পার্টির নামটি সিলেক্ট করুন");
            document.getElementById("submit2").setAttribute("disabled","disabled");
        }else if (qtyVal == "0" || pidVal == "0"){
            alert("দয়া করে শেষের ঘরটি পূরণ করুন");
            //document.getElementById("submit2").setAttribute("disabled","disabled");
        } 
        else if (name != "লিখুন" && qtyVal != "0" && pidVal != "0"){
            document.getElementById("submit2").removeAttribute("disabled",0);
            document.getElementById("submit").click();
        }
    } else if (confirmed && !lastRow && serial>0) {
        if (name === "লিখুন"){
            alert("দয়া করে পার্টির নামটি সিলেক্ট করুন");
            document.getElementById("submit2").setAttribute("disabled","disabled");
        } else {
            document.getElementById("submit2").removeAttribute("disabled",0);
            document.getElementById("submit").click();
        }
    }
}
function selectClient(){
    var name = document.getElementById("company_name").value;
    var serial = parseInt(document.getElementById("total-row").value);
    var pidId = "pid"+serial;
    var pidVal = noNaN(parseInt(toEnglish(document.getElementById(pidId).value)));
    var duplic = false;
    if(serial > 1){
        for (var prevIndex = 1 ; prevIndex < serial ; prevIndex++){
            prevPid = "pid"+prevIndex;
            prevPidVal = noNaN(parseInt(document.getElementById(prevPid).value));
            if(pidVal == prevPidVal){
                duplic = true;
                //alert("একই আইডি দু'বার প্রদান করা হয়েছে"+pidVal+"ager"+prevPidVal+"serial"+serial);
                alert("একই আইডি দু'বার প্রদান করা হয়েছে");
                document.getElementById(pidId).value = "";
                break;
            }
        }
    }
    if (name === "লিখুন"){
        alert("দয়া করে পার্টির নামটি সিলেক্ট করুন");
        document.getElementById("submit2").setAttribute("disabled","disabled");
    }else if (duplic == true){
        alert("একই আইডি দু'বার প্রদান করা হয়েছে");
        document.getElementById("submit2").setAttribute("disabled","disabled");
    }else if (name != "লিখুন" && duplic == false){
        document.getElementById("submit2").removeAttribute("disabled",0);
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
