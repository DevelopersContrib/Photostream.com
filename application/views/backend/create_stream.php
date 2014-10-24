<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<link href="/css/pages/dashboard.css" rel="stylesheet">

<div class="main">

    <div class="container">

      <div class="row">
      	
      	<div class="span12">
      		
      		<div class="widget stacked">
					
				<div class="widget-header">
					<i class="icon-check"></i>
					<h3>Create a Stream</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					<br />
					
					<form action="<?=base_url()?>stream/upload" method="POST" id="create_stream" class="form-horizontal">
						<fieldset>
						    <div class="control-group">
						      <label class="control-label" for="name">Stream Name</label>
						      <div class="controls">
						        <input type="text" class="input-large" name="name" id="name">
						      </div>
						    </div>
						    
						    <div class="control-group">
						      <label class="control-label" for="message">Description</label>
						      <div class="controls">
						        <textarea class="span4" name="description" id="description" rows="4"></textarea>
						      </div>
						    </div>
						    
						    <div class="control-group">
				            <label class="control-label">&nbsp;</label>
				            <div class="controls">
				              <label class="checkbox">
				                <input type="checkbox" name="show_to_public" id="show_to_public" value="is_public">
				                Show to Public
				              </label>
				              
				              <p class="help-block">
								<strong>Note:</strong> If you choose to set your stream to public, it will become searchable in search engines.</p>
				            </div>
				          </div>
						  
						    <div class="form-actions">
						      <button type="submit" class="btn btn-danger btn">Create</button>&nbsp;&nbsp;
						      <button type="reset" class="btn">Cancel</button>
						    </div>
						  </fieldset>
						</form>
					
				</div> <!-- /widget-content -->
					
			</div> <!-- /widget -->					
			
	    </div> <!-- /span12 --> 
      	
      </div> <!-- /row -->

    </div> <!-- /container -->
    
</div> <!-- /main -->
<script src="<?=base_url();?>js/plugins/validate/jquery.validate.js"></script>
<script src="<?=base_url();?>js/demo/validation.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/create_stream.js"></script> 
<?php $this->load->view('backend/footer')?>    

