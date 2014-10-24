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
					<h3>About PhotoStream.com</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">				
					<p><strong>PhotoStream.com</strong> is your repository for all of your photos on the major social networks.
					Create streams and enjoy it publicly or privately with friends.</p>
					<br />
					<p>
					<a href="http://ecorp.com">eCorp</a> is the worlds largest virtual domain development incubator on the planet. 
					Founded in 1996, we create, acquire, match, manage and liquidate premium domain assets and platforms.
					We build and manage world class web-based, domain centric operating businesses for clients and internal ventures.
					Learn more about our ventures, staffing opportunites and partnership models.
						</p>
	
					<p>PhotoStream.com is a proud project of <a href="http://globalventures.com">Global Ventures, LLC.</a></p>
					
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
