/*####################################################################
#	File Name	:	validate_admin_home.js
#	Author		:	Brian
####################################################################*/
$(document).ready(function() {

	$('#menu-top').find('ul').addClass('sub_menu');
	$('#error_log_div').hide();
	$('#error_log_btn').on('click', function(){	$('#error_log_div').show(); });
	$('.close_btn').on('click', function(){	$(this).parents('#error_log_div').hide();	});

	
	$("#clearLogCommand").click(function(){
		
		var formData = new FormData($("#footerSettingsForm")[0]);
		formData.append("op_command", "CLEAR_ERR_LOG");

		$.ajax({
			type: "POST",
			url: 	"Ajax/ajx_clearErrorLog.php",
			data: 	formData,
			success: function(ajaxResponse){
					if($.trim(ajaxResponse) == 'success')
					{
						$("#errorLogReportArea").show();
						$("#errorLogReportArea").html("");
						$("#errorLogReportArea").html(" No Errors Found!");
					}
				},//success
				cache: false,
				contentType: false,
				processData: false
		});	//ajax
			
			
		
	});

});

