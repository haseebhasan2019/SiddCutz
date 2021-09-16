const form = document.getElementById("login");

form.addEventListener("submit", function (event) {
	// stop form submission
	event.preventDefault();
	
	fetch("./password.json")
		.then(response => {
		return response.json();
		})
		.then(data => {
			// validate the form
			let nameValid = (form.elements["username"]).value.trim() === data.username;
			let passwordValid = (form.elements["password"]).value.trim() === data.password;

			// if valid, submit the form.
			if (nameValid && passwordValid) {
				location.href = "admin.php";
			}
			else {
				alert("Invalid Username and Password.");
			}
		});		
	

});