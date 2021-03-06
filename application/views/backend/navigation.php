<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<i class="icon-cog"></i>
			</a>
			
			<a class="brand" href="/dashboard">
				<img src="/img/logo-photostream.png" alt="PhotoStream" style="height:35px;">
			</a>		
			
			<div class="nav-collapse collapse">
				<ul class="nav pull-right">
					<li class="dropdown">
						
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-cog"></i>
							Settings
							<b class="caret"></b>
						</a>
						
						<ul class="dropdown-menu">
							<li><a href="/account">Account Settings</a></li>
							<? 
							
							$userid = $this->session->userdata('userid');
							
							if($this->photousers->isAdmin($userid) == 1): ?>
							
							<li><a href="/dashboard/users">Manage Users</a></li>
							
							<? endif; ?>
							<li class="divider"></li>
							<li><a href="/help">Help</a></li>
						</ul>
						
					</li>
			
					<li class="dropdown">
						
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-user"></i> 
							<? if($user_profile==0){
								echo $name; }
								elseif($user_profile2==2){
								//echo $tweet_profile->name;
								echo $user_profile['name'];
								//print_r($user_profile);
							      }
							  else{
								//echo $user_profile['first_name']; }
								echo $tweet_profile->name;
							  }
							 ?>
							<b class="caret"></b>
						</a>
						
						<ul class="dropdown-menu">
							<li><a href="/profile/username/<?=$this->photousers->getinfobyid('username',$this->session->userdata('userid'))?>">My Profile</a></li>
							<li class="divider"></li>
							<? if($user_profile==0){ ?>
							<li><a href="/dashboard/logout">Logout</a></li>
							<?}?>
							<? if($user_profile2==1){ ?>
							<li><a href="/dashboard/tweeter_logout">Logout</a></li><? } ?>
							<? if($user_profile2==2) { ?>
							<li><a href="<?php echo $logout_url ?>">Logout</a></li>
							<? }?>
						</ul>
						
					</li>
				</ul>
			
				<form class="navbar-search pull-right" method="POST" action="<?=base_url()?>search">
					<input type="text" id="header_search_key" class="search-query" name="header_search_key" placeholder="Search">
				</form>
				
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->
<?php $this->load->view('backend/navigation-bar')?>    
