<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<link href="/css/pages/dashboard.css" rel="stylesheet" />
<script src="<?=base_url()?>js/jquery-latest.pack.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/jcarousellite_1.0.1c4.js" type="text/javascript"></script>
      
<link href="<?=base_url()?>css/photostream.css" rel="stylesheet" />
<script src="<?=base_url()?>js/blocksit.min.js"></script>
<link href="<?=base_url()?>css/blocksit-style.css" rel="stylesheet" media="screen" />
<script type="text/javascript" src="<?=base_url()?>js/profile.js"></script>
<link rel="stylesheet" href="<?=base_url();?>css/photostream-add-style.css" />
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
<script type="text/javascript" >
$(function() 
{
$(".delete").click(function(){
var element = $(this);
var I = element.attr("id");
$('li#list'+I).fadeOut('slow', function() {$(this).remove();});		
return false;
});
});



$(function() 
{
$(".add").click(function(){
var element = $(this);
var I = element.attr("id");
var to_add_userid = $('#to_add_userid').val();
		$.post('/friends/add_friend',
		{to_add_userid:to_add_userid},
		function(data){
			if(data == "OK"){
				$('#friendship'+I).html('<p>Waiting for confirmation</p>');
				$('li#list'+I).fadeOut( 1600, function() {$(this).remove();});		
				
			}else{
				$.msgbox("An error occurred: "+data, {type: "error"});
			}
		});
return false;
});
});
</script>
<style type="text/css">
	.wrap-newsFeed{
		background-color: #fff;
		border: 1px solid #CCCCCC;
		height: 300px;
	}
	/*ul style for news feed*/
	#newsFeed-ul > li{
		border-bottom: 1px solid #e7e7e7;
		padding-bottom: 5px;
		padding-top: 5px;
		width: 260px;
	}
	.a-feed,.a-feed:hover{
		text-decoration: none;
	}
	.info-feed{
		color: #333;
	}
</style>
<div class="main">

    <div class="container">

      <div class="row">
      	
      	<div class="span3">
			<div id="loads" class="row-fluid" style="margin-bottom: 20px;">
				<? $this->load->view("backend/dashboard_ticker"); ?>
			</div>
      		<div class="row-fluid">
				
			</div>	
			<div class="row-fluid">
				<div class="widget widget-nopad stacked">
					<div class="widget-header">
						<h3>Suggested Friends</h3>
					</div>
					<div class="widget-content">
<ul id="facebook">
	<? foreach($user_suggest->result() as $suggest): ?>
	<? $profile_userid = $suggest->userid; 
		$isFriends = $this->photofriends->checkIfFriends($user,$profile_userid);
		//echo $isFriends;
		
		$isSelf = 0;
		
		if($user==$profile_userid){
		
			$isSelf = 1;
		
		}else{
			$isSelf = 0;
		}
		
		//echo $isSelf;
		
	?>
	<?if($isFriends == 0 && $isSelf == 0):?>
	<li id="list<?=$suggest->userid?>">
		<img src="<? echo $this->photopics->getinfobyid('filename',$suggest->avatar_id); ?>" style="width:50px;height:50px;"> <span class="del"><a href="" class="delete" title="Remove" id="<?=$suggest->userid?>">x</a></span>
		<a href="/<?=$suggest->username?>" class="user-title"><? echo $suggest->firstname." ".$suggest->lastname?></a>
		<div id="friendship<?=$suggest->userid?>">
		<input type="hidden" name="to_add_userid" id="to_add_userid" value="<?=$profile_userid?>" />
		<span class="addas"><a href="" class="add" id="<?=$suggest->userid?>" title="Add as friend" > <img class="img-icon-fb" src="<?=base_url();?>img/facebook-icons.png"/> Add as Friend</a></span>
		</div>
	</li>
	<? endif; ?>
	<? endforeach; ?>
</ul>
					</div> <!-- /widget-content -->
				</div>
			</div>
			<div class="row-fluid">
				<div class="widget widget-nopad stacked">
					<div class="widget-header">
						<h3>Adsense Tittle</h3>
					</div>
					<div class="widget-content">
						Put here!
					</div> <!-- /widget-content -->
				</div>
			</div>
	    </div> <!-- /span3 -->
      	
      	
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
				
			$('.main').mousemove(function(){
				
			
			
			})
				
				
				
			});
</script>
<?php $this->load->view('backend/footer')?>    