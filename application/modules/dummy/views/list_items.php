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
				<h4>Lead ID: <span>123456</span></h4>
			</div>
			<div class="col-md-7 col-lg-7 info_top">
				<div class="col-md-12 info_main_div p-10">
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Type of Lead</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"> Phone Enquiry </p>
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
								<p class="form-control-static"> Chinna Swamy </p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Assigned Sales person</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"> Iyer </p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Branch manager</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"> Venu Gopal </p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Coordinator</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static"> Venu Gopal </p>
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
								<label class="control-label">Contact Person</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static">Krishna Murthy</p>
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
								<p class="form-control-static">9874255145</p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Email-ID</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static">murthy@gmail.com</p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">priority</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static">Medium</p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Notes</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static">Dummy text</p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Status</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static">Lost</p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Reason</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static">Lorem Ipsum Text Lorem Ipsum Text Lorem Ipsum Text Lorem Ipsum Text Lorem Ipsum Text Lorem Ipsum Text</p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Comment</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static">Lorem Ipsum Text</p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div">
						<div class="form-group">
							<div class="col-md-6">
								<label class="control-label">Lost to</label>
							</div>
							<div class="col-md-6">
								<p class="form-control-static">CSSC Generator Corp</p>
							</div>
							<span class="colons">:</span>
						</div>
					</div>
					<div class="col-md-12 info_div text-center">
						<button class="btn blue-hoki">Back</button>
					</div>
				</div>
			</div>
			<div class="col-md-5 col-lg-5 info_top">
				<div class="view_activity p-10">
					<div class="view_btn">
						<button class="btn btn-info">View Activity</button>
					</div>
					<div class="view_date">
						<h4>Date Of Activity Assigned:<span>12/12/18</span></h4>
					</div>
				</div>
				<div class="scroll_activity custom_scroll">
					<div class="meeting">
						<div class="meeting_head">Meeting 1</div>
						<div class="about_client p-10">
							<div class="about_1">
								<div class="img_container"><img src=""></div>
								<div class="cust_name text-center"><h5>Deepak singh</h5></div>
							</div>
							<div class="about_2">
								<div class="dt_delivery"><h4>Date & Time of Activity</h4><span>:22/12/18 04:00PM</span></div>
								<div class="status"><h4>Status</h4><span>:In Process</span></div>
							</div>
						</div>
						<div class="change_employe text-center m-10">
							<button class="btn yellow-mint">Change Employee</button>
						</div>
					</div>
					<div class="meeting">
						<div class="meeting_head">Meeting 1</div>
						<div class="about_client p-10">
							<div class="about_1">
								<div class="img_container"><img src=""></div>
								<div class="cust_name text-center"><h5>Deepak singh</h5></div>
							</div>
							<div class="about_2">
								<div class="dt_delivery"><h4>Date & Time of Activity</h4><span>:22/12/18 04:00PM</span></div>
								<div class="status"><h4>Status</h4><span>:In Process</span></div>
							</div>
						</div>
						<div class="change_employe text-center m-10">
							<button class="btn yellow-mint">Change Employee</button>
							<button class="btn blue-madison" data-toggle="modal" data-target="#myModal">View Reason</button>
						</div>
					</div>
					<div class="meeting">
						<div class="meeting_head">Meeting 1</div>
						<div class="about_client p-10">
							<div class="about_1">
								<div class="img_container"><img src=""></div>
								<div class="cust_name text-center"><h5>Deepak singh</h5></div>
							</div>
							<div class="about_2">
								<div class="dt_delivery"><h4>Date & Time of Activity</h4><span>:22/12/18 04:00PM</span></div>
								<div class="status"><h4>Status</h4><span>:In Process</span></div>
							</div>
						</div>
						<div class="change_employe text-center m-10">
							<button class="btn yellow-mint">Change Employee</button>
							<button class="btn blue-madison" data-toggle="modal" data-target="#myModal">View Reason</button>
						</div>
					</div>
					<div class="meeting">
						<div class="meeting_head">Meeting 1</div>
						<div class="about_client p-10">
							<div class="about_1">
								<div class="img_container"><img src=""></div>
								<div class="cust_name text-center"><h5>Deepak singh</h5></div>
							</div>
							<div class="about_2">
								<div class="dt_delivery"><h4>Date & Time of Activity</h4><span>:22/12/18 04:00PM</span></div>
								<div class="status"><h4>Status</h4><span>:In Process</span></div>
							</div>
						</div>
						<div class="change_employe text-center m-10">
							<button class="btn yellow-mint">Change Employee</button>
							<button class="btn blue-madison" data-toggle="modal" data-target="#myModal">View Reason</button>
						</div>
					</div>
					<div class="meeting">
						<div class="meeting_head">Meeting 1</div>
						<div class="about_client p-10">
							<div class="about_1">
								<div class="img_container"><img src=""></div>
								<div class="cust_name text-center"><h5>Deepak singh</h5></div>
							</div>
							<div class="about_2">
								<div class="dt_delivery"><h4>Date & Time of Activity</h4><span>:22/12/18 04:00PM</span></div>
								<div class="status"><h4>Status</h4><span>:In Process</span></div>
							</div>
						</div>
						<div class="change_employe text-center m-10">
							<button class="btn yellow-mint">Change Employee</button>
							<button class="btn blue-madison" data-toggle="modal" data-target="#myModal">View Reason</button>
						</div>
					</div>
					<div class="meeting">
						<div class="meeting_head">Meeting 1</div>
						<div class="about_client p-10">
							<div class="about_1">
								<div class="img_container"><img src=""></div>
								<div class="cust_name text-center"><h5>Deepak singh</h5></div>
							</div>
							<div class="about_2">
								<div class="dt_delivery"><h4>Date & Time of Activity</h4><span>:22/12/18 04:00PM</span></div>
								<div class="status"><h4>Status</h4><span>:In Process</span></div>
							</div>
						</div>
						<div class="change_employe text-center m-10">
							<button class="btn yellow-mint">Change Employee</button>
							<button class="btn blue-madison" data-toggle="modal" data-target="#myModal">View Reason</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
        <div class="col-md-12 form-group m-10">
			<label class="col-md-6 control-label">Reason For Reschedule</label>
			<div class="col-md-6">
				<input type="text" class="form-control" placeholder="Enter text">
			</div>
		</div>
		<div class="col-md-12 form-group m-10">
			<label class="col-md-6 control-label">Date & Time</label>
			<div class="col-md-3">
				<input type="text" class="form-control" placeholder="Enter Date">
			</div>
			<div class="col-md-3">
				<input type="text" class="form-control" placeholder="Enter Time">
			</div>
		</div>
		<div class="col-md-12 form-group m-10">
			<label class="col-md-6 control-label">Textarea</label>
			<div class="col-md-6">
				<textarea class="form-control" rows="3"></textarea>
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
					