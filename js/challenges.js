var curr_menu = 'challenge_menu';
activateMenu(curr_menu);




$(document).ready(function(){
	var rules = {
		    	rules: {
					caption: {
						minlength: 2,
						required: true
					},
					description: {
						required: true
					},
					selected_photo_url: {
						required: true
					}
				}
		    };
		
	    var validationObj = $.extend (rules, Application.validationRules);
	    
		$('#challenge_details').validate(validationObj);
});