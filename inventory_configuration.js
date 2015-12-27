/*function postGenres(){
	var genres = '<option value="1" >জেঃ</option> <option value="2">লেঃ</option> <option value="3">সু</option> <option value="4">বেঃ</option>';
	document.getElementById("genre").innerHTML= genres;
}*/
function checkGenres(){
	var genreVal = document.getElementById("genre").value;
	if (genreVal == 0 ){
		alert("দয়া করে ধরন সিলেক্ট করুন");
		document.getElementById("submit1").setAttribute("disabled","disabled");
	} else {
		document.getElementById("submit1").removeAttribute("disabled");
	}
}