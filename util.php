<?php 
function arr($conn)
{
	$array = [];
	while($row = mysqli_fetch_array($conn))
	{

		$array[] = $row ;
	}

	return $array;
}
// function Db($query)
// {
// 	$qry = ($con, "$query");
// 	return $row = mysqli_fetch_array($qry);
// }

/**
 * sends a query to the database and returns the rows 
 * back if the query is an select query
 * 
 * @param  [string] $query the query to be passed to the database
 * @return [array]        returns the data array if the query is 
 *                                an insert query
 */
function db($query)
{   
	$con=mysqli_connect("localhost","root","","avijatry");
	//set bangla
	mysqli_query($con,"SET CHARACTER SET utf8");
	mysqli_query($con,"SET SESSION collation_connection='utf8_general_ci'") or die(mysqli_connect_error());
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	// echo "$query";
	$qry = mysqli_query($con, "$query");
	$array =[];



	$queryWord = explode(' ',trim($query));
	if ($queryWord[0] == 'select') 
	{
		while ($row = mysqli_fetch_array($qry))
		{
			$array[] = $row;
		}
	}

	if(count($array) == 1 )
	{
		$array = $array[0];
	}
	return $array;
}
function dbEach($query)
{   
	$con=mysqli_connect("localhost","root","","avijatry");
	//set bangla
	mysqli_query($con,"SET CHARACTER SET utf8");
	mysqli_query($con,"SET SESSION collation_connection='utf8_general_ci'") or die(mysqli_connect_error());
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	// echo "$query";
	$qry = mysqli_query($con, "$query");
	$array =[];



	$queryWord = explode(' ',trim($query));
	if ($queryWord[0] == 'select') 
	{
		while ($row = mysqli_fetch_array($qry))
		{
			$array[] = $row;
		}
	}
	return $array;
}
//function findDuplicate
// function ifExists($tableName, $fieldName, $fieldVal)
// {
// 	$row = db("select * from $tableName where $fieldName = '$fieldVal' limit 1");
// 	if(count($row)>0)
// 	{
// 		echo "exists";
// 		return true;
// 	}
// 	else
// 	{
// 		echo "not found";
// 		return false;
// 	}
// }


  function ifExists($pid)
  {
    $row = db("select * from inventory_check where pid = '$pid' limit 1");
    if($row!=[])
    {
      return true;
    }
    return false;
  }

  function getDescription($pid)
  {
  	$con=mysqli_connect("localhost","root","","avijatry");
	//set bangla
	mysqli_query($con,"SET CHARACTER SET utf8");
	mysqli_query($con,"SET SESSION collation_connection='utf8_general_ci'") or die(mysqli_connect_error());
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
  	//...............................
	$inventory_result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = '$pid' LIMIT 1");               
	$inventory = mysqli_fetch_array($inventory_result) ;

	//getting description
	$genre = '';
	if ($inventory['genre'] == 1) {
	$genre = 'জেন্টস' ;
	} else if ($inventory['genre'] == 2) {
	$genre = 'লেডিস';
	} else if ($inventory['genre'] == 3) {
	$genre = 'সু';
	} else if ($inventory['genre'] == 4) {
	$genre = 'বেবি';
	} else{}

	$type_result = mysqli_query($con,"SELECT * FROM inventory_config_types WHERE genre = '$inventory[genre]' AND serial_no = '$inventory[type]' LIMIT 1");                
	$type = mysqli_fetch_array($type_result) ;
	$type = $type['type'];

	$color_result = mysqli_query($con,"SELECT * FROM inventory_config_colors WHERE serial_no = '$inventory[color]' LIMIT 1");               
	$color = mysqli_fetch_array($color_result) ;
	$color = $color['color'];

	$description = "$genre $type $color";
	if ($description != " "){
		return $description;	
	} else{
		return 'পাওয়া যায়নি';
	}
  }
 ?>