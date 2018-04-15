<?php
if (isset($_GET["submit"])) {
		$dbAddress = "127.0.0.1";
		$dbAdmin = "root";
		$dbPass = "mic2837mic2837";
		$dbSelect = "gymdb";
		
		$search = $_GET["search"];
		$location = $_GET["location"];
		
		
		
		
		
		
		
		
		
		



if ($search = "" AND $location = "") {
	$query = "";			// RICERCA GENERICA PER LE PALESTRE PIU' VOTATE ORDINATE PER VOTI LIMITATE AD UNA TOP 100
} elseif ($search != "" AND $location = ""){
	$query = " SELECT * FROM gym_list WHERE gym_name LIKE '%{$search}%' ORDER BY gym_id ASC ";
} elseif ($search = "" AND $location != ""){
	$query = " SELECT * FROM gym_list WHERE gym_location LIKE '%{$location}%' ORDER BY gym_id ASC ";
} elseif ($search != "" AND $location != ""){
	$query = " SELECT * FROM gym_list WHERE gym_name = '%{$search}%' AND gym_location = '%{$location}%' ORDER BY gym_id ASC ";
}






		$nameQuery = " SELECT * FROM gym_list WHERE gym_name LIKE '%{$search}%' ORDER BY gym_id ASC ";
		$positionQuery = " SELECT * FROM gym_list WHERE gym_location LIKE '%{$location}%' ORDER BY gym_id ASC ";
		//$dualQuery = " SELECT * FROM gym_list WHERE `gym_name`.`meta_value` = '%{$search}%' OR `gym_location`.`meta_value` = '%{$location}%' ORDER BY gym_id ASC ";
		$dualQuery = " SELECT * FROM gym_list WHERE gym_name = '%{$search}%' AND gym_location = '%{$location}%' ORDER BY gym_id ASC ";
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/* RICERCA PER PALESTRA */
		function nameSearch() {
			$connect = new mysqli ($dbAddress, $dbAdmin, $dbPass, $dbSelect) or die("Cannot connect to database");		
			$searchQuery = mysqli_query($connect, " SELECT * FROM gym_list WHERE gym_name LIKE '%{$search}%' ORDER BY gym_id ASC "); // WHERE gym_name = '$search'			
			$queryNumRows = mysqli_num_rows($searchQuery);
			//$queryNumColumns = mysqli_num_fields($searchQuery);			
			if ($queryNumRows != 0) {
				$storedGymId = "";
				$storedGymName = "";
				$storedGymOwner = "";
				$storedGymRating = "";
				$storedGymLocation = "";
				$storedGymInfos = "";			
				$multiRes = array();			
				while ($row = mysqli_fetch_assoc($searchQuery)) {
					/*$storedGymId = $row["gym_id"];
					$storedGymName = $row["gym_name"];
					$storedGymOwner = $row["gym_owner"];
					$storedGymRating = $row["gym_rating"];
					$storedGymLocation = $row["gym_location"];
					$storedGymInfos = $row["gym_infos"];*/
					$multiRes[] = $row;
				}
			}
		mysqli_close($connect);
		}
		
		/* RICERCA PER ZONA */
		function positionSearch() {
			$connect = new mysqli ($dbAddress, $dbAdmin, $dbPass, $dbSelect) or die("Cannot connect to database");		
			$searchQuery = mysqli_query($connect, " SELECT * FROM gym_list WHERE gym_location LIKE '%{$location}%' ORDER BY gym_id ASC ");			
			$queryNumRows = mysqli_num_rows($searchQuery);
			//$queryNumColumns = mysqli_num_fields($searchQuery);			
			if ($queryNumRows != 0) {
				$storedGymId = "";
				$storedGymName = "";
				$storedGymOwner = "";
				$storedGymRating = "";
				$storedGymLocation = "";
				$storedGymInfos = "";			
				$multiRes = array();			
				while ($row = mysqli_fetch_assoc($searchQuery)) {
					/*$storedGymId = $row["gym_id"];
					$storedGymName = $row["gym_name"];
					$storedGymOwner = $row["gym_owner"];
					$storedGymRating = $row["gym_rating"];
					$storedGymLocation = $row["gym_location"];
					$storedGymInfos = $row["gym_infos"];*/
					$multiRes[] = $row;
				}
			}
		mysqli_close($connect);
		}
		
		/* RICERCA PER PALESTRA E ZONA */
		function fullSearch() {
			$connect = new mysqli ($dbAddress, $dbAdmin, $dbPass, $dbSelect) or die("Cannot connect to database");		
			$searchQuery = mysqli_query($connect, " SELECT * FROM gym_list WHERE gym_name LIKE '%{$search}%' GROUP BY gym_name HAVING gym_location LIKE '%{$location}%' ORDER BY gym_id ASC ");			
			$queryNumRows = mysqli_num_rows($searchQuery);
			//$queryNumColumns = mysqli_num_fields($searchQuery);			
			if ($queryNumRows != 0) {
				$storedGymId = "";
				$storedGymName = "";
				$storedGymOwner = "";
				$storedGymRating = "";
				$storedGymLocation = "";
				$storedGymInfos = "";			
				$multiRes = array();			
				while ($row = mysqli_fetch_assoc($searchQuery)) {
					/*$storedGymId = $row["gym_id"];
					$storedGymName = $row["gym_name"];
					$storedGymOwner = $row["gym_owner"];
					$storedGymRating = $row["gym_rating"];
					$storedGymLocation = $row["gym_location"];
					$storedGymInfos = $row["gym_infos"];*/
					$multiRes[] = $row;
				}
			}
		mysqli_close($connect);
		}
}
?>