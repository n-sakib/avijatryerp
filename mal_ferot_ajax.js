function ajax_post_retail_prices(priceTag, pidTag) {
    // Create our XMLHttpRequest object
    var hr1 = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "mal_ferot_pid_get_prices.php";
    var pid = document.getElementById(pidTag).value;
    var vars = "pid=" + pid;
    hr1.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr1.onreadystatechange = function() {
        if (hr1.readyState == 4 && hr1.status == 200) {
            var return_data = hr1.responseText;

            document.getElementById(priceTag).value = return_data;
            //document.getElementById("type").innerHTML = return_data;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr1.send(vars); // Actually execute the request
    document.getElementById(priceTag).innerHTML = "processing...";
}
function ajax_post_subtotal_prices() {
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "mal_ferot_pid_get_subtotal_price.php";
    var qty = document.getElementById("qtys").value;
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
            
            var data = parseFloat(document.getElementById("subtotal_prices").value);
            var raw_total_price = parseFloat(document.getElementById("raw_total_price").value);
            raw_total_price = raw_total_price + data;
            
            var comm_perc = parseFloat(document.getElementById("comm_perc").value);
            var comm = raw_total_price*comm_perc*0.01;
            var total_price = raw_total_price - comm ;
            document.getElementById("raw_total_price").value = raw_total_price;
            document.getElementById("comm").value = comm;
            document.getElementById("total_price").value = total_price;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    //document.getElementById("subtotal_prices").innerHTML = "processing...";
    
}
function ajax_post_pid_form(){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "get_pid_form.php";
    var return_type = document.getElementById("ferot_type").value;
    var vars = "return_type=" + return_type ;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("pid_form").innerHTML = return_data;
            //document.getElementById("memo_hidden_in").value = return_data;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request    
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
            document.getElementById("factories").innerHTML = return_data;
            //document.getElementById("memo_hidden_in").value = return_data;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request    
}