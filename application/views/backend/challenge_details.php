<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<link href="/css/pages/dashboard.css" rel="stylesheet">
<script src="<?=base_url();?>js/plugins/validate/jquery.validate.js"></script>
<script src="<?=base_url();?>js/demo/validation.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/challenge_details.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/create_challenge.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/global.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/challenges.js"></script>
<style type="text/css">
	.hover{background-color:orange;}
</style>
<div class="main">

    <div class="container">

      <div class="row">
      
		<div class="span8">      		
      		
      		<div class="widget stacked ">
      			
      			<div class="widget-header">
      				<i class="icon-trophy"></i>
      				<h3><?=$title?></h3>
  				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					<p><a><strong><?=$title?></strong></a></p>
					<p><?=$description?></p>
					<p><?=$date_posted?></p>
					<br /><br />
					<?if($status == 0 && $show_join_btn == 1 ):?>
						<div id="challengesubmitform"  style="display:none">
							<form method = "POST" action="<?=base_url()?>challenges/savesubmit/<?=$challenge_id;?>" class="form-horizontal" id="challenge_details" name="challenge_details">
								<fieldset>
									<div class="control-group">
									  <label class="control-label" for="name">Select from stream</label>
									  <div class="controls">
										<a id="showSelectFromStream" data-toggle="modal" href="#StreamDialog" >Open Streams</a>
									  </div>
									</div>
									
									<div class="control-group">
									  <label class="control-label" for="name">Preview</label>
									  <div class="controls">
										<div id="preview_image"><p>No Image Selected</div>
										<input type="hidden" id="selected_photo_url" name="selected_photo_url" value="" />
									  </div>
									</div>
									
									<div class="control-group">
									  <label class="control-label" for="name">Caption</label>
									  <div class="controls">
										<input type="text" class="input-large" id="caption" name="caption" value="" />
									  </div>
									</div>
									
									<div class="control-group">
									  <label class="control-label" for="message">Description</label>
									  <div class="controls">
										<textarea class="span4" name="description" id="description" rows="4"></textarea>
									  </div>
									</div>

									 <div class="form-actions">
										<input type="hidden" name="challenge_id" id="challenge_id" value="<?=$challenge_id?>"/>
										<button type="submit" class="btn btn-danger btn">Submit</button>&nbsp;&nbsp;
										<button type="reset" class="btn">Cancel</button>
									</div>

								</fieldset>
							</form>

						</div>				
						<a href="javascript:;" id="submitbtn" class="btn btn-large btn-primary">Submit your entry!</a>	
					<?else:?>
						<?if($status == 1):?>
							<p class="generalNotif">This challenge is closed</p>	
						<?endif;?>
					<?endif;?>
					<? if($challenge_submissions->num_rows()==0): ?>
					<a href="#" class="btn btn-large btn-tertiary">View Submissions [&nbsp;<?=$challenge_submissions->num_rows()?>&nbsp;]</a>
					<? else: ?>
					<a href="<?=base_url()?>challenges/viewsubmission/<?=$challenge_id;?>" class="btn btn-large btn-tertiary">View Submissions [&nbsp;<?=$challenge_submissions->num_rows()?>&nbsp;]</a>
					<? endif; ?>
					
				</div><!-- widget content -->
				
			</div><!-- widget stacked -->
		</div><!-- span12 -->
		
		<div class="span4">
			<div class="widget stacked ">
				<div class="widget-header">
      				
      				<h3><i class="icon-trophy" style="margin-left: 5px;margin-right: 5px;"></i> <?=$title?></h3>
  				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					<p>Posted by:</p>
					<ul class="gallery-container">
						<li>
							<img src="<?=$poster_avatar_url?>" />
							<p><?=$poster_fullname?></p>
						</li>
					</ul>
				</div>
			</div>
		</div>
		
      </div> <!-- /row -->

    </div> <!-- /container -->
    
</div> <!-- /main -->
<div id="StreamDialog" class="modal fade hide" >

	<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h3>Select from Streams</h3>
  </div>
  <div class="modal-body" id="myStreams">
    <p class="generalNotif">Fetching data</p>
	<div class="progress progress-primary progress-striped active">
						<div class="bar" style="width: 25%"></div> <!-- /.bar -->				
	</div> <!-- /.progress -->
  </div>
  
  <div class="modal-footer">
    <a href="javascript:;" class="btn" data-dismiss="modal">Close</a>
  </div>
	
</div>
<?php $this->load->view('backend/footer')?>

