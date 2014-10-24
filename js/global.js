	function activateMenu(active_menu_now){
		var menu_array = new Array("home_menu","stream_menu","fiends_menu","challenge_menu");
		for(i= 0; i<menu_array.length; i++){
			if(menu_array[i] == active_menu_now){
				$('#'+menu_array[i]).attr('class','dropdown active');
			}else{
				$('#'+menu_array[i]).attr('class','dropdown');
			}
		}
	}