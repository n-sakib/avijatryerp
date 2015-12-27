function ajax_post_cost_prices() {
    // Create our XMLHttpRequest object
    var hr1 = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "mal_ferot_before_sell_prices.php";
    var pid = document.getElementById("pids").value;
    var vars = "pid=" + pid;
    hr1.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr1.onreadystatechange = function() {
        if (hr1.readyState == 4 && hr1.status == 200) {
            var return_data = hr1.responseText;
            document.getElementById("prices").value = return_data;
            document.getElementById("prices_cell").innerHTML = return_data;
            //document.getElementById("type").innerHTML = return_data;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr1.send(vars); // Actually execute the request
   // document.getElementById("prices").innerHTML = "processing...";
}

function ajax_post_subtotal_prices() {
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "mal_ferot_pid_get_subtotal_price.php";
    var qty = noNaN(parseInt(toEnglish(document.getElementById("qtys").value)));
    var price = document.getElementById("prices").value;
    var vars = "qty=" + qty +"&retail_price=" + price;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            
            document.getElementById("subtotal_prices").value = return_data;
            document.getElementById("subtotal_prices_cell").innerHTML = return_data;
            var subtotal = parseFloat(document.getElementById("subtotal_prices").value);
            var total = parseFloat(document.getElementById("total_price").value);
            
            total = total + subtotal;
            
            document.getElementById("total_price").value = total;
            document.getElementById("total_price_cell").innerHTML = total;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    //document.getElementById("subtotal_prices").innerHTML = "processing...";
    
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