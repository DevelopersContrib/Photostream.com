<?php $this->load->view('public/header')?>
<?php $this->load->view('public/navigation')?>	

<div class="subnavbar">&nbsp;</div>
<div class="main">

    <div class="container">

      <div class="row">
      	
      	<div class="span8">
      		
      		<div class="widget stacked">
					
				<div class="widget-header">
					<i class="icon-pushpin"></i>
					<h3>Contact Us</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">				
					<iframe frameBorder="0" src="http://domaindirectory.com/servicepage/contactus2_form.php?domain=photostream.com" width="500px" height="550px" ></iframe>		
				</div> <!-- /widget-content -->
					
			</div> <!-- /widget -->	
			
	    </div> <!-- /span8 -->
	    
	    
	    
	    <div class="span4">
					
			<? $this->load->view('public/info-right'); ?>
			
		</div> <!-- /span4 -->
      	
      	
      	
      </div> <!-- /row -->

    </div> <!-- /container -->
	    
</div> <!-- /main -->

<?php $this->load->view('public/footer')?>
<script src="/js/msgGrowl.js"></script>
<script src="/js/signup.js"></script>
