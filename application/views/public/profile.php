<?php $this->load->view('public/header')?>
<?php $this->load->view('public/navigation')?>
<link href="/css/pages/dashboard.css" rel="stylesheet">
<div class="main">
	  <div class="container">

      <div class="row">
			<?if(isset($error)):?>
				<div class="span12">
				<div class="widget stacked " style="margin-top:20px">
						<div class="widget-header">
							<i class="icon-camera"></i>
							<h3>4 oh four</h3>
						</div> <!-- /widget-header -->
						<div class="widget-content" style="min-height:245px">
							<?echo $error?>
						</div><!-- widget-content -->
				</div><!-- widget stacked -->
			</div><!-- span12 -->
		<?else:?>
			<div class="span4">
				<div class="widget stacked ">
					<div class="widget-header">
								<i class="icon-book"></i>
								<h3><?echo $profile_fullname?></h3>
					</div> <!-- /widget-header -->
					<div class="widget-content">
						<?$this->load->view('public/profile_user_info');?>
					</div><!-- widget content -->
				</div><!-- widget stacked -->
			</div><!-- span4 -->
			
			<div class="span8">      			
				<div class="widget stacked ">
							<div class="widget-header">
								<i class="icon-star"></i>
								<h3>PhotoStream Activities</h3>
							</div> <!-- /widget-header -->
							<div class="widget-content">
								
								<div class="tabbable">
									<ul class="nav nav-tabs">
									  <li class="active"><a href="#streams_tab" data-toggle="tab">Streams [&nbsp;<?=$profile_streams->num_rows()?>&nbsp;]</a></li>
									  <li><a href="#challenge_tab" data-toggle="tab">Challenges [&nbsp;<?=$profile_challenges->num_rows()?>&nbsp;]</a></li>
									  <li><a href="#friends_tab" data-toggle="tab">Friends [&nbsp;<?=$profile_all_friends->num_rows()?>&nbsp;]</a></li>
									</ul>
									
								</div><!-- tabbable -->
								
								<div class="tab-content">
									
									<div class="tab-pane active" id="streams_tab">
										<?$this->load->view('public/profile_streams');?>
									</div><!-- streams_tab -->
									
									<div class="tab-pane" id="challenge_tab">
										<?$this->load->view('public/profile_challenges');?>
									</div><!-- challenge_tab -->
									
									<div class="tab-pane" id="friends_tab">
										<?$this->load->view('public/profile_friends');?>
									</div><!-- friends_tab -->
								
								</div><!-- tab-content -->
								
							</div><!-- widget-content -->
						
				</div><!-- widget stacked -->
			</div><!-- span8 -->
		<?endif;?>
	</div><!-- row -->
</div> <!-- /container -->
  
</div> <!-- /main -->
<?php $this->load->view('public/footer')?>  