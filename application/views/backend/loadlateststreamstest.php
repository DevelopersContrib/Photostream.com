
<?if($latest_streams->num_rows() > 0):?>
		<div id="container">
					<div class="grid">
						<div class="imgholder">
							<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img27.jpg" />
						</div>
						<strong>Sunset Lake</strong>
						<p>A peaceful sunset view...</p>
						<div class="meta">by j osborn</div>
					</div>
					<div class="grid">
						<div class="imgholder">
							<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img26.jpg" />
						</div>
						<strong>Bridge to Heaven</strong>
						<p>Where is the bridge lead to?</p>
						<div class="meta">by SigitEko</div>
					</div>
					<div class="grid">
						<div class="imgholder">
							<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img15.jpg" />
						</div>
						<strong>Autumn</strong>
						<p>The fall of the tree...</p>
						<div class="meta">by Lars van de Goor</div>
					</div>
					<div class="grid">
						<div class="imgholder">
							<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img23.jpg" />
						</div>
						<strong>Winter Whisper</strong>
						<p>Winter feel...</p>
						<div class="meta">by Andrea Andrade</div>
					</div>
					<div class="grid">
						<div class="imgholder">
							<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img17.jpg" />
						</div>
						<strong>Light</strong>
						<p>The only shinning light...</p>
						<div class="meta">by Lars van de Goor</div>
					</div>
					<div class="grid">
						<div class="imgholder">
							<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img22.jpg" />
						</div>
						<strong>Rooster's Ranch</strong>
						<p>Rooster's ranch landscape...</p>
						<div class="meta">by Andrea Andrade</div>
					</div>
					<div class="grid">
						<div class="imgholder">
							<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img16.jpg" />
						</div>
						<strong>Autumn Light</strong>
						<p>Sun shinning into forest...</p>
						<div class="meta">by Lars van de Goor</div>
					</div>
					<div class="grid">
						<div class="imgholder">
							<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img21.jpg" />
						</div>
						<strong>Yellow cloudy</strong>
						<p>It is yellow cloudy...</p>
						<div class="meta">by Zsolt Zsigmond</div>
					</div>
					<div class="grid">
						<div class="imgholder">
							<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img28.jpg" />
						</div>
						<strong>Herringfleet Mill</strong>
						<p>Just a herringfleet mill...</p>
						<div class="meta">by Ian Flindt</div>
					</div>
					<div class="grid">
						<div class="imgholder">
							<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img2.jpg" />
						</div>
						<strong>Battle Field</strong>
						<p>Battle Field for you...</p>
						<div class="meta">by Andrea Andrade</div>
					</div>
					<div class="grid">
						<div class="imgholder">
							<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img24.jpg" />
						</div>
						<strong>Sundays Sunset</strong>
						<p>Beach view sunset...</p>
						<div class="meta">by Robert Strachan</div>
					</div>
					<div class="grid">
						<div class="imgholder">
							<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img19.jpg" />
						</div>
						<strong>Sun Flower</strong>
						<p>Good Morning Sun flower...</p>
						<div class="meta">by Zsolt Zsigmond</div>
					</div>
					<div class="grid">
						<div class="imgholder">
							<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img5.jpg" />
						</div>
						<strong>Beach</strong>
						<p>Something on beach...</p>
						<div class="meta">by unknown</div>
					</div>
					<div class="grid">
						<div class="imgholder">
							<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img25.jpg" />
						</div>
						<strong>Flowers</strong>
						<p>Hello flowers...</p>
						<div class="meta">by R A Stanley</div>
					</div>
					<div class="grid">
						<div class="imgholder">
							<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img20.jpg" />
						</div>
						<strong>Alone</strong>
						<p>Lonely plant...</p>
						<div class="meta">by Zsolt Zsigmond</div>
					</div> <!---->
				</div>
<?else:?>
	<div class="message-warning">
		<span>No streams found. Your query resulted <? var_dump($latest_streams);?></span>
	</div>
<?endif;?>
<script>
$(document).ready(function() {
				//blocksit define
				$(window).load( function() {
					
					$('#container').BlocksIt({
						numOfCol: 5,
						offsetX: 8,
						offsetY: 8
					});
					
					resize2();
				});
				
				function resize2() {
				 var winWidth = $(window).width();
				 var conWidth;
				 if(winWidth < 320) {
				  conWidth = 300;
				  col = 1
				 } else if(winWidth < 680) {
				  conWidth = 540;
				  col = 2
				 }else if(winWidth < 880) {
				  conWidth = 660;
				  col = 3
				 } else if(winWidth < 1024) {
				  conWidth = 940;
				  col = 4;
				 } else {
				  conWidth = 835;
				  col = 4;
				 }
				 
				 if(conWidth != currentWidth) {
				  currentWidth = conWidth;
				  $('#container').width(conWidth);
				  $('#container').BlocksIt({
				   numOfCol: col,
				   offsetX: 8,
				   offsetY: 8
				  });
				 }
				}
				
				//window resize
				var currentWidth = 1100;
				$(window).resize(function(){
					resize2();
				});
				
				
				
			});
	</script>
	