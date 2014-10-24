<?php
include 'main-header.php';

$varXml = $domain->getRandomXml('travel-guide/country/',5);

?>
	
<script type="text/javascript" src="js/jquery-easing-1.3.pack.js"></script>
<script type="text/javascript" src="js/jquery-easing-compatibility.1.2.pack.js"></script>
<script type="text/javascript" src="js/coda-slider.1.1.1.pack.js"></script>
<script type="text/javascript">
	
		var theInt = null;
		var $crosslink, $navthumb;
		var curclicked = 0;
		
		theInterval = function(cur){
			clearInterval(theInt);
			
			if( typeof cur != 'undefined' )
				curclicked = cur;
			
			$crosslink.removeClass("active-thumb");
			$navthumb.eq(curclicked).parent().addClass("active-thumb");
				$(".stripNav ul li a").eq(curclicked).trigger('click');
			
			theInt = setInterval(function(){
				$crosslink.removeClass("active-thumb");
				$navthumb.eq(curclicked).parent().addClass("active-thumb");
				$(".stripNav ul li a").eq(curclicked).trigger('click');
				curclicked++;
				if( 6 == curclicked )
					curclicked = 0;
				
			}, 3000);
		};
		
		$(function(){
			
			$("#main-photo-slider").codaSlider();
			
			$navthumb = $(".nav-thumb");
			$crosslink = $(".cross-link");
			
			$navthumb
			.click(function() {
				var $this = $(this);
				theInterval($this.parent().attr('href').slice(1) - 1);
				return false;
			});
			
			theInterval();
		});
	</script>


<div id="content-wrap">
<div id="content">
<div id="inner">

<div id="left">
			
	<div class="slider-wrap">
		<div id="main-photo-slider" class="csw">
			<div class="panelContainer">
					<div class="panel" title="Panel 1"><img src="images/raw/hotel-pic.jpg" alt="" /></div>
					<div class="panel" title="Panel 2"><img src="images/raw/hotel-pic-2.jpg" alt="" /></div>	
					<div class="panel" title="Panel 3"><img src="images/raw/hotel-pic-3.jpg" alt="" /></div>
                    <div class="panel" title="Panel 4"><img src="images/raw/hotel-pic-4.jpg" alt="" /></div>
                    <div class="panel" title="Panel 5"><img src="images/raw/hotel-pic-5.jpg" alt="" /></div>
                    <div class="panel" title="Panel 6"><img src="images/raw/hotel-pic.jpg" alt="" /></div>
					<div class="panel" title="Panel 7"><img src="images/raw/hotel-pic-2.jpg" alt="" /></div>	
					<div class="panel" title="Panel 8"><img src="images/raw/hotel-pic-3.jpg" alt="" /></div>
                    <div class="panel" title="Panel 9"><img src="images/raw/hotel-pic-4.jpg" alt="" /></div>
                    <div class="panel" title="Panel 10"><img src="images/raw/hotel-pic-5.jpg" alt="" /></div>
			</div>
		</div>

		<div id="movers-row">
        	<a href="#1" class="cross-link active-thumb"><img src="images/raw/hotel-pic.jpg" alt="" class="nav-thumb"  /></a>
			<a href="#2" class="cross-link"><img src="images/raw/hotel-pic-2.jpg" alt="" class="nav-thumb" /></a>
			<a href="#3" class="cross-link"><img src="images/raw/hotel-pic-3.jpg" alt="" class="nav-thumb" /></a>
			<a href="#4" class="cross-link"><img src="images/raw/hotel-pic-4.jpg" alt="" class="nav-thumb" /></a>
			<a href="#5" class="cross-link"><img src="images/raw/hotel-pic-5.jpg" alt="" class="nav-thumb" /></a>
			<a href="#6" class="cross-link"><img src="images/raw/hotel-pic.jpg" alt="" class="nav-thumb"  /></a>
            <a href="#7" class="cross-link"><img src="images/raw/hotel-pic-2.jpg" alt="" class="nav-thumb" /></a>
            <a href="#8" class="cross-link"><img src="images/raw/hotel-pic-3.jpg" alt="" class="nav-thumb" /></a>
            <a href="#9" class="cross-link"><img src="images/raw/hotel-pic-4.jpg" alt="" class="nav-thumb" /></a>
            <a href="#10" class="cross-link "><img src="images/raw/hotel-pic-5.jpg" alt=""  class="nav-thumb"/></a>
		</div>

	</div><!--slider-wrap -->


	<?php
		foreach($varXml as $data):
	?>
    <div class="info-box">
    	<div class="info-box-thumb">
			<a class="travelguide" href="travelguide-post.php?xml=<?php echo $data->XmlUrl;?>"><img src="<?php echo $data->Image;?>"  alt=" " /></a>
		</div>
   		<div class="info-box-content"> 
        	<h2 ><a class="travelguide" href="travelguide-post.php?xml=<?php echo $data->XmlUrl;?>"><?php echo $data->Heading;?></a></h2>
            <p><?php echo $data->Desc;?></p>
        	<!--<ul>
            	<li><a href="#">Best Attractions &amp; Activities</a></li>
            	<li><a href="#">Museums</a></li>
            	<li><a href="#">Parks</a></li>
            </ul>-->
        </div>
    </div><!--info-box -->
	<?php endforeach;?>
	
	<?php /*?>	
    <div class="info-box">
    	<div class="info-box-thumb"><img src="images/raw/attraction.jpg"  alt=" " /></div>
   		<div class="info-box-content"> 
        	<h2 >Attractions</h2>
            <p>vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril 
            delenit augue duis dolore te feugait nulla facili</p>
        	<ul>
            	<li><a href="#">Best Attractions &amp; Activities</a></li>
            	<li><a href="#">Museums</a></li>
            	<li><a href="#">Parks</a></li>
            </ul>
        </div>
    </div><!--info-box -->
    
    <div class="info-box">
    	<div class="info-box-thumb"><img src="images/raw/hotel.jpg"  alt=" " /></div>
   		<div class="info-box-content"> 
        	<h2 >Hotels</h2>
            <p>vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril 
            delenit augue duis dolore te feugait nulla facili</p>
        	<ul>
            	<li><a href="#">Best Hotels</a></li>
            	<li><a href="#">Family-Friendly Hotels</a></li>
            	<li><a href="#">Luxury Hotels</a></li>
            	<li><a href="#">Resort</a></li>
            </ul>
        </div>
    </div><!--info-box -->
    
    <div class="info-box">
    	<div class="info-box-thumb"><img src="images/raw/restaurants.jpg"  alt=" " /></div>
   		<div class="info-box-content"> 
        	<h2 >Restaurants</h2>
            <p>vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril 
            delenit augue duis dolore te feugait nulla facili</p>
        	<ul>
            	<li><a href="#">Best Restaurants</a></li>
            	<li><a href="#">Seafood</a></li>
            	<li><a href="#">Steakhouses</a></li>
            	<li><a href="#">Italian</a></li>
            </ul>
        </div>
    </div><!--info-box -->
    
    <div class="info-box">
    	<div class="info-box-thumb"><img src="images/raw/nightclub.jpg"  alt=" " /></div>
   		<div class="info-box-content"> 
        	<h2 >Nightlife</h2>
            <p>vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril 
            delenit augue duis dolore te feugait nulla facili</p>
        	<ul>
            	<li><a href="#">Best Nightlife</a></li>
            	<li><a href="#">Dance Clubs</a></li>
            	<li><a href="#">Bars</a></li>
            	<li><a href="#">Live Music</a></li>
            </ul>
        </div>
    </div><!--info-box -->
    
    
    <div class="info-box">
    	<div class="info-box-thumb"><img src="images/raw/shopping.jpg"  alt=" " /></div>
   		<div class="info-box-content"> 
        	<h2 >Shopping</h2>
            <p>vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril 
            delenit augue duis dolore te feugait nulla facili</p>
        	<ul>
            	<li><a href="#">Best Shopping</a></li>
            </ul>
        </div>
    </div><!--info-box -->
    
    
    <?php */?>
    <br />
<? include 'modules/travel-module.php';?>   
</div><!--left -->
<div id="right">
    
<?
include 'modules/sidebar-widget.php';
?>
</div><!--right -->

<br class="clear" /> 
</div><!--inner -->        
</div><!--content -->
</div><!--content-wrap -->    

<?php 
include 'main-footer.php';
?>