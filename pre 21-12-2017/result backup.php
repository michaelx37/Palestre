<?php	
	session_start();
	
	$dbAddress = "127.0.0.1";
	$dbAdmin = "root";
	$dbPass = "mic2837mic2837";
	$dbSelect = "gymdb";

	$loggedUserId = $loggedUserNickname = null;
	
	if (isset($_SESSION["userNickname"]) && $_SESSION["loggedIn"] === true) {
		$loggedUserId = $_SESSION["userId"];
		$loggedUserNickname = $_SESSION["userNickname"];
		$loggedUserAvatar = $_SESSION["userAvatar"];
		if ($_SESSION["userGender"] === "maschio") {
			$welcome = "Benvenuto ";
		} else {
			$welcome = "Benvenuta ";
		}
	}
		
	if (isset($_GET["submit"])) {
		
		$search = $_GET["search"];
		$location = $_GET["location"];
		
		$connect = new mysqli ($dbAddress, $dbAdmin, $dbPass, $dbSelect) or die("Cannot connect to database");
		
		if ($search == "" && $location == "") {
			/*temp*/$query = " SELECT gym_list.*, AVG(ratings.rating) AS rating FROM gym_list LEFT JOIN ratings ON gym_list.gym_id=ratings.gym_id GROUP BY gym_list.gym_id ";// RICERCA GENERICA TRAMITE VIEW PER LE PALESTRE PIU' VOTATE ORDINATE PER VOTI LIMITATE AD UNA TOP 100
		} elseif ($search != "" && $location == ""){
			/*$query = " SELECT * FROM gym_list WHERE gym_name LIKE '%{$search}%' ORDER BY gym_id ASC ";*/
			$query = " SELECT gym_list.*, AVG(ratings.rating) AS rating FROM gym_list LEFT JOIN ratings ON gym_list.gym_id=ratings.gym_id WHERE gym_list.gym_name LIKE '%{$search}%' GROUP BY gym_list.gym_id ";
		} elseif ($search == "" && $location != ""){
			/*$query = " SELECT * FROM gym_list WHERE gym_location LIKE '%{$location}%' ORDER BY gym_id ASC ";*/
			$query = " SELECT gym_list.*, AVG(ratings.rating) AS rating FROM gym_list LEFT JOIN ratings ON gym_list.gym_id=ratings.gym_id WHERE gym_list.gym_location LIKE '%{$location}%' GROUP BY gym_list.gym_id ";
		} elseif ($search != "" && $location != ""){
			/*$query = " SELECT * FROM gym_list WHERE gym_name LIKE '%{$search}%' AND gym_location LIKE '%{$location}%' ORDER BY gym_id ASC ";*/
			$query = " SELECT gym_list.*, AVG(ratings.rating) AS rating FROM gym_list LEFT JOIN ratings ON gym_list.gym_id=ratings.gym_id WHERE gym_list.gym_name LIKE '%{$search}%' AND gym_list.gym_location LIKE '%{$location}%' GROUP BY gym_list.gym_id ";
			
			//old//mysqli_query($connect, " CREATE VIEW gym_list_view AS SELECT * FROM gym_list WHERE gym_name LIKE '%{$search}%' ");
			//old//$query = " SELECT * FROM gym_list_view WHERE gym_location LIKE '%{$location}%' ORDER BY gym_id ASC ";
		}
		
		$searchQuery = mysqli_query($connect, $query);
		
		$queryNumRows = mysqli_num_rows($searchQuery);
		$queryNumColumns = mysqli_num_fields($searchQuery);
		
		if ($queryNumRows != 0) {
			/*$storedGymId = "";
			$storedGymName = "";
			$storedGymOwner = "";
			$storedGymRating = "";
			$storedGymLocation = "";
			$storedGymInfos = "";*/			
			$multiRes = array();			
			while ($row = mysqli_fetch_assoc($searchQuery)) {
				$multiRes[] = $row;
			}
		}
		mysqli_close($connect);
	}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Ricerca Goderelli</title>
	<link rel="icon" type="image/gif" href="/sub/Honeycomb-Intenet-64.png">
	<link type="text/css" rel="stylesheet" href="/sub/result.css">
	<meta charset="UTF-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <script src="/sub/result.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-2.0.0.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <style>
	</style>
</head>


<body>

	<div class="container col-12">

        <div id="headerAlt">
            <div class="leftHeaderAlt">
                <a href="index.php" class="headerBtn">LOGO / HOME / INDEX</a>
            </div>            
            <div class="rightHeaderAlt">
            	<div class="accountAlt">
                    <span id="loginBtn" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:none";}else{echo "display:block";}?> ">Accedi</span>
                    <span id="regBtn" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:none";}else{echo "display:block";}?> ">Registrati</span>
                    <span class="userAvatar" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block;background-image:url(".$loggedUserAvatar.");";}else{echo "display:none";}?> "></span>
                    <span class="userAvatarAlt" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block;background-image:url("."/sub/Avatars/usertile10.bmp".");";}else{echo "display:none";}?> "></span>
                    <span class="userAvatarAlt" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block;background-image:url("."/sub/Avatars/usertile19.bmp".");";}else{echo "display:none";}?> "></span>
                    <span class="userAvatarAlt" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block;background-image:url("."/sub/Avatars/usertile20.bmp".");";}else{echo "display:none";}?> "></span>
                    <a href="session.php" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block";}else{echo "display:none";}?> "><?php echo $welcome.$_SESSION["userNickname"]." &#9660;"; ?></a>
                    <a href="gymlogout.php" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block";}else{echo "display:none";}?> ">Esci</a>
				</div>
            </div>
        </div><!-- #headerAlt -->
        
        <div class="content">
            <div class="cardContainer">
                <?php
				/*
                    echo "<h4 style='text-align:center;'>onclick version</h4>";
                    
                    for ($resRow = 0; $resRow < $queryNumRows; $resRow++) {
                        echo "<div id='card' onclick=\"location.href='gym-page.php?gym_id=".$multiRes[$resRow]["gym_id"]."'\">";
                            echo "<div class='cardImage' style='background-image:url(".$multiRes[$resRow]["gym_icon"].");'>";
                            echo "</div>";//  .cardImage
                            echo "<div class='cardDetails'>";  //".$multiRes[$resRow]["gym_id"]."
                                echo "<div class='cardHeader'>";
                                    echo "<h3>".$multiRes[$resRow]["gym_name"]."  [Id: ".$multiRes[$resRow]["gym_id"]."]</h3>";
                                echo "</div>";//  .cardHeader
                                echo "<div class='cardInfo'>";
                                    echo "<span>Località: ".$multiRes[$resRow]["gym_location"]."</span><br /><br /><span>Voto: ". round($multiRes[$resRow]["rating"] * 2) / 2 ."</span>";
                                echo "</div>";	//  .cardInfo					
                            echo "</div>";//  .cardDetails
                        echo "</div>";//  #card
                    }*/
                    
                    echo "<h4 style='text-align:center;'>href version</h4>";
                    
                    for ($resRow = 0; $resRow < $queryNumRows; $resRow++) {
                        echo "<a id='card' href='gym-page.php?gym_id=".$multiRes[$resRow]["gym_id"]."'>";
                            echo "<div class='cardImage' style='background-image:url(".$multiRes[$resRow]["gym_icon"].");'>";
                            echo "</div>";//  .cardImage
                            echo "<div class='cardDetails'>";  //".$multiRes[$resRow]["gym_id"]."
                                echo "<div class='cardHeader'>";
                                    echo "<h3>".$multiRes[$resRow]["gym_name"]."  [Id: ".$multiRes[$resRow]["gym_id"]."]</h3>";
                                echo "</div>";//  .cardHeader
                                echo "<div class='cardInfo'>";
                                    echo "<span>Località: ".$multiRes[$resRow]["gym_location"]."</span><br /><br /><span>Voto: ". round($multiRes[$resRow]["rating"] * 2) / 2 ."</span>";
                                echo "</div>";	//  .cardInfo					
                            echo "</div>";//  .cardDetails
                        echo "</a>";//  #card
                    }
                    
                    /*
                    for ($resRow = 0; $resRow < $queryNumRows; $resRow++) {
                      echo "<p><b>Riga numero $resRow</b></p>";
                      echo "<ul>";
                      if($multiRes[$resRow]['rating']==0){$finalRating="Nessuna recensione";}else{$finalRating=round($multiRes[$resRow]['rating'], 1, PHP_ROUND_HALF_EVEN)." / 5";}
                      echo "id: ".$multiRes[$resRow]['gym_id']." "."<h3>".$multiRes[$resRow]['gym_name']."</h3>"." "."<h4>".$finalRating/*round( $multiRes[$resRow]['rating'], 1, PHP_ROUND_HALF_EVEN)." / 5"*//*."</h4>"." ".$multiRes[$resRow]['gym_owner']." ".$multiRes[$resRow]['gym_location']." ".$multiRes[$resRow]['gym_description']." "."<br />";
                      /*for ($resCol = 0; $resCol <= $queryNumColumns; $resCol++) {
                        echo "<li>".$multiRes[$resRow][$resCol]."</li>";
                      }*//*
                      echo "<form action='/rate-comments.php' method='post'>
                            <input type='hidden' name='idGym' value=".$multiRes[$resRow]['gym_id']." class='rateInput'>
                            <input type='hidden' name='idUser' value=".$loggedUserId." class='rateInput'>
                            <label><b>Valutazione [0.5-5]:</b></label>
                            <input type='text' name='ratingGym' autocomplete='off' class='rateInput'>
                            <label><b>Commento:</b></label>
                            <input type='text' name='commentGym' autocomplete='off' class='rateInput'>
                            <input type='submit' name='rateSubmit' value='Lascia feedback' class='rateBtn'>
                            </form>";
                      echo "</ul>";
                    }*/
                ?>
                
                <!--
                <div class='card'>
                    <div class='cardImage'></div>
                    <div class='cardDetails'>
                        <div class='cardTitle'></div>
                        <div class='cardInfos'></div>
                    </div>
                </div><!-- .card -->
    
                
            </div> <!-- .cardContainer -->
        </div> <!-- .content -->
    </div> <!-- .container col-12 -->
    
    
    
</body>

</html>