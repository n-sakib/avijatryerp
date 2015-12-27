function ajax_post_types() {
    // Create our XMLHttpRequest object
    var hr1 = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "get_shoetypes.php";
    var genre = document.getElementById("genre").value;
    var vars = "genre=" + genre;
    hr1.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr1.onreadystatechange = function() {
        if (hr1.readyState == 4 && hr1.status == 200) {
            var return_data = hr1.responseText;
            document.getElementById("types").innerHTML = return_data;
            //document.getElementById("type").innerHTML = return_data;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr1.send(vars); // Actually execute the request
    //document.getElementById("types").innerHTML = "processing...";
}
function ajax_post_colors() {
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "get_shoecolors.php";
    var genre = document.getElementById("genre").value;
    var vars = "genres=" + genre;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("colors").innerHTML = return_data;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    //document.getElementById("colors").innerHTML = "processing...";
    
}
function ajax_post_availability() {
    //var pidIs = document.getElementById("pid1").value;
    //console.log("{in av checking and posting av " + pidIs);
    var url = "get_availability.php";
    var genres = document.getElementById("genre").value;
    var types = document.getElementById("types").value;
    var colors = document.getElementById("colors").value;
    var factories = document.getElementById("factory_name").value;
    var designs = document.getElementById("designs").value;
    var vars = "genres=" + genres + "&types=" + types + "&colors=" + colors + "&factories=" + factories + "&designs=" + designs;
    console.log(factories + "" + genres + "" + types + "" + colors + "" + designs);
    return $.ajax({
        url: url,
        type: 'POST',
        data: vars
    }).promise();
}
function getTheAv(results) {
    var d = $.Deferred();
    console.log("in get the av , with results"+results);
    var return_data = results;
    var state = document.getElementById("design_no").innerHTML;
    if (return_data == "নতুন" || state == "আজকের মাল") {
        console.log("notun mal");
        //check from previous pids
        var last = document.getElementById("total_serial").value;
        var pidId = "pid" + last;
        var pid = document.getElementById(pidId).value;

        var renew = false;

        var matchedDesign = null;
        var newDesign = null;
        //var prevPid =  null;
        //my recursive tech
        var change = 0;
        for (var prev = 1; prev < last; prev++) {
            var prevPidId = "pid" + prev;
            //if(document.getElementById(prevPidId)){
            var prevPid = document.getElementById(prevPidId).value;
            //}
            console.log(pid + " prev :" + prevPid);
            //console.log(prevPid);
            //console.log("change"+change);
            if (pid == prevPid) {
                change++;
                console.log("change" + change);
                var prevDesign = String(prevPid);
                var matchedDesign = parseInt(prevDesign.substr(8, 10));
                var newDesignInt = matchedDesign + 1;
                var blankDesign = "000";
                newDesign = String(newDesignInt);
                newDesign = blankDesign.substr(0, blankDesign.length - newDesign.length) + newDesign;

                var pidWODesign = pid.substr(0, 8);
                pid = pidWODesign + newDesign;

                //  console.log(newDesign);
                renew = true;
                //break;
            }
        }
        //console.log("aidi"+pid);
        if (change != 0) { //} || state == "নতুন মাল"){
            console.log("recursing");
        }
        if (renew == true) {
            //console.log("renew");
            document.getElementById("design_no").innerHTML = "আজকের মাল";

            document.getElementById("designs").value = newDesign;
            var pidWODesign = pid.substr(0, 8);

            var newPid = pidWODesign + newDesign;
            document.getElementById(pidId).value = newPid;
        } else {
            //console.log("here notun");
            document.getElementById("design_no").innerHTML = "নতুন";
        }

    } else if (return_data == "আগের মাল") {
        console.log("here আগের মাল");
        document.getElementById("design_no").innerHTML = return_data;
        //document.getElementById("design_no").innerHTML = "নতুন মাল";
        console.log("before renew");
        document.getElementById("renew").click();
        console.log("after renew");
    } else { //new
        document.getElementById("design_no").innerHTML = return_data;
    }
    console.log("out of av}");
    d.resolve();
    return d.promise();
}
/*function ajax_post_availability() {
    var d = $.Deferred();
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "get_availability.php";
    var genres = document.getElementById("genre").value;
    var types = document.getElementById("types").value;
    var colors = document.getElementById("colors").value;
    var factories = document.getElementById("factories").value;
    var designs = document.getElementById("designs").value;
    var vars = "genres=" + genres+"&types="+types+"&colors="+colors+"&factories="+factories+"&designs="+designs;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            var state = document.getElementById("design_no").innerHTML;
            if (return_data == "নতুন" || return_data == "আগের মাল" || state == "আজকের মাল" ){
                //check from previous pids
                var last = document.getElementById("total_serial").value;
                var pidId = "pid"+last;
                var pid = document.getElementById(pidId).value;
    
                var renew = false;

                var matchedDesign = null;
                var newDesign = null;
                //my recursive tech
                var change = 0;
                for(var prev = 1; prev < last; prev++){
                    var prevPidId = "pid"+prev;
                    var prevPid = document.getElementById(prevPidId).value;
                    //alert(pid+" prev :"+prevPid);
                    if (pid == prevPid){
                        change++;
                        var prevDesign = String(prevPid);
                        var matchedDesign = parseInt(prevDesign.substr(8,10));
                        var newDesignInt = matchedDesign +1;
                        var blankDesign = "000";
                        newDesign = String(newDesignInt);
                        newDesign = blankDesign.substr(0, blankDesign.length - newDesign.length)+newDesign;

                        var pidWODesign = pid.substr(0,8);
                        pid = pidWODesign+newDesign;

                        //alert(newDesign);
                        renew =true;
                        //break;
                    }
                }
                if (change != 0){
                        ajax_post_availability();
                    }
                if (renew == true){
                    //alert("renew");
                    document.getElementById("design_no").innerHTML = "আজকের মাল"; 
                    
                    document.getElementById("designs").value = newDesign;
                    var pidWODesign = pid.substr(0,8);

                    var newPid = pidWODesign+newDesign;                    
                    /*var pidInt = parseInt(pid) +1;
                    var blankPid = "00000000000"; //11 digits of pid
                    var newPid = String(pidInt);
                    var newPid = blankPid.substr(0, blankPid.length - newPid.length)+newPid;*//*
                    document.getElementById(pidId).value = newPid;
                } else{
                    //alert(return_data);
                    document.getElementById("design_no").innerHTML = "নতুন";   
                }
                
            } else if (return_data == "আগের মাল"){
                //alert("here আগের মাল");
                document.getElementById("design_no").innerHTML = return_data;
                setTimeout(function(){document.getElementById("renew").click();},0);
                
            }
            d.resolve();
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    //document.getElementById("design_no").innerHTML = "processing...";
    
    return d.promise();
}
function ajax_renew_design() {
    var d = $.Deferred();
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "renew_design.php";
    var genres = document.getElementById("genre").value;
    var types = document.getElementById("types").value;
    var colors = document.getElementById("colors").value;
    var factories = document.getElementById("factories").value;;
    var designs = document.getElementById("designs").value;
    var inv_state = document.getElementById("design_no").innerHTML;
    var vars = "genres=" + genres+"&types="+types+"&colors="+colors+"&factories="+factories+"&designs="+designs+"&inv_state="+inv_state;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("designs").value = return_data;
            
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    //document.getElementById("designs").value = "processing...";
    d.resolve();
    return d.promise();
}*/
function ajax_renew_design() {
    console.log("{in ren ");
    var url = "renew_design.php";
    var genres = document.getElementById("genre").value;
    var types = document.getElementById("types").value;
    var colors = document.getElementById("colors").value;
    var factories = document.getElementById("factory_name").value;
    var designs = document.getElementById("designs").value;
    var inv_state = document.getElementById("design_no").innerHTML;
    var vars = "genres=" + genres + "&types=" + types + "&colors=" + colors + "&factories=" + factories + "&designs=" + designs + "&inv_state=" + inv_state;
    return $.ajax({
        url: url,
        type: 'POST',
        data: vars
    }).promise();
}
function renTheDesign(results){
    var d = $.Deferred();
    document.getElementById("designs").value = results;
    console.log("out of ren :S}"+results);
    d.resolve();
    return d.promise();
}
function ajax_post_pid(serial) {
    //var d = $.Deferred();
    console.log("{posting pid");
    var pidId = "pid" + serial;
    // Create our XMLHttpRequest object
    //var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "post_pid.php";
    var genres = document.getElementById("genre").value;
    var types = document.getElementById("types").value;
    var colors = document.getElementById("colors").value;
    var factories = document.getElementById("factory_name").value;
    var designs = document.getElementById("designs").value;
    var vars = "genres=" + genres + "&types=" + types + "&colors=" + colors + "&factories=" + factories + "&designs=" + designs;
    //hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    //hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    /*hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {

    console.log("{posting pid }:S");console.log("{posting pid");console.log("{posting pid");console.log("{posting pid");
            var return_data = hr.responseText;
            document.getElementById(pidId).value = return_data;
            console.log("new pid"+return_data+"}");
        }
    }*/
    return $.ajax({
        url: url,
        type: 'POST',
        data: vars
    }).promise();
    /*,
        success: function(results) {
            document.getElementById(pidId).value = results;
            console.log("new pid" + results + "}");
        }*/
    // Send the data to PHP now... and wait for response to update the status div
    //hr.send(vars); // Actually execute the request
    //return d.promise();
}
function postThePid(results,serial){
    var d = $.Deferred();
    var pidId = "pid" + serial;
    document.getElementById(pidId).value = results;
    console.log("new pid" + results + "}");
    d.resolve();
    return d.promise();
}
function ajax_post_pid(serial) {
    console.log("{posting pid");
    var pidId = "pid" + serial;
    var url = "post_pid.php";
    var genres = document.getElementById("genre").value;
    var types = document.getElementById("types").value;
    var colors = document.getElementById("colors").value;
    var factories = document.getElementById("factory_name").value;
    var designs = document.getElementById("designs").value;
    var vars = "genres=" + genres + "&types=" + types + "&colors=" + colors + "&factories=" + factories + "&designs=" + designs;
    return $.ajax({
        url: url,
        type: 'POST',
        data: vars
    }).promise();
}
function postThePid(results,serial){
    var d = $.Deferred();
    var pidId = "pid" + serial;
    document.getElementById(pidId).value = results;
    console.log("new pid" + results + "}");
    d.resolve();
    return d.promise();
}

/*function ajax_post_pid(serial) {
    var d = $.Deferred();
    alert("posting pid");
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "mal_ferot_post_pid.php";
    var genres = document.getElementById("genre").value;
    var types = document.getElementById("types").value;
    var colors = document.getElementById("colors").value;
    var designs = document.getElementById("designs").value;
    var factories = document.getElementById("factories").value;
    /*alert(factories);
    alert(genres);
    alert(types);
    alert(colors);*//*
    
    var vars = "genres=" + genres+"&types="+types+"&colors="+colors+"&factories="+factories+"&designs="+designs;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            var pidId = "pid"+serial;
            document.getElementById(pidId).value = return_data;
            //alert(return_data);
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    d.resolve();
    return d.promise();
}*/