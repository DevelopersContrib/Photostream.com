<?php $this->load->view('backend/header')?>

<?php $this->load->view('backend/navigation')?>





<div class="main">



    <div class="container">

      <div class="row">

		<div class="span12">      		

      		

      		<div class="widget stacked ">

      			

      			<div class="widget-header">

      				<i class="icon-pencil"></i>

      				<h3>Notifications</h3>

  				</div> <!-- /widget-header -->

				

				
				<?php

				/* Displays details of GD support on your server */

				/*echo '<div style="margin: 10px;">';

				echo '<p style="color: #444444; font-size: 130%;">GD is ';

				if (function_exists("gd_info")) {

					echo '<span style="color: #00AA00; font-weight: bold;">supported</span> by your server!</p>';

					$gd = gd_info();
						
					foreach ($gd as $k => $v) {

						echo '<div style="width: 340px; border-bottom: 1px solid #DDDDDD; padding: 2px;">';
						echo '<span style="float: left;width: 300px;">' . $k . '</span> ';

						if ($v)
							echo '<span style="color: #00AA00; font-weight: bold;">Yes</span>';
						else
							echo '<span style="color: #EE0000; font-weight: bold;">No</span>';

						echo '<div style="clear:both;"><!-- --></div></div>';
					}

				} else {

					echo '<span style="color: #EE0000; font-weight: bold;">not supported</span> by your server!</p>';

				}

				echo '<p>by <a href="http://www.dagondesign.com">dagondesign.com</a></p>';

				echo '</div>';*/

				?>
				
				
				
				
				<div class="widget-content" style="min-height: 251px;">	

					<?if($notifications->num_rows() > 0):?>
						
							<?foreach($notifications->result() AS $notification):?>
									<li>
										
										 <a href="<?=$notification->url?>" target="_blank">
												<div class="details-msg">
												 <div class="msg-cont">
													  <p class="ellipsis">
															<?echo $notification->message?>
													 </p>
												</div>
											 </div>
										</a>
									</li>		
							<?endforeach;?>
							
					<?else: ?>

						<li class="header-msg">
								<p>You have no new notifications</p>
						</li>

					<?endif;?>
					
					
					
				</div>

				

			</div><!-- widget stacked -->

		</div><!-- span12 -->

		

      </div> <!-- /row -->



    </div> <!-- /container -->

    

</div> <!-- /main -->



<?php $this->load->view('backend/footer')?>    

<script src="./js/libs/jquery-1.8.3.min.js"></script>

<script src="./js/libs/jquery-ui-1.10.0.custom.min.js"></script>

<script src="./js/libs/bootstrap.min.js"></script>




<script type="text/javascript">

	activateMenu("stream_menu");

</script>