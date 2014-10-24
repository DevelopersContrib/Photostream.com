<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<link href="/css/pages/dashboard.css" rel="stylesheet">
<div class="main">

    <div class="container">

      <div class="row">
      	
		
		<!-- p>Stream Id <?=$stream_id?></p>
		<p>Public? <?=$is_public?></p -->
      	
		
		<div class="span12">      		
      		
      		<div class="widget stacked ">
      			
      			<div class="widget-header">
      				<i class="icon-pencil"></i>
      				<h3>Upload Photos to your stream through facebook</h3>
  				</div> <!-- /widget-header -->
				
				<div class="widget-content" style="min-height: 267px;">	
						<form id="add_more_form" action="/stream/upload" method="POST" style="margin:0">
								<a onclick="document.getElementById('add_more_form').submit();" class="btn btn-tertiary">
										&nbsp;<i class="icon-long-arrow-left"></i>&nbsp;Back to Socials
								</a>
								<input type="hidden" name="stream_id" id="stream_id" value="<?=$this->session->userdata('stream_id')?>" />
						</form>
						<center style="padding-top:50px;">
						<h4>Select facebook Album</h4>
						<!--<a href="<?php //echo $logout_url ?>">Logout</a></li>-->
								
								<? $id = $this->session->userdata('stream_id'); ?>
								<form method="post" action="fb_photos/<?=$this->session->userdata('stream_id')?>/<?=url_title($this->photostream->getinfobyid('title',$id))?>">
								<input type="hidden" name="stream_id" id="stream_id" value="<?=$this->session->userdata('stream_id')?>" />
								<select id="albums2" name="albums2" >
								    <? foreach( $albums['data'] as $albums['id']=>$val )
								    {
									echo"<option value =".$val['id'].">".$val['name']."</option>";
								    }?>
								</select>
								
								</br>
								<button type="submit" value="select album" class="button btn btn-warning btn-medium">Select</button>
								</form>
								</center>
							
						
						
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