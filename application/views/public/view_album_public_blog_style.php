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
													<h3 style="font-size: 25px;"><?=$stream_title?></h3>
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
							
						<?foreach($album_pics->result() AS $pic):?>
							<div class="row-fluid" style="margin-bottom: 20px;">
								<div class="span12">
									<div class="row-fluid">
										<div class="span8">
											<img class="img-polaroid" src="<?=$pic->filename?>" style="width: 98.6%;"/>
										</div>
										<div class="span4">
											<div class="row-fluid">
											<div class="span12" style="padding: 3px;">
												<div class="row-fluid">
													<div class="span2">
														<span class="meta-blogstyle-date" style="float:left;font-size: 35px;font-weight: 700;padding: 6px 0 0;width: 100%;color: #959595;">17</span>
														
														<span class="meta-blogstyle-year" style="float:left;font-size: 9px;font-weight: 700;letter-spacing: 1.5px;padding-top: 0;text-transform: uppercase;width: 100%;padding-left: 5px;color: #959595;">06/13</span>
													</div>
													<div class="span10" style="padding-left: 6px;">
														<div class="row-fluid">
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
												<div class="row-fluid" style="border-top: 1px solid #e9e9e9;">
													<span><p style="text-align: justify; color: #000; font-size: 13px;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum.</p></span>
												</div>
												<div class="row-fluid" style="margin-top: 20px;">
													<div class="row-fluid" style="background-color: #EDEFF4; border-radius: 2px; margin: 5px 0 5px 0;">
														<div class="span12" style="padding: 4px;">
															<div class="span1">
																<img src="http://i.cdn.turner.com/cnn/.element/img/2.0/sect/connect/avatar.gif" />
															</div>
															<div class="span11">
																<span><a href="#" style="color: #3B5998;"><strong>Jeiseun Slow</strong></a><p style="text-align: left; color: #000; font-size: 13px;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum.</p></span>
																<div class="row-fluid">
																	<span><p style="font-size: 11px;color: #868a97;">June 18 at 2:22pm</p></span>
																</div>
															</div>
														</div>
													</div>
													<div class="row-fluid">
														<div class="span12">
															<div class="span1" style="margin: 2px 0 2px 0;">
																<img src="http://i.cdn.turner.com/cnn/.element/img/2.0/sect/connect/avatar.gif" />
															</div>
															<div class="span11">
																<form>
																	<div class="controls">
																		<textarea class="input-block-level" rows="2" placeholder="Write a comment..."></textarea>
																	</div>
																	<div class="controls">
																		<button class="btn btn-primary btn-small">Submit</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</div>
											</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?endforeach;?>

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