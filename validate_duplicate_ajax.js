function ifDuplic(inputId,fieldName,tableName) {
    document.getElementById("submit").setAttribute("disabled","disabled");
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "validate_duplicate.php";
    //inputId.value = "none";
    //alert(tableName);
    var input = document.getElementById(inputId).value;
    var vars = "input=" + input +"&field_name="+fieldName+"&table_name="+tableName;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            if(return_data == "duplicate"){
                alert('অন্য নাম দিন, এই নামটি পূর্বে সংরক্ষিত');
                document.getElementById(inputId).value = "";
                document.getElementById("submit").setAttribute("disabled","disabled");
            }
            else{
                document.getElementById("submit").removeAttribute("disabled",0);
            }
            //alert(inputId);
            //alert("return");
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    
}