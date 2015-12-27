function addField(){
    var genre_value = parseInt(document.getElementById("genre").value);
    var pid_value = parseInt(document.getElementById("pid").value);
    
    if (genre_value != 0){
        $(document).ready(function(){
            var serial = parseInt(document.getElementById("serial").innerHTML) ;
            serial++;

            document.getElementById("serial").removeAttribute("id",0);
            document.getElementById("genre").removeAttribute("id",0);
            document.getElementById("types").removeAttribute("id",0);
            document.getElementById("colors").removeAttribute("id",0);
            document.getElementById("designs").removeAttribute("id",0);
            document.getElementById("design_no").removeAttribute("id",0);
            document.getElementById("check").removeAttribute("id",0);
            document.getElementById("renew").removeAttribute("id",0);


            document.getElementById("pid").removeAttribute("onfocus",0);
            document.getElementById("pid").removeAttribute("id",0);
                

            $('<tr> <td rowspan="2" id="serial">'+serial+'</td> <td rowspan="1"> <select style=""name="genres[]" id="genre" onChange="javascript:ajax_post_types();ajax_post_colors();ajax_post_availability();ajax_post_pid();"> <option class="new" value="0" selected="selected">সিলেক্ট</option> <option value="1" >জেঃ</option> <option value="2">লেঃ</option> <option value="3">সু</option> <option value="4">বেবি</option> </select> </td> <td rowspan="1"> <select name="types[]" id="types" onclick="javascript:ajax_post_pid();"> </select> </td> <td rowspan="1"> <select name="colors[]" id="colors" onChange="javascript:ajax_post_availability();javascript:ajax_post_pid();"> </select> </td> <td rowspan="1"> <p id="design_no"></p> <input type="hidden" name="designs[]" id="designs" value="001" > <!-- <input type="hidden" name="pids[]" id ="pid" value="00000000"> --> <input class="new button btn btn-info" type="button" value="নতুন" id="renew" onclick="javascript:ajax_renew_design();ajax_post_availability();" onmouseup="javascript:ajax_post_pid();"> <input class="new button btn btn-info" type="button" value="চেক" id="check" onclick="javascript:ajax_post_availability();javascript:ajax_post_pid();"> </td> <td rowspan="2"> <input class="new button btn btn-info" name="images[]" id="image photo_up" type="file" title="ছবি দিন"  style="width: 60%;" value="ছবি দিন"> </td> <td rowspan="2"> <input type="text" name="qtys[]" value="6"> </td> <td rowspan="2"> <input type="text" name ="retail_prices[]"> </td> <td rowspan="2"> <input type="text" name="cost_prices[]"> </td> </tr> <tr> <td colspan="4">আইডি <input type="text" name="pids[]" id ="pid" value="000000000" onfocus="javascript:addField();"></td> </tr>').insertBefore('#last_row');         
        });
    } else if (pid_value != 0) {
        $(document).ready(function(){
            var serial = parseInt(document.getElementById("serial").innerHTML) ;
            serial++;

            document.getElementById("genre").removeAttribute("id",0);
            document.getElementById("types").removeAttribute("id",0);
            document.getElementById("colors").removeAttribute("id",0);
            document.getElementById("designs").removeAttribute("id",0);
            document.getElementById("design_no").removeAttribute("id",0);
            document.getElementById("check").removeAttribute("id",0);
            document.getElementById("renew").removeAttribute("id",0);


            document.getElementById("pid").removeAttribute("onfocus",0);
            document.getElementById("pid").removeAttribute("id",0);


            $('<tr> <td rowspan="2" id="serial">'+serial+'</td> <td rowspan="1"> <select style=""name="genres[]" id="genre" onChange="javascript:ajax_post_types();ajax_post_colors();ajax_post_availability();ajax_post_pid();"> <option class="new" value="0" selected="selected">সিলেক্ট</option> <option value="1" >জেঃ</option> <option value="2">লেঃ</option> <option value="3">সু</option> <option value="4">বেবি</option> </select> </td> <td rowspan="1"> <select name="types[]" id="types" onclick="javascript:ajax_post_pid();"> </select> </td> <td rowspan="1"> <select name="colors[]" id="colors" onChange="javascript:ajax_post_availability();javascript:ajax_post_pid();"> </select> </td> <td rowspan="1"> <p id="design_no"></p> <input type="hidden" name="designs[]" id="designs" value="001" > <!-- <input type="hidden" name="pids[]" id ="pid" value="00000000"> --> <input class="new button btn btn-info" type="button" value="নতুন" id="renew" onclick="javascript:ajax_renew_design();ajax_post_availability();" onmouseup="javascript:ajax_post_pid();"> <input class="new button btn btn-info" type="button" value="চেক" id="check" onclick="javascript:ajax_post_availability();javascript:ajax_post_pid();"> </td> <td rowspan="2"> <input class="new button btn btn-info" name="images[]" id="image photo_up" type="file" title="ছবি দিন"  style="width: 60%;" value="ছবি দিন"> </td> <td rowspan="2"> <input type="text" name="qtys[]" value="6"> </td> <td rowspan="2"> <input type="text" name ="retail_prices[]"> </td> <td rowspan="2"> <input type="text" name="cost_prices[]"> </td> </tr> <tr> <td colspan="4">আইডি <input type="text" name="pids[]" id ="pid" value="000000000" onfocus="javascript:addField();"></td> </tr>').insertBefore('#last_row');        
         });
    }      
}

