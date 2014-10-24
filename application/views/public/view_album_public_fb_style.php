<?php $this->load->view('public/header')?>

<?php $this->load->view('public/navigation')?>

<link href="/css/pages/dashboard.css" rel="stylesheet">


<div class="main">

	  <div class="container">



      <div class="row">

      

		<div class="span12">      		

      		

      		<div class="widget stacked ">

					

				<?if($album_pics->num_rows() > 0):?>

					<div class="widget-header">

						<div class="row-fluid">
							<div class="span12">
								<div class="row-fluid">
									<div class="span12" style="padding:3px 10px 0 10px;">
										<div class="row-fluid">
											<div class="wrap-user-title">
												<img class="fbstyle-img" src="http://i.cdn.turner.com/cnn/.element/img/2.0/sect/connect/avatar.gif"/>
												<div class="meta-wrap-title">
													<h3 class="meta-fbstyle-title"><?=$stream_title?></h3>
													<p class="meta-date">Date publish</p>
												</div>
											</div>	
										</div>
									</div>
								</div>
								<div class="row-fluid" style="width: 95%; padding:0 10px 0 10px;margin-top:-10px;">
									<p class="gallery-desc"><?=stripslashes($stream_description)?></p>
								</div>
							</div>
						</div>
						
					</div> <!-- /widget-header -->
					
					
					
					<div class="widget-content">
						<div class="row-fluid">
						<div class="span12">
							<div class="row_fluid">
								<div class="span4 fbstyle-side-content" style="margin:0;margin-top: 10px;">
									<div class="row-fluid">
										<div class="wrap-side-nav">
											<div class="side-header">
												<h4 class="side-title">ABOUT</h4>
											</div>
											<div style="clear: both;"></div>
											<div class="side-user-info">
												<div class="row-fluid">
													<div class="span12" style="margin: auto">
														<div class="span12 side-brdrbtm">
															<div class="row-fluid">
																<div class="span1" style="margin: 0;">
																	<i class="icon-briefcase"></i>
																</div>
																<div class="span11" style="margin:0;">
																	<p class="side-work">
																		Web Developer and HTML/CSS Developer at zipsite.net 
																	</p>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row-fluid">
													<div class="span12" style="margin: auto">
														<div class="span12 side-brdrbtm">
															<div class="row-fluid">
																<div class="span1" style="margin: 0;">
																	<i class="icon-book"></i>
																</div>
																<div class="span11" style="margin:0;">
																	<p class="side-work">
																		Studied Information Technology Major in Software Engineering at University of the Immaculate Conception
																	</p>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row-fluid">
													<div class="span12" style="margin: auto">
														<div class="span12 side-brdrbtm">
															<div class="row-fluid">
																<div class="span1" style="margin: 0;">
																	<i class="icon-home"></i>
																</div>
																<div class="span11" style="margin:0;">
																	<p class="side-work">
																		Lives in Davao City
																	</p>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row-fluid">
													<div class="span12" style="margin: auto">
														<div class="span12">
															<div class="row-fluid">
																<div class="span1" style="margin: 0;">
																	<i class="icon-heart"></i>
																</div>
																<div class="span11" style="margin:0;">
																	<p class="side-work">
																		Followed by 122 people
																	</p>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>							
										</div>
										<div class="wrap-side-nav">
											<div class="side-header">
												<h4 class="side-title">RECENT ACTIVITY</h4>
											</div>
											<div style="clear: both;"></div>
											<div class="side-user-info">
												<div class="row-fluid">
													<div class="span12" style="margin:auto;">
														<div class="span12 side-brdrbtm">
															<div class="row-fluid">
																<div class="span2" style="margin: 0;">
																	<div class="row-fluid">
																		<img src="http://i.cdn.turner.com/cnn/.element/img/2.0/sect/connect/avatar.gif" />
																	</div>
																</div>
																<div class="span10" style="margin:0;">
																	<div class="row-fluid">
																		<p class="side-activity">Jeiseun followed iPhone 5.</p>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row-fluid">
													<div class="span12" style="margin:auto;">
														<div class="span12 side-brdrbtm">
															<div class="row-fluid">
																<div class="span2" style="margin: 0;">
																	<img src="http://i.cdn.turner.com/cnn/.element/img/2.0/sect/connect/avatar.gif" />
																</div>
																<div class="span10" style="margin:0;">
																	<p class="side-activity">Jeiseun shared the photo iPhone 5.</p>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row-fluid">
													<div class="span12" style="margin:auto;">
														<div class="span12">
															<div class="row-fluid">
																<div class="span2" style="margin: 0;">
																	<img src="http://i.cdn.turner.com/cnn/.element/img/2.0/sect/connect/avatar.gif" />
																</div>
																<div class="span10" style="margin:0;">
																	<p class="side-activity">Jeiseun loved the photos iPhone 5.</p>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="span8 fbstyle-mid-content" style="margin:0;">
									<?foreach($album_pics->result() AS $pic):?>
										<div class="fbstyl-brdrtop" style="margin-bottom: 10px;">
											<div class="fbstyle-box">
												<div class="row-fluid">
													<div class="span12">
														<div class="span1">
															<img class="fbstyle-img" src="http://i.cdn.turner.com/cnn/.element/img/2.0/sect/connect/avatar.gif"/>
														</div>
														<div class="span11" style="padding-top: 3px;">
																<div class="row-fluid">
																	<a href="#" class="fbstyle-user-name"><strong>Jeiseun Slow</strong></a> — <span class="meta-fbstyle-addphts">added a photos. </span><span class="meta-fbstyle-hours"> 21 hours ago</span>
																<span>
																	<p class="meta-fbstyle-desc">
																	God has a prefect plan for each and everyone. Most of the time we dwell on the past not knowing what lies ahead of us but if we are patient enough, you will then realize that the best is yet to come.
																	</p>
																</span>
																</div>
														</div>
													</div>
												</div>
												<div class="row-fluid">
													<img class="img-polaroid fb-content-img" src="<?=$pic->filename?>" />
												</div>
												<div class="row-fluid" style="border-bottom: 1px solid #e9e9e9;">
													<div style="padding-left: 3px;">
														<span><a href="#" class="meta-fbstyle-link">Love</a></span>
														<span style="font-size: 12px; font-weight: bold; color: #ccc;">·</span>
														<span><a href="#" class="meta-fbstyle-link">Share</a></span>
													</div>
												</div>
												<div class="row-fluid" style="margin-bottom: 5px;">
													<div style="padding-left: 3px;">
														<span class="meta-fbstyle-text">
															<a href="#" class="meta-fbstyle-link">4 people</a> love this.
														</span>
														and
														<span class="meta-fbstyle-text">
															<a href="#" class="meta-fbstyle-link">6 people</a> share this.
															</span>
													</div>
												</div>
											</div>
										</div>
									<?endforeach;?>
								</div>
							</div>
						</div>
						</div>
					</div><!-- widget content -->

				<?else:?>

					<div class="widget-header">

						<i class="icon-camera"></i>

						<h3>Stream Not Found</h3>

					</div> <!-- /widget-header -->

					

					<div class="widget-content">

						<p>This stream has no content</p>

					</div><!-- widget content -->

				<?endif;?>

				

				

			</div><!-- widget stacked -->

		</div><!-- span12 -->

		

      </div> <!-- /row -->



    </div> <!-- /container -->

  

</div> <!-- /main -->

<?php $this->load->view('public/footer')?>