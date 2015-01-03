$(document).ready(function() {

	var subParam = getUrlParameter('subParam')
	,	userID
	,	subgroupname
	;


	function getUrlParameter(sParam) {
	    var sPageURL = window.location.search.substring(1);
	    var sURLVariables = sPageURL.split('&');
	    for (var i = 0; i < sURLVariables.length; i++) 
	    {
	        var sParameterName = sURLVariables[i].split('=');
	        if (sParameterName[0] == sParam) 
	        {
	            return sParameterName[1];
	        }
	    }
	}          

	function success(data) {

		var response = {}, i = 0, j = 0, flag;

		response.listgroup = [];

		data = JSON.parse(data);

		for(i in data) {

			flag = false;
			for(j in response.listgroup) {

				if(response.listgroup[j].clubname === data[i].subgroupname) {
					flag = true;
					break;
				}
			}
			
			if( !flag ) {

				var obj = {
					"clubname": data[i].subgroupname,
					"messages" : [
					{
						"head" : "Posted by " + data[i].firstname + " on " + data[i].postdate,
						"body" : data[i].text
					}]
				};

				response.listgroup.push(obj);

			} else {

				response.listgroup[j].messages.push({
					"head" : "Posted by " + data[i].firstname + " on " + data[i].postdate,
					"body" : data[i].text					
				}); 

			}
		}

		$("#clubNamesTemplate").tmpl(response).appendTo("#clubNames");

	    $("div.tab-menu>div.list-group>a").on("click", function(e) {

	        e.preventDefault();
	        $(this).siblings('a.active').removeClass("active");
	        $(this).addClass("active");
	        
	        var index = $(this).index();
	        $("div.tab>div.tab-content").removeClass("active");
	        $("div.tab>div.tab-content").eq(index).addClass("active");
	    });

		$("#rightWrapperTemplate").tmpl(response).appendTo("#rightWrapper");

		$.template( "messageWrapperTemplate", $('#messageWrapperTemplate').html() );

		for( i in response.listgroup) {

			$.tmpl( "messageWrapperTemplate", response.listgroup[ i ].messages ).appendTo( $(".showMessages")[ i ] );	
		}

		checkUser();

		$('#add').click(function(){
			$.ajax({
			  url: 'PHP/adddel.php',
			  data: 'userID='+userID+'&'+'subParam='+1+'&'+'subgroupname='+subgroupname+'&',
			  success: function(data){console.log(data);},
			  //dataType: 'json'
			});		
		});

		$('#delete').click(function(){
			$.ajax({
			  url: 'PHP/adddel.php',
			  data: 'userID='+userID+'&'+'subParam='+0+'&'+'subgroupname='+subgroupname+'&',
			  success: function(data){console.log(data);},
			  //dataType: 'json'
			});		
		});

		$('#post').click(function(){
			var text = $($(this).parent()[0]).find('textarea').val();
				
			$.ajax({
			  url: 'PHP/post.php',
			  data: 'userID='+userID+'&'+'subParam='+0+'&'+'text='+text+'&'+'subgroupname='+subgroupname+'&',
			  success: function(data){console.log(data);},
			  //dataType: 'json'
			});		
		});
	}

	function disableComponents(data){

		if(!data[0]) {
			$('div[id^="first"]').addClass('disabled');
		}

		if(!data[1]) {
			$('div[id^="second"]').addClass('disabled');
		}

		if(!data[2]) {
			$('div[id^="third"]').addClass('disabled');
		}		
	}

	function getAllTabsData(){

		$.ajax({
		  url: 'PHP/tabs.php',
		  data: 'subParam='+subParam+'&',
		  success: success,
		  //dataType: 'json'
		});		
	}

	function checkUser(){

		// clearing disabling if it is there
		if( $('div[id^="first"]').hasClass('disabled') ){

			$('div[id^="first"]').removeClass('disabled')

		} else if( $('div[id^="second"]').hasClass('disabled') ){

			$('div[id^="first"]').removeClass('disabled')

		} else if( $('div[id^="third"]').hasClass('disabled') ){

			$('div[id^="first"]').removeClass('disabled')

		}

		userID = sessionStorage.getItem('userID');
		subgroupname = $('#clubNames').find('.active')[0].text.trim();
		

		$.ajax({
		  url: 'PHP/checkuser.php',
		  data: 'userID='+userID+'&'+'groupID='+subParam+'&'+'subgroupname='+subgroupname+'&',
		  success: disableComponents,
		  //dataType: 'json'
		});
	}

	function logoutUser(){
		
		//clear all session storage
		sessionStorage.clear();

		// redirect to login page
		window.location.href = "login.html";
	}

	getAllTabsData();

	$('a[title]').tooltip();

	$('#clubNames').click(checkUser);

	$('#logout').click(logoutUser);

}); 