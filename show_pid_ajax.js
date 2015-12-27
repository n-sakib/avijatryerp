function ajax_show_barcode(index) {
    var input_tag = 'in'+ index;
    var des_tag = 'des' + index;
    var bc_tag = 'bc' + index;
    if(document.getElementById(input_tag).value != ''){
        var barcode = document.getElementById(input_tag).value;

        var barcode = '*'+barcode.trim()+'*';

        document.getElementById(bc_tag).innerHTML = barcode;

        // Create our XMLHttpRequest object
        var hr1 = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file
        var url = "get_description.php";
        var pid = document.getElementById(input_tag).value;
        pid = pid.trim();
        var vars = "pid=" + pid;
        hr1.open("POST", url, true);
        // Set content type header information for sending url encoded variables in the request
        hr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // Access the onreadystatechange event for the XMLHttpRequest object
        hr1.onreadystatechange = function() {
            if (hr1.readyState == 4 && hr1.status == 200) {
                var return_data = hr1.responseText;
                //window.alert(return_data);
                document.getElementById(des_tag).innerHTML = return_data;
                document.getElementById(bc_tag).innerHTML = barcode;
            }
        }
        // Send the data to PHP now... and wait for response to update the status div
        hr1.send(vars); // Actually execute the request
        //document.getElementById("types").innerHTML = "processing...";
    }
}