function firstFunction(){
		  var d = $.Deferred();
		  // some very time consuming asynchronous code...
		  setTimeout(function() {
		    console.log('1');
		    d.resolve();
		  }, 1000);
		  return d.promise();
		}
		function secondFunction(){
		  var d = $.Deferred();
		  setTimeout(function() {
		    console.log('2');
		    d.resolve();
		  }, 3000);
		  return d.promise();
		}
		function thirdFunction(){
		  var d = $.Deferred();
		  // definitely dont wanna do this until secondFunction is finished
		  setTimeout(function() {
		    console.log('3');
		    d.resolve();
		  }, 2000);
		  return d.promise();
		}
		function fourthFunction(val){
		  var d = $.Deferred();
		  // last function, not executed until the other 3 are done.
		  setTimeout(function() {
		    console.log('4'+val);
		    d.resolve();
		  }, 500);
		  return d.promise();
		}
		/*$(document).ready(function() {
		    $("#btn").click(function(){
		        firstFunction().pipe(secondFunction).pipe(thirdFunction).pipe(fourthFunction);
		    }); 
		});*/
		function triggerDef(){
			console.log("started");
			firstFunction().pipe(secondFunction).pipe(function(){fourthFunction("the thing");}).pipe(thirdFunction).pipe(function(){console.log("finished");});
		}