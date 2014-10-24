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
					<h3>Services</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">				
					
				<p>PhotoStream.com offers customized consultant systems and solutions for enterprise,
				associations, organizations and networks.<br /><br />
				 We use the latest in web-based platforms, Mobile and application technology to custom build and integrate easy to use,
				 effective and valuable tools for customers. From the 10,000 attorney network to the 10 realtors, we offer a full solution
				 set to help build customer value around their most valuable asset.. their customers.

					<br /><br />
					<a href="<?=base_url()?>/info/contact_us">Contact us</a> today to get a free consultation.</p>					
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
