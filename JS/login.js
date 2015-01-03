$(document).ready(function() {
	var inputUserID, inputPassword, inputObj;

	function success(response) {
		if( response === '0' ) {
			console.log('Error at connection');	
		} else if( response === '-1' ) {
			console.log('No results were found');	
		} else {

			console.log('Login successful !');	

			response = JSON.parse(response);
			sessionStorage.setItem('authenticated', response.authenticated);
			sessionStorage.setItem('level', response.level);
			sessionStorage.setItem('userID', inputUserID);

			window.location.href = 'home.html';
		}
		
	}

	// get the username and password from user
	$( ".form-signin" ).submit(function( event ) {
		inputObj = $( this ).serializeArray();

		inputUserID = inputObj[0].value;
		inputPassword = inputObj[1].value;

		// make ajax call to PHP and get the answer
		$.ajax({
		  url: 'PHP/login.php',
		  type: 'GET',
		  data: inputObj,
		  success: success,
		//  dataType: 'json'
		});

		event.preventDefault();
	});

});