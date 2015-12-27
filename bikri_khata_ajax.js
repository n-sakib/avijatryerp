function ajax_credit_types() {
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "get_names.php";
    var purchase_type = document.getElementById("purchase_type").value;
    var vars = "purchase_type=" + purchase_type;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("names").innerHTML = return_data;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    
}
function ajax_get_bikri_names() {
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "get_bikri_names.php";
    var sell_type = document.getElementById("sell_type").value;
    var vars = "sell_type=" + sell_type;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("sell_name").innerHTML = return_data;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    
}
function ajax_get_jolap_form() {
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "get_jolap_form.php";
    var company_name = document.getElementById("company_name").value;
    var vars = "company_name=" + company_name;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("jolap_row").innerHTML = return_data;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    
}
function ajax_gen_comment() {
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "gen_comment.php";
    var jolap_name = document.getElementById("jolap_name").value;
    var jolap_address = document.getElementById("jolap_address").value;
    var jolap_phone = document.getElementById("jolap_phone").value;
    var vars = "jolap_name=" + jolap_name + "&jolap_address=" + jolap_address + "&jolap_phone=" + jolap_phone;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("comment").value = return_data;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    
}
function ajax_post_bank_names(){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "post_bank_names.php"
    var pay_method = document.getElementById("pay_method").value;
    var vars = "pay_method=" + pay_method;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("gen_bank_name").innerHTML = return_data;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    
}
$(document).ready(function(){
    $(document).on("change","select[name='purchase_type']",function(){
        //alert($(this).val());
        if($(this).val()=='factory')
        {
            $('<div class="payCheckBox"> <span class="badge">চেক</span> - <input type="checkbox" name="payCheck" value="yes"/><br /> ইস্যু তারিখ:<input name="dateIssued" type="date"><br /></input>তাগাদা দেওয়ার তারিখ:<input name="date" type="date"></input></div>').insertAfter('#names');
            
            $( "input[type='date']" ).datepicker();
            $( "input[type='date']" ).datepicker( "option", "dateFormat", "dd/mm/yy" );

        }
        else
        {
            $('#names').siblings(".payCheckBox").remove();
        }
    });
});