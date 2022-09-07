<?php
include("../includes/dbconnect_fpscript.php");
$ids = $_POST['ids'];
$arr = explode(',',$ids);
for($i=1;$i<=count($arr);$i++)
{
	$q = "UPDATE allokation.prio SET prio = ".$i." WHERE id = ".$arr[$i-1];
	mysqli_query($con,$q);
}
?>
