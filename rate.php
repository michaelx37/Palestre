<?php
	session_start();
	
	$dbAddress = "127.0.0.1";
	$dbAdmin = "root";
	$dbPass = "mic2837mic2837";
	$dbSelect = "gymdb";

	$gymId = $loggedUserId = $gymRating = $gymComment = $currentDate = "";
	
	if (isset($_POST["vota"]) && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["userNickname"]) && $_SESSION["loggedIn"] === true) {
		
		$gymId = $_SESSION["currentGym"];
		$loggedUserId = $_SESSION["userId"];
		$gymRating = $_POST["ratingInput-1"];
		$gymComment = $_POST["comment"];
		$currentDate = date ("Y-m-d-H-i-s", time());
		
		$connect = new mysqli($dbAddress, $dbAdmin, $dbPass, $dbSelect) or die("Cannot connect to database");
		
		$checkQuery = mysqli_query($connect,"
			SELECT *
			FROM gym_reviews
			WHERE gym_id = '$gymId' AND user_id = '$loggedUserId' ");
			
		$reviewRows = mysqli_num_rows($checkQuery);
			if ($reviewRows == 0) {
				mysqli_query($connect,"
					INSERT INTO gym_reviews (gym_id, user_id, rating, comment, first_review)
					VALUES ('$gymId', '$loggedUserId', '$gymRating', '$gymComment', '$currentDate') ");
			} else {
				mysqli_query($connect,"
					UPDATE gym_reviews
					SET rating = '$gymRating', comment = '$gymComment', modified_review = '$currentDate'
					WHERE gym_id = '$gymId' AND user_id = '$loggedUserId' ");
			}
		
		mysqli_close($connect);
	}
	header ("location: gym-page.php?gym_id=$gymId");
	//  !!!TEST!!!
	echo "gym id:  ".$gymId;
	echo "<br />";
	echo "user id: ".$loggedUserId;
	echo "<br />";
	echo "rating: ".$gymRating;
	echo "<br />";
	echo "comment ".$gymComment;
	echo "<br />";
	echo "date ".$currentDate;
	echo "<br />";
	/*
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}	*/
		
?>