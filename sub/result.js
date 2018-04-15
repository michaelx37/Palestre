window.onload = function() {
	// --- LOGIN MODAL ---
	// Get the modal
	var loginModal = document.getElementById("loginModal");
	
	// Get the button that opens the modal
	var loginBtn = document.getElementById("loginBtn");
	
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	
	// When the user clicks on the button, open the modal
	loginBtn.onclick = function() {
		loginModal.style.display = "block";
	}
	
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
		loginModal.style.display = "none";
	}
	
	// When the user clicks anywhere outside of the modal, close it    !!! CONTROLARE !!!
	window.onclick = function(event) {
		if (event.target == loginModal) {
			loginModal.style.display = "none";
		}
	}
	// --- REGISTRATION MODAL ---
	var regModal = document.getElementById("regModal");
	
	var regBtn = document.getElementById("regBtn");
	
	var span = document.getElementsByClassName("close")[1];
	
	regBtn.onclick = function() {
		regModal.style.display = "block";
	}
	
	span.onclick = function() {
		regModal.style.display = "none";
	}
	
	window.onclick = function(event) {
		if (event.target == regModal) {
			regModal.style.display = "none";
		}
	}
}