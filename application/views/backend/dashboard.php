<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<link href="/css/pages/dashboard.css" rel="stylesheet" />
<script src="<?=base_url()?>js/jquery-latest.pack.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/jcarousellite_1.0.1c4.js" type="text/javascript"></script>

<link href="<?=base_url()?>css/photostream.css" rel="stylesheet" />
<script src="<?=base_url()?>js/blocksit.min.js"></script>
<link href="<?=base_url()?>css/blocksit-style.css" rel="stylesheet" media="screen" />
<script type="text/javascript" src="<?=base_url()?>js/profile.js"></script>
<link rel="stylesheet" href="<?=base_url();?>css/photostream-add-style.css" />
<script type="text/javascript">
    $(function() {
        $(".newsticker-jcarousellite").jCarouselLite({
            vertical: true,
            hoverPause:true,
            visible: 3,
            auto:500,
            speed:1000
        });
    });
</script>
<script type="text/javascript" >
    $(function() 
      {
          $(".delete").click(function(){
              var element = $(this);
              var I = element.attr("id");
              $('li#list'+I).fadeOut('slow', function() {$(this).remove();});		
              return false;
          });
      });
    
    
    
    $(function() 
      {
          $(".add").click(function(){
              var element = $(this);
              var I = element.attr("id");
              var to_add_userid = $('#to_add_userid').val();
              $.post('/friends/add_friend',
                     {to_add_userid:to_add_userid},
                     function(data){
                         if(data == "OK"){
                             $('#friendship'+I).html('<p>Waiting for confirmation</p>');
                             $('li#list'+I).fadeOut( 1600, function() {$(this).remove();});		
                             
                         }else{
                             $.msgbox("An error occurred: "+data, {type: "error"});
                         }
                     });
              return false;
          });
      });
</script>
<style type="text/css">
    .wrap-newsFeed{
        background-color: #fff;
        border: 1px solid #CCCCCC;
        height: 300px;
    }
    /*ul style for news feed*/
    #newsFeed-ul > li{
        border-bottom: 1px solid #e7e7e7;
        padding-bottom: 5px;
        padding-top: 5px;
        width: 98%;
    }
    .a-feed,.a-feed:hover{
        text-decoration: none;
    }
    .info-feed{
        color: #333;
    }
    .wrp-nf-head{
        background: -webkit-linear-gradient(center top , #FAFAFA 0%, #E9E9E9 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
        background: -moz-linear-gradient(center top , #FAFAFA 0%, #E9E9E9 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
        background: -o-linear-gradient(center top , #FAFAFA 0%, #E9E9E9 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
        background: -ms-linear-gradient(center top , #FAFAFA 0%, #E9E9E9 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
        background: linear-gradient(center top , #FAFAFA 0%, #E9E9E9 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
        border: 1px solid #D5D5D5;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        line-height: 40px;
        min-height: 40px;
        position: relative;
    }
    .wrp-nf-head h3{
        color: #555555;
        display: inline-block;
        font-size: 14px;
        font-weight: 600;
        left: 10px;
        line-height: 18px;
        margin-right: 3em;
        margin-top: 15px;
        position: relative;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
        top: 2px;
    }
	.feature{padding: 20px 10px;}
</style>
<div class="main">
    
    <div class="container">
        
        <div class="row">
            
            <div class="span3">
                <div class="row-fluid">
                    <div class="wrp-nf-head">
                        <h3>News Feed</h3>
                    </div>
                    <div id="loads" style="margin-bottom: 20px;">
                        <? //$this->load->view("backend/dashboard_ticker"); ?>
                        <div class="wrap-newsFeed">
                            <div id="newsFeed">
                                <ul id="newsFeed-ul" class="inline">
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>	
                <div class="row-fluid">
                    <div class="widget widget-nopad stacked">
                        <div class="widget-header">
                            <h3>Suggested Friends</h3>
                        </div>
                        <div class="widget-content">
                            <ul id="facebook">
                                <? foreach($user_suggest->result() as $suggest): ?>
                                <? $profile_userid = $suggest->userid; 
$isFriends = $this->photofriends->checkIfFriends($user,$profile_userid);
//echo $isFriends;

$isSelf = 0;

if($user==$profile_userid){
    
    $isSelf = 1;
    
}else{
    $isSelf = 0;
}

//echo $isSelf;

                                ?>
                                <?if($isFriends == 0 && $isSelf == 0):?>
                                <li id="list<?=$suggest->userid?>">
                                    <img src="<? echo $this->photopics->getinfobyid('filename',$suggest->avatar_id); ?>" style="width:50px;height:50px;"> <span class="del"><a href="" class="delete" title="Remove" id="<?=$suggest->userid?>">x</a></span>
                                    <a href="/<?=$suggest->username?>" class="user-title"><? echo $suggest->firstname." ".$suggest->lastname?></a>
                                    <div id="friendship<?=$suggest->userid?>">
                                        <input type="hidden" name="to_add_userid" id="to_add_userid" value="<?=$profile_userid?>" />
                                        <span class="addas"><a href="" class="add" id="<?=$suggest->userid?>" title="Add as friend" > <img class="img-icon-fb" src="<?=base_url();?>img/facebook-icons.png"/> Add as Friend</a></span>
                                    </div>
                                </li>
                                <? endif; ?>
                                <? endforeach; ?>
                            </ul>
                        </div> <!-- /widget-content -->
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="widget widget-nopad stacked">
                        <div class="widget-header">
                            <h3>Sponsors</h3>
                        </div>
                        <div class="widget-content">
                           <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 160 x 600 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:160px;height:600px"
     data-ad-client="ca-pub-0390821261465417"
     data-ad-slot="7270445903"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
                        </div> <!-- /widget-content -->
                    </div>
                </div>
            </div> <!-- /span3 -->
            
            
            <div class="span9">	
                
				<? if($onboardview === true){	?>
				<div class="widget stacked" >                    
                    <div class="widget-header">                        
                        <i class="icon-bookmark"></i>                        
                        <h3>Onboarding Message</h3>                        
                    </div> <!-- /widget-header -->                    
                    <div class="widget-content" >
						<div class="text-center" >
							<h1>Welcome to PhotoStream.com!</h1>
							<br>
							<h3>Stream your Social Photos and Create Challenges</h3>
							<h4>Import your streams through your social accounts. </h3>
						</div>
						<section>
							<div style="padding: 20px 0px;">
								
									<div class="span3" style="width: 21%;">
										<div class="feature">
											<i class="icon-globe icon-2x pull-left" style=" height: 80px; "></i>
											<p>Import your social photos and organize them into streams</p>
										</div>
									</div><!-- /span3 -->
									<div class="span3" style="width: 21%;">
										<div class="feature">
											<i class="icon-wrench icon-2x pull-left" style=" height: 80px; "></i>
											<p>Create challenges with your friends and peers</p>
										</div>
									</div><!-- /span3 -->
									<div class="span3" style="width: 21%;">
										<div class="feature">
											<i class="icon-desktop icon-2x pull-left" style=" height: 80px; "></i>
											<p>Meet friends </p>
										</div>
									</div><!-- /span3 -->
									<div class="span3" style="width: 21%;">
										<div class="feature">
											<i class="icon-thumbs-up icon-2x pull-left" style=" height: 80px; "></i>
											<p>Earn adshare revenue</p>
										</div>
									</div><!-- /span3 -->
								
							</div><!-- /container -->
						</section>
						
					</div>
				</div>
                <? } ?>
                
                
                <div class="widget stacked">
                    
                    
                    
                    <div class="widget-header">
                        
                        <i class="icon-bookmark"></i>
                        
                        <h3>Latest Streams</h3>
                        
                    </div> <!-- /widget-header -->
                    
                   
                    
                    <div class="widget-content" id="dashboard_right">
                        
                         <div style="width:730px;margin:0px auto;">
              <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Lead Template 2 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-0390821261465417"
     data-ad-slot="1158994701"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
              </div>  
                        
                        <?if($latest_streams->num_rows() > 0):?>	
                        <div id="container">
                            <? foreach($latest_streams->result() as $stream): ?>
                            <div class="grid">
                                <div class="imgholder">
                                    <a href="/stream/album/<?=url_title($stream->title)?>/<?=$stream->stream_id?>"><img src="<?=$this->photopics->getinfobyid('filename',$stream->cover_pic)?>" /></a>
                                </div>
                                <strong><?=strip_tags(ucwords($stream->title))?></strong>
                                <p class="ellipsis"><?=stripslashes($stream->description)?></p>
                                <div class="meta">by <a class="meta" href="/<?=$this->photousers->getinfobyid('username',$stream->userid)?>"> <?=$this->photousers->getinfobyid('firstname',$stream->userid)." ".$this->photousers->getinfobyid('lastname',$stream->userid)?></a></div>
                            </div>
                            <? endforeach; ?>
                            
                        </div>
                        <?else:?>
                        <div class="message-warning">
                            <span>No streams found. Your query resulted <? var_dump($latest_streams);?></span>
                        </div>
                        <?endif;?>
                        
                        
                        
                        
                    </div> <!-- /widget-content -->
                    
                    
                    
                </div> <!-- /widget -->
                
                
                
                
                
                
                
                
                
            </div> <!-- /span9 -->
            
            
            
        </div> <!-- /row -->
        
        
        
    </div> <!-- /container -->
    
    
    
</div> <!-- /main -->
<script type="text/javascript" src="<?=base_url();?>js/jquery-slimscroll.js"></script>
<script type="text/javascript">
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
                conWidth = 230;
                col = 1
            } else if(winWidth < 680) {
                conWidth = 387;
                col = 1
            }else if(winWidth < 880) {
                conWidth = 505;
                col = 2
            } else if(winWidth < 1024) {
                conWidth = 670;
                col = 3;
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
        
        $('.main').mousemove(function(){
            
            
            
        })
        
        
        
    });
    
    
    var cnt = 0;
    var db_count = new Array();
    var old_count = 0;
    
    
    function addmsg(type, msg,img,lname,fname,username,title,pcount,stream_id){
        /* Simple helper to add a div.
				type is the name of a CSS class (old/new/error).
				msg is the contents of the div */
        var mystr = msg;
        var myarr = mystr.split(" ");
        var photo;
        var slug = convertToSlug(title);
        if(pcount == 1){
            
            photo = "photo";
            
        }else{
            
            photo = "photos";
            
        }
        
        //$("#newsFeed-ul").prepend(
        //"<li><div class='media'><a class='pull-left' href=''><img style='width:30px;height:30px;' src='"+img+"' alt='' /></a><div class='media-body'><a class='a-feed' href='/"+username+"'><b>"+fname+" "+lname+"  </b><span class='info-feed'>"+myarr[0]+"<b> "+pcount+" "+photo+" </b>"+myarr[2]+" "+myarr[3]+" in Album <a href = '/stream/album/"+slug+"/"+stream_id+"'>"+title+"</a> </span></a></div></div></li>"
        //);
        
        $("<li><div class='media'><a class='pull-left' href=''><img style='width:30px;height:30px;' src='"+img+"' alt='' /></a><div class='media-body'><a class='a-feed' href='/"+username+"'><b>"+fname+" "+lname+"  </b><span class='info-feed'>"+myarr[0]+"<b> "+pcount+" "+photo+" </b>"+myarr[2]+" "+myarr[3]+" in Album <a href = '/stream/album/"+slug+"/"+stream_id+"'>"+title+"</a> </span></a></div></div></li>").hide().prependTo('#newsFeed-ul').slideDown("slow");
        
    }
    
    
    
    function convertToSlug(title)
    {
        return title
        .toLowerCase()
        .replace(/[^\w ]+/g,'')
        .replace(/ +/g,'-')
        ;
    }
    
    
    
    function updatecount(type, msg, msg2){
        /* Simple helper to add a div.
				type is the name of a CSS class (old/new/error).
				msg is the contents of the div */
        $("#messages2").html(
            "<div class='msg "+ type +"'>"+ msg + msg2 + "</div>"
        );
    }
    
    
    
    function waitForMsg(){
        /* This requests the url "msgsrv.php"
				When it complete (or errors)*/
        
        $.ajax({
            type: "GET",
            url: "http://www.photostream.com/dashboard/ticker",
            
            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,
            timeout:50000, /* Timeout in ms */
            
            success: function(data){ /* called when request to barge.php completes */
                
                var json = eval('(' + data + ')');
                var msg = json[cnt]['message'];
                var title = json[cnt]['title'];
                var fname = json[cnt]['fname'];
                var lname = json[cnt]['lname'];
                var img = json[cnt]['avatar'];
                var msg2 = json['count'];
                var username = json[cnt]['username'];
                var pcount = json[cnt]['pcount'];
                var stream_id = json[cnt]['stream_id'];
                var msg3 = msg2-1;
                addmsg("new", msg,img,lname,fname,username,title,pcount,stream_id); /* Add response to a .msg div (with the "new" class)*/
                
                
                if(msg3 != cnt){
                    
                    
                    setTimeout(
                        waitForMsg, /* Request next message */
                        1000 /* ..after 1 seconds */
                    );
                    cnt = cnt+1;
                    
                }
                else{
                    
                    checkdb();
                    cnt = cnt+1;
                }
                
            }
        });
    };
    
    
    function checkdb(){
        /* This requests the url "msgsrv.php"
				When it complete (or errors)*/
        
        
        $.ajax({
            type: "GET",
            url: "http://www.photostream.com/dashboard/ticker",
            
            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,
            timeout:50000, /* Timeout in ms */
            
            success: function(data){ /* called when request to barge.php completes */
                
                var json = eval('(' + data + ')');
                var msg = old_count;
                var msg2 = json['num_rows'];
                db_count[0] = msg2;
                
                //updatecount("new", msg,msg2); /* Add response to a .msg div (with the "new" class)*/
                
                if(msg2 != old_count)
                {
                    setTimeout(
                        waitForMsg, /* Request next message */
                        1000 /* ..after 1 seconds */
                    );
                    old_count = msg2;
                }else{
                    
                    checkdb();
                    
                }
                
                
                
            }
        });
    };
    
    
    
    $(document).ready(function(){
        checkdb(); /* Start the inital request */
    });
    
    $(function(){
        $('#newsFeed').slimScroll({
            height: 'auto'
        });
    });
</script>
<?php $this->load->view('backend/footer')?>    