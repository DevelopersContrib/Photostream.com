<!-- script type="text/javascript" src="<?=base_url();?>/js/global.js"></script -->

<script type="text/javascript">

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
	
	$.post('/photo/getUnreadNotificationsCount',function(data){
			if(data == 0){
				$('#notifcount').text("Notifications");
			}else{
				$('#notifcount').text('Notifications('+data+')');
				
			}
		});
		
		$.post('/photo/getUnreadNotificatios',function(data){
		if(data == '0'){
			//do nothing..
			$('#notification_list').html("no notifications");
		}else{
			$('#notification_list').html(data);
		}
		});
		
	
	

</script>
<script>

$(document).ready(function(){
		 $('#notifications').click(function(){

				//var userid = $('#user_id').val();
				//alert("test");

				$.post('/photo/setReadNotification',function(data){
					$('#notifcount').text('Notifications');
					
				});



			});
	})


</script>



<div class="subnavbar">



	<div class="subnavbar-inner">

	

		<div class="container">

			

			<a class="btn-subnavbar collapsed" data-toggle="collapse" data-target=".subnav-collapse">

				<i class="icon-reorder"></i>

			</a>



			<div class="subnav-collapse collapse">

				<ul class="mainnav">

				

					<li class="active" id="home_menu">

						<a href="<?=base_url()?>dashboard">

							<i class="icon-home"></i>

							<span>Home</span>

						</a>	    				

					</li>

					

					<li class="dropdown" id="stream_menu">					

						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">

							<i class="icon-th"></i>

							<span>Stream</span>

							<b class="caret"></b>

						</a>	    

					

						<ul class="dropdown-menu">

							<li><a href="<?=base_url()?>stream">View Streams</a></li>

							<li><a href="<?=base_url()?>stream/create">Create Stream</a></li>

							<!-- li><a href="/photos/upload">Upload Photos</a></li -->

						</ul> 				

					</li>

					

					<li class="dropdown" id="fiends_menu">					

						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">

							<i class="icon-copy"></i>

							<span>Friends <? if($current_user_waiting->num_rows()==0){
											echo "";
									}else{
									echo " (".$current_user_waiting->num_rows().")"; }?></span>

							<b class="caret"></b>

						</a>	    

					

						<ul class="dropdown-menu">

							<li><a href="<?=base_url()?>friends">View Friends</a></li>

							<li><a href="<?=base_url()?>friends/search">Search</a></li>

						</ul> 				

					</li>

					

					<li class="dropdown" id="challenge_menu">					

						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">

							<i class="icon-external-link"></i>

							<span>Challenge</span>

							<b class="caret"></b>

						</a>	

					

						<ul class="dropdown-menu">

							<li><a href="<?=base_url()?>challenges">View Challenges</a></li>

							<li><a href="<?=base_url()?>challenges/create">Create Challenge</a></li>

						</ul>    				

					</li>
					
					
					<!---------------------------------------------------------------->
					
						<?	$userid = $this->session->userdata('userid');
								
						if($this->photousers->isAdmin($userid) == 1): ?>
						<li class="dropdown" id="notifications">					

							 <a href="" id="notifications" name="notifications" class="dropdown-toggle" data-toggle="dropdown">

								<i class="icon-globe"></i>
								
								<span id="notifcount"></span>

								<b class="caret"></b>
							</a>	

						
						
							<ul class="dropdown-menu" id="notification_list">

								

							</ul>    				

						</li>
						
						<? endif;?>
					<!---------------------------------------------------------------->

				

				</ul>

			</div> <!-- /.subnav-collapse -->



		</div> <!-- /container -->

	

	</div> <!-- /subnavbar-inner -->



</div> <!-- /subnavbar -->