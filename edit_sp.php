<?php 
include "bikri_khata_edit_sp_start.php"; 
include "util.php"; ?> 
<?php 
if($_POST)
{
  $newSp = convertToEnglishNumber($_POST["newSp"]);
  $memo_no = $_GET["memo_no"];
  $sells = db("select * from sells where memo_no = '$memo_no' ");
  if($sells != [])
  {
    db("update sells set total_price = '$newSp' where memo_no='$memo_no'");
  }
  else
  {
   db("insert into sells (memo_no,total_price,sell_type) values ('$memo_no','$newSp','client')"); 
  }
}
 ?>

<form action="edit_sp.php<?php echo "?memo_no=$_GET[memo_no]" ?> " method="post">  
নতুন দাম:
<input type="text" name="newSp" required>
<input type="submit" value="যোগ">
</form>
<?php include "bikri_khata_end.php"; ?>