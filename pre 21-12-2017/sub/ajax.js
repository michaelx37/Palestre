$(document).ready(function(){

	$("#regForm").submit(function(event) {
		// Stop the browser from submitting the form and reload the page.
		event.preventDefault();
		//Send the form
		preSubmitForm();
	})
	
	
	var regUsername = "";
	var regPassword = "";
	var regPasswordCheck = "";
	var regEmail = "";
	var regFirstName = "";
	var regLastName = "";
	var regBirth = "";
	var regGender = "";
	
	function preSubmitForm() {
		var regUsername = /*$(".regInput").attr('name', 'regUsername').val(); */ $("#regUsername").val();
		var regPassword = /*$(".regInput").attr('name', 'regPassword').val(); */ $("#regPassword").val();
		var regPasswordCheck = /*$(".regInput").attr('name', 'regPasswordCheck').val(); */ $("#regPasswordCheck").val();
		var regEmail = /*$(".regInput").attr('name', 'regEmail').val(); */ $("#regEmail").val();
		var regFirstName = /*$(".regInput").attr('name', 'regFirstName').val(); */ $("#regFirstName").val();
		var regLastName = /*$(".regInput").attr('name', 'regLastName').val(); */ $("#regLastName").val();
		var regBirth = /*$(".regInput").attr('name', 'regBirth').val(); */ $("#regBirth").val();
		var regGender = /*$(".regInput").attr('name', 'regGender').val(); */ $(".genInput:checked").val();// $('input[name=regGender]:checked').val();
		$(".formFeedback").html(regUsername +" "+ regPassword +" "+ regPasswordCheck +" "+ regEmail +" "+ regFirstName +" "+ regLastName +" "+ regBirth +" "+ regGender);
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
		
		//if (regUsername != "" && regPassword != "" && regEmail != "" && regFirstName != "" && regLastName != "" && regBirth != "" && regGender != "") {		
			$.ajax ({
				type: "POST",
				url: "registration.php",
				data: "regUsername=" + regUsername + "&regPassword=" + regPassword + "&regEmail=" + regEmail + "&regFirstName=" + regFirstName + "&regLastName=" + regLastName + "&regBirth=" + regBirth + "&regGender=" + regGender,
				success: function(text) {
					if (text == "success") {
						formSuccess();
					} else {
						formError();
						$.ajax({
							type: 'POST',
							url: 'registration.php',
							dataType: 'json',
							cache: false,
							success: function(errorReturn) {
								//$('#content1').html(errorReturn[0]);
								if (errorReturn[0] == "") {
									$("#regUsername").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
								} else {
									$("#regUsername").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
								}
								if (errorReturn[1] == "") {
									$("#regPassword").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
								} else {
									$("#regPassword").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
								}
								if (errorReturn[2] == "") {
									$("#regPasswordCheck").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
								} else {
									$("#regPasswordCheck").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
								}
								if (errorReturn[3] == "") {
									$("#regEmail").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
								} else {
									$("#regEmail").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
								}
								if (errorReturn[4] == "") {
									$("#regFirstName").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
								} else {
									$("#regFirstName").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
								}
								if (errorReturn[5] == "") {
									$("#regLastName").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
								} else {
									$("#regLastName").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
								}
								if (errorReturn[6] == "") {
									$("#regBirth").css({"borderColor": "#ccc", "borderWidth": "2px", "borderStyle": "solid"});
								} else {
									$("#regBirth").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid"});
								}
								if (errorReturn[7] == 0) {
									$(".genderInput").css({"borderColor": "none", "borderWidth": "none", "borderStyle": "none", "padding": "none"});
								} else {
									$(".genderInput").css({"borderColor": "red", "borderWidth": "2px", "borderStyle": "solid", "padding": "5px"});
								}
							},
						});
						//errorFeedback(false,text); // !!! CAMBIARE !!!
					}
				}
			});
	//	} else {
	//		formError();
	//	}
	}
	
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