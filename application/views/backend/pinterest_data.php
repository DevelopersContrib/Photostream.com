<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation-socials')?>

<link href="<?=base_url()?>css/pages/dashboard.css" rel="stylesheet">
<link href="<?=base_url()?>css/blocksit-style.css" rel="stylesheet" media="screen">
<style>
            .blurbckgnd{
                background-color: none;
            }
            .grid.blurbckgnd >.imgholder >.ps-label > img{
				opacity:0.5;
                transition: opacity 0.4s ease-in-out 0s;
            }
			 .grid >.imgholder >.ps-label > img:hover{
				opacity:0.8;
			 }
</style>


<div class="main">

    <div class="container">

      <div class="row">
      
		<div class="span12">      		
      		
      		<div class="widget stacked ">
      			
      			<div class="widget-header">
      				<i class="icon-pencil"></i>
      				<h3>Import from Pinterest</h3>
  				</div> <!-- /widget-header -->
				
				<div class="widget-content">
				
						<input type="hidden" name="stream_id" id="stream_id" value="<?=$this->session->userdata('stream_id')?>" />
						<input type="hidden" name="stream_name" id="stream_name" value="<?=$this->photostream->getinfobyid('title',$this->session->userdata('stream_id'))?>" />
						<input type="hidden" name="conter" id = "counter" value="" />
						<? $id = $this->session->userdata('stream_id'); ?>
						<div style="width:100%;margin-bottom: 20px;">
							<div style=" text-align: left; display: inline-block; width: 50%;">
								<span style="font-size: 25px;">Photo Pins from Pinterest </span><br>
								<span> (Select a photo to add to PhotoStream)</span>
							</div>
							<div style=" text-align: right; display: inline-block; width: 49%;">
							<form id="add_more_form" action="/stream/upload" method="POST" style="margin:0">
								<a onclick="document.getElementById('add_more_form').submit();" class="btn btn-tertiary">
										&nbsp;<i class="icon-long-arrow-left"></i>&nbsp;Back to Socials
								</a>
								<input type="hidden" name="stream_id" id="stream_id" value="<?=$this->session->userdata('stream_id')?>" />
								<a href="<?=base_url()?>stream/album/<?=url_title($this->photostream->getinfobyid('title',$id))?>/<?=$this->session->userdata('stream_id')?>" class="btn btn-tertiary">
										&nbsp;<i class="icon-picture"></i>&nbsp;View Streams
								</a>
							</form>
							</div>
						</div>
				
					<div id="container" style="display:none;width:100%">
						<? date_default_timezone_set('UTC'); $i=0; $x= date("l, F d, Y " ,time());; ?>
						<? if($photos){?>
							<?foreach($photos as $pin){?>
								<div class="grid" id="<?=$i?>">
									<!--<div class="photohover" id="hover<?//=$i?>"><img src="<?//=base_url()?>img/plus.png"><b>&nbsp; Add to PhotoStream</b></div>-->
									<div class="imgholder">
										<label class="ps-label" for="pin<?=$i?>">
										<img id="img<?=$i?>" src="<?=$pin['url']?>" alt="<?=(str_replace(' ','',$pin['title'])!='')?$pin['title']:'Pinterest '.$i.' '.date('Ymd His')?>" />
										</label>
									</div>
									<div class="meta"><?=(str_replace(' ','',$pin['title'])!='')?$pin['title']:'Pinterest '.$i.' '.date('Ymd His')?></div>
									<input id="pin<?=$i?>" class="check" name="checkupload" id="checkupload" type="checkbox" value="<?=$pin['url']?>" />
								</div>
								<? $i++; ?>
							<? } ?>
						<? } ?>
						
					</div>
					
					 <button type="submit" class="btn btn-danger btn" id="addstream" name="addstream">Add to Stream</button>&nbsp;&nbsp;
					 <button class="btn btn-success" id="selectall" name="selectall">Select All</button>&nbsp;&nbsp;
				     <button type="reset" class="btn" id="diselectall" name="diselectall">Cancel</button>

		
				</div>
				
			</div><!-- widget stacked -->
		
		</div><!-- span12 -->
		
      </div> <!-- /row -->

    </div> <!-- /container -->
    
</div> <!-- /main -->


<link href="<?=base_url()?>css/photostream.css" rel="stylesheet"> 
<script src="<?=base_url()?>js/libs/jquery-1.8.3.min.js"></script>
<script src="<?=base_url()?>js/libs/jquery-ui-1.10.0.custom.min.js"></script>
<script src="<?=base_url()?>js/libs/bootstrap.min.js"></script>
<script src="<?=base_url()?>js/blocksit.min.js"></script>
<script type="text/javascript">
/*	activateMenu("stream_menu");

	//blocksit define
	$(window).load( function() {
		$('#gallery-container').BlocksIt({
			numOfCol: 5,
			offsetX: 8,
			offsetY: 8
		});
		
		var pinterestphotos = $('#gallery-container').children('div');
							
		$.each(pinterestphotos,function(key,value){
								
			var gridID = $(value).attr('id');
			var gridH = $('#'+gridID).height();
			var gridW  = $('#'+gridID).width();
					
			$('#hover'+gridID).css('width',Math.round(gridW)+30);
			$('#hover'+gridID).css('height',(Math.round(gridH)/2)+30);
			$('#hover'+gridID).css('padding-top',(Math.round(gridH)/2));
			$('#hover'+gridID).css('margin-bottom',-1*(Math.round(gridH)+15));
								
		});
							
		$(".gallery-grid").mouseenter(function(){
			var gridID = $(this).attr('id');
			$('#hover'+gridID).show();
		}).mouseleave(function(){
			var gridID = $(this).attr('id');
			$('#hover'+gridID).hide();
		});
		
		$('.photohover').click(function(){
			var id = $(this).attr('id');
			id = id.replace('hover','');
			var url = $('#img'+id).attr('src');
			var title = $('#img'+id).attr('alt');
			
			var stream_id = $('#stream_id').val();
			var base_url = $('#base_url').val();
								
			$.post(base_url+'stream/upload_fb_photos',{url:url,title:title,stream_id:stream_id},function(res){
									
				if(res=='OK'){
					$('#'+id).hide();
				}else{
					alert('Oh! Crap! Something went wrong!');
				}
			});
			
		});
	});*/
</script>




<script type="text/javascript">
	activateMenu("stream_menu");
	
	$(document).ready(function() {	
		
		$('.albumpics').hover(
			function(){
				$(this).css('background','rgba(0, 0, 0,.5)');
			},
			function(){
				$(this).css('background','none');
			}
		);
	
		//blocksit define
		$(window).load( function() {
				$('#container').show();
					$('#container').BlocksIt({
						numOfCol: 5,
						offsetX: 8,
						offsetY: 8
					});
					
				resize2();
		
		
			var pinterestphotos = $('#container').children('div');
								
			$.each(pinterestphotos,function(key,value){
				console.log(value);					
				var gridID = $(value).attr('id');
				var gridH = $('#'+gridID).height();
				var gridW  = $('#'+gridID).width();
				
					
				$('#hover'+gridID).css('width',Math.round(gridW)+30);
				$('#hover'+gridID).css('height',(Math.round(gridH)/2)+40);
				$('#hover'+gridID).css('padding-top',(Math.round(gridH)/2)-40);
				$('#hover'+gridID).css('margin-bottom',-1*(Math.round(gridH)-15));
			});						
		});
		
		function resize2() {
				 var winWidth = $(window).width();
				 var conWidth;
				if(winWidth < 240) {
					  conWidth = 149;
					  col = 1
					 }else if(winWidth < 320) {
					  conWidth = 230;
					  col = 1
					 } else if(winWidth < 680) {
					  conWidth = 387;
					  col = 1
					 }else if(winWidth < 880) {
					  conWidth = 690;
					  col = 3
					 } else if(winWidth < 1024) {
					  conWidth = 907;
					  col = 4;
					 } else {
					  conWidth = 1136;
					  col = 5;
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
		
							
		$(".grid").mouseenter(function(){
			var gridID = $(this).attr('id');
			$('#hover'+gridID).show();
		}).mouseleave(function(){
			var gridID = $(this).attr('id');
			$('#hover'+gridID).hide();
		});
		
	});
	
	/*$('.imgholder').click(function(){
	
		
		$(this).css('opacity','0.5');
		$(this).css('transition','opacity 0.4s ease-in-out 0s');
		//alert('test');
		
		
	
	})*/
	
	$('input[type="checkbox"][name="checkupload"]').change(function() {
		if($(this).is(':checked')){
			$(this).parent().addClass("blurbckgnd");
			
		}else{
			
			$(this).parent().removeClass("blurbckgnd");
			
		}
	});
	
	$('#addstream').click(function(){
	
		var stream_id =  $('#stream_id').val();
		var stream_name = $('#stream_name').val();
		var url = '';
		var selected_pics = [];
		var counter = $('#counter').val();
		$("input:checkbox[name=checkupload]:checked").each(function(){
			url = $(this).val();
			selected_pics.push(url);
		});
		
		
		if(selected_pics.length <= 0){
				alert("no image selected");
			}else{
				
				$.post('/stream/save_pinterest_pics',{selected_pics:selected_pics,counter:counter},function(data){
					
						window.location.replace("/stream/album/"+stream_name+"/"+stream_id);
					
				});
				
			}
		
		
		
		//$.post('/stream/save_facebook_pics',{selected_pics:selected_pics});
	
	})
	
	$('#selectall').click(function(){
		 $('input:checkbox').attr('checked', true);
		 $('.grid').addClass('blurbckgnd');
		 var n = $( "input:checked" ).length;
		 $( "#counter" ).val( n );
		
	})
	
	$('#diselectall').click(function(){
		$('input:checkbox').attr('checked',false);
		$('.grid').removeClass('blurbckgnd');
		var n = $( "input:checked" ).length;
		 $( "#counter" ).val( n );
	})
	
	
	
	var countChecked = function() {
	var n = $( "input:checked" ).length;
	$( "#counter" ).val( n );
	};
	countChecked();
	$( "input[type=checkbox]" ).on( "click", countChecked );
	
	
	
	
	
	
</script>
					
<?php $this->load->view('backend/footer')?>  
