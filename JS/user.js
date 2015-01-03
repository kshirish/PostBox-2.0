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

		$('#post').click(function(){
			var text = $($(this).parent()[0]).find('textarea').val()
			,	t = text.indexOf('@');
			,	toID;

			if(t === -1) {

				console.log('error');
				
			} else {

				for(i = t+1; i < text.length ; i++) {

					if(text[i] === ' '){
						l = i;
						break;
					}
				}	

				toID = text.substring(t+1, l);

				$.ajax({
				  url: 'PHP/post.php',
				  data: 'fromID='+userID+'&'+'toID='+toID+'&'+'subParam='+1+'&'+'text='+text+'&',
				  success: function(data){console.log(data);},
				  //dataType: 'json'
				});		

			}
		});

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