<?php 
include_once 'dbconnect.php';
if(isset($_GET['source']))
{
	$val=$_GET['source'];

	$query="SELECT DISTINCT `source` FROM `route` WHERE source LIKE '%$val%' LIMIT 5";

	$ans="";

	$result = $conn->query($query);
       
	if( $result->num_rows>0) {
		while($row=$result->fetch_assoc())
		{
			$t=$row['source'];
		//echo $t;
			$ans=$ans. "<li><a href='#'>$t<br /></a></li>";
		}
	}
	echo $ans;
}
else
{
	$val=$_GET['dest'];

	$query="SELECT DISTINCT `destination` FROM `route` WHERE destination LIKE '%$val%' LIMIT 5";

	$ans="";

	$result = $conn->query($query);
       
	if( $result->num_rows>0) {
		while($row=$result->fetch_assoc())
		{
			$t=$row['destination'];
		//echo $t;
			$ans=$ans. "<li><a href='#'>$t<br /></a></li>";
		}
	}
	echo $ans;
}
                

?>