<?php $this->load->view('public/header')?>

<?php $this->load->view('public/navigation')?>

<link href="<?=base_url()?>css/pages/dashboard.css" rel="stylesheet">
<link href="<?=base_url()?>css/photostream.css" rel="stylesheet">
<script src="<?=base_url()?>js/blocksit.min.js"></script>
<script src="<?=base_url()?>js/lovesharecomment.js"></script>
<link href="<?=base_url()?>css/blocksit-style.css" rel="stylesheet" media="screen">
	
<script type="text/javascript">

	activateMenu("stream_menu");

	$(document).ready(function() {
		
		var base_url = $('#base_url').val();
		
		//blocksit define
	$(window).load( function() {
					$('#gallery-container').show();
					$('#gallery-container').BlocksIt({
						numOfCol: 5,
						offsetX: 8,
						offsetY: 8
					});
					
					resize2();
				});
				
				function resize2() {
				 var winWidth = $(window).width();
				 var conWidth;
				if(winWidth < 240) {
				  conWidth = 155;
				  col = 1
				 } else if(winWidth < 320) {
				  conWidth = 230;
				  col = 1
				 } else if(winWidth < 680) {
				  conWidth = 387;
				  col = 1
				 }else if(winWidth < 880) {
				  conWidth = 483;
				  col = 2
				 } else if(winWidth < 1024) {
				  conWidth = 625;
				  col = 3;
				 } else {
				  conWidth = 785;
				  col = 4;
				 }
				 
				 if(conWidth != currentWidth) {
				  currentWidth = conWidth;
				  $('#gallery-container').width(conWidth);
				  $('#gallery-container').BlocksIt({
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
				
		$('#layoutoption').change(function(){
			var layout = $(this).val();
			var stream_id = $('#stream_id').val();
			$('#loading-container').html('<center><br><br><br><img src="'+base_url+'img/loading.gif"></center>');
			
			if(layout=='gallery'){	
				$('#loading-container').html('');
				$('#timeline-container').hide();
				$('#blog-container').hide();
				$('#gallery-container').show('slow');
			}
			else if(layout=='timeline'){					
				$('#gallery-container').hide();					
				$('#blog-container').hide();
				
				$.post(base_url+'photo/timeline',{stream_id:stream_id},function(res){
					$('#loading-container').html('');
					$('#timeline-container').html(res);	
					$('#timeline-container').show('slow');
				});
						
			}
			else if(layout=='blog'){
				$('#gallery-container').hide();
				$('#timeline-container').hide();
				
				$.post(base_url+'photo/blogstyle',{stream_id:stream_id},function(res){
					$('#loading-container').html('');
					$('#blog-container').html(res);	
					$('#blog-container').show('slow');
				});
				
				
			}
		});	
	});
		
</script>


<div class="main">
	  <div class="container">
	  
	  <!-- AddThis Button BEGIN -->
	
	<!-- AddThis Button END -->

      <div class="row">
      
		<div class="span12">      		
      		
      		<div class="widget stacked " style="margin-top:20px">
      			
      			
				
				
						<div class="widget-header" >

						<div class="row-fluid">
							<div class="span12">
								<div class="row-fluid">
									<div class="span12" style="padding:3px 10px 0 10px;">
										<div class="row-fluid">
											<div class="wrap-user-title">
												<b>Four Oh Four...</b>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div> <!-- /widget-header -->
					
							<div class="widget-content" style="min-height:245px">

						<center><img  src = "http://www.beta.photostream.com/img/404.png"/></center>

					</div><!-- widget content -->
				
				
				
			</div><!-- widget stacked -->
		</div><!-- span12 -->
		
      </div> <!-- /row -->

    </div> <!-- /container -->
  
</div> <!-- /main -->
<?php $this->load->view('public/footer')?>   
