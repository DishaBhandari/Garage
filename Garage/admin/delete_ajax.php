<?php
	include '../database/db_connection.php';
	$id=$_POST['id'];

	if($_POST['table']=="sliders"){
		$sql = "UPDATE sliders SET deleted_at= NOW() WHERE id=$id";
	}	elseif($_POST['table']=='services'){
		$sql = "UPDATE services SET deleted_at= NOW() WHERE id=$id";
	} elseif($_POST['table']=='client_details'){
		$sql = "UPDATE client_details SET deleted_at= NOW() WHERE id=$id";
	} elseif($_POST['table']=='work_details'){
		$sql = "UPDATE work_details SET deleted_at= NOW() WHERE id=$id";
	}elseif($_POST['table']=='manufacturers'){
		$sql = "UPDATE manufacturers SET deleted_at= NOW() WHERE id=$id";
	}elseif($_POST['table']=='car_models'){
		$sql = "UPDATE car_models SET deleted_at= NOW() WHERE id=$id";
	}elseif($_POST['table']=='fuel_types'){
		$sql = "UPDATE fuel_types SET deleted_at= NOW() WHERE id=$id";
	}

	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("response"=>'DONE'));
	} 
	mysqli_close($conn);
?>