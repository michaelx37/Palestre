<?php
	session_start();
	
	$dbAddress = "127.0.0.1";
	$dbAdmin = "root";
	$dbPass = "mic2837mic2837";
	$dbSelect = "gymdb";
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	if ($username != "" && $password != "") {
		$connect = new mysqli ($dbAddress, $dbAdmin, $dbPass, $dbSelect) or die("Cannot connect to database"); //connessione al database
		
		$loginQuery = mysqli_query($connect, " SELECT * FROM user_list WHERE user_nickname = '$username' "); //ricerca riga esatta dell'utente inserito
		
		$queryNumRows = mysqli_num_rows($loginQuery); //quantitativo di righe presenti nella selezione
		
		if ($queryNumRows != 0) {
			while ($row = mysqli_fetch_assoc($loginQuery)) {
				$storedId = $row["user_id"];
				$storedUser = $row["user_nickname"];
				$storedPass = $row["user_password"];
				$storedAvatar = $row["user_avatar"];
				$storedGender = $row["user_gender"];
				$storedLastLogin = $row["user_last_login"];
			}
			if ($username == $storedUser && $password == $storedPass) { //verifica corrispondenza dati inseriti con quelli presenti nel database
				//echo "Login successful. <a href='private_alt.php'>Enter now!</a>"; // !!cambiare!!
				header ("location: index.php");
				$_SESSION["loggedIn"] = true;
				$_SESSION["userId"] = $storedId;
				$_SESSION["userNickname"] = $storedUser;
				$_SESSION["userAvatar"] = $storedAvatar;
				$_SESSION["userGender"] = $storedGender;
				$_SESSION["userLastLogin"] = $storedLastLogin;
				$_SESSION["userIP"] = $_SERVER['REMOTE_ADDR'];
				
				$timestamp = date ("Y-m-d-H-i-s", time());
				$queryDateLog = mysqli_query($connect, " UPDATE user_list SET user_last_login_temp = '$timestamp' WHERE user_nickname = '$storedUser' ");
			} else {
				$_SESSION["loggedIn"] = false;
				echo "Password non valida!"; // !!! cambiare !!!
			}
		} else {
			$_SESSION["loggedIn"] = false;
			die ("Username non valido!"); //!!! cambiare !!!
		}
		
	} else {
		$_SESSION["loggedIn"] = false;
		die ("Inserire nome utente e password.");
	}
	mysqli_close($connect);
?>