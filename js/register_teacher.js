$(document).ready(
		function() {
			// Create a jqxDateTimeInput
			$("#dobJqxWidget").jqxDateTimeInput({width: '100%', height: '34px'});
			clearDefaultValues();
			$("#registerBtn").click(function(e){
				$("#dob").val($("#dobJqxWidget").val());
				fillDefaultValues();
				$( "#submitBtn" ).trigger( "click" );
				e.preventDefault(); // Prevents the default behavior of
//				formValidation();
//				return false;
//				$("#teacherRegForm").submit();
			});
			
			
		});


