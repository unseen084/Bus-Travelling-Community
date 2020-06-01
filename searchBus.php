<?php 
include_once 'dbconnect.php';
if(isset($_GET['name']) && isset($_GET['source'])&& isset($_GET['destination']))
{
	$val=$_GET['name'];
	$source=$_GET['source'];
	$destination=$_GET['destination'];

	$q="SELECT route_id FROM `route` WHERE source='$source' AND destination='$destination'";
	$result=$conn->query($q);
	if($result->num_rows==0)
	{
		echo " ";
		exit(0);
	}
	$row=$result->fetch_assoc();
	$routeID=$row['route_id'];

	//$query="SELECT DISTINCT `bus_name` FROM `bus` WHERE bus_name LIKE '%$val%' LIMIT 5";
	$query="SELECT DISTINCT `bus_name` FROM bus NATURAL JOIN travels_through WHERE travels_through.route_id=$routeID AND bus.bus_name LIKE '%$val%' LIMIT 5";

	$ans="";

	$result = $conn->query($query);
       
	if( $result->num_rows>0) {
		while($row=$result->fetch_assoc())
		{
			$t=$row['bus_name'];
		//echo $t;
			$ans=$ans. "<li><a href='#'>$t<br /></a></li>";
		}
	}
	echo $ans;
}

                

?>