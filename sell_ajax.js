function ajax_get_khuchra_form() {
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "sell_get_khuchra_form.php";
    var company_name = document.getElementById("company_name").value;
    var vars = "company_name=" + company_name;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("khuchra_form").innerHTML = return_data;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    
}
function ajax_get_mal_ferot() {
    document.getElementById("mal-ferot").innerHTML = "processing...";
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "sell_get_mal_ferot.php";
    var company_name = document.getElementById("company_name").value;
    var vars = "company_name=" + company_name;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("mal-ferot").innerHTML = return_data;
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
    var khuchra_name = document.getElementById("khuchra_name").value;
    var khuchra_address = document.getElementById("khuchra_address").value;
    var khuchra_phone = document.getElementById("khuchra_phone").value;
    var vars = "khuchra_name=" + khuchra_name + "&khuchra_address=" + khuchra_address + "&khuchra_phone=" + khuchra_phone;
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
function ajax_post_khuchra_comment() {
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "post_khuchra_comment.php";
    var comment = document.getElementById("comment").value;
    var khuchra_comment = document.getElementById("khuchra_comment").value;
    var vars = "comment=" + comment + "&khuchra_comment=" + khuchra_comment;
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
function ajaxFerotConfirm(ferotMemo){
    var confirmed = confirm('আপনি কি মাল ফেরত নিতে নিশ্চিত');
    if (confirmed) {
        // Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file
        var url = "mal_ferot_confirm.php";
        var memo_no = document.getElementById("memo_no").value;
        var company_name = document.getElementById("company_name").value;
        var vars = "memo_no=" + memo_no+"&ferot_memo="+ferotMemo+"&company_name="+company_name;
        hr.open("POST", url, true);
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // Access the onreadystatechange event for the XMLHttpRequest object
        hr.onreadystatechange = function() {
            if (hr.readyState == 4 && hr.status == 200) {
                var return_data = hr.responseText;
                alert('সফল');
                //alert(return_data);
                ajax_get_mal_ferot();
            }
        }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request
    } else{}
}
function ajaxFerotCancel(ferotMemo){
    var confirmed = confirm('আপনি কি মাল ফেরত টি বাতিল করতে চান ?');
    if (confirmed) {
        // Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file
        var url = "mal_ferot_cancel.php";
        var vars = "ferot_memo="+ferotMemo;
        hr.open("POST", url, true);
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // Access the onreadystatechange event for the XMLHttpRequest object
        hr.onreadystatechange = function() {
            if (hr.readyState == 4 && hr.status == 200) {
                var return_data = hr.responseText;
                if(return_data == "ok"){alert('সফল');}
                //alert(return_data);
                ajax_get_mal_ferot();
            }
        }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request
    } else{}
}
function ajaxPostPidInfo(rowNum){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "sellPostPidInfo.php";
    var pidId = "pid"+rowNum;
    var pid = document.getElementById(pidId).value;
    pid = pid.trim();
    var vars = "pid="+pid+"&serial="+rowNum;
    //alert(pid);
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            var qtyId = "qty"+rowNum;
            
            /*if(return_data == "অপেক্ষা করুন"){
                ajaxPostStockInfo(rowNum);
            } else {*/
                //alert(return_data);
                document.getElementById(qtyId).parentNode.innerHTML = return_data;
                document.getElementById(qtyId).focus();
            //}
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
}
/*function ajaxPostStockInfo(rowNum){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "sellPostStockInfo.php";
    var pidId = "pid"+rowNum;
    var pid = document.getElementById(pidId).value;
    var vars = "pid="+pid;
    alert(pid);
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            var qtyId = "qty"+rowNum;
            document.getElementById(qtyId).parentNode.innerHTML = return_data;
            ajaxPostStockInfo(rowNum);
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
}*/