<script type="text/javascript" src="<?=base_url();?>/js/global.js"></script>
<div class="subnavbar">

	<div class="subnavbar-inner">
	
		<div class="container">
			
			<a class="btn-subnavbar collapsed" data-toggle="collapse" data-target=".subnav-collapse">
				<i class="icon-reorder"></i>
			</a>

			<div class="subnav-collapse collapse">
				<ul class="mainnav">
				
					<li class="active" id="home_menu">
						<a href="/dashboard">
							<i class="icon-home"></i>
							<span>Home</span>
						</a>	    				
					</li>
					
					<li class="dropdown" id="stream_menu">					
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-th"></i>
							<span>Stream</span>
							<b class="caret"></b>
						</a>	    
					
						<ul class="dropdown-menu">
							<li><a href="/streams">View Streams</a></li>
							<li><a href="/stream/create">Create Stream</a></li>
							<li><a href="/photos/upload">Upload Photos</a></li>
						</ul> 				
					</li>
					
					<li class="dropdown" id="fiends_menu">					
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-copy"></i>
							<span>Friends</span>
							<b class="caret"></b>
						</a>	    
					
						<ul class="dropdown-menu">
							<li><a href="/friends">View Friends</a></li>
							<li><a href="/friends/search">Search</a></li>
						</ul> 				
					</li>
					
					<li class="dropdown" id="challenge_menu">					
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-external-link"></i>
							<span>Challenge</span>
							<b class="caret"></b>
						</a>	
					
						<ul class="dropdown-menu">
							<li><a href="/challenges">View Challenges</a></li>
							<li><a href="./signup.html">Create Challenge</a></li>
						</ul>    				
					</li>
				
				</ul>
			</div> <!-- /.subnav-collapse -->

		</div> <!-- /container -->
	
	</div> <!-- /subnavbar-inner -->

</div> <!-- /subnavbar -->