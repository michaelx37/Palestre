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
	
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		$idGym = $_GET["gym_id"];
		
		$connect = new mysqli($dbAddress, $dbAdmin, $dbPass, $dbSelect) or die("Cannot connect to database");
		
		$infoQuery = mysqli_query($connect," SELECT * FROM gym_list WHERE gym_id = '$idGym' ");	
		$numRows = mysqli_num_rows($infoQuery);
		
		if ($numRows != 0) {
			while ($row = mysqli_fetch_assoc($infoQuery)) {
				$gymName = $row["gym_name"];
				$gymImage = $row["gym_icon"];
				$gymCoordinates = $row["gym_coordinates"];
			}
		}

	}
?>
<!DOCTYPE html>
<html>

<head>
	<title><?php echo $gymName; ?></title>
	<link rel="icon" type="image/gif" href="/sub/Honeycomb-Intenet-64.png">
	<link type="text/css" rel="stylesheet" href="/sub/gym-page.css">
	<meta charset="UTF-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <script src="/sub/result.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-2.0.0.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #sadmap {
        height: 400px;
		width: 100%;
      }
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
                    <a href="session.php" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block";}else{echo "display:none";}?> "><?php echo $welcome.$_SESSION["userNickname"]; ?></a>
                    <a href="gymlogout.php" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block";}else{echo "display:none";}?> ">Esci</a>
				</div>
            </div>
        </div><!-- #headerAlt -->  
        
        <div class="content" style="text-align:center;">
        
        	<h3>
				<?php echo $gymName; ?>
            </h3>
            
            <div class="slideContainer">
				<img src=" <?php echo $gymImage; ?> ">
            </div>
            
            <div style="height:500px;">
            </div>
            
            <div id="sadmap">
            </div>
            
			<script>
              function initMap() {
                // Create a map object and specify the DOM element for display.
                var map = new google.maps.Map(document.getElementById('sadmap'), {
                  center: {lat: 43.884302, lng: 12.868188},
                  zoom: 17
                });
              }
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI0EPgbHOAOBV0eXKelBYzU1hMDDwsYk4&callback=initMap" async defer></script>
            

            <div class="mapContainer">
            </div>
            
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
    </div>
    
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
    </div>


</body>

</html>