<?php
	session_start();
	$_SESSION['id'] = $_GET["id"];
	$conn = new Mongo();
	$db = $conn->soneta;
	$personas = $db->personas;
	
	$user = $personas->findOne(array('id' =>  $_SESSION['id']));
	if ($user == null){
		$insert_bool = $persona->insert(array ('id' => $_GET["id"], 'name' => $_GET["name"], 'fb_token' => $_GET['fb_token']));
		if ($insert_bool == true){
			//echo "Inserted new user to mongoDB<br/>";
		}
	}
	//var_dump ($user);
	
	header('Location: http://localhost/soneta/index.php');
	
?>