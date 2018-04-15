<?php
	session_start();
	
	$dbAddress = "127.0.0.1";
	$dbAdmin = "root";
	$dbPass = "mic2837mic2837";
	$dbSelect = "gymdb";
	
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
	
	if ($_SERVER["REQUEST_METHOD"] == "GET") {//   INSERIRE MESSAGGIO DI ERRORE IN CASO DI ID SBAGLIATO O REINDIRIZZARE ALLA PAG PRECEDENTE
		$gymId = $_GET["gym_id"];
		$_SESSION["currentGym"] = $_GET["gym_id"];// TEMP
		
		$connect = new mysqli($dbAddress, $dbAdmin, $dbPass, $dbSelect) or die("Cannot connect to database");
		
		$gymQuery = mysqli_query($connect,"
			SELECT gym_list.*, gym_reviews.comment, gym_reviews.rating, gym_reviews.first_review
			FROM gym_list 
			LEFT JOIN gym_reviews ON gym_list.gym_id = gym_reviews.gym_id
			WHERE (gym_reviews.user_id = '$loggedUserId') AND (gym_list.gym_id = '$gymId')");
			//CAMBIARE LA CONDIZIONE CON UNA VARIABILE NEL CASO IN CUI NESSUNO SIA LOGGATO O MANCHINO DEI DATI
		
		$numRows = mysqli_num_rows($gymQuery);
		if ($numRows != 0) {
			while ($row = mysqli_fetch_assoc($gymQuery)) {
				$gymName = $row["gym_name"];
				$gymImage = $row["gym_icon"];
				//$gymCoordinates = $row["gym_coordinates"];
				if ($_SESSION["loggedIn"] === true){
					$lastComment = $row["comment"];
					$lastRating = $row["rating"];
					$firstReview = $row["first_review"];
				}
			}
		}		
	}
	mysqli_close($connect);
?>
<!DOCTYPE html>
<html>

<head>
	<title><?php echo $gymName." - Goderelli"; ?></title>
	<link rel="icon" type="image/gif" href="/sub/Honeycomb-Intenet-64.png">
	<link type="text/css" rel="stylesheet" href="/sub/gym-page.css">
	<meta charset="UTF-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <script src="/sub/gym-page.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
		.bla {
			width: 30px;
			color: #666666;
		}
		.starChecked {
			color: orange;
		}
	</style>
    
    <style>
		.rating {
            overflow: hidden;
            display: inline-block;
		}
		.ratingInput {
			float: right;
			width: 16px;
			height: 16px;
			padding: 0;
			margin: 0 0 0 -16px;
			opacity: 0;
		}
		/* !!! LE CLASSI A SEGUIRE DEVONO AVERE QUEST'ORDINE !!! */
		.rating:hover .ratingStar:hover,
		.rating:hover .ratingStar:hover ~ .ratingStar,
		.ratingInput:checked ~ .ratingStar {
			background-position: 0 0;
		}
		.ratingStar,
		.rating:hover .ratingStar {
			cursor: pointer;
			position: relative;
			display: block;
			width: 16px;
			height: 16px;
			background: url('/sub/star.png') 0 -16px;
			float: right;
		}/* FINE */
		#gymReview {
			resize: none;
		}
	</style>

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
                    <a href="session.php" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block";}else{echo "display:none";}?> "><?php echo $welcome.$_SESSION["userNickname"]; ?></a>
                    <a href="gymlogout.php" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block";}else{echo "display:none";}?> ">Esci</a>
				</div>
            </div>
        </div><!-- #headerAlt -->  
        
        <div class="content">
            
            <div class="gymInfo" style="margin-left:20px;float:left;">
                <h3><?php echo $gymName; ?></h3>
				<img src=" <?php echo $gymImage; ?> ">
                <div class="ratingContainer" style="width:100%;">
					<?php
                        echo "user: ".$loggedUserId." ".$loggedUserNickname;
                        echo "<br />";
                        echo "gym: ".$gymId." ".$gymName;
                        echo "<br />";
                        echo "user comment: ".$lastComment;
                        echo "<br />";
                        echo "user rating: ".$lastRating;
                        echo "<br />";
                    ?>
                    <div class="rating">
                        <form action="/rate.php" method="post">
                            <input type="radio" class="ratingInput" value="5"
                                id="ratingInput-1-5" name="ratingInput-1" <?php if($lastRating == 5){echo "checked";}else{echo "";}?>>
                            <label for="ratingInput-1-5" class="ratingStar"></label>
                            <input type="radio" class="ratingInput" value="4"
                                id="ratingInput-1-4" name="ratingInput-1" <?php if($lastRating == 4){echo "checked";}else{echo "";}?>>
                            <label for="ratingInput-1-4" class="ratingStar"></label>
                            <input type="radio" class="ratingInput" value="3"
                                id="ratingInput-1-3" name="ratingInput-1" <?php if($lastRating == 3){echo "checked";}else{echo "";}?>>
                            <label for="ratingInput-1-3" class="ratingStar"></label>
                            <input type="radio" class="ratingInput" value="2"
                                id="ratingInput-1-2" name="ratingInput-1" <?php if($lastRating == 2){echo "checked";}else{echo "";}?>>
                            <label for="ratingInput-1-2" class="ratingStar"></label>
                            <input type="radio" class="ratingInput" value="1"
                                id="ratingInput-1-1" name="ratingInput-1" <?php if($lastRating == 1){echo "checked";}else{echo "";}?>>
                            <label for="ratingInput-1-1" class="ratingStar"></label>
                            <br />
                            <div>
                                <textarea id="gymReview" name="comment" required><?php echo $lastComment; ?></textarea>
                            </div>
                            <br />
                            <div>
                                <input type="submit" name="vota" value="Invia" class="" required/>
                            </div>
                        </form>
                    </div>
                    <br /><br /><br /><br />
                    <span class="bla fa fa-star starChecked fa-2x"></span>
                    <span class="bla fa fa-star fa-2x"></span>
                    <br /><br />
                    <span class="bla fa fa-star-half-full fa-2x"></span>
                    <span class="bla fa fa-star-half fa-2x"></span>
                    <span class="bla fa fa-star-half-full starChecked fa-2x"></span>
                    <span class="bla fa fa-star-half starChecked fa-2x"></span>
                    <br /><br />
                    <span class="bla fa fa-star-o fa-2x"></span>
                    <span class="bla fa fa-star-o starChecked fa-2x"></span>
            	</div><!-- .ratingContainer -->
            </div><!-- .gymInfo -->
            
            <div id="slidecontainer" style="margin-left:100px;float:left;max-width:100%;">
                <div class="slide">
                    <img class="slideImg" onClick="" src="/sub/goderecci.jpg"></img>
                    <img class="slideImg" onClick="" src="/sub/IMG_20161015_213117_res.jpg"></img>
                    <img class="slideImg" onClick="" src="/sub/IMG_20161016_001453_res.jpg"></img>
                </div>
      		</div>
            
            <div id="map" style="float:right;z-index:1;height: 400px;width: 400px;background-color:#FF9900;">
            </div>
                        
            <div style="height:600px;">
            </div>
            
			<script>/*
              function initMap() {
                // Create a map object and specify the DOM element for display.
                var map = new google.maps.Map(document.getElementById('map'), {
                  center: {lat: 43.883444, lng: 12.865278},
                  zoom: 18
                });
              }*/
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI0EPgbHOAOBV0eXKelBYzU1hMDDwsYk4&callback=initMap" async defer></script>
                        
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