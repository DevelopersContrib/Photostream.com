<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<link href="/css/pages/dashboard.css" rel="stylesheet">
<link href="<?=base_url();?>/css/photostream-add-style.css" rel="stylesheet">

<script type="text/javascript">
	var curr_menu = 'challenge_menu';
	activateMenu(curr_menu);
</script>

<div class="main">

    <div class="container">

      <div class="row">
      
		<div class="span12">      		
      		
      		<div class="widget stacked ">
      			
      			<div class="widget-header">
      				<i class="icon-hand-right"></i>
      				<h3>Challenges</h3>
  				</div> <!-- /widget-header -->
				
				<div class="widget-content" style="min-height: 267px;">
					<div class="tabbable tabs-left tabs-blue">
						<ul id="blue-arrw" class="nav nav-tabs">
						  <li class="active">
							<a href="#openchallenges" data-toggle="tab">Open Challenges</a>
						      <b></b>
						  </li>
						  <li><a href="#closedchallenges" data-toggle="tab">Closed Challenges</a><b></b></li>
						  <li><a href="#mychallenges" data-toggle="tab">My Challenges</a><b></b></li>
						</ul>
					
					
					
						<div class="tab-content">
							<div class="tab-pane active" id="openchallenges">
								<div class="row-fluid">
									<?=$this->load->view('backend/openchallenges');?>
								</div>
							</div>
							
							<div class="tab-pane" id="closedchallenges">
								<?=$this->load->view('backend/closedchallenges');?>
							</div>
							
							<div class="tab-pane" id="mychallenges">
								<?=$this->load->view('backend/mychallenges');?>
							</div>
						</div><!-- tab-content -->
					
					</div><!-- tabbable -->
				</div><!-- widget content -->
				
			</div><!-- widget stacked -->
		</div><!-- span12 -->
		
      </div> <!-- /row -->

    </div> <!-- /container -->
    
</div> <!-- /main -->

<?php $this->load->view('backend/footer')?> 