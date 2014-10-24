<script type="text/javascript" src="http://www.google.com/jsapi"></script><script type="text/javascript">
/*<![CDATA[*/
google.load("jquery","1.5.2");
google.load("jqueryui","1.8.2");

/*]]>*/
</script>        <script type="text/javascript" src="/js/main.js"></script>
                <style>
#imgtag
{
  position:relative;
  min-width:300px;
  min-height:300px;
  float:left;
  border:solid 3px #fff;
  cursor: crosshair;
}
.tagview
{
  border:solid 3px #fff;
  width:100px;
  height:100px;
  position:absolute;
  display:none;
}
#tagit
{
  position:absolute;
  top:0;left:0;
  width:250px;
}
#tagit .box
{
  border:solid 3px #fff;
  width:100px;
  height:100px;
  float:left;
}

#tagit .name
{
  float:left;
  background-color:#fff;
  width:130px;
  height:80px;
  padding:5px;
}
#tagit div.text
{
  margin-bottom:5px;
}
#tagit input[type=text]
{
  margin-bottom:5px;
}
#tagit #tagname
{
  width:110px;
}
#taglist
{
  background-color:#012D4A;
  width:300px;
  min-height:200px;
  height:auto !important;
  height:200px;
  float:left;
  padding:10px;
  margin-left:20px;
  color:#BFC6D0;
  -moz-border-radius:5px;
  -webkit-border-radius:5px;
  border-radius:5px;

}
#taglist ol { padding:0 20px;float:left;cursor:pointer}
#taglist ol a { color:#BFC6D0;font-size:11px;}
#taglist ol a:hover { text-decoration:underline }
.tagtitle
{
  font-size:14px;
  text-align:center;
  width:100%;
  float:left;
}
</style>
<script>
  $(document).ready(function(){
    var counter = 0;
    var mouseX = 0;
    var mouseY = 0;

    $("#imgtag img").click(function(e){ // make sure the image is click
      var imgtag = $(this).parent(); // get the div to append the tagging list
      mouseX = e.pageX - $(imgtag).offset().left; // x and y axis
      mouseY = e.pageY - $(imgtag).offset().top;
      $('#tagit').remove(); // remove any tagit div first
      $(imgtag).append('<div id="tagit"><div class="box"></div><div class="name"><div class="text">Type any name or tag</div><select type="text" name="txtname" id="tagname" ><?
	  
		foreach($current_user_friends->result() AS $friend){
		if($friend->friend_id == $this->session->userdata('userid'))
		{
					$connection_id = $friend->userid_id;
		}
				else{
					$connection_id = $friend->friend_id;
			
		} 
		
		echo '<option>'.$this->photousers->getinfobyid('firstname',$connection_id)." ".$this->photousers->getinfobyid('lastname',$connection_id).'</option>';
		
		}
	  
	  
	  ?></select><input type="text" name="mousex" id="mousex" value="'+mouseX+'"><input type="text" name="mousey" id="mousey" value="'+mouseY+'"><input type="button" name="btnsave" value="Save" id="btnsave" onlick="save()"  /><input type="button" name="btncancel" value="Cancel" id="btncancel" /></div></div>');
      $('#tagit').css({top:mouseY,left:mouseX});

      $('#tagname').focus();
    });

    $('#tagit #btnsave').live('click',function(){
      var tagname = $('#tagname').val();
	  var mousex = $('#mousex').val();
	  var mousey = $('#mousey').val();
      counter++;
      $('#taglist ol').append('<li rel="'+counter+'"><a>'+tagname+'</a> (<a class="remove">Remove</a>)</li>');
      $('#imgtag').append('<div class="tagview" id="view_'+counter+'"></div>');
      $('#view_' + counter).css({top:mouseY,left:mouseX});
      $('#tagit').fadeOut();
	  $.post('/dashboard/tagsave',{tagname:tagname,
									mousex:mousex,
									mousey:mousey
										
									});
    });

     $('#tagit #btncancel').live('click',function(){
      $('#tagit').fadeOut();

    });

    $('#taglist li').live('mouseover mouseout',function(event){
      id = $(this).attr("rel");
      if (event.type == "mouseover"){
        $('#view_' + id).show();
      }else{
        $('#view_' + id).hide();
      }
    });

    $('#taglist li a.remove').live('click',function(){
      id = $(this).parent().attr("rel");
      $(this).parent().fadeOut('slow');
      $('#view_' + id).remove();
	  $.post('/dashboard/tagdelete',{id:id});
    });
  });
</script>
<div class="sampleTitle">Facebook Style Photo Tagging</div><br /><br />
<div id="imgtag">
<img src="https://fbcdn-sphotos-b-a.akamaihd.net/hphotos-ak-ash3/s720x720/563445_3800469448064_1263895778_n.jpg" />

<? 


?>
</div>
<div id="taglist">
  <span class="tagtitle">List of Tags</span>
  <ol>
  </ol>
</div>
                        </div>
                    </div>
                    <div id="footer">
                        <div class="center">
                            <a href="https://twitter.com/#!/bryglen" target="_blank" title="Follow me on Twitter">
                                <div class="twitter"></div>
                            </a>
                            <a href="http://www.phpclasses.org/browse/author/817505.html" target="_blank" title="Rate my class on PHPClasses">
                                <div class="phpclasses"></div>
                            </a>
                   
            </div>
        </div>
    </body>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-19062903-1']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
</html>
