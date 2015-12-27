function addField(){
    var genre_value = parseInt(document.getElementById("genre").value);
    var pid_value = parseInt(document.getElementById("pid").value);
    
    if (genre_value != 0){
        $(document).ready(function(){
            var serial = parseInt(document.getElementById("serial").innerHTML) ;
            serial++;

            document.getElementById("serial").removeAttribute("id",0);

            document.getElementById("genre").removeAttribute("onchange",0);
            document.getElementById("genre").removeAttribute("id",0);
            
            document.getElementById("types").removeAttribute("onclick",0);
            document.getElementById("types").removeAttribute("id",0);
            
            document.getElementById("colors").removeAttribute("onchange",0);
            document.getElementById("colors").removeAttribute("id",0);

            document.getElementById("designs").removeAttribute("id",0);
            document.getElementById("design_no").removeAttribute("id",0);


            document.getElementById("check").removeAttribute("onclick",0);
            document.getElementById("renew").removeAttribute("onclick",0);
            document.getElementById("check").removeAttribute("id",0);
            document.getElementById("renew").removeAttribute("id",0);

			
            document.getElementById("prices").setAttribute("type",'hidden');
            var price = parseInt(document.getElementById("prices").value) ;
            $('<p>'+price+'</p>').insertBefore('#prices');
            document.getElementById("qtys").setAttribute("type",'hidden');
            var qty = parseInt(document.getElementById("qtys").value) ;
            $('<p>'+qty+'</p>').insertBefore('#qtys');
            document.getElementById("subtotal_prices").setAttribute("type",'hidden');
            var subtotal_price = parseInt(document.getElementById("subtotal_prices").value) ;
            $('<p>'+subtotal_price+'</p>').insertBefore('#subtotal_prices');            
            document.getElementById("prices").removeAttribute("id",0);
            document.getElementById("qtys").removeAttribute("id",0);
            document.getElementById("subtotal_prices").removeAttribute("id",0);

            document.getElementById("pid").removeAttribute("onfocus",0);
            document.getElementById("pid").removeAttribute("onblur",0);
            document.getElementById("pid").removeAttribute("id",0);
                

            $('<tr> <td rowspan="2" ><strong id="serial">'+serial+'</strong></td> <td rowspan="1"> <select name="genres[]" id="genre" onChange="javascript:ajax_post_types();ajax_post_colors();ajax_post_availability();ajax_post_pid();"> <option value="0"selected="selected">সিলেক্ট</option> <option value="1" >জেঃ</option> <option value="2">লেঃ</option> <option value="3">সু</option> <option value="4">বেঃ</option> </select> </td> <td rowspan="1"> <select name="types[]" id="types" onclick="javascript:ajax_post_pid();"></select> </td> <td rowspan="1"> <select name="colors[]" id="colors" onChange="javascript:ajax_post_availability();javascript:ajax_post_pid();"></select> </td> <td rowspan="1"> <p id="design_no"></p> <input type="hidden" name="designs[]" id="designs" value="001" > <!-- <input type="hidden" name="pids[]" id ="pid" value="00000000"> --> <input type="button" class="btn btn-info" value="রিনিউ" id="renew" onclick="javascript:ajax_renew_design();ajax_post_availability();"> <input type="button" class="btn btn-info" value="চেক" id="check" onclick="javascript:ajax_post_availability();javascript:ajax_post_pid();"></td> <td rowspan="2"> <input type="text" name="retail_prices[]" id="prices"></td> <td rowspan="2"> <input type="text" name="qtys[]" id="qtys" onblur="javascript:ajax_post_subtotal_prices()" value="6"></td> <td rowspan="2"> <input type="text" name="subtotal_prices[]" id="subtotal_prices"></td> </tr> <tr> <td colspan="4"> আইডি : <input type="text" name="pids[]" id ="pid" value="00000000" onblur="javascript:ajax_post_retail_prices();" onfocus="javascript:addField();"></td> </tr>').insertBefore('#last_row'); }); 
} else if (pid_value != 0) {
        $(document).ready(function(){
            var serial = parseInt(document.getElementById("serial").innerHTML) ;
            serial++;
            
            document.getElementById("serial").removeAttribute("id",0);

            document.getElementById("genre").removeAttribute("onchange",0);
            document.getElementById("genre").removeAttribute("id",0);
            
            document.getElementById("types").removeAttribute("onclick",0);
            document.getElementById("types").removeAttribute("id",0);
            
            document.getElementById("colors").removeAttribute("onchange",0);
            document.getElementById("colors").removeAttribute("id",0);

            document.getElementById("designs").removeAttribute("id",0);
            document.getElementById("design_no").removeAttribute("id",0);


            document.getElementById("check").removeAttribute("onclick",0);
            document.getElementById("renew").removeAttribute("onclick",0);
            document.getElementById("check").removeAttribute("id",0);
            document.getElementById("renew").removeAttribute("id",0);

			
            document.getElementById("prices").setAttribute("type",'hidden');
            var price = parseInt(document.getElementById("prices").value) ;
            $('<p>'+price+'</p>').insertBefore('#prices');
            document.getElementById("qtys").setAttribute("type",'hidden');
            var qty = parseInt(document.getElementById("qtys").value) ;
            $('<p>'+qty+'</p>').insertBefore('#qtys');
            document.getElementById("subtotal_prices").setAttribute("type",'hidden');
            var subtotal_price = parseInt(document.getElementById("subtotal_prices").value) ;
            $('<p>'+subtotal_price+'</p>').insertBefore('#subtotal_prices');            
            document.getElementById("prices").removeAttribute("id",0);
            document.getElementById("qtys").removeAttribute("id",0);
            document.getElementById("subtotal_prices").removeAttribute("id",0);

            document.getElementById("pid").removeAttribute("onfocus",0);
            document.getElementById("pid").removeAttribute("onblur",0);
            document.getElementById("pid").removeAttribute("id",0);

            $('<tr> <td rowspan="2" ><strong id="serial">'+serial+'</strong></td> <td rowspan="1"> <select name="genres[]" id="genre" onChange="javascript:ajax_post_types();ajax_post_colors();ajax_post_availability();ajax_post_pid();"> <option value="0"selected="selected">সিলেক্ট</option> <option value="1" >জেঃ</option> <option value="2">লেঃ</option> <option value="3">সু</option> <option value="4">বেঃ</option> </select> </td> <td rowspan="1"> <select name="types[]" id="types" onclick="javascript:ajax_post_pid();"></select> </td> <td rowspan="1"> <select name="colors[]" id="colors" onChange="javascript:ajax_post_availability();javascript:ajax_post_pid();"></select> </td> <td rowspan="1"> <p id="design_no"></p> <input type="hidden" name="designs[]" id="designs" value="001" > <!-- <input type="hidden" name="pids[]" id ="pid" value="00000000"> --> <input type="button" class="btn btn-info" value="রিনিউ" id="renew" onclick="javascript:ajax_renew_design();ajax_post_availability();"> <input type="button" class="btn btn-info" value="চেক" id="check" onclick="javascript:ajax_post_availability();javascript:ajax_post_pid();"></td> <td rowspan="2"> <input type="text" name="retail_prices[]" id="prices"></td> <td rowspan="2"> <input type="text" name="qtys[]" id="qtys" onblur="javascript:ajax_post_subtotal_prices()" value="6"></td> <td rowspan="2"> <input type="text" name="subtotal_prices[]" id="subtotal_prices"></td> </tr> <tr> <td colspan="4"> আইডি : <input type="text" name="pids[]" id ="pid" value="00000000" onblur="javascript:ajax_post_retail_prices();" onfocus="javascript:addField();"></td> </tr>').insertBefore('#last_row');        
         });
    }      
}

