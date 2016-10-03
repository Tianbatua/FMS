$(document).ready(function() {
	$('#loginLink').click(function(){	
		event.preventDefault();
		processSecureLogin(13);	
		
	});

	$("#form input").keypress(function(e) {
	    if (e.which == 13) {
	        event.preventDefault();
	        processSecureLogin(13);	
	    }
	});

	/* Simple VanillaJS to toggle class */
	// document.getElementById('toggleProfile').addEventListener('click', function () {
	//   [].map.call(document.querySelectorAll('.profile'), function(el) {
	//     el.classList.toggle('profile--open');
	//   });
	// });
});

function processSecureLogin(keycode) {
	if(keycode == 13) {
		var loginValidated	=	true;
		var loginName		= 	$.trim($("#loginName").val());
		var loginPwd		= 	$.trim($("#loginPwd").val());
		var alertMsg		=	"";

		if(loginName == "") {
			loginValidated = false;
			alertMsg	+= "<br>";
			alertMsg	+=	"<font color='red'>&raquo; Login Name Required.</font>";
		}
		if(loginPwd == "") {
			loginValidated = false;
			alertMsg	+= "<br>";
			alertMsg	+=	"<font color='red'>&raquo; Login Password Required.</font>";
		}	

		if(loginValidated) {
			var plainPwd	=	$("#loginPwd").val();
			var encPwd 		=	$.md5(plainPwd);
			$("#loginPwd").val(encPwd);			
			console.log($("#form").serialize());
			
			$.ajax({
				type: "POST",
				url: "ajax/ajax_secureLogin.php",
				data: $("#form").serialize() + "&op_command=SECURE_LOGIN",
				success: function(ajaxResponse) {	
					console.log(ajaxResponse);
					var loginResponse	=	($.trim(ajaxResponse));
					if(loginResponse == 'SUCCESS') {
						alert("login success");
						$(location).attr('href', 'admin_home.php');
					} else {
						//...
					}
				},
				error: function(e) {
					console.log("err-->".e);
				}
			});	//ajax
		} else {
			bootbox.alert(alertMsg, function() {	});	
		}
	}
}