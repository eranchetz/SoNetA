<?php
	session_start();
	$_SESSION['id'] = $_GET["id"];
	$conn = new Mongo();
	$db = $conn->soneta;
	$personas = $db->personas;
	
	$user = $personas->findOne(array('id' =>  $_SESSION['id']));
	if ($user != null){
		$update_twt = update(array("id" => $_GET['id']), array('twt_oauth_token' => $_GET["oauth_token"], 						'twt_oauth_token_secret' => $_GET['oauth_token_secret'])), array("upsert" => true));
		if ($update_twt == true){
			//echo "Inserted new user to mongoDB<br/>";
		}
	}
	//var_dump ($user);
	
	header('Location: http://localhost/soneta/index.php');
	
?>