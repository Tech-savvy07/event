<?php
require('database.inc.php');
require('functions.inc.php');
	// prx($_POST);
	$event_name = get_safe_value($con, $_POST['event_name']);
	$event_date = get_safe_value($con, $_POST['event_date']);
	$event_time = get_safe_value($con, $_POST['event_time']);
	$sql = "insert into event (event_name,event_date,event_time) values('$event_name','$event_date','$event_time')";
	// echo $sql;
	// die();
	if (!mysqli_query($con, $sql)) {
		$arr=array('title'=>'Ahh','message'=>'Check your Internet Connection','status'=>'error');
		echo json_encode($arr);
		die();
	} else {
		$arr=array('title'=>'Thank You','message'=>'Event Added Successfully!','status'=>'success');
		echo json_encode($arr);
		die();
	}
?>