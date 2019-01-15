<style>
.portlet.light.bordered {
	width:100%;
	float:left;
}
.form-control-static{
	padding-top:1px;
	font-size:17px;
	color: #938e8e;
}
.info_div{
	margin:10px 0px;
	position: relative;
}
label.control-label{
	text-transform:capitalize;
	font-size: 17px;
	color: #1f1f1f;
    font-weight: 500;

}
.lead_main{
	border: 1px solid #dbd6d6;
    padding: 0px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}
.lead_id{
	background: #36c6d3;
    padding: 10px 10px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}
.lead_id h4{
	margin-top: 0px;
    margin-bottom: 0px;
    color: #fff;
    font-weight: 500;
}
.colons{
	position: absolute;
    left: calc(50% - 1.5px);
    top: 1%;
	font-size: 17px;
    font-weight: 600;
	color: #6e6e6e;
}
.p-10{
	padding:10px;
}
.p-20{
	padding:10px;
}
.info_top{
	padding-top: 15px;
    padding-bottom: 15px;

}
.info_main_div{
	border-right: 1px solid #ebe2e2;
}
.view_btn{
	width: 30%;
    display: inline-block;
}
.view_date{
	width: 69%;
    display: inline-block;
    text-align: right;
}
.view_date h4 span{
	color: #938e8e;
}
.view_date h4{
	font-size:15px;
}
.meeting{
	border: 1px solid #36c6d3;
    margin-top: 15px;
    border-radius: 5px;
}
.meeting_head{
	padding: 5px 10px;
    background: #36c6d3;
	font-size: 15px;
    text-transform: uppercase;
	color: #fff;
}
.about_1{
	width: 25%;
    display: inline-block;
    vertical-align: top;
    padding: 0px 6px;
}
.img_container{
	height: 70px;
    width: 70px;
    margin: 0 auto;
    border: 1px solid #ccc;
    border-radius: 50%;
}
.about_2{
	width: 72%;
    display: inline-block;
}
.dt_delivery h4, .status h4{
	width: 50%;
    display: inline-block;
    font-size: 15PX;
    color: #000000;
	
}
.dt_delivery span, .status span{
	vertical-align: top;
    margin-top: 8px;
    display: inline-block;
    font-size: 15px;
    color: #7c7979;
}
.m-10{
	margin:10px;
}
.modal-dialog{
	top: calc(50% - 180px);
}
.modal-footer{
	text-align:center !important;
}
.scroll_activity{
	max-height: 920px;
    overflow: hidden;
    overflow-y: scroll;
}
.custom_scroll::-webkit-scrollbar {
    width: 5px;
	height:20px;
}
/* Track */
.custom_scroll::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey; 
    border-radius: 10px;
}
 
/* Handle */
.custom_scroll::-webkit-scrollbar-thumb {
    background: #c1c1c1; 
    border-radius: 10px;
}

/* Handle on hover */
.custom_scroll::-webkit-scrollbar-thumb:hover {
    background: #d54823; 
}
.modal-content{
	border: 2px solid #0f6ca9 !important;
}
</style>
<h1 class="page-title" style="font-weight: 500"><?php echo $page_title; ?> 

</h1>
<div class="row">
	<div class="portlet light bordered">
		<div class="col-md-12 col-lg-12 lead_main">
			<div class="lead_id">
				<h4>Complaint ID: <span><?php echo ucwords($res->dynamic_complaint_id); ?></span></h4>
			</div>
			<div class="col-md-7 col-lg-7 info_top">
				<div class="col-md-12 info_main_div p-10">
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Complaint Type:</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"> <?php echo ucwords($res->complaint_types); ?></p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Client name</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"><?php echo ucwords(@$res->client_name); ?> </p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Contact Person</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"> <?php echo @$res->contact_person; ?> </p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Branch Manager :</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"><?php echo @$res->manager_name; ?></p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
                                    
                                    
                                    <div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Coordinator :</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"><?php echo @$res->cordinator_name; ?></p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
                                    
                                    
                                    <div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Assigned Service Person :</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"><?php echo @$res->service_name; ?></p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Website</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"> www.skgroup.com </p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Contact Number</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"><?php echo @$res->contact_number	; ?></p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">priority</label>
							</div>
                                                    
                                                    				<?php if($res->priority=='1')
			{
			$priority='Low';	
			}
			if($res->priority=='2')
			{
			$priority='Medium';	
			}
			if($res->priority=='3')
			{
			$priority='High';	
			}   ?>
                                                    
                                                    
							<div class="col-md-6">
								<p class="form-control-static"><?php echo @$priority; ?></p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">DG Set Number :</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"><?php echo @$res->dg_set_number; ?></p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">KVA</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"><?php echo @$res->kva; ?></p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Engine/Alternator :</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"><?php echo @$res->engine_alternator; ?></p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Performance:</label>
							</div>
                                                    				<?php if($res->performance=='1')
			{
			$performance='Good';	
			}
			if($res->performance=='2')
			{
			$performance='Satisfactory';	
			}
			   ?>
                                                    
							<div class="col-md-6">
								<p class="form-control-static"><?php echo @$performance; ?></p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Efforts:</label>
							</div>
							<div class="col-md-6">
                                                            
                                                            				<?php if($res->efforts=='1')
			{
			$efforts='Good';	
			}
			if($res->efforts=='2')
			{
			$efforts='To Be Improved';	
			}
			  ?>
                                                            
								<p class="form-control-static"><?php echo @$efforts; ?></p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
                                    
                                    
                                    <div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Website :</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"><?php echo @$res->website; ?></p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
                                    
                                    
                                    
                                    
                                    <div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Location :</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"><?php if(@$res->location){ echo @$res->location;}else{ echo @$res->address;} ?></p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
                                    
                                    <div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Email Id:</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"><?php echo @$res->email_id; ?></p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Nature of Complaint</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"><?php echo @$res->complaint; ?></p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
                                 
                                    <div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Status :</label>
							</div>
							<div class="col-md-6">
                                                            
                                                             <?php
              if (@$res->outcome_status == '0') {
                $outcome_status = 'In Process';
            }                                          
           if (@$res->outcome_status == '1') {
                $outcome_status = 'Won';
            }
            if (@$res->outcome_status == '2') {
                $outcome_status = 'Lost';
            }
            if (@$res->outcome_status == '3') {
                $outcome_status = 'Continue';
            }
            if (@$res->outcome_status == '4') {
                $outcome_status = 'Reshedule';
            }

                                                        ?>  
                                                            
								<p class="form-control-static"><?php echo @$outcome_status; ?></p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
                                   
                                    
					<div class="col-md-12 info_div text-center">
						 <a href="<?php echo base_url("complaint/list_items"); ?>"class="btn green">Back</a>
					</div>
				</div>
			</div>
			<?php if($meeting){ ?>
                    
			<div class="col-md-5 col-lg-5 info_top">
				<div class="view_activity p-10">
					<div class="view_btn">
						<a href="<?php echo base_url('complaint/view_activity/'.  ID_encode($res->id)); ?>"class="btn btn-info">View Activity</a>
					</div>
					<div class="view_date">
						<h4>Date Of Activity Assigned:<span><?php echo date('d-m-Y',strtotime($res->assigned_activity_date)); ?></span></h4>
					</div>
				</div>
				<div class="scroll_activity custom_scroll">
					
                                    
                                    <?php $i=1;foreach($meeting as $client_metting){ ?>
					<div class="meeting">
						<div class="meeting_head">Meeting <?php echo $i; ?></div>
						<div class="about_client p-10">
							<div class="about_1">
								<div class="img_container">
                                                                    
                                                                    
                                                                    <img style="height: 69px;"class="thumb-lg img-circle" src="<?= base_url(); ?>uploads/profile_image/<?= ($client_metting->service_image != "") ? $client_metting->service_image : 'default.png'; ?>">
                                                                
                                                                </div>
								<div class="cust_name text-center"><h5><?php echo @$client_metting->service_name; ?></h5></div>
							</div>
							<div class="about_2">
                                                            
                                                            <?php if(@$client_metting->emp_add_type == '1' && @$client_metting->outcome_status == '0') { ?>
                                                            <h4>New Employee Assigned</h4>
                                                            <div class="dt_delivery"><h4 style="width: 44%;">Date of employee added</h4><span >: <?php echo date('d/m/Y',strtotime(@$client_metting->created_date));?></span></div>
                                                            
                                                            <?php } ?>
                                                            
                                                 
								<div class="dt_delivery"><h4 style="width: 44%;">Date & Time of Activity</h4><span >: <?php echo date('d/m/Y h:iA',strtotime(@$client_metting->created_date));?></span></div>
								                      
                                                            <?php if(@$client_metting->outcome_status == '4') { ?>
                                                           
                                                            <div class="dt_delivery"><h4 style="width: 44%;">Reschedule Date & Time</h4><span >: <?php echo date('d/m/Y',strtotime(@$client_metting->meeting_date));?> <?php echo date('h:iA',strtotime(@$client_metting->meeting_time));?></span></div>
                                                            
                                                            <?php } ?>


                                                            <?php if(@$client_metting->outcome_status == '1') { ?>
                                                           
                                                            <div class="dt_delivery"><h4 style="width: 44%;">Completed Date</h4><span >: <?php echo date('d/m/Y',strtotime(@$client_metting->meeting_date));?></span></div>
                                                            
                                                            <?php } ?>
                                                            
                                                             <?php if(@$client_metting->outcome_status == '2') { ?>
                                                           
                                                            <div class="dt_delivery"><h4 style="width: 44%;">Lost Date</h4><span >: <?php echo date('d/m/Y',strtotime(@$client_metting->meeting_date));?></span></div>
                                                            
                                                            <?php } ?>
                                                            
                                                             <?php if(@$client_metting->outcome_status == '3') { ?>
                                                           
                                                            <div class="dt_delivery"><h4 style="width: 44%;">Continued Date & Time</h4><span >: <?php echo date('d/m/Y',strtotime(@$client_metting->meeting_date));?> <?php echo date('h:iA',strtotime(@$client_metting->meeting_time));?></span></div>
                                                            
                                                            <?php } ?>
                                                            
                                                            


  <?php
              if (@$client_metting->outcome_status == '0') {
                $outstatus = 'In Process';
            }                                          
           if (@$client_metting->outcome_status == '1') {
                $outstatus = 'Won';
            }
            if (@$client_metting->outcome_status == '2') {
                $outstatus = 'Lost';
            }
            if (@$client_metting->outcome_status == '3') {
                $outstatus = 'Continue on another day';
            }
            if (@$client_metting->outcome_status == '4') {
                $outstatus = 'Reshedule';
            }

                                                        ?> 
                                                                
                                                                
                                                                
                                                                
                                                                
                                                            <div class="status"><h4 style="width: 30%;">Status</h4><span>: <?php echo $outstatus;?></span></div>
							</div>
						</div>
						<div class="change_employe text-center m-10">
                                                         
                                                    <?php if(count($meeting)=== $i){ ?>
<!--							<a href="<?php echo base_url('leadmanagement/assign_activity/'.  ID_encode($res->id)); ?>"class="btn yellow-mint"></a>-->
							<?php if(@$client_metting->outcome_status!='1' && @$client_metting->outcome_status!='2'){ ?>
                                                      <button class="btn yellow-mint" data-toggle="modal" data-target="#myModalemp">Change Employee</button>

                                                        
                                                          <?php }  ?>
                                                        <?php }  ?>
                                                        <?php if(@$client_metting->outcome_status=='4'){  ?>
                                                        
                                                        <button class="btn blue-madison" data-toggle="modal" data-target="#myModal<?php echo @$client_metting->id?>">View Reason</button>
                                                        <?php }  ?>
                                                
                                                
                                                </div>
					</div>
                                    
                                    
                                    
                                    <!-- Modal -->
<div id="myModal<?php echo @$client_metting->id?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
        <div class="col-md-12 form-group m-10">
			<label class="col-md-6 control-label">Reason For Reschedule</label>
			<div class="col-md-6">
                            <input type="text" value="<?php echo @$client_metting->reason_title;?>" class="form-control" readonly="" placeholder="Enter text">
			</div>
		</div>
		<div class="col-md-12 form-group m-10">
			<label class="col-md-6 control-label">Date & Time</label>
			<div class="col-md-3">
				<input type="text" value="<?php echo date('d/m/Y',strtotime(@$client_metting->meeting_date));?>" class="form-control" readonly="" placeholder="Enter Date">
			</div>
			<div class="col-md-3">
				<input type="text"  value="<?php echo date('h:iA',strtotime(@$client_metting->start_time));?>" class="form-control" readonly="" placeholder="Enter Time">
			</div>
		</div>
		<div class="col-md-12 form-group m-10">
			<label class="col-md-6 control-label">Textarea</label>
			<div class="col-md-6">
				<textarea class="form-control" rows="3" readonly=""> <?php echo @$client_metting->reason_description;?></textarea>
			</div>
		</div>
      </div>
      <div class="modal-footer text-center">
		<button type="button" class="btn blue" data-dismiss="modal">Submit</button>
        <button type="button" class="btn red-mint" data-dismiss="modal">Close</button>
        
      </div>
    </div>

  </div>
</div>
<!-- modal -->
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                     <?php $i++; } ?>
                                      
					
				</div>
			</div>
                      <?php } ?>
		</div>
	</div>
</div>

<div id="myModalemp" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
        <div class="col-md-12 form-group m-10">
			<label class="col-md-4 control-label">Select Sales Person</label>
			<div class="col-md-8">
                            
                              <select class="form-control edited" name="service_person_id" id="service_person_id">
                                        <option value="">Select Service Person</option>
                                        <?php foreach (@$serviceperson as $value) { ?>
                                            <option value="<?php echo $value->id; ?>" <?php echo set_select('serviceperson_id', $value->id, $value->id == @$res->service_person_id ? TRUE : FALSE); ?> ><?php echo $value->fname . ' ' . $value->lname; ?></option>
                                        <?php } ?>
                                    </select>
                            
                            
                            
			</div>
		</div>
		
		
      </div>
      <div class="modal-footer text-center">
		<button type="button" class="btn blue" id="change_emp">Submit</button>
        <button type="button" class="btn red-mint" data-dismiss="modal">Close</button>
        
      </div>
    </div>

  </div>
</div>

<script>
    $("#change_emp").click(function(){
       var service_person_id=$("#service_person_id").val();
       var complaint_id="<?php echo @$res->id; ?>"
      
      
        $.ajax({
	   
                    type:"POST",
                    url:"<?php echo base_url("complaint/change_employee") ?>",
                    data:{service_person_id:service_person_id,complaint_id:complaint_id},
	                success:function(data){
                            
                            location.reload();
                           //window.location.href = "<?= base_url() ?>salesperson/list_items";
                      }
            });
        
    });
    </script>