<?php
	$dbAddress = "127.0.0.1";
	$dbAdmin = "root";
	$dbPass = "mic2837mic2837";
	$dbSelect = "gymdb";

	$gymId = $userId = $comment = $rating = "";
	$gymIdErr = $userIdErr = $commentErr = $ratingErr = $noInput = "";
	/*
	if (isset($_SESSION["userNickname"]) && $_SESSION["loggedIn"] === true) {
		$loggedUserId = $_SESSION["userId"];
		$loggedUserNickname = $_SESSION["userNickname"];
	}*/

	if (isset($_POST["sendRC"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
		/*
		if (empty($_POST["idGym"])) {
			$gymIdErr = "Campo obbligatorio";
		} else {
			$gymId = test_input($_POST["idGym"]);
			if (!preg_match("/^[0-9]*$/",$gymId)) {
				$gymIdErr = "Sono consentiti solo numeri";
			}
		}
	
		if (empty($_POST["idUser"])) {
			$userIdErr = "Campo obbligatorio";
		} else {
			$userId = test_input($_POST["idUser"]);
			if (!preg_match("/^[0-9]*$/",$userId)) {
				$userIdErr = "Sono consentiti solo numeri";
			}
		}*/
	
		if (empty($_POST["commentGym"])) {
			$commentErr = "qualcosa";
		} else {
			$comment = test_input($_POST["commentGym"]);
			if (!preg_match("/^[a-zA-Z0-9 ]*$/",$comment)) {
				$commentErr = "Sono consentite solo lettere, numeri e spazi";
			}
		}
	
		if (empty($_POST["ratingGym"])) {
			$ratingErr = "qualcosa";
		} else {
			$rating = test_input($_POST["ratingGym"]);
			if (!preg_match("/^[0-5]*$/",$rating)) {
				$ratingErr = "Sono consentiti solo numeri";
			}
		}
		
		
		
		if ($rating != 0 && $comment != "") {
			$connect = new mysqli($dbAddress, $dbAdmin, $dbPass, $dbSelect) or die("Cannot connect to database");
			
			$ratingQuery = mysqli_query($connect," SELECT * FROM ratings WHERE user_id = '$userId' AND gym_id = '$gymId' ");	
			$ratingRows = mysqli_num_rows($ratingQuery);
			if ($ratingRows == 0) {
				mysqli_query($connect, " INSERT INTO ratings (gym_id, user_id, rating) VALUES ('$gymId', '$userId', '$rating') ");
			} else {
				mysqli_query($connect, " UPDATE ratings SET rating = '$rating' WHERE user_id = '$userId' AND gym_id = '$gymId' ");
			}
			
			
			$commentQuery = mysqli_query($connect," SELECT * FROM comments WHERE user_id = '$userId' AND gym_id = 'gymId' ");
			$commentRows = mysqli_num_rows($commentQuery);
			if ($commentRows == 0) {
				mysqli_query($connect, " INSERT INTO comments (gym_id, user_id, comment) VALUES ('$gymId', '$userId', '$comment') ");
			} else {
				mysqli_query($connect, " UPDATE comments SET comment = '$comment' WHERE user_id = '$userId' AND gym_id = '$gymId' ");
			}
			
			mysqli_close($connect);
		} else {
			$noInput = "Nessun dato inserito";
		}
		
		//   !!!TEST!!!
		echo "gym error  ".$gymIdErr;
		echo "<br />";
		echo "user error  ".$userIdErr;
		echo "<br />";
		echo "rating error  ".$ratingErr;
		echo "<br />";
		echo "comment error  ".$commentErr;
		echo "<br />";
		echo "no input  ".$noInput;
		echo "<br />";
	}
	
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}	
		
?>