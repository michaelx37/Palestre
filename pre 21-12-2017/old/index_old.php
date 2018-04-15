<?php
	/*include("gymlogin.php");
	$_SESSION["LoggedUserKey"] = null;
	session_start();
	$logInOut = "<button id='loginBtn'>Login</button>";
	if ($_SESSION["LoggedUserKey"] != null) {
		  $logInOut = "<a href='logout.php'><button type='button'>Logout</button></a>";
	}*/
?>
<!DOCTYPE html>
<html>

<head>
	<title>Goderelli</title>
	<link rel="icon" type="image/gif" href="/sub/Honeycomb-Home-64.png">
	<link type="text/css" rel="stylesheet" href="/sub/index.css">
	<meta charset="UTF-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <script src="/sub/index.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-2.0.0.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>


<body>

	<div class="container col-12">
    	<div class="header">        
        	<div class="left-header">
            	<div class="logo">
                	LOGO
                </div>
            </div>            
        	<div class="right-header">
            	<div class="account" onclick="">
                	<?php //echo $logInOut; ?>
                    <button id='loginBtn'>Login</button>
                    <a href='gymlogout.php'><button type='button'>Logout</button></a>
                    <a href='registration_page.php'><button type='button'>Register</button></a>
                </div>
            	<div class="menu">
                	=
                </div>
            </div>
        </div> <!-- .header -->  
        <div class="main col-12">
        	<div class="search-menu col-12">
            	<div class="bla">
                    <div class="search-select">Ricerca per palestra</div>
                    <div class="search-select">Ricerca per attività</div>
                    <br />
                    <div class="search-box">
                        <form action="/result.php" method="get">
                            <input type="text" name="search" autocomplete="on" placeholder="palestra, attività, istruttore ...">
                            <input type="text" name="location" autocomplete="on" placeholder="in che zona?">
                            <input type="submit" name="submit" value="Vai" class="gobtn">
                        </form>
                        <div><p><a class="gobtn" href="home.php">Pagina personale</a></p></div>
                    </div>
				</div>
            </div>
        </div><!-- .main col-12 -->
    </div><!-- .container col-12 -->




  
<!-- The Modal -->
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>
            <form action="/gymlogin.php" method="post" class="logForm">
                <label><b>Username:</b></label>
                <input type="text" name="username" autocomplete="on" placeholder="Enter Username">
                <label><b>Password:</b></label>
                <input type="password" name="password" autocomplete="off" placeholder="Enter Password">
                <input type="submit" value="Login" class="logBtn">
            </form>
        </p>
    </div>
</div>



</body>

</html>
