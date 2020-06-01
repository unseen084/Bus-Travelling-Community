<?php
	session_start();
	include_once 'dbconnect.php';
	$busID=$_GET['id'];
	$date=$_GET['date'];

	$q="SELECT * FROM (SELECT ticket.ticket_id FROM isbooked_for,ticket WHERE isbooked_for.busID=$busID AND isbooked_for.ticketID=ticket.ticket_id AND ticket.travel_date='$date') AS tmp NATURAL JOIN seats_of_ticket";
	$result=$conn->query($q);
	$ans= array();
	while($row=$result->fetch_assoc())
	{
		array_push($ans,$row['seat_no']);
		
	}

	//$myArr = array($_GET['id'],$_GET['date']);
	//$myArr = array("mara","gelam");

$myJSON = json_encode($ans);
unset($ans);
echo $myJSON;

?>