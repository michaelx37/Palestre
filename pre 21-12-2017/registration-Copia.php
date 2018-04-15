<?php
	$dbAddress = "127.0.0.1";
	$dbAdmin = "root";
	$dbPass = "mic2837mic2837";
	$dbSelect = "gymdb";
	
	$nickErr = $pswErr = $pswCheckErr = $emailErr = $firstNameErr = $lastNameErr = $birthErr = $genderErr = "";
	$nick = $psw = $pswCheck = $email = $firstName = $lastName = $birth = $gender = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
	  if (empty($_POST["regUsername"])) {
		$nickErr = "Campo obbligatorio";
	  } else {
		$nick = test_input($_POST["regUsername"]);
		// check if name only contains letters, numbers and whitespace
		if (!preg_match("/^[a-zA-Z0-9 ]*$/",$nick)) {
		  $nickErr = "Sono consentite solo lettere, numeri e spazi";
		}
	  }
		
	  if (empty($_POST["regPassword"])) {
		$pswErr = "Campo obbligatorio";
	  } else {
		$psw = test_input($_POST["regPassword"]);
		// check if name only contains letters, numbers and whitespace
		if (!preg_match("/^[a-zA-Z0-9 ]*$/",$psw)) {
		  $pswErr = "Sono consentite solo lettere, numeri e spazi";
		}
	  }
	  /*	
	  if (empty($_POST["regPasswordCheck"])) {
		$pswCheckErr = "Campo obbligatorio";
	  } else {
		$pswCheck = test_input($_POST["regPasswordCheck"]);
		// check if name only contains letters, numbers and whitespace
		if (!preg_match("/^[a-zA-Z0-9 ]*$/",$pswCheck)) {
		  $pswCheckErr = "Sono consentite solo lettere, numeri e spazi";
		}
	  }
	  */
	  if (empty($_POST["regEmail"])) {
		$emailErr = "Campo obbligatorio";
	  } else {
		$email = test_input($_POST["regEmail"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $emailErr = "Email non valida";
		}
	  }
	  
	  if (empty($_POST["regFirstName"])) {
		$firstNameErr = "Campo obbligatorio";
	  } else {
		$firstName = test_input($_POST["regFirstName"]);
		// check if name only contains letters, numbers and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
		  $firstNameErr = "Sono consentite solo lettere e spazi";
		}
	  }
	  
	  if (empty($_POST["regLastName"])) {
		$lastNameErr = "Campo obbligatorio";
	  } else {
		$lastName = test_input($_POST["regLastName"]);
		// check if name only contains letters, numbers and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
		  $lastNameErr = "Sono consentite solo lettere e spazi";
		}
	  }
	  /*
	  if (empty($_POST["regBirth"])) {
		$birthErr = "Campo obbligatorio";
	  } else {
		$birth = test_input($_POST["regBirth"]);
		$bday = date('Y-m-d',strtotime($_POST['userSubmittedBDay']));
	  }
	  */  
	  if (empty($_POST["regGender"])) {
		$genderErr = "Specificare il sesso";
	  } else {
		$gender = test_input($_POST["regGender"]);
	  }
	  
	  
	 /* if ($nickErr != "" || $pswErr != "" || $emailErr != "" || $firstNameErr != "" || $lastNameErr != "" || $genderErr != "") {
		//header ("location: index.php?error=regError");
		$errorReturn = array(
			"done" => "Ricontrollare i campi",
			"ne" => $nickErr,
			"pe" => $pswErr,
			"pce" => $pswCheckErr,
			"ee" => $emailErr,
			"fne" => $firstNameErr,
			"lne" => $lastNameErr,
			"be" => $birthErr,
			"ge" => $genderErr
			);
		} else {
			$errorReturn = array("done" => "Dati inviati!");
		}
		echo json_encode($errorReturn);	 */ 
	}
		
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	
	$dataReturn = array(
		"done" => "ERA ORA!",
		"ne" => $nick,
		"pe" => $psw,
		"ee" => $email,
		"fne" => $firstName,
		"lne" => $lastName,
		"ge" => $gender
		);
	echo json_encode($dataReturn);
		
?>
<?php

/*
echo "<h2>Your Input:</h2>";
echo $nick;
echo "<br>";
echo $psw;
echo "<br>";
echo $lastName;
echo "<br>";
echo $firstName;
echo "<br>";
echo $gender;
echo "<br>";
echo $email;

echo "<h2>Errors:</h2>";
echo "nickErr: ".$nickErr;
echo "<br>";
echo "pswErr: ".$pswErr;
echo "<br>";
echo "lastNameErr: ".$lastNameErr;
echo "<br>";
echo "firstNameErr: ".$firstNameErr;
echo "<br>";
echo "genderErr: ".$genderErr;
echo "<br>";
echo "emailErr: ".$emailErr;*/

?>