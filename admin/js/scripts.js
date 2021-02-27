$(document).ready(function(){

	// Custom editor
	tinymce.init({
	   selector: '#mytextarea'
	});

	// Bootstrap modal 
	$(".modal_thumbnails").click(function(){
		$("#set_user_image").prop('disabled', false); // making the button active
			let user_href = $("#user-id").prop('href');
			let user_href_splitted = user_href.split("=");
			let user_id = user_href_splitted[user_href_splitted.length - 1];

			let image_src = $(this).prop("src");
			let image_href_splitted = image_src.split("/");
			let image_name = image_href_splitted[image_href_splitted.length - 1];

			$("#set_user_image").click(function(){
			$.ajax({
			url: "includes/ajax_code.php",
			data:{image_name: image_name, user_id:user_id},
			type: "POST",
			success:function(data){
				if(!data.error) {
					alert(data);
				}
			}
		});
	});
	});
});



