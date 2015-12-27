<?php    
	require "conn.php";   
    $result = mysqli_query($con,"SELECT * FROM factories");
    while($row = mysqli_fetch_array($result)){
      echo "<option value=\"".$row['factory_name']."\">".$row['factory_name']."</option>";
      }     
                         