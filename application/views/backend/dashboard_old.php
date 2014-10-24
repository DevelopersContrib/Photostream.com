<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<link href="/css/pages/dashboard.css" rel="stylesheet">
<script src="<?=base_url()?>js/jquery-latest.pack.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/jcarousellite_1.0.1c4.js" type="text/javascript"></script>
      
<link href="<?=base_url()?>css/photostream.css" rel="stylesheet">
<script src="<?=base_url()?>js/blocksit.min.js"></script>

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

					

					<div class="progress progress-secondary progress-striped active">

						<div class="bar" style="width: 70%"></div> <!-- /.bar -->				

					</div> <!-- /.progress -->	

					

					<div class="message-info"><span>Loading Updates</span></div>

				

				</div> <!-- /widget-content -->

				

			</div> <!-- /widget -->

      		

      		

					

					

				      </div> <!-- /span9 -->

      	

      </div> <!-- /row -->



    </div> <!-- /container -->

    

</div> <!-- /main -->
<script type="text/javascript">
	$(function(){
		$(window).load( function() {
				$('#gallery-container').show();
				$('#gallery-container').BlocksIt({
					numOfCol: 2,
					offsetX: 8,
					offsetY: 8
				});
		});
	
		$.post('/dashboard/showLatestStreams',function(data_html){
			$('#dashboard_right').html(data_html);
		});
	});
</script>
<?php $this->load->view('backend/footer')?>    