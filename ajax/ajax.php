<?php 
	
include '../includes/config_inc.php';

	if(isset($_POST["name"]) && isset($_POST["value"]) && isset($_POST["pk"]) && strlen($_POST["value"]) > 2) { 
	 
	$mysqli->query("UPDATE usr_roles set ".$mysqli->real_escape_string($_POST['name'])."='".$mysqli->real_escape_string($_POST['value'])."' where rol_id='".$mysqli->real_escape_string($_POST["pk"])."'"); 
	if($mysqli->affected_rows > 0){ 
	echo "<div class='alert alert-success'>Successfully Perform Operation</div>"; 
	} else {
	 echo "<div class='alert alert-danger'>Failed to Perform Operation ".$mysqli->error."</div>"; 
	} 
	} else
	if(isset($_POST["rol_id"]) && isset($_POST["rol_name"])) { 
	 
	$checkToInsert = $mysqli->query("SELECT rol_id from usr_roles where rol_id='".$mysqli->real_escape_string($_POST["rol_id"])."' || rol_name='".$mysqli->real_escape_string($_POST["rol_name"])."'");
	if($checkToInsert->num_rows < 1 ) {  
	$mysqli->query("INSERT into usr_roles set rol_id='".$mysqli->real_escape_string($_POST["rol_id"])."', rol_name='".$mysqli->real_escape_string($_POST["rol_name"])."'"); 
	if($mysqli->affected_rows > 0){ 
	echo "<div class='alert alert-success'>Successfully Perform Operation</div>"; 
	} else {
	 echo "<div class='alert alert-danger'>Failed to Perform Operation ".$mysqli->error."</div>"; 
	} 
	 } else { 
	 echo "<div class='alert alert-danger'>Oh! Snap Value is already available</div>"; 
	} 
	} else
	if(isset($_POST["pk"]) && isset($_POST["delete"]) && $_POST["delete"] == "true") {
	 
	$mysqli->query("DELETE from usr_roles where rol_id='".$mysqli->real_escape_string($_POST["pk"])."'"); 
	if($mysqli->affected_rows > 0){ 
	echo "<div class='alert alert-success'>Successfully Perform Operation</div>"; 
	} else {
	 echo "<div class='alert alert-danger'>Failed to Perform Operation ".$mysqli->error."</div>"; 
	} 
	}  else { 
	 echo "<div class='alert alert-danger'>Kindly fill all the form properly</div>"; 
	} ?>
