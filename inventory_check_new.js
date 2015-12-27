$(document).ready(function(){
	// //alert("reday");
	$(document).on("click",".add",function(){
		pid = $("#pid").val();
		qty = $("#qty").val();

		inventoryHas(pid);
	});
	$(document).on("blur","#qty",function(){
		pid = $("#pid").val();
		qty = $("#qty").val();

		//alert(pid);

		inventoryHas(pid);
	});
	// $("#qty").click(function(){
	// 	inventoryHasThe();
	// });
	function inventoryHas(pid)
	{
		var url = 'inv_chk_ajx.php';
        var vars = "variable=variable"+"&function=inventoryHas"+"&pid="+pid;
        
        var request = $.ajax({
        	url: url,
            type: 'POST',
            data: vars,
            dataType: "text"
        });
        
        //the page returns the new entry index
        request.done(function(msg){
        	//console.log(msg);
        	//alert(msg);
            if(msg=="true")
            {
            	getQtyOf(pid);
            	return true;
            	// 
            }
            else if (msg == "false")
            {
            	return false;
            }
        });
	}
	function getQtyOf(pid)
	{
		qty = $("#qty").val()
		var url = 'inv_chk_ajx.php';
        var vars = "variable=variable"+"&function=getQtyOf"+"&pid="+pid+"&qty="+qty;
        
        var request = $.ajax({
        	url: url,
            type: 'POST',
            data: vars,
            dataType: "text"
        });
        
        //the page returns the new entry index
        request.done(function(msg){
        	//console.log(msg);
        	if(pagehasthis(pid))
        	{
        		updateInfo(pid,qty);
        	}
        	else
        	{
                //alert("not in the page");
        		$(msg).insertBefore(".last-row");
			}
        });
	}
	function updateInfo(pid,qty)
	{
		var url = 'inv_chk_ajx.php';
        var vars = "variable=variable"+"&function=updateInfo"+"&pid="+pid+"&qty="+qty;
        
        var request = $.ajax({
            url: url,
            type: 'POST',
            data: vars,
            dataType: "text"
        });
        
        //the page returns the new entry index
        request.done(function(entry){
			updatePage(pid);
        });
	}
    function updatePage(pid)
    {
        //alert("updating page");
        $(".pid").each(function(){
            if($(this).html() === pid)//used .val() mistakenly
            {
                //$(this).siblings(".entry").html(entry);
                qty = $(this).siblings(".qty").html();

                entry = $("#qty").val();//**/
                prevEntry = $(this).siblings(".entry").html();
                newEntry = parseInt(entry) + parseInt(prevEntry);
                rem = qty - newEntry;
                $(this).siblings(".rem").html(rem);
                $(this).siblings(".entry").html(newEntry);

                //alert("updating page done");
                console.log("qty="+qty);
                console.log("entry="+entry);
                console.log($(this).parent().html());
                updateDb(pid,newEntry);
            }
            else{}
        });
    }
    function updateDb(pid,newEntry)
    {
        var url = 'inv_chk_ajx.php';
        var vars = "variable=variable"+"&function=updateDb"+"&pid="+pid+"&newEntry="+newEntry;
        
        var request = $.ajax({
            url: url,
            type: 'POST',
            data: vars,
            dataType: "text"
        });
        
        //the page returns the new entry index
        request.done(function(msg){
            //alert(msg);
        });
    }
	function pagehasthis(pid)
	{
		pagehas = false;
		$(".pid").each(function(){
            console.log("if("+$(this).html()+" == "+pid+")");
			if($(this).html() == pid)
			{
				pagehas = true;
			}
			else{}
		});

        return pagehas;
	}
	function inventoryHasThe()
	{

		//alert("here");
		var url = 'inv_chk_ajx.php';
        var vars = "variable=variable"+"&function=inventoryHas"+"&pid="+"pid";
        
        var request = $.ajax({
            url: url,
            type: 'POST',
            data: vars,
            dataType: "text"
        });
        
        //the page returns the new entry index
        request.done(function(msg){

		//alert("done");
        	//console.log(msg);
        	//alert(msg);
        });
	}
    /**=============================================
    //    local features
    ==============================================*/
    $(document).on("click",".del",function(){
        deleteFromDb(this);
    });
    //helpers
    function deleteFromDb(delBtn)
    {
        pid = $(delBtn).parent().siblings(".pid").html();
        ////alert(pid);
        var url = 'inv_chk_ajx.php';
        var vars = "variable=variable"+"&function=deleteFromDb"+"&pid="+pid;
        
        var request = $.ajax({
            url: url,
            type: 'POST',
            data: vars,
            dataType: "text"
        });
        
        //the page returns the new entry index
        request.done(function(msg){
            $(delBtn).parent().parent().remove();
        });
    }
    //**** end of local features ****
    
});
// function pagehas(pid)
// {
//     pagehas = false;
//     $(".pid").each(function(){
//         if($(this).val() == pid)
//         {
//             pagehas = true;
//         }
//         else{}

//     });

//     return pagehas;
// }