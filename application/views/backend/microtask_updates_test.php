<?php 
 if (!$this->session->userdata('logged_in')){
  	$this->load->view('marketplace/header'); 
  }else {
  	$this->load->view('marketplace/header-login');
  }
?>

 <style>
            .container{
                width:1170px;
            }
            .wrap-mt-up{
                border-color: #ccc;
                border-style: solid;
                border-image:none;
                border-radius: 3px;
                border-width: 1px 1px 2px;
                background-color: #fff;
            }
            .wrap-mt-up .dl-mu:nth-child(1), .wrap-mt-up .dl-mu:nth-child(2), .wrap-mt-up .dl-mu:nth-child(3), .wrap-mt-up .dl-mu:nth-child(4){
                border-bottom: 1px solid #ccc;
            }
            .wrap-mt-up .dl-mu:nth-child(5) dd{
                padding:3px;
            }
            .mc-u{
                background-color: #f2f2f2;
                padding:10px;
                border-color: #D4D4D4 #D4D4D4 #BCBCBC;
                border-width: 1px;
                border-style: solid;
            }
            .dl-mu{
                margin: 0;
            }
            .dl-mu-cc{
                background-color: #f7f7f7;
            }
            .dl-mu dt{
                width: 100px;
                font-weight:normal;
                color: #555555;
                text-transform: capitalize;
            }
            .dl-mu dd{
                margin-left:110px;
                color: #444;
                font-weight:bold;
                text-transform: capitalize;
                line-height: normal;
            }
            .wrap-mu-head{
                background: linear-gradient(to bottom, #F7F9FC 0%, #EEF3FA 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
                border-color: #E0E9F5;
                border-width: 1px;
                border-style: solid;
                padding: 5px 10px;
            }
            .wrap-mu-ins{
                background-color: #fff;
                padding: 5px 10px;
                border-color: #D4D4D4 #D4D4D4 #BCBCBC;
                border-width: 1px;
                border-style: solid;
                border-top: none;
            }
            .wrap-mu-ins h5{
                color: #555;
            }
            .mu-ins-cont{
                color: #666;
            }
            .wrap-h-t{
                padding:10px;
                text-align:justify;
                margin-bottom: 10px;
                border-radius: 0 0 3px 3px;
                border-top: none;
            }
			 /* MICROTASK UPDATE COMMENTS ------------------------------------------------------------------*/
            .wrap-mu-r{
                margin-top: 20px;
                margin-bottom: 10px;
                padding: 10px;
            }
            .wrap-mu-u{
                width: 50px;
                height:50px;
                overflow: hidden;
                border: 1px solid #eee;
            }
            .wrap-mu-u img{
                max-height: 50px;
                max-width:50px;
                width:100%;
            }
            .wrap-mu-d-r , .wrap-mu-d-r i{
                color: #666;
            }
            .wrap-mu-r-box .comment-arrow {
                display: inline-block;
                margin-bottom: 2px;
            }
            .comment-arrow{
                background-image: url(img/comment-arrow.png);
                background-position: 0 2px;
                background-repeat: no-repeat;
                margin-left: -17px;
                padding-left: 17px;
                position: relative;
            }
            .wrap-mu-head-r{
                margin-left: 65px;
                border-color: #D4D4D4 #D4D4D4 #BCBCBC;
                border-width: 1px;
                border-style: solid;
                background: -webkit-linear-gradient(center top , #FFFFFF 0px, #F7F7F7 99%) repeat scroll 0 0 rgba(0, 0, 0, 0);
                background: -moz-linear-gradient(center top , #FFFFFF 0px, #F7F7F7 99%) repeat scroll 0 0 rgba(0, 0, 0, 0);
                background: -o-linear-gradient(center top , #FFFFFF 0px, #F7F7F7 99%) repeat scroll 0 0 rgba(0, 0, 0, 0);
                background: -ms-linear-gradient(center top , #FFFFFF 0px, #F7F7F7 99%) repeat scroll 0 0 rgba(0, 0, 0, 0);
                background: linear-gradient(center top , #FFFFFF 0px, #F7F7F7 99%) repeat scroll 0 0 rgba(0, 0, 0, 0);
                font-size: 11px;
                padding: 5px 10px;
                border-bottom: 1px solid #D4D4D4;
                position: relative;
                text-transform: capitalize;
            }
            .wrap-mu-cnt{
                margin-left: 65px;
                padding: 5px 10px;
                border-color: #D4D4D4 #D4D4D4 #BCBCBC;
                border-width: 1px;
                border-style: solid;
                border-top: none;
            }
   </style>
        
        <div class="container" style="margin-top: 50px;">
            <div class="row-fluid">
                <div class="span12">
                    <div class="mc-u">
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="wrap-mu-head">
                                    <h5>How To Send Updates</h5>
                                </div>
                                <div class="row-fluid">
                                    <div class="wrap-mt-up wrap-h-t">
                                        <p>1. To inform the employer that you are already working on the task, click "Start Task" button. Employer will receive an email stating that you are working on the task.</p>
                                        <p>2. Send a message or updates about the task using the text field of this page. You will also receive email message when your employer sends reply to your update.</p>
                                        <p>3. When you are finished, you should click the button "I already finished this task". The employer will be notified that you finished the task. The employer will pay you via your paypal account. Note: You can withdraw your compensation by the time the total amount reaches at least 50 USD.</p>
                                    </div>
                                </div>
                                <div class="wrap-mt-up">
                                    <div class="row-fluid">
									<?foreach($task_details->result() AS $task_info):?>
                                        <dl class="dl-horizontal dl-mu dl-mu-cc">
                                            <dt>Assign to</dt>
                                            <dd><?echo $this->members->GetUserInfo('FirstName','MemberId',$task_info->contrib_user)." ".$this->members->GetUserInfo('LastName','MemberId',$task_info->contrib_user);?></dd>
                                        </dl>
                                        <dl class="dl-horizontal dl-mu">
                                            <dt>Date Started</dt>
                                            <dd><?echo $task_info->date_started?></dd>
                                        </dl>
                                        <dl class="dl-horizontal dl-mu">
                                            <dt>Date Finished</dt>
                                            <dd><?echo $task_info->date_finished?></dd>
                                        </dl>
                                        <dl class="dl-horizontal dl-mu">
                                            <dt>Proof</dt>
                                            <dd><?echo $task_info->proof?></dd>
                                        </dl>
                                        <dl class="dl-horizontal dl-mu">
                                            <dt>&nbsp;</dt>
                                            <dd>
                                                <button class="btn btn-success">Start Task</button>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="span8">
                                <div class="wrap-mu-head">
                                    <div class="row-fluid">
                                        <h4><?echo $task_info->title?></h4>
                                    </div>
                                </div>
                                <div class="wrap-mu-ins">
                                    <h5>Instruction:</h5>
                                    <div class="mu-ins-cont">
                                        <?echo $task_info->instruction?>
                                    </div>
                                </div>
								<div class="row-fluid" style="margin-top:20px">
								<textarea class="wysiwyg" id="update_message"></textarea>
									<input type="hidden" name="task_id" id="task_id" value="<?=$task_id?>" />
									<br />
									<button type="button" class="btn btn-primary pull-right" id="submit_task_update">Send Update</button>
								</div>
                            </div>
							<?endforeach;?>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
	<div id="update_messages_container">
		 <div class="row-fluid">
		 <?foreach($updates_query->result() AS $updates):?>
                <div class="wrap-mu-r">
                    <div class="wrap-mu-u pull-left">
                        <a href="">
                            <img src="/uploads/profile/<?=$this->profiledata->getinfo('profile_image','member_id',$updates->contrib_user)?>" alt="">
                        </a>
                    </div>
                    <div class="wrap-mu-r-box">
                        <div class="wrap-mu-head-r">
                            <div class="wrap-mu-d-r pull-right">
                               <i class="icon-time"></i>
                               on <?=$updates->date_created?>
                            </div>
                            <span class="comment-arrow">
                                By <a href=""><?echo $updates->vnoc_member == null ? 'You':'Verified Employer'?></a>
                            </span>
                        </div>
                        <div class="wrap-mu-cnt">
                            <p><?=stripslashes($updates->message)?></p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
			<?endforeach;?>
            </div>
		</div>

		
<link rel="stylesheet" href="/css/plugins/jquery.wysiwyg.css"/>
<script type="text/javascript" src="/js/plugins/wysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="/js/plugins/wysiwyg/wysiwyg.image.js"></script>
<script type="text/javascript" src="/js/plugins/wysiwyg/wysiwyg.link.js"></script>
 <script type="text/javascript">
	$(document).ready(function(){
		$('#submit_task_update').click(function(){
			var message = $('#update_message').val();
			var task_id = $('#task_id').val();
			
			if(message == ""){
				$('#udpating_status').html('<div class="alert alert-danger">Message required</div>');
				$('#update_message').focus();
			}else{
				$('#udpating_status').html('<img src="/images/ajax-loader-trans.gif" alt=""> Saving updates..');
				$.post('/microtasks/saveupdate',{task_id:task_id,message:message},function(data){
					if(data.success){
						$('#udpating_status').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Message sent!</div>');
						$('#update_messages_container').html('<center><img src="/images/ajax-loader-trans.gif" alt="Loading messages .."></center>');
						$.post('/microtasks/reloadmessagestest',{task_id:task_id},function(data_html){
							$('#update_messages_container').html(data_html);
						});
					}else{
						$('#udpating_status').html('<div class="alert alert-danger">Something horrible happened.</div>');
					}
				});
			}
			
			
		});
		
		$('#taskfinished').click(function(){
			$("#confirmFinish").show("slow");
		});
		
		$('#cancelfinish').click(function(){
			$("#confirmFinish").hide("slow");
		});
		
		$('#yesconfirm').click(function(){
			var task_id = $('#task_id').val();
			$("#confirmFinish").html("Processing..");
			$.post('/microtasks/setdatefinish',{task_id:task_id},function(data){
				if(data.success){
					$('#finished_btn_container').hide('slow');
					$("#confirmFinish").html('<div class="alert alert-success">This task has been marked as done. Your employer will contact you shortly.</div>');
					$('#db_date_finished').html(data.finished_date);
				}else{
					$("#confirmFinish").html('<div class="alert alert-danger"><strong>Oopps!</strong> An error occurred..</div>');
				}
			});
		});
		
		$('#taskstarted').click(function(){
			var task_id = $('#task_id').val();
			$.post('/microtasks/setdatestart',{task_id:task_id},function(data){
				if(data.success){
					$('#update_dates').hide();
					$('#db_date_started').html(data.date_started);
				}else{
					alert("unable to update");
				}
			});
		});
		
		$(function(){
		$('.wysiwyg').wysiwyg({
			controls: {
				indent: { visible: false },
				outdent: { visible: false },
				subscript: { visible: false },
				superscript: { visible: false },
				redo: { visible: false },
				undo: { visible: false },
				insertOrderedList: { visible: true },
				insertUnorderedList: { visible: true },
				insertHorizontalRule: { visible: false },
				insertTable: { visible: false },
				code: { visible: false },
				removeFormat: { visible: false },
				strikethrough: { visible: false },
				strikeThrough: { visible: false },
			}
		});
	});
		
	});
	
	function learnmore(){
		$('#instructions').toggle("slow");
	}
 </script>


 <?if (!$this->session->userdata('logged_in')){
  	$this->load->view('marketplace/footer'); 
  }else {
  	$this->load->view('marketplace/footer-login');
  }
?>