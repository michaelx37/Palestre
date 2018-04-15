<?php
	session_start();
	
	if (isset($_SESSION["userNickname"]) && $_SESSION["loggedIn"] === true) {
		$loggedUserId = $_SESSION["userId"];
		$loggedUserNickname = $_SESSION["userNickname"];
		$loggedUserAvatar = $_SESSION["userAvatar"];
		if ($_SESSION["userGender"] === "maschio") {
			$welcome = "Benvenuto ";
		} else {
			$welcome = "Benvenuta ";
		}
	} else {
		header ("location: index.php");
		die ();
	}
	
	$dbAddress = "127.0.0.1";
	$dbAdmin = "root";
	$dbPass = "mic2837mic2837";
	$dbSelect = "gymdb";
?>
<!DOCTYPE html>
<html>

<head>
	<title>Goderelli</title>
	<link rel="icon" type="image/gif" href="/sub/Honeycomb-Home-64.png">
	<link type="text/css" rel="stylesheet" href="/sub/result.css">
	<link type="text/css" rel="stylesheet" href="/sub/misc.css">
	<meta charset="UTF-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <script src="/sub/index.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
		.dropdown {float: left;overflow: hidden;}
		.dropdown .dropbtn {font-size: 17px;border: none;outline: none;color: white;background-color: inherit;font-family: inherit;margin: 0;z-index: 1;}
		.dropdown-content {display: none;position: absolute;background-color: #f9f9f9;min-width: 160px;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)/*0px 4px 8px #888888*/;z-index: 1;}
		.dropdown-content a {float: none;color: black;font-size: 17px;padding: 12px 16px;text-decoration: none;display: block;text-align: left;}
		.dropdown-content a:hover {background-color: /*#ddd*/ #3498DB;color: #FFFFFF;}
		.dropdown:hover .dropdown-content {display: block;}
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
                    <span class="headerBtn dropdown">
                        <span class="dropbtn">
							<?php echo $welcome.$_SESSION["userNickname"]; ?> 
                            <i class="fa fa-caret-down"></i>
                        </span>
                        <span class="dropdown-content">
                            <a href="#">Ja</a>
                            <a href="#">Nein</a>
                            <a href="#">Rammstein</a>
                            <a href="gymlogout.php">Logout</a>
                        </span>
                    </span>
                    <span class="userAvatar" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block;background-image:url(".$loggedUserAvatar.");";}else{echo "display:none";}?> "></span>
                    <a href="session.php" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block";}else{echo "display:none";}?> "><?php echo $welcome.$_SESSION["userNickname"]; ?></a>
                    <a href="gymlogout.php" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block";}else{echo "display:none";}?> ">Esci</a>
				</div>
            </div>
        </div><!-- #headerAlt -->
        


        
        <div id="headerAlt">
            <div class="leftHeaderAlt">
                <a href="index.php" class="headerBtn">LOGO / HOME / INDEX</a>
            </div>            
            <div class="rightHeaderAlt">
            	<div class="accountAlt">
                    <span id="loginBtn" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:none";}else{echo "display:block";}?> ">Accedi</span>
                    <span id="regBtn" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:none";}else{echo "display:block";}?> ">Registrati</span>
                    <span class="headerBtn dropdown">
                        <span class="dropbtn">
							<?php echo $welcome.$_SESSION["userNickname"]; ?> 
                            <i class="fa fa-caret-down"></i>
                        </span>
                        <span class="dropdown-content">
                            <a href="#">Ja</a>
                            <a href="#">Nein</a>
                            <a href="#">Rammstein</a>
                            <a href="gymlogout.php">Logout</a>
                        </span>
                    </span>
                    <span class="userAvatar" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block;background-image:url(".$loggedUserAvatar.");";}else{echo "display:none";}?> "></span>
                    <a href="session.php" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block";}else{echo "display:none";}?> "><?php echo $welcome.$_SESSION["userNickname"]; ?></a>
                    <a href="gymlogout.php" class="headerBtn" style=" <?php if(isset($_SESSION["userNickname"])){echo "display:block";}else{echo "display:none";}?> ">Esci</a>
				</div>
            </div>
        </div><!-- #headerAlt -->
        
        <div style="margin-left:5%;">
			<?php
                for ($test = 0; $test<=5; $test=$test+0.1){
                    echo $test ." = ". round($test * 2) / 2 . "<br>";
                }
            ?>
        </div><!-- . -->
             
    </div><!-- .container col-12 -->



</body>

</html>