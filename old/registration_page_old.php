<?php
	$dbAddress = "127.0.0.1";
	$dbAdmin = "root";
	$dbPass = "mic2837mic2837";
	$dbSelect = "gymdb";

	$regNick = $regPass = "";
	//if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["submit"])) {
		$regNick = test_input($_POST[""]);
		$regPass = test_input($_POST[""]);		
		$regLastName = test_input($_POST[""]);
		$regFirstName = test_input($_POST[""]);
		$regAge = test_input($_POST[""]);
		$regGender = test_input($_POST[""]);
		$regMail = test_input($_POST[""]);
	}
	function test_input ($userData) {
		$userData = trim($userData);
		$userData = stripslashes($userData);
		$userData = htmlspecialchars($userData);
		return $userData;
	}
	
	if (isset($_POST["submit"])) {

		$connect = new mysqli($dbAddress, $dbAdmin, $dbPass, $dbSelect) or die("Cannot connect to database");
		
		$query = mysqli_query($connect," SELECT * FROM user_list WHERE user_nickname = '$regNick' ");	
		$numRows = mysqli_num_rows($query);
		
		if ($numRows == 0) {
			$newRowQuery = " INSERT INTO user_list (user_nickname, user_password, user_last_name, user_first_name, user_age, user_gender) VALUES ('$regNick', '$regPass', $regLastName, $regFirstName, $regAge, $regGender, $regMail)";
			if ($connect->query($newRowQuery) === TRUE) {
					$timestamp = date("Y-m-d-H-i-s",time());
					/*$query_datelog = */mysqli_query($connect," UPDATE user_list SET user_last_login = '$timestamp' WHERE user_nickname = '$regNick' ");
				}
		}else {
			die("Username non disponibile!");
		}
	}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Register</title>
	<link rel="icon" type="image/gif" href="/sub/Honeycomb-Home-64.png">
	<link type="text/css" rel="stylesheet" href="/sub/registration.css">
	<meta charset="UTF-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <script src="/sub/registration.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-2.0.0.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

	<div>
    	<table>
        	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method='POST'>
                <tr>
                    <td>Username (max 20 char) : </td>
                    <td><input type="text" name="reg_username" maxlength="20" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>Password (max 30 char) : </td>
                    <td><input type="password" name="reg_password" maxlength="30" autocomplete="off"></td>
                </tr>
                <tr>
                	<td colspan="2" style="text-align:center;"><input type="submit" name="submit" value="Register"></td>
				</tr>
			</form>
       </table>     
	</div>
    

</body>

</html>