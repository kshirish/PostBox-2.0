$(document).ready(function() {
	var userID = sessionStorage.getItem('userID');

	function success(data) {
		var messages = {};
		data = JSON.parse(data);
		
		$("#userinfoTemplate").tmpl(data[0]).appendTo($(".userinfo"));

		messages.listgroup = [];
		data.splice(0, 1);
		messages.listgroup = data;

		$("#messageWrapperTemplate").tmpl(messages).appendTo($(".showMessages"));

	}

	function getAllUserData(){
		$.ajax({
		  url: 'PHP/user.php',
		  data: 'subParam='+userID+'&',
		  success: success,
		  //dataType: 'json'
		});		
	}

	function logoutUser(){
		
		//clear all session storage
		sessionStorage.clear();

		// redirect to login page
		window.location.href = "login.html";
	}

	getAllUserData();

	$('#logout').click(logoutUser);


});