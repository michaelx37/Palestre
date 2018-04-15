<?php
	session_start();
	
	$dbAddress = "127.0.0.1";
	$dbAdmin = "root";
	$dbPass = "mic2837mic2837";
	$dbSelect = "gymdb";
	
	if (isset($_SESSION["userNickname"]) && $_SESSION["loggedIn"] === true) {
		$loggedUserId = $_SESSION["userId"];
		$loggedUserNickname = $_SESSION["userNickname"];
		
		$connect = new mysqli($dbAddress, $dbAdmin, $dbPass, $dbSelect) or die("Cannot connect to database");
		
		$queryLastLogTemp = mysqli_query($connect, " SELECT user_last_login_temp FROM user_list WHERE user_id = '$loggedUserId' ");
		
		$lastLogTemp = mysqli_fetch_assoc($queryLastLogTemp);
		
		$newLastLog = $lastLogTemp["user_last_login_temp"];
		
		mysqli_query($connect, " UPDATE user_list SET user_last_login = '$newLastLog' WHERE user_id = '$loggedUserId' ");
		
		mysqli_close($connect);
		
		
		session_unset(); // remove all session variables
		
		session_destroy(); // destroy the session
		
		header ("location: index.php");
	}
?>