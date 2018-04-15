<?php	
	session_start();
	
	$dbAddress = "127.0.0.1";
	$dbAdmin = "root";
	$dbPass = "mic2837mic2837";
	$dbSelect = "gymdb";

	$loggedUserId = $loggedUserNickname = "";
		
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
		
		if (isset($_GET["rpp"])) {
			$resPPage = $_GET["rpp"];
		} else {
			$resPPage = 15; //   !!! RICONTROLLARE !!!
		}
		
		if (isset($_GET["pag"])) {
			$pageNum = $_GET["pag"];
		} else {
			$pageNum = 1;
		}
		
		
		$connect = new mysqli ($dbAddress, $dbAdmin, $dbPass, $dbSelect) or die("Cannot connect to database");
		
		// TIPO DI QUERY DA USARE IN BASE AI CAMPI INSERITI
		if ($search == "" && $location == "") {
			/*temp* $query = " SELECT gym_list.*, AVG(ratings.rating) AS rating FROM gym_list LEFT JOIN ratings ON gym_list.gym_id=ratings.gym_id GROUP BY gym_list.gym_id ";*/
			$query = " 
				SELECT gym_list.*, AVG(gym_reviews.rating) AS rating 
				FROM gym_list 
				LEFT JOIN gym_reviews ON gym_list.gym_id = gym_reviews.gym_id 
				GROUP BY gym_list.gym_id ";
			//DA MODIFICARE IN UNA RICERCA GENERICA TRAMITE VIEW PER LE PALESTRE PIU' VOTATE ORDINATE PER VOTI LIMITATE AD UNA TOP 100
		
		} elseif ($search != "" && $location == ""){
			//$query = " SELECT gym_list.*, AVG(ratings.rating) AS rating FROM gym_list LEFT JOIN ratings ON gym_list.gym_id=ratings.gym_id WHERE gym_list.gym_name LIKE '%{$search}%' GROUP BY gym_list.gym_id ";
			$query = "
				SELECT gym_list.*, AVG(gym_reviews.rating) AS rating 
				FROM gym_list 
				LEFT JOIN gym_reviews ON gym_list.gym_id = gym_reviews.gym_id 
				WHERE gym_list.gym_name LIKE '%{$search}%' 
				GROUP BY gym_list.gym_id ";
			
		} elseif ($search == "" && $location != ""){
			//$query = " SELECT gym_list.*, AVG(ratings.rating) AS rating FROM gym_list LEFT JOIN ratings ON gym_list.gym_id=ratings.gym_id WHERE gym_list.gym_location LIKE '%{$location}%' GROUP BY gym_list.gym_id ";
			$query = " 
				SELECT gym_list.*, AVG(gym_reviews.rating) AS rating 
				FROM gym_list 
				LEFT JOIN gym_reviews ON gym_list.gym_id = gym_reviews.gym_id 
				WHERE gym_list.gym_location LIKE '%{$location}%' 
				GROUP BY gym_list.gym_id ";
		
		} elseif ($search != "" && $location != ""){
			//$query = " SELECT gym_list.*, AVG(ratings.rating) AS rating FROM gym_list LEFT JOIN ratings ON gym_list.gym_id=ratings.gym_id WHERE gym_list.gym_name LIKE '%{$search}%' AND gym_list.gym_location LIKE '%{$location}%' GROUP BY gym_list.gym_id ";
			$query = " 
				SELECT gym_list.*, AVG(gym_reviews.rating) AS rating 
				FROM gym_list 
				LEFT JOIN gym_reviews ON gym_list.gym_id = gym_reviews.gym_id 
				WHERE gym_list.gym_name LIKE '%{$search}%' AND gym_list.gym_location LIKE '%{$location}%' 
				GROUP BY gym_list.gym_id ";
			
			//old   //mysqli_query($connect, " CREATE VIEW gym_list_view AS SELECT * FROM gym_list WHERE gym_name LIKE '%{$search}%' ");
			//old   //$query = " SELECT * FROM gym_list_view WHERE gym_location LIKE '%{$location}%' ORDER BY gym_id ASC ";
		}
		
		$searchQuery = mysqli_query($connect, $query);
		
		$queryNumRows = mysqli_num_rows($searchQuery);
		//$queryNumColumns = mysqli_num_fields($searchQuery);
		
		if ($queryNumRows != 0) {		
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>

	<div class="container col-12">

        <div id="headerAlt">
            <div class="leftHeaderAlt">
                <a href="index.php" class="headerBtn">LOGO / HOME</a>
            </div>            
            <div class="rightHeaderAlt">
            	<div class="accountAlt">
                    <span id="loginBtn" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:none";}else{echo "display:block";}?> ">Accedi</span>
                    <span id="regBtn" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:none";}else{echo "display:block";}?> ">Registrati</span>
                    <span class="userAvatar" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block;background-image:url(".$loggedUserAvatar.");";}else{echo "display:none";}?> "></span>
                    <a href="session.php" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block";}else{echo "display:none";}?> "><?php echo $welcome.$_SESSION["userNickname"]." &#9660;"; ?></a>
                    <a href="gymlogout.php" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block";}else{echo "display:none";}?> ">Esci</a>
				</div>
            </div>
        </div><!-- #headerAlt -->
        
        <div class="content">
        
            <div class="filterSearchContainer">
                <div class="filterSearch">
                    <form action="" method="get">
                    	<label>Nome</label>
                        <input type="text" name="search" autocomplete="off" placeholder="" value="<?php echo $search; ?>" class="filterInputs" />
                        
                    	<label>Zona</label>
                        <input type="text" name="location" autocomplete="off" placeholder="" value="<?php echo $location; ?>" class="filterInputs" />
                        
                    	<label>Mostra</label>
                        <select name="rpp">
                            <option value="10" <?php if($resPPage == 10){echo "selected";}else{echo "";}?> >10</option>
                            <option value="15" <?php if($resPPage == 15){echo "selected";}else{echo "";}?> >15</option>
                            <option value="25" <?php if($resPPage == 25){echo "selected";}else{echo "";}?> >25</option>
                            <option value="50" <?php if($resPPage == 50){echo "selected";}else{echo "";}?> >50</option>
                            <option value="100" <?php if($resPPage == 100){echo "selected";}else{echo "";}?> >100</option>
                            <option value="200" <?php if($resPPage == 200){echo "selected";}else{echo "";}?> >200</option>
						</select>
                        
                        <input type="submit" name="submit" value="Filtra" class="gobtn" />
                    </form>
                    <?php //   !!! POSSIBILE UTILIZO FUTURO !!!
					function getCurrentURL() {
						$currentURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
						$currentURL .= $_SERVER["SERVER_NAME"];
					 
						if($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443")
						{
							$currentURL .= ":".$_SERVER["SERVER_PORT"];
						} 
					 
							$currentURL .= $_SERVER["REQUEST_URI"];
						return $currentURL;
					}
					//echo "<br /><br /><p style='width:100%;color:black;'>".getCurrentURL()."</p>";
					?>
                </div><!-- .filterSearch -->
            </div><!-- .filterSearchContainer -->
            
            <div class="cardContainer">
				<?php					
					function maxPages() {
						
						global $resPPage;
						global $queryNumRows;
													
						$pagesRaw = round($queryNumRows/$resPPage,0,PHP_ROUND_HALF_UP);
						//echo $qnr."/10 = ".$qnr/$resPPage." arrotondato:  ".$pagesRaw."<br>";
						
						if ($pagesRaw == $queryNumRows/$resPPage) {
							$maxPages = $pagesRaw;
							//echo "max pages (=):  ".$maxPages."<br><br>";
						} elseif ($pagesRaw < $queryNumRows/$resPPage) {
							$maxPages = $pagesRaw+1;
							//echo "max pages (+1):  ".$maxPages."<br><br>";
						} else {
							$maxPages = $pagesRaw;
							//echo "max pages:  ".$maxPages."<br><br>";
						}
						return $maxPages;
					}
					
					function nextPage() {
						global $pageNum;
						$cp = $pageNum;
						if ($cp == maxPages()) {
							$nextPage = 1;
						} else {
							$nextPage = $cp + 1;
						}
						return $nextPage;
					}
					
					function prevPage() {
						global $pageNum;
						$cp = $pageNum;
						if ($cp == 1) {
							$prevPage = maxPages();
						} else {
							$prevPage = $cp - 1;
						}
						return $prevPage;
					}
					
					echo "<div class='pagContainer'>";
						//echo "<br /><p style='width:100%;color:black;'>".getCurrentURL()."</p>";
						//echo $queryNumRows . " risultati in " . maxPages() . " pagine<br><br>";
						echo "<div id='map'></div><!-- #map -->";
						echo "<div class='pagination'>";
							echo "<a href='".$_SERVER['PHP_SELF']."?pag=".prevPage()."&rpp=".$resPPage."&search=".$_GET["search"]."&location=".$_GET["location"]."&submit=".$_GET["submit"]."'>&laquo;</a>"; //htmlentities($_SERVER['PHP_SELF'])   echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8");
							for ($page = 1; $page <= maxPages(); $page++) {
								if ($pageNum == $page) {
									$activePage = "class='active'";
								} else {
									$activePage = "";
								}
								echo "<a href='".$_SERVER['PHP_SELF']."?pag=".$page."&rpp=".$resPPage."&search=".$_GET["search"]."&location=".$_GET["location"]."&submit=".$_GET["submit"]."' ".$activePage.">".$page."</a>"; //htmlentities($_SERVER['PHP_SELF'])   echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8");
							}
							echo "<a href='".$_SERVER['PHP_SELF']."?pag=".nextPage()."&rpp=".$resPPage."&search=".$_GET["search"]."&location=".$_GET["location"]."&submit=".$_GET["submit"]."'>&raquo;</a>"; //htmlentities($_SERVER['PHP_SELF'])   echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8");
						echo "</div>"; //   .pagination
					echo "</div>"; //   .pagContainer
						
					
					$startRow = ($pageNum - 1) * $resPPage;
					$stopRow = ($pageNum * $resPPage);
						
                    for ($resRow = $startRow; ($resRow < $stopRow) && ($resRow < $queryNumRows); $resRow++) {
                        echo "<a id='card' href='gym-page.php?gym_id=".$multiRes[$resRow]["gym_id"]."'>";
                            echo "<div class='cardImage' style='background-image:url(".$multiRes[$resRow]["gym_icon"].");'>";
                            echo "</div>";//  .cardImage
                            echo "<div class='cardDetails'>";
                                echo "<div class='cardHeader'>";
                                    echo "<h3>".$multiRes[$resRow]["gym_name"]." [Id: ".$multiRes[$resRow]["gym_id"]."]</h3>";
                                echo "</div>";//  .cardHeader
                                echo "<div class='cardInfo'>";
                                    echo "<span>Zona: ".$multiRes[$resRow]["gym_location"]."</span><br /><br /><span>Voto: ". round($multiRes[$resRow]["rating"] * 2) / 2 ."</span>";
                                echo "</div>";	//  .cardInfo					
                            echo "</div>";//  .cardDetails
                        echo "</a>";//  #card
                    }
					
					echo "<div class='pagContainer' style='margin-bottom:150px;'>";
						echo "<div class='pagination'>";
							echo "<a href='".$_SERVER['PHP_SELF']."?pag=".prevPage()."&rpp=".$resPPage."&search=".$search."&location=".$location."&submit=".$_GET["submit"]."'>&laquo;</a>"; //htmlentities($_SERVER['PHP_SELF'])   echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8");
							for ($page = 1; $page <= maxPages(); $page++) {
								if ($pageNum == $page) {
									$activePage = "class='active'";
								} else {
									$activePage = "";
								}
								echo "<a href='".$_SERVER['PHP_SELF']."?pag=".$page."&rpp=".$resPPage."&search=".$search."&location=".$location."&submit=".$_GET["submit"]."' ".$activePage.">".$page."</a>"; //htmlentities($_SERVER['PHP_SELF'])   echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8");
							}
							echo "<a href='".$_SERVER['PHP_SELF']."?pag=".nextPage()."&rpp=".$resPPage."&search=".$search."&location=".$location."&submit=".$_GET["submit"]."'>&raquo;</a>"; //htmlentities($_SERVER['PHP_SELF'])   echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8");
						echo "</div>"; //   .pagination
					echo "</div>"; //   .pagContainer
				?>
                <script>
					function initMap() {
						// Create a map object and specify the DOM element for display.
						var avrlat = (43.885040 + 43.863345)/2;
						var avrlng = (12.867853 + 12.839200)/2;
						var map = new google.maps.Map(document.getElementById('map'), {
							//center: {lat: 43.884302, lng: 12.868188},
							center: {lat: avrlat, lng: avrlng},
							zoom: 13
						});
						
						var marker = new google.maps.Marker({
							position: {lat: 45.080105, lng: 11.804517},
							map: map	
						});//rovigo
						var marker = new google.maps.Marker({
							position: {lat: 46.003220, lng: 8.951873},
							map: map	
						});//lugano
						var marker = new google.maps.Marker({
							position: {lat: 43.885040, lng: 12.867853},
							map: map	
						});//villa fastiggi
						var marker = new google.maps.Marker({
							position: {lat: 43.863345, lng: 12.839200},
							map: map	
						});//villa ceccolini
				  	}
				</script>
				<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI0EPgbHOAOBV0eXKelBYzU1hMDDwsYk4&callback=initMap" async defer></script>
                <?php
				/*
                    echo "<h4 style='text-align:center;'>onclick version</h4>";
                    
                    for ($resRow = 0; $resRow < $queryNumRows; $resRow++) {
                        echo "<div id='card' onclick=\"location.href='gym-page.php?gym_id=".$multiRes[$resRow]["gym_id"]."'\">"; // !!! IMPORTANTE !!!
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
					
					/*
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
    

  
    <!-- MODALS -->
    
    <div id="loginModal" class="loginModal">
        <!-- Modal content -->
        <div class="loginModalContent">
            <span class="close">&times;</span>
            <p>
                <form action="/gymlogin.php" method="post" class="logForm">
                    <div class="formContainer">
                        <label><b>Username:</b></label>
                        <input type="text" name="username" autocomplete="on" placeholder="" class="logInput" />
                        
                        <label><b>Password:</b></label>
                        <input type="password" name="password" autocomplete="off" placeholder="" class="logInput" />
                        
                        <input type="submit" value="Login" class="logBtn" />
                    </div>
                </form>
            </p>
        </div>
    </div><!-- #loginModal -->
    
    <div id="regModal" class="regModal">
        <div class="regModalcontent">
            <span class="close">&times;</span>
            <p>
                <form action="/registration.php" method="post" id="regForm">
                    <div class="formContainer">
                        <label><b>Username:</b></label>
                        <input type="text" name="regUsername" autocomplete="on" value="" class="regInput" id="regUsername" />
                        <label><span class="error"><?php /*if (isset($_GET['nickErr'])) echo $_GET['nickErr'];*/ ?></span></label>
                        <br /><br />
                        <label><b>Password:</b></label>
                        <input type="password" name="regPassword" autocomplete="off" placeholder="" class="regInput" id="regPassword" />
                        <label><span class="error"><?php if (isset($_GET['pswErr'])) echo $_GET['pswErr']; ?></span></label>
                        <br /><br />
                        <label><b>Verifica password:</b></label>
                        <input type="password" name="regPasswordCheck" autocomplete="off" placeholder="" class="regInput" id="regPasswordCheck" />
                        <label><span class="error"><?php if (isset($_GET['pswCheckErr'])) echo $_GET['pswCheckErr']; ?></span></label>
                        <br /><br />
                        <label><b>Email:</b></label>
                        <input type="text" name="regEmail" autocomplete="on" value="" class="regInput" id="regEmail" />
                        <label><span class="error"><?php if (isset($_GET['emailErr'])) echo $_GET['emailErr']; ?></span></label>
                        <br /><br />
                        <label><b>Nome:</b></label>
                        <input type="text" name="regFirstName" autocomplete="on" value="" class="regInput" id="regFirstName" />
                        <label><span class="error"><?php if (isset($_GET['firstNameErr'])) echo $_GET['firstNameErr']; ?></span></label>
                        <br /><br />
                        <label><b>Cognome:</b></label>
                        <input type="text" name="regLastName" autocomplete="on" value="" class="regInput" id="regLastName" />
                        <label><span class="error"><?php if (isset($_GET['lastNameErr'])) echo $_GET['lastNameErr']; ?></span></label>
                        <br /><br />
                        <label><b>Data di nascita:</b></label>
                        <input type="text" name="regBirth" autocomplete="on" placeholder="" class="regInput" id="regBirth" />
                        <span>
                            <input type="text" name="regBirthDay" autocomplete="off" placeholder="GG" class="regInput" id="" />
                            <input type="" name="regBirthMonth" autocomplete="off" placeholder="MM" class="regInput" id="" />
                            <input type="text" name="regBirthYear" autocomplete="off" placeholder="HHHH" class="regInput" id="" /></span>
                        <label><span class="error"><?php if (isset($_GET['birthErr'])) echo $_GET['birthErr']; ?></span></label>
                        <br /><br />
                        <div class="genderInput">
                        <label><b>Sesso:</b></label>
                        <input class="genInput" type="radio" name="regGender" value="" checked="checked" style="display:none;" />
                        <input class="genInput" type="radio" name="regGender" <?php //if (isset($gender) && $gender=="male") echo "checked";?> value="maschio" />Maschio
                        <input class="genInput" type="radio" name="regGender" <?php //if (isset($gender) && $gender=="female") echo "checked";?> value="femmina" />Femmina
                        <label><span class="error"><?php //if (isset($_GET['genderErr'])) echo $_GET['genderErr']; ?></span></label>
                        </div>
                        <br /><br />
                        <input type="submit" value="Registrati" class="regBtn" />
                    </div>
                </form>
            </p>
            <p class="formFeedback" style="font-weight:bold; display:block; width:100%; text-align:center;">
            </p>
        </div>
    </div><!-- #regModal -->
    
</body>

</html>