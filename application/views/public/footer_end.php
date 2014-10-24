	<?php
	if (@$user_profile){
		$this->load->view('public/footer');
	}
	else{
		echo " ";
	}
	?>	
	
	<?php
		$this->load->view('public/scripts');
	?>
	
</body>
</html>