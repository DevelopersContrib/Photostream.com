<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<link href="/css/pages/dashboard.css" rel="stylesheet">
<script src="<?=base_url()?>js/jquery-latest.pack.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/jcarousellite_1.0.1c4.js" type="text/javascript"></script>
      
<link href="<?=base_url()?>css/photostream.css" rel="stylesheet">
<script src="<?=base_url()?>js/blocksit.min.js"></script>
<link href="<?=base_url()?>css/blocksit-style.css" rel="stylesheet" media="screen">
<script type="text/javascript">
      $(function() {
	$(".newsticker-jcarousellite").jCarouselLite({
		vertical: true,
		hoverPause:true,
		visible: 3,
		auto:500,
		speed:1000
	});
});
</script>

   
<div class="main">

    <div class="container">

      <div class="row">
      	
      	<div class="span3">
      		
      		<div class="widget widget-nopad stacked">
						
				<div class="widget-header">
					<i class="icon-list-alt"></i>
					<h3>News Feed</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					   
					 <div class="newsticker-jcarousellite">
					<ul class="news-items">
					  
					    <? if($updates->num_rows() > 0): ?>
					<? foreach($updates->result() as $update): ?>
			<? $name2 = $this->photousers->getinfobyid('firstname',$update->userid)." ".$this->photousers->getinfobyid('lastname',$update->userid);?>

						<li>
					

							<div class="news-item-detail">																	<div class="row-fluid">
									<div class="row-fluid">
										<div class="span12">
											<div class="span2">
												<img class="recnt-pic" src="<? echo $this->photopics->getinfobyid('filename',$this->photousers->getinfobyid('avatar_id',$update->userid)); ?>"/>
											</div>
											<div class="span10">
												<div class="row-fluid">
													<a href="/<?=$this->photousers->getinfobyid('username',$update->userid)?>"><? echo $name2; ?></a>
												</div>
												<div class="row-fluid">
													<a href="<? echo $update->link; ?>"><p class="news-item-preview"><? echo $update->message; ?></p></a>
													 <span class="meta-date-challenges"><i class="icon-time"></i> 
													 
													 <?php 
													  $datetime = strtotime($update->date);
	                                                  echo date("M d, Y", $datetime);
													?>
													 
													 
													 
													 </span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</li>
						<? endforeach; ?>
						<? endif; ?>

					</ul>
					</div>
					
					
				</div> <!-- /widget-content -->
			
			</div> <!-- /widget -->	
	    </div> <!-- /span6 -->
      	
      	
      <div class="span9">	

      		

      		

      		<div class="widget stacked">

					

				<div class="widget-header">

					<i class="icon-bookmark"></i>

					<h3>Latest Streams</h3>

				</div> <!-- /widget-header -->

				

				<div class="widget-content" id="dashboard_right">

					

						<?if($latest_streams->num_rows() > 0):?>	
						<div id="container">
									<? foreach($latest_streams->result() as $stream): ?>
									<div class="grid">
										<div class="imgholder">
											<a href="/stream/album/<?=$stream->stream_id?>"><img src="<?=$this->photopics->getinfobyid('filename',$stream->cover_pic)?>" /></a>
										</div>
										<strong><?=strip_tags(ucwords($stream->title))?></strong>
										<p class="ellipsis"><?=stripslashes($stream->description)?></p>
										<div class="meta">by <a class="meta" href="/<?=$this->photousers->getinfobyid('username',$stream->userid)?>"><?=$this->photousers->getinfobyid('firstname',$stream->userid)." ".$this->photousers->getinfobyid('lastname',$stream->userid)?></a></div>
									</div>
									<? endforeach; ?>
									
						</div>
						<?else:?>
							<div class="message-warning">
								<span>No streams found. Your query resulted <? var_dump($latest_streams);?></span>
							</div>
						<?endif;?>


				

				</div> <!-- /widget-content -->

				

			</div> <!-- /widget -->

      		

      		

					

					

				      </div> <!-- /span9 -->

      	

      </div> <!-- /row -->



    </div> <!-- /container -->

    

</div> <!-- /main -->
<script type="text/javascript">
	$(document).ready(function() {
				//blocksit define
				$(window).load( function() {
					
					$('#container').BlocksIt({
						numOfCol: 5,
						offsetX: 8,
						offsetY: 8
					});
					
					resize2();
				});
				
				function resize2() {
				 var winWidth = $(window).width();
				 var conWidth;
				if(winWidth < 320) {
				  conWidth = 230;
				  col = 1
				 } else if(winWidth < 680) {
				  conWidth = 387;
				  col = 1
				 }else if(winWidth < 880) {
				  conWidth = 505;
				  col = 2
				 } else if(winWidth < 1024) {
				  conWidth = 670;
				  col = 3;
				 } else {
				  conWidth = 835;
				  col = 4;
				 }
				 
				 if(conWidth != currentWidth) {
				  currentWidth = conWidth;
				  $('#container').width(conWidth);
				  $('#container').BlocksIt({
				   numOfCol: col,
				   offsetX: 8,
				   offsetY: 8
				  });
				 }
				}
				
				//window resize
				var currentWidth = 1100;
				$(window).resize(function(){
					resize2();
				});
				
				
				
			});
</script>
<?php $this->load->view('backend/footer')?>    