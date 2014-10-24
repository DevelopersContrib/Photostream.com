<?php $this->load->view('backend/header')?>
<?php $this->load->view('backend/navigation')?>
<link rel="stylesheet" href="/css/demo_table.css" type="text/css" media="all" />
<script src="/js/jquery.dataTables.js" type="text/javascript"></script>
<script type="text/javascript" src="/js/jquery.dataTables.columnFilter.js"></script>

<div class="main">
	  <div class="container">

	
	  
      <div class="row">
      
		<div class="span12">      		
      		
      		<div class="widget stacked ">
			
					
					<div class="widget-header">

						<div class="row-fluid">
							<div class="span12">
								<div class="row-fluid">
									<div class="span12" style="padding:3px 10px 0 10px;">
										<div class="row-fluid">
											<div class="wrap-user-title">
												<div style="padding: 3px 0 3px 0;">
													<h3 style="margin: 0;margin-top:2px;display:inherit;line-height: 15px;top:2px;font-size: 18px;">List of members</h3>
													
													
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div> <!-- /widget-header -->
					
					
				
					<div class="widget-content" style="min-height: 245px;">
						
						
						<div class="row-fluid members" id="_members">
						<div class="span12">
							<h3>Members</h3>
							 <table id="memberstable" class="display">
								<thead>
								   <tr>
										<th align="left">Id</th>
										<th align="left">Firstname</th>
										<th align="left">Lastname</th>
										<th align="left">Email</th>
										<th align="left">Action</th>
									</tr>
								</thead>
								 <tbody>
									<tr>
									  <td>loading...</td>
									</tr>
								  </tbody>
							</table>
						</div>
					</div>
							
					</div><!-- widget content -->
					
						
						
					
				
				
				
			</div><!-- widget stacked -->
		</div><!-- span12 -->
		
      </div> <!-- /row -->

    </div> <!-- /container -->
  
</div> <!-- /main -->



<?php $this->load->view('backend/footer')?>
<script>
$(function() {
	
		$('#memberstable').dataTable( {
		  "aaSorting": [ [0,'asc']],
	       "aoColumns": [
	           { "bSearchable": true ,"bSortable": true},
	           { "bSearchable": true , "bSortable": true},
	           { "bSearchable": true , "bSortable": true},
			   { "bSearchable": true , "bSortable": true},
			   { "bSearchable": true , "bSortable": true,
						"fnRender": function ( o, val ) {
						
						var id = o.aData[0];
						var isAdmin = o.aData[4];
	                 
					 if(isAdmin == 1){
                      return "<a id='user_"+id+"' class='admin' >Admin</a>";
					 // return "<a href='#myModal' role='button' class='btn' data-toggle='modal'>Launch demo modal</a>"
					 }else{
					 
						return "<a id='user_"+id+"' class='admin' >Make Admin</a>";
					 
					 }
	                }	
			  
			  }
	       ],
	       
	       "bProcessing": true,
	       "bServerSide": true,
	       "sAjaxSource": "/dashboard/mymemberstable",
		   
		   
		   "fnDrawCallback": function( oSettings ) {
			jQuery('.admin').click(function(){
			var str = $(this).attr('id');
			var id = str.replace("user_","");
			var message = $(this).html();
					
				if(message == "Make Admin"){
					jQuery.post('/dashboard/makeAdmin',{id:id},function(data){
					
						$('#user_'+id).html(data);
					
					});
				}else{
				
					jQuery.post('/dashboard/removeAdmin',{id:id},function(data){
					
						$('#user_'+id).html(data);
					
					})
				
				
				}
					
					
			
			});
			
			
			
		}   
		   
		   
		   
	   } );  
})	   
</script>