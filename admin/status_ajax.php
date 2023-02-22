<?php
	include '../database/db_connection.php';
	$id=$_POST['id'];
    $status=$_POST['status'];

	if($_POST['table']=="sliders"){
		$sql = "UPDATE sliders SET status='$status' WHERE id=$id";
	}	elseif($_POST['table']=='services'){
		$sql = "UPDATE services SET status='$status' WHERE id=$id";
	} elseif($_POST['table']=='client_details'){
		$sql = "UPDATE client_details SET status='$status' WHERE id=$id";
	} elseif($_POST['table']=='manufacturers'){
		$sql = "UPDATE manufacturers SET status='$status' WHERE id=$id";
	}elseif($_POST['table']=='car_models'){
		$sql = "UPDATE car_models SET status='$status' WHERE id=$id";
	}elseif($_POST['table']=='fuel_types'){
		$sql = "UPDATE fuel_types SET status='$status' WHERE id=$id";
	}elseif($_POST['table']=='contact_us'){
		$sql = "UPDATE contact_us SET status='$status' WHERE id=$id";
	}elseif($_POST['table']=='feedbacks'){
		$sql = "UPDATE feedbacks SET status='$status' WHERE id=$id";
	}

	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("response"=>$status));
	} 
	mysqli_close($conn);
?>