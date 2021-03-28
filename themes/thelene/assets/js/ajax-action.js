(function($) {
$("#register_action_btn").click(function(e){
	e.defaultPrevent();
	var serialized = jQuery( '#regiter_action_form' ).serialize();
    jQuery.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: ajax_user_register_signup_object.ajaxurl,
        data: serialized,
        success: function(data){
            console.log(data);
            if(typeof(data['user_status']) != "undefined" &&  data['user_status'].length != 0 && data['user_status'] == 'success'){
            }else{
            }
        }
});
})(jQuery);
