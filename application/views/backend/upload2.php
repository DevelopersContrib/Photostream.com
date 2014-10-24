<?php $this->load->view('backend/header')?>

<?php $this->load->view('backend/navigation')?>





<div class="main">



    <div class="container">

      <div class="row">

		<div class="span12">      		

      		

      		<div class="widget stacked ">

      			

      			<div class="widget-header">

      				<i class="icon-pencil"></i>

      				<h3>Upload from file</h3>

  				</div> <!-- /widget-header -->

				

				
				<?php

				/* Displays details of GD support on your server */

				/*echo '<div style="margin: 10px;">';

				echo '<p style="color: #444444; font-size: 130%;">GD is ';

				if (function_exists("gd_info")) {

					echo '<span style="color: #00AA00; font-weight: bold;">supported</span> by your server!</p>';

					$gd = gd_info();
						
					foreach ($gd as $k => $v) {

						echo '<div style="width: 340px; border-bottom: 1px solid #DDDDDD; padding: 2px;">';
						echo '<span style="float: left;width: 300px;">' . $k . '</span> ';

						if ($v)
							echo '<span style="color: #00AA00; font-weight: bold;">Yes</span>';
						else
							echo '<span style="color: #EE0000; font-weight: bold;">No</span>';

						echo '<div style="clear:both;"><!-- --></div></div>';
					}

				} else {

					echo '<span style="color: #EE0000; font-weight: bold;">not supported</span> by your server!</p>';

				}

				echo '<p>by <a href="http://www.dagondesign.com">dagondesign.com</a></p>';

				echo '</div>';*/

				?>
				
				
				
				
				<div class="widget-content" style="min-height: 251px;">	

					<form id="add_more_form" action="/stream/upload" method="POST" style="margin:0">
						<a onclick="document.getElementById('add_more_form').submit();" class="btn btn-tertiary">
								&nbsp;<i class="icon-long-arrow-left"></i>&nbsp;Back to Socials
						</a>
						<input type="hidden" name="stream_id" id="stream_id" value="<?=$this->session->userdata('stream_id')?>" />
					</form>
					<? $id = $this->session->userdata('stream_id'); ?>
					<a href="<?=base_url()?>stream/album/<?=url_title($this->photostream->getinfobyid('title',$id))?>/<?=$this->session->userdata('stream_id')?>" class="btn btn-tertiary">
							&nbsp;<i class="icon-picture"></i>&nbsp;View Stream
					</a>
						
						
						<div class="row-fluid" style="text-align: center;padding-top: 45px;">
							<h4>Upload from file</h4>
							<div class="row-fluid">
								
								<input type="hidden" id="stream_id" name="stream_id" value="<?=$stream_id?>"/>
								<div id="photo_up" class="photo_up">
									<div id="user_image" class="userphoto" style="height:200px;width:200px;">
										<div id="files" class="files" style="display:block"></div> 
									</div>
									<span class="btn btn-primary btn-small fileinput-button" id="uploadbutton" style="margin-left: 20px;margin-top: 3px;">                               
										<i class="icon-plus icon-white"></i>                               
										<span>Upload Image</span>                               
										<!-- The file input field used as target for the file upload widget --> 
										<input id="fileupload" type="file" name="files[]" multiple>  
									</span>
									<div id="progress" class="progress progress-success progress-striped" style="margin-left: 20px;margin-top: 3px;">
										<div class="bar"></div>                        
									</div> 
									<!-- The container for the uploaded files -->
									
									<span id="saved_status" class="help-block" style="margin-left: 20px;margin-top: 3px;"></span>
								</div>
								
								
							</div>
						</div>
				</div>

				

			</div><!-- widget stacked -->

		</div><!-- span12 -->

		

      </div> <!-- /row -->



    </div> <!-- /container -->

    

</div> <!-- /main -->



<?php $this->load->view('backend/footer')?>    

<script src="./js/libs/jquery-1.8.3.min.js"></script>

<script src="./js/libs/jquery-ui-1.10.0.custom.min.js"></script>

<script src="./js/libs/bootstrap.min.js"></script>


<script src="/js/upload/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="/js/upload/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="/js/upload/jquery.fileupload.js"></script>


<script type="text/javascript">

  /*jslint unparam: true */
    /*global window, $ */
    $(function () {
        'use strict';
        // Change this to the location of your server-side upload handler:
        var url = '/photo/uploadpic';
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    if(file.error){
                        $('#saved_status').text("Ooops! You uploaded a file alright but it's not in the correct format. We only accept .jpg, .jpeg, or .png files");
                    }else{
                        $('#saved_status').text("Please wait while we are saving your image..");
                        $('<p/>').html("<img src='http://photostream.com/uploads/profile/thumbnail/"+file.name+"'/>").appendTo('#files');
                        $('#userimage').attr('src',file.name);
						var stream_id = $('#stream_id').val();
                        //automatically save user profile image
                        $.post('/photo/savefileimage',{filename:file.name,stream_id:stream_id},function(data){
                            if(data == "OK"){
                                var filename = file.name;
                                var ext = filename.split('.').pop().toLowerCase();
                                if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                                    $('#saved_status').text("The file you are trying to upload is invalid.");
                                }else{
                                    $('#saved_status').text("Your image has been saved.");
                                }
                            }else{
                                $('#saved_status').text("An error occurred while uploading your image. Please try again.");
                            }
                        });
                    }
                });
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .bar').css(
                    'width',
                    progress + '%'
                );
            }
        }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
    });


</script>


<script type="text/javascript">

	activateMenu("stream_menu");

</script>