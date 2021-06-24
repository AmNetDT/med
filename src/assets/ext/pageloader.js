$(document).ready(function(){

	$("#loader_httpFeed").hide();
	$('._mc a').click(function (e) {
		
		//Pssing values to nextPage 
		var rsData = "eQvmTfgfru";
		var dataString = "rsData=" + rsData;
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: $(this).attr('id') + "/index.php",
			data: dataString,
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});
  
  //Payment view window
	$("#loader_httpFeed").hide();
	$('._payment a').click(function (e) {

		//Pssing values to nextPage 
		var rsData = "eQvmTfgfru";
		var dataString = "rsData=" + rsData;
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: $(this).attr('id') + "/tuition.php",
			data: dataString,
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});

	
	$(document).on('click', '.staff_student_view', async function () {

		var member_id = $(this).attr('id');
		var view_ = $(this).attr('lang');

		$.ajax({
			type: "POST",
			url: view_ + "/view.php",
			data: {
				'member_id': member_id
			},
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		return false;

	});

});