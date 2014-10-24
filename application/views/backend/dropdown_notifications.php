<?php
	/*
		dropdown_notifications 
			view for notifications in dashboard
		
		created by: sheina Feb 20, 2014
		last edit: seph al Feb 21, 2014
	*/
?>

<?if($notifications->num_rows() > 0):?>
	<li class="header-msg">
            <!--<p>You have <?//echo $notifications->num_rows();?> new notifications</p>-->
    </li>
		<?foreach($notifications->result() AS $notification):?>
				<li>
					
					 <a href="<?=$notification->url?>" target="_blank">
							<div class="details-msg">
							 <div class="msg-cont">
								  <p class="ellipsis">
										<?echo $notification->message?>
								 </p>
							</div>
						 </div>
					</a>
				</li>		
		<?endforeach;?>
		
<?else: ?>

	<li class="header-msg">
            <p>You have no new notifications</p>
    </li>

<?endif;?>
<li class="see-msg">
    <a class="more-msg text-center" href="/photo/notificationpage">View All <i class="icon-arrow-right"></i></a>
</li>