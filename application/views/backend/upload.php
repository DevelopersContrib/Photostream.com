<?php $this->load->view('backend/header')?>

<?php $this->load->view('backend/navigation')?>

<link href="/css/pages/dashboard.css" rel="stylesheet" />
<link href="/css/custom.css" rel="stylesheet" />

<div class="main">



    <div class="container">



      <div class="row">

      	

		

		<!-- p>Stream Id <?=$stream_id?></p>

		<p>Public? <?=$is_public?></p -->

      	

		

		<div class="span12">      		

      		

      		<div class="widget stacked ">

      			

      			<div class="widget-header">

      				<i class="icon-pencil"></i>

      				<h3>Upload Photos to your stream <?=$stream_title?></h3>

  				</div> <!-- /widget-header -->

				

				<div class="widget-content" style="min-height: 251px;">	

						<? //echo $stream_id; ?>
						
						<div class="row-fluid" style="text-align: center;padding-top: 45px;">
							<h4>Select social network to import from</h4>
							<div class="row-fluid">
								<ul class="inline">
									<li>
										<?php echo anchor($this->instagram_api->instagramLogin(), img(array('src'=>'http://d2qcctj8epnr7y.cloudfront.net/sheina/photostream/insta-round.png','class'=>'upload-social-network','alt'=>'Login through instagram'))); ?>
									</li>
									<li>
										<?php echo anchor($this->facebook->getLoginUrl(array('scope' => 'user_photos','redirect_uri'=>'http://www.photostream.com/stream/facebook_photos')), img(array('src' => 'http://d2qcctj8epnr7y.cloudfront.net/sheina/photostream/facebook.png','class'=>'upload-social-network','alt'=>'Login through facebook'))); ?>
									</li>
									<li>
										<a class="upload-social-network" href="<?=base_url()?>pinterest"><img src="http://d2qcctj8epnr7y.cloudfront.net/sheina/photostream/pinterest.png" /></a>
									</li>
									<li>
										<a class="upload-social-network" href="<?=base_url()?>stream/twitter_redirect"><img src="http://d2qcctj8epnr7y.cloudfront.net/sheina/photostream/twitter.png" /></a>
									</li>
									<li>
										<a class="upload-social-network" href="<?=base_url()?>googleplus"><img src="http://d2qcctj8epnr7y.cloudfront.net/sheina/photostream/google_plus.png" /></a>
									</li>
									<li>
										<a class="upload-social-network" href="https://api.flickr.com/services/auth/?api_key=d6c0d7b8d5de76bf23aabaada770a5f2&perms=read&api_sig=4ffad08729599fd1a023a7e34b42e267"><img src="<?=base_url()?>img/flickr.png" /></a>
									</li>
									<? 
									$userid = $this->session->userdata('userid');
									if($this->photousers->isAdmin($userid) == 1): ?>
									<li>
										<a class="upload-social-network" href="<?=base_url()?>photo/uploadfromfile/<?=$stream_id?>"><i class="icon-file-text" alt="upload_csv" style="font-size:86px; line-height:60px; color:#0088CC"></i></a>
									</li>
									<?
										endif;
									?>
								</ul>
							</div>
						</div>
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