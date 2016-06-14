$(document).ready(
		function() {
			$("#states").change(
					function() {
						$.ajax(
								{
									url : "/YourTeacher/getDistricts?stateCd="
											+ $("#states").val(),
									context : document.body
								}).done(
								function(data) {
									$("#districts").html('');
									$("#districts").append(
											new Option('District', ''));
									$("#districts").selectpicker('refresh');
									for (var i = 0; i < data.length; i++) {
										$("#districts").append(
												new Option(
														data[i].districtName,
														data[i].districtName));
									}
									$("#districts").selectpicker('refresh');

								});
					});

			$("#sendMail").click(function(e) {
				contactMe();
				e.preventDefault(); // Prevents the default behavior of the link
			});
			
			$("#seachTeachers").click(function(e) {
				$("#teacherSearchForm").submit();
				e.preventDefault(); // Prevents the default behavior of the link
			});
		});

function contactMe() {
	$.post("/YourTeacher/conatactMe.do", $("#contactForm").serialize()).done(
			function(data) {
				alert(data);
			});
}