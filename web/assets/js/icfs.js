$(function() {
	$(".sponsorimage").click(function(){
		var sponsorid = $(this).attr('data-id');
		$.get("/sponsors/" + sponsorid + "/ajax")
			.success(function(data){
				$("#sponsor_details").html(data)
			})
	})
})