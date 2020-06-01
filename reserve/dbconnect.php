<?php
	
	$serverName="localhost";
	$userName="root";
	$password="";
	$dbName="btc_system";
	
	$conn= new mysqli($serverName,$userName,$password,$dbName);
	if($conn->connect_error)
	{
			die("connection failed".$conn->connect_error);
	}
