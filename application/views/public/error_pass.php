<div class="body-wrap" style="border-top: 8px solid #1d9ed6;border-bottom: 8px solid #1d9ed6;margin-top: 5px;">
	<div class="container-fluid">
		<div class="span5 offset4">
			<center>
				<? echo '<h2 class="text-warning">'.$message.'</h2>'; ?>
				<a href="<?echo base_url();?>index.php/home/index">Back</a>
			</center>
		</div>
	</div>
</div>
<?php
	$this->load->view('public/footer_end');
?>