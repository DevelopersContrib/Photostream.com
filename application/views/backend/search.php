<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<link href="/css/pages/dashboard.css" rel="stylesheet">
<script type="text/javascript" src="<?=base_url()?>js/global.js"></script>

<link href="<?=base_url()?>css/photostream.css" rel="stylesheet">
<script src="<?=base_url()?>js/blocksit.min.js"></script>
<link href="<?=base_url()?>css/blocksit-style.css" rel="stylesheet" media="screen">

<style type="text/css">
	.friend-search {
margin-bottom: 2em;
text-align: right;
}
	.friend-search input {
width: 96%;
display: block;
padding: 2%;
}
</style>

<div class="main">
<div class="container">
		<div class="row">
			<div class="span6">
				<div class="widget stacked ">
					<div class="widget-header">
								<i class="icon-search"></i>
								<h3>Search Users</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
						<div id="friend-search" class="friend-search">
							<input type="text" name="searched_string" id="searched_string" placeholder="Enter keyword" />
						</div>
						<div id="progress_bar"></div>
					</div><!-- widget content -->
				
				</div><!-- widget stacked -->
				
				
				<div class="widget widget-nopad stacked">
						
				<div class="widget-header">
					<i class="icon-list-alt"></i>
					<h3>Results</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content" id="search_results">
					
					<?=$this->load->view('backend/latestusers')?>
					
				</div> <!-- /widget-content -->
			
			</div> <!-- /widget -->	
				
				
				
			</div><!-- span8 -->
			<div class="span6">
				<div class="widget stacked ">
					<div class="widget-header">
						<i class="icon-list-alt"></i>
						<h3>Latest Streams</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content" id="dashboard_right">
						<?if($latest_streams->num_rows() > 0):?>	
						<div id="container">
									<? foreach($latest_streams->result() as $stream): ?>
									<div class="grid">
										<div class="imgholder">
											<a href="/stream/album/<?=url_title($stream->title)?>/<?=$stream->stream_id?>"><img src="<?=$this->photopics->getinfobyid('filename',$stream->cover_pic)?>" /></a>
										</div>
										<strong><?=strip_tags(ucwords($stream->title))?></strong>
										<p class="ellipsis"><?=stripslashes($stream->description)?></p>
										<div class="meta">by <a class="meta" href="/<?=$this->photousers->getinfobyid('username',$stream->userid)?>"> <?=$this->photousers->getinfobyid('firstname',$stream->userid)." ".$this->photousers->getinfobyid('lastname',$stream->userid)?></a></div>
									</div>
									<? endforeach; ?>
									
						</div>
						<?else:?>
							<div class="message-warning">
								<span>No streams found. Your query resulted <? var_dump($latest_streams);?></span>
							</div>
						<?endif;?>
					</div>
				</div>
			</div><!-- span4 -->
			
		</div><!-- row -->
</div> <!-- /container -->
  
</div> <!-- /main -->

<script type="text/javascript">
	activateMenu('fiends_menu');
	$(document).ready(function(){
	
		/*$(window).load( function() {
				$('#gallery-container').show();
				$('#gallery-container').BlocksIt({
					numOfCol: 2,
					offsetX: 8,
					offsetY: 8
				});
		});*/
		
		
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
				  conWidth = 150;
				  col = 1
				 } else if(winWidth < 680) {
				  conWidth = 387;
				  col = 1
				 }else if(winWidth < 880) {
				  conWidth = 315;
				  col = 1
				 } else if(winWidth < 1024) {
				  conWidth = 425;
				  col = 2;
				 } else {
				  conWidth = 537;
				  col = 2;
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
		
		$('#friend-search input').bind('keypress', function(e) {

			 var search_keyword = $('#searched_string').val();
			 var code = (e.keyCode ? e.keyCode : e.which);
			 
			 if(code == 13) { //Enter keycode
				$('#progress_bar').html('<div class="progress progress-primary progress-striped active"><div class="bar" style="width: 65%"></div></div>');
				$.post('/friends/getresults',{keyword:search_keyword},function(data_html){
					 $('#search_results').html(data_html);
					 $('#progress_bar').html('&nbsp;');
				});
			 }
		});
		
		/*$.post('/dashboard/showLatestStreams',function(data_html){
			$('#dashboard_right').html(data_html);
		});*/
		
	});
</script>
<?php $this->load->view('backend/footer')?>  