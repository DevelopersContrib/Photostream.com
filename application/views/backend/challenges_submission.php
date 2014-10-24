<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<link href="<?=base_url()?>css/pages/dashboard.css" rel="stylesheet">
<script src="<?=base_url()?>js/lovesharecomment.js"></script>
<script type="text/javascript">
	activateMenu("stream_menu");
	
	$(function(){
		$(document).on("click", "#addcomment", function(){ 
			var photoID = $('#photoID').val();
			var userID = $('#userID').val();
			var comment = $('#comment').val();
			var base_url = $('#base_url').val();
			
			if(comment.replace(/ /g, '')=='') 
				alert('empty');
			else{
				$.post(base_url+'photo/addphotocomment',{photoID:photoID,userID:userID,comment:comment},function(res){
					//alert(res);
					if(res=='ok')
						location.reload();
					else 
						alert('something went wrong!');
				});
			}
		}); 
	});
</script>
<style>
.meta-fbstyle-link{text-decoration: none !important;}
</style>
<div class="main">
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="widget stacked">
					<div class="widget-header" >
							<div class="row-fluid">
								<div class="span12">
									<div class="row-fluid">
										<div class="span12" style="padding:3px 10px 0 10px;">
											<div class="row-fluid">
												<div class="wrap-user-title">
                                                                                                        <i class="icon-trophy"></i>
													<strong> <?=$title?></strong>
													</div>
												</div>	
											</div>
										</div>
									</div>
								</div>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
						<?if($challenge_pics->num_rows() > 0):?>
						
					<? foreach($challenge_pics->result() AS $pic): ?>
					
							
							<div class="row-fluid" style="margin-bottom: 20px;">
								<div class="span12">
									<div class="row-fluid">
										<div class="span8">
											<img class="img-polaroid" src="<?=$pic->filename?>" style="width: 98.6%;">
                                                                                       
										</div>
										<div class="span4">
											<div class="row-fluid">
											<div class="span12" style="padding: 3px;">
												<div class="row-fluid">
                                                                                                    
													<div class="span2" style="text-align:center;">
														<span class="meta-blogstyle-date" style="float:left;font-size: 35px;font-weight: 700;padding: 6px 0 0;width: 100%;color: #959595;"><img src="<?=$this->photopics->getinfobyid('filename',$this->photousers->getinfobyid('avatar_id',$pic->userid))?>"></span>
														
														<span class="meta-blogstyle-year" style="float:left;font-size: 9px;font-weight: 700;letter-spacing: 1.5px;padding-top: 0;text-transform: uppercase;width: 100%;color: #959595;"><a href="/<?=$this->photousers->getinfobyid('username',$pic->userid)?>"><?=$this->photousers->getinfobyid('firstname',$pic->userid)?></a></span>
													</div>
													<div class="span10" style="padding-left: 6px;">														
														<div class="row-fluid" style="margin-bottom: 5px;">
															<div style="padding-left: 3px; text-align:center;">
																<h2>&quot; <?=str_replace('_',' ',$pic->caption)?> &quot;</h2>
                                                                                                                                
															</div>
														</div>
														<div class="row-fluid" style="padding-left: 3px; text-align:center;">
															<div style="padding:0 0 3px 10px;display: inline;font-size: 15px;">
																<?=stripslashes(str_replace('_',' ',$pic->description))?>
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
                                                <? else: ?>
                                                <!-- /widget-header -->
				
						<div class="widget-content">
								
								<center><strong>This stream has no content.</strong></center>
						</div>
					<?endif;?>
			
					</div>
		
	
	
				</div>
			</div>
		</div>
	</div>
</div>
					

<?php $this->load->view('backend/footer')?>    

