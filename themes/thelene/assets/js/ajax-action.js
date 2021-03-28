(function($) {
	$("#register_action_btn").click(function(e){
		e.preventDefault();
		var serialized = $( '#regiter_action_form' ).serialize();
	    $.ajax({
	        type: 'POST',
	        dataType: 'JSON',
	        url: ajax_user_register_signup_object.ajaxurl,
	        data: serialized,
	        success: function(data){
	            console.log(data);
	            if(typeof(data['status']) != "undefined" &&  data['status'].length != 0 && data['status'] == 'success'){
                  var successMsg = data['login_success'];
                  $('#regiter_action_form').html('<div class="success-msg"><p>'+successMsg+'</p></div>');
                  function redirect_page(){
                    location.reload();
                  }
                  setTimeout(redirect_page,1000);
	            }else{
	            }
	        }
		});
	});
})(jQuery);
