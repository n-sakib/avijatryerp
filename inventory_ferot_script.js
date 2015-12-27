function addField(){
	$(document).ready(function(){
        var serial = parseInt(document.getElementById("serial").innerHTML) ;
        serial++;
        /*var price = parseInt(document.getElementById("prices").value) + 0;
       	if(price == 0 || price == null){
       		var invalid_entry = document.getElementById("serial");
			invalid_row.parentNode.parentNode.removeChild(parentNode.invalid_row);
       	} else {}*/

        document.getElementById("serial").removeAttribute("id",0);
        document.getElementById("pids").removeAttribute("onblur",0);       
		
        document.getElementById("pids").setAttribute("type",'hidden');
        var pids = document.getElementById("pids").value ;
        $('<p>'+pids+'</p>').insertBefore('#pids');
        document.getElementById("qtys").setAttribute("type",'hidden');
        var qty = noNaN(parseInt(toEnglish(document.getElementById("qtys").value))) ;
        $('<p>'+qty+'</p>').insertBefore('#qtys');

        document.getElementById("pids").removeAttribute("id",0);
        document.getElementById("prices").removeAttribute("id",0);
        document.getElementById("prices_cell").removeAttribute("id",0);
        document.getElementById("qtys").removeAttribute("id",0);
        document.getElementById("subtotal_prices").removeAttribute("id",0);
        document.getElementById("subtotal_prices_cell").removeAttribute("id",0); 

        $('<tr> <td id="serial">'+serial+'</td> <td> <input type="text" name="pids[]" id="pids" onblur="javascript:ajax_post_cost_prices();"></td> <td> <p id="prices_cell"></p> <input type="hidden" name="cost_prices[]" id="prices"></td> <td> <input type="text" name="qtys[]" id="qtys" onblur="javascript:ajax_post_subtotal_prices();"></td> <td> <p id="subtotal_prices_cell"></p> <input type="hidden" name="subtotal_prices[]" id="subtotal_prices"></td> </tr>').insertBefore('#last_row'); }); 
		var last_pid = document.getElementById('last_pid').value;
        document.getElementById('pids').value = last_pid;
        document.getElementById('last_pid').value = null;
        document.getElementById('pids').focus();
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