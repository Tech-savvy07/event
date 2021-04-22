<?php
	session_start();
	$con = mysqli_connect('localhost','root','','calendar');

	if(!$con)
	{
		echo 'Not Connected to server';
	}
	if(!mysqli_select_db($con,'calendar'))
	{
		echo 'Database Not Selected';
	}
	date_default_timezone_set("Asia/Kolkata");
	$time=date("h:i:sa");
	$date=date("d-m-y");
?>
