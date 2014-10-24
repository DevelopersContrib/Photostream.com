<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<link href="/css/pages/dashboard.css" rel="stylesheet">
<script type="text/javascript" src="<?=base_url()?>js/global.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/search_pics.js"></script>
	
	<div class="main">

    <div class="container">

      <div class="row">
      
		<div class="span12">      		
      		
      		<div class="widget stacked ">
      			
      			<div class="widget-header">
      				<i class="icon-trophy"></i>
      				<h3>Search Photo Streams - <?=$key?> </h3>
  				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					<input type="hidden" name="key" id="key" value="<?=$key?>" />
					
					<div class="message-info"><span><?=$results_count?> results found</span></div>
					
					<?if($search_results->num_rows() > 0):?>
						<ul class="gallery-container" id="search_results">
							<?foreach($search_results->result() AS $result):?>
								<li>
									<a href="<?=base_url()?>stream/album/<?=$result->stream_id?>">
										<img src="<?=$result->filename?>" alt="<?=$result->title?>" />
										<p><?=$result->title?></p>
									</a>
								</li>
							<?endforeach;?>
						</ul>
						
						<div id="pagination" class="pagination">
							<?if($per_page < $results_count):?>
								<ul>
								<?
									$pages_count =  $results_count/$per_page;
										if($results_count%$per_page > 0){
											$pages_count++;
										}
									
									for($i = 1; $i <= $pages_count ; $i++){
										?>
											<li id="pg_<?=$i?>" <? echo $i == 1 ? "class='active'" : ''; ?>><a href="javascript:gotoPage(<?=$i?>)"> <? echo $i?> </a></li>
										<?
									}
								?>
								</ul>
							<?endif;?>
						</div>
					<?else:?>
						<div class="message-info"><span>No results found.</span></div>
					<?endif;?>
					
				</div>
			</div>
		</div>
		
      </div> <!-- /row -->

    </div> <!-- /container -->
    
</div> <!-- /main -->
	
	
<?php $this->load->view('backend/footer')?>