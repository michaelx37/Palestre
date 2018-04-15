$(document).ready(function(){

	$("#regForm").submit(function(event) {
		// Stop the browser from submitting the form and reload the page.
		event.preventDefault();
		//Send the form
		submitForm();
	})

	var regUsername = "";
	var regPassword = "";
	var regPasswordCheck = "";
	var regEmail = "";
	var regFirstName = "";
	var regLastName = "";
	var regBirth = "";
	
	function submitForm() {
		var regUsername = $("#regUsername").val();
		var regPassword = $("#regPassword").val();
		var regPasswordCheck = $("#regPasswordCheck").val();
		var regEmail = $("#regEmail").val();
		var regFirstName = $("#regFirstName").val();
		var regLastName = $("#regLastName").val();
		var regBirth = $("#regBirth").val();
		var regGender = $('input[name=regGender]:checked').val();
		
		//$(".formFeedback").html(regUsername +" "+ regPassword +" "+ regPasswordCheck +" "+ regEmail +" "+ regFirstName +" "+ regLastName +" "+ regBirth +" "+ regGender);
		
		/*if (regUsername == "") {
			$("#regUsername").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
		} else {
			$("#regUsername").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
		}
		if (regPassword == "") {
			$("#regPassword").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
		} else {
			$("#regPassword").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
		}
		if (regPasswordCheck == "") {
			$("#regPasswordCheck").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
		} else {
			$("#regPasswordCheck").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
		}
		if (regEmail == "") {
			$("#regEmail").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
		} else {
			$("#regEmail").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
		}
		if (regFirstName == "") {
			$("#regFirstName").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
		} else {
			$("#regFirstName").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
		}
		if (regLastName == "") {
			$("#regLastName").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
		} else {
			$("#regLastName").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
		}
		if (regBirth == "") {
			$("#regBirth").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
		} else {
			$("#regBirth").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
		}
		if (regGender == 0) {
			$(".genderInput").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid", "padding": "5px"});
			//$(".genderInput").css({"borderColor": "none", "borderWidth": "none", "borderStyle": "none", "padding": "none"});
		} else {
			$(".genderInput").css({"borderColor": "none", "borderWidth": "none", "borderStyle": "none", "padding": "none"});
			//$(".genderInput").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid", "padding": "5px"});
		}*/
		
		$.ajax ({
			type: "POST",
			url: "registration.php",
			data: "regUsername=" + regUsername + "&regPassword=" + regPassword + "&regEmail=" + regEmail + "&regFirstName=" + regFirstName + "&regLastName=" + regLastName + "&regGender=" + regGender,
			dataType: "json",
			cache: false,
			success: function(dataReturn) {
				//alert(dataReturn['done']+' nick'+dataReturn['ne']+' psw'+dataReturn['pe']+' mail'+dataReturn['ee']+' fname'+dataReturn['fne']+' lname'+dataReturn['lne']+' gender'+dataReturn['ge']);
				if (dataReturn['ne'] == "") {
					$("#regUsername").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
				} else {
					$("#regUsername").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
				}
				if (dataReturn['pe'] == "") {
					$("#regPassword").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
				} else {
					$("#regPassword").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
				}
				if (dataReturn['pce'] == "") {
					$("#regPasswordCheck").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
				} else {
					$("#regPasswordCheck").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
				}
				if (dataReturn['ee'] == "") {
					$("#regEmail").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
				} else {
					$("#regEmail").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
				}
				if (dataReturn['fne'] == "") {
					$("#regFirstName").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
				} else {
					$("#regFirstName").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
				}
				if (dataReturn['lne'] == "") {
					$("#regLastName").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
				} else {
					$("#regLastName").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
				}
				if (dataReturn['be'] == "") {
					$("#regBirth").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
				} else {
					$("#regBirth").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
				}
				if (dataReturn['ge'] == "") {
					$(".genderInput").css({"borderColor": "none", "borderWidth": "none", "borderStyle": "none", "padding": "none"});
				} else {
					$(".genderInput").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid", "padding": "5px"});
				}
				$(".formFeedback").html(dataReturn['done']);
			}	// success method
		});	// ajax method
	}
	/*
	function formSuccess() {
		$(".formFeedback").html("Registrazione completata!");
		$(".formFeedback").css({"display":"block", "color":"green"});
	}
	function formError() {
		$(".formFeedback").html("Ricontrolla i campi "+errorReturn[0]+" "+errorReturn[1]+" "+errorReturn[2]+" "+errorReturn[3]+" "+errorReturn[4]+" "+errorReturn[5]+" "+errorReturn[6]+" "+errorReturn[7]);
		$(".formFeedback").css({"display":"block", "color":"red"});
	}
	/*function errorFeedback(valid, msg){// !!! CAMBIARE !!!
		if(valid){
			var msgClasses = "h3 text-center tada animated text-success";
		} else {
			var msgClasses = "h3 text-center text-danger";
		}
		$("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
	}*/
});