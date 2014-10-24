<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js" type="text/javascript" charset="utf-8"></script>

    <style type="text/css" media="screen">
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
			width: 260px;
		}
		.a-feed,.a-feed:hover{
			text-decoration: none;
		}
		.info-feed{
			color: #333;
		}
    </style>

    <script type="text/javascript" charset="utf-8">
	var cnt = 0;
	var db_count = new Array();
	var old_count = 0;
	
	
    function addmsg(type, msg,img,lname,fname,username,title){
        /* Simple helper to add a div.
        type is the name of a CSS class (old/new/error).
        msg is the contents of the div */
        $("#messages").append(
            "<li><div class='media'><a class='pull-left' href=''><img style='width:30px;height:30px;' src='"+img+"' alt='' /></a><div class='media-body'><a class='a-feed' href='/"+username+"'><b>"+fname+" "+lname+"</b><span class='info-feed'>"+msg+"</span></a></div></div></li>"
        );
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
            url: "http://www.beta.photostream.com/dashboard/ticker",

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
				var msg3 = msg2-1;
				addmsg("new", msg,img,lname,fname,username,title); /* Add response to a .msg div (with the "new" class)*/
				
               
				if(msg3 > cnt){
				
					
					setTimeout(
					waitForMsg, /* Request next message */
					1000 /* ..after 1 seconds */
					);
					cnt = cnt+1;
					
				}
				else{
				
					checkdb()
				}
				
            }
        });
    };
	
	
	 function checkdb(){
        /* This requests the url "msgsrv.php"
        When it complete (or errors)*/
		
		
       $.ajax({
            type: "GET",
            url: "http://www.beta.photostream.com/dashboard/ticker",

            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,
            timeout:50000, /* Timeout in ms */

            success: function(data){ /* called when request to barge.php completes */
				
				var json = eval('(' + data + ')');
				var msg = old_count;
				var msg2 = json['num_rows'];
				db_count[0] = msg2;
				
				//updatecount("new", msg,msg2); /* Add response to a .msg div (with the "new" class)*/
				
				if(msg2 > old_count)
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
    </script>
</head>
<body>
<div class="wrap-newsFeed">
<div id="newsFeed">
	<ul id="newsFeed-ul" class="inline">
    <div id="messages">

    </div>
</ul>
</div>
</div>


	
	
<!------------------------------------------------------------------------------------------------------------>
<!--<div class="wrap-newsFeed">
<div id="newsFeed">
	<ul id="newsFeed-ul" class="inline">
		
		<div id="messages">
		
		</div>
		
	</ul>
</div>
</div>
<script type="text/javascript" src="<?=base_url();?>js/jquery-slimscroll.js"></script>
<script type="text/javascript">
	$(function(){
	  $('#newsFeed').slimScroll({
		  height: 'auto'
	  });
	});
</script>-->
<!------------------------------------------------------------------------------------------------------------>
