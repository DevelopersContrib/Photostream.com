<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<link href="/css/pages/dashboard.css" rel="stylesheet" />

<script src="<?=base_url()?>js/plugins/msgGrowl/js/msgGrowl.js"></script>
<script src="<?=base_url()?>js/plugins/lightbox/jquery.lightbox.min.js"></script>
<script src="<?=base_url()?>js/plugins/msgbox/jquery.msgbox.min.js"></script>
<style type="text/css">
	.nav-tabs > .active > a, .nav-tabs > .active > a:hover, .nav-tabs > .active > a:focus{
		color: #555;
		font-weight: bold;
		font-family: 'lucida grande',tahoma,verdana,arial,sans-serif;
	}
	.count{
		font-weight: normal;
		margin-left: 10px;
	}
</style>
<script type="text/javascript" src="<?=base_url()?>js/profile.js"></script>
<div class="main">
	  <div class="container">
	  
      <div class="row">
			<?if(isset($error)):?>
				<div class="span12">
				<div class="widget stacked ">
						<div class="widget-header">
							<i class="icon-camera"></i>
							<h3>4 oh four</h3>
						</div> <!-- /widget-header -->
						<div class="widget-content" style="min-height: 245px;">
							<center><img  src = "http://www.beta.photostream.com/img/404.png"/></center>
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
						<?$this->load->view('backend/profile_user_info');?>
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
									  <li class="active"><a href="#streams_tab" data-toggle="tab">Streams <span class="muted count">(<?=$profile_streams->num_rows()?>)</span> </a></li>
									  <li><a href="#challenge_tab" data-toggle="tab">Challenges <span class="muted count">(<?=$profile_challenges->num_rows()?>)</span></a></li>
									  <li><a href="#friends_tab" data-toggle="tab">Friends <span class="muted count">(<?=$profile_all_friends->num_rows()?>)</span></a></li>
									  <li><a href="#followers_tab" data-toggle="tab">Followers<span class="muted count">(<?=$follower_count?>)</span></a></li>
									  <li><a href="#following_tab" data-toggle="tab">Following<span class="muted count">(<?=$followed_count?>)</span></a></li>
									  
									  
									</ul>
									
								</div><!-- tabbable -->
								
								<div class="tab-content">
									
									<div class="tab-pane active" id="streams_tab">
										<?$this->load->view('backend/profile_streams');?>
									</div><!-- streams_tab -->
									
									<div class="tab-pane" id="challenge_tab">
										<?$this->load->view('backend/profile_challenges');?>
									</div><!-- challenge_tab -->
									
									<div class="tab-pane" id="friends_tab">
										<?$this->load->view('backend/profile_friends');?>
									</div><!-- friends_tab -->
									
									<div class="tab-pane" id="followers_tab">
										<?$this->load->view('backend/profile_followers');?>
									</div>
									
									<div class="tab-pane" id="following_tab">
										<?$this->load->view('backend/profile_following');?>
									</div>
								
								</div><!-- tab-content -->
								
							</div><!-- widget-content -->
						
				</div><!-- widget stacked -->
			</div><!-- span8 -->
		<?endif;?>
	</div><!-- row -->
</div> <!-- /container -->
  
</div> <!-- /main -->
<?php $this->load->view('backend/footer')?>  