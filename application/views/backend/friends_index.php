<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<link href="/css/pages/dashboard.css" rel="stylesheet">

<script src="<?=base_url()?>js/plugins/msgGrowl/js/msgGrowl.js"></script>
<script src="<?=base_url()?>js/plugins/lightbox/jquery.lightbox.min.js"></script>
<script src="<?=base_url()?>js/plugins/msgbox/jquery.msgbox.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>js/friends.js"></script>

<div class="main">

    <div class="container">

      <div class="row">
      	
		
		<!-- p>Stream Id <?=$stream_id?></p>
		<p>Public? <?=$is_public?></p -->
      	
		
		<div class="span12">      		
      		
      		<div class="widget stacked ">
      			
      			<div class="widget-header">
      				<i class="icon-group"></i>
      				<h3>Friends</h3>
  				</div> <!-- /widget-header -->
				
				<div class="widget-content" style="min-height:267px;">	
					<div class="tabbable">
					<ul class="nav nav-tabs">
					  <li class="active">
					    <a href="#friends" data-toggle="tab">Friends [<span id="display_all_friends_count"></span>]</a>
					  </li>
					  <li><a href="#added" data-toggle="tab">Added friends [<span id="display_added_friends_count"></span>]</a></li>
					  <li><a href="#waiting" data-toggle="tab">Waiting for Confirmation [<span id="display_waiting_friends_count"></span>]</a></li>
					</ul>
					
					<br>
					
						<div class="tab-content">
							<div class="tab-pane active" id="friends">
								<div id="all_friends_container">
									<? $this->load->view('backend/my_friends'); ?>
								</div>
							</div>
							<div class="tab-pane" id="added">
								<div id="added_friends_container">
									<? $this->load->view('backend/my_added_friends'); ?>
								</div>
							</div>
							<div class="tab-pane" id="waiting">
								<div id="waiting_friends_container">
									<? $this->load->view('backend/my_waiting_friends'); ?>
								</div>
							</div>
						</div><!--- tab-content -->
					</div><!-- tabbable -->
					
				
				</div><!-- widget-content -->
				
			</div><!-- widget stacked -->
		</div><!-- span12 -->
		
      </div> <!-- /row -->

    </div> <!-- /container -->
<input type="hidden" name="all_friends_count" id="all_friends_count" value="<?=$current_user_friends->num_rows()?>" />    
<input type="hidden" name="added_friends_count" id="added_friends_count" value="<?=$current_user_invited->num_rows()?>" />    
<input type="hidden" name="waiting_friends_count" id="waiting_friends_count" value="<?=$current_user_waiting->num_rows()?>" />    
</div> <!-- /main -->
<?php $this->load->view('backend/footer')?>
<script type="text/javascript">
	activateMenu("stream_menu");
</script>