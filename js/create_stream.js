$(document).ready(function(){	
	var rules = {
		    	rules: {
					name: {
						minlength: 2,
						required: true
					},
					description: {
						required: true,
					}
				}
		    };
		
	    var validationObj = $.extend (rules, Application.validationRules);
	    
		$('#create_stream').validate(validationObj);
		

		$('#create_stream').submit(function(event){
			//event.preventDefault(); // prevent from submitting
				var name = $('#name').val();
				var description = $('#description').val();
				
				if(name == "" || name.match(/^\s*$/)){
					return false;
					
				}else if(description == "" || description.match(/^\s*$/)){
					return false;
					
				}else{
					return true;
				}
		});
		
});

activateMenu("stream_menu");