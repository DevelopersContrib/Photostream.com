<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<?
if($this->session->userdata('stream_id')=='')
	die('<script type="text/javascript">window.location.href="'.base_url().'stream/create";</script>');
?>

<link href="/css/pages/dashboard.css" rel="stylesheet">
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
				<form id="add_more_form" action="/stream/upload" method="POST" style="margin:0">
						<a onclick="document.getElementById('add_more_form').submit();" class="btn btn-tertiary">
								&nbsp;<i class="icon-long-arrow-left"></i>&nbsp;Back to Socials
						</a>
						<input type="hidden" name="stream_id" id="stream_id" value="<?=$this->session->userdata('stream_id')?>" />
				</form>
				
					<div style="font-size: 17.5px;display:inline-block;height:200px;padding-top:20px;width: 100%;text-align: center;">
						
						<form method="post" onsubmit="return sumbitCheck();" action="<?=base_url()?>pinterest/getphotos" >
					
							<b>Please enter your <a href="http://pinterest.com" target="_blank"><span style="color: rgb(185, 0, 0);">Pinterest</span></a> pins link : </b>
							
							<br>
							<div id="pinwarning">
								<img src="http://cdn1.iconfinder.com/data/icons/silk2/exclamation.png">
								<span id="pinmsg"></span>
							</div>
							<input type="text" id="link" name="link" style="margin: 10px 0 -5px;">
							<br>
							<span style="font-size:11px">( ex. http://pinterest.com/jwmoz/pins )</span>
							<br><br>
							<button type="submit" class="btn btn-primary" id="ubtn">continue</button>
						
						</form>
						
					</div>
					
					<div id="pincontent"></div>

					<script>
						function sumbitCheck(){
							var link = $('#link').val();
							var base_url = $('#base_url').val();
																
							var patt1 = /http:\/\/pinterest.com/i;
							var patt2 = /pins/i;
														
							if(link.match(patt2) && link.match(patt1)){
								return true;
							}else{
								$('#pinwarning').show();
								$('#pinmsg').html(' &nbsp; Invalid Pinterest pins link.');
								return false;
							}	
						}
						
						$(function(){
							$('#username').focus(function(){
								$('#pinwarning').hide();
								$('#pinmsg').html('');
							});
							
						});
					</script>

						
				</div>
				
			</div><!-- widget stacked -->
		
		</div><!-- span12 -->
		
      </div> <!-- /row -->

    </div> <!-- /container -->
    
</div> <!-- /main -->

<link href="./css/photostream.css" rel="stylesheet"> 
<script src="./js/libs/jquery-1.8.3.min.js"></script>
<script src="./js/libs/jquery-ui-1.10.0.custom.min.js"></script>
<script src="./js/libs/bootstrap.min.js"></script>
<script src="./js/blocksit.min.js"></script>
<script type="text/javascript">
	activateMenu("stream_menu");
</script>

<?php $this->load->view('backend/footer')?>  