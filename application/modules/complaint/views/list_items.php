<style>
/* .table-scrollable {
    width: auto;
    overflow-x: scroll!important;
    overflow-y: scroll;
    border: 1px solid #e7ecf1;
    margin: 10px 0!important;
} */
.table-scrollable {
    width: auto;
    overflow-x: visible;
    overflow-y: visible;
    /* border: 1px solid #e7ecf1; */
    /* margin: 10px 0!important; */
}
.table-scrollable .dataTable td>.btn-group, .table-scrollable .dataTable th>.btn-group {
    position: relative;
    margin-top: -2px;
}
</style>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN DASHBOARD STATS 1-->
                        <div class="clearfix"></div>
                        <!-- END DASHBOARD STATS 1-->
						
						<h1 class="page-title" style="font-weight: 500"><?php echo $page_title; ?> 

                        </h1>
						<div class="row">
						<div class="portlet light bordered">
                                    <div class="portlet-title">
                           
                                    <div class="portlet-body">
                                        <div class="table-toolbar">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="btn-group btn_grp_list">
                                                        <a href='<?php echo base_url("complaint/add"); ?>' id="sample_editable_1_new" class="btn sbold green"> Add New
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    
                                                         <button id="delete_btn_list" class="btn sbold green"> Delete
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    <!--- filter starts 27-12-2018-->
                                                    
                                                    <form method="get" id="form_search" >
                                                        <div  class="col-md-2">
                                                                <select name="priority" class="form-control search_filter" id="" >
                                                                    <option value="">Priority</option>
                                                                    <option value="1" <?php echo set_select('priority', '1', @$_GET['priority'] == '1' && !empty(@$_GET['priority']) ? TRUE : FALSE); ?>>Low </option>
                                                                    <option value="2" <?php echo set_select('priority', '2', @$_GET['priority'] == '2' && !empty(@$_GET['priority']) ? TRUE : FALSE); ?>>Medium	</option>
                                                                    <option value="3" <?php echo set_select('priority', '3', @$_GET['priority'] == '3' && !empty(@$_GET['priority']) ? TRUE : FALSE); ?>>High</option>
                                                                    
                                                                </select>
                                                            </div>
                                                            <?php if ( getUserInfos()->role == "0") { ?>
                                                            <div  class="col-md-2">
                                                                <select name="manager_id" class="form-control search_filter" id="" >
                                                                    <option value="">Branch Manager</option>
                                                                    <?php if (isset($manager) && !empty($manager)) { ?>
                                                                        <?php foreach ($manager as $key => $val) { ?>
                                                                            <option value="<?php echo $val->id; ?>"<?php if ($val->id == @$_GET['manager_id']) { echo "selected"; } ?>><?php echo $val->fname.' '.$val->lname ?></option>
                                                                          <?php } ?>
                                                                          <?php } ?>
                                                                </select>
                                                            </div>
                                                                        <?php } ?>
                                                                <div  class="col-md-2">
                                                                <select name="coordinator_id" class="form-control search_filter" id="" >
                                                                    <option value=""> Coordinator</option>
                                                                    <?php if (isset($coordinator) && !empty($coordinator)) { ?>
                                                                        <?php foreach ($coordinator as $key => $val) { ?>
                                                                            <option value="<?php echo $val->id; ?>"<?php if ($val->id == @$_GET['coordinator_id']) { echo "selected"; } ?>><?php echo $val->fname.' '.$val->lname ?></option>
                                                                          <?php } ?>
                                                                          <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div  class="col-md-2">
                                                                <select name="serviceperson_id" class="form-control search_filter" id="" >
                                                                    <option value="">Service Person</option>
                                                                    <?php if (isset($serviceperson) && !empty($serviceperson)) { ?>
                                                                        <?php foreach ($serviceperson as $key => $val) { ?>
                                                                            <option value="<?php echo $val->id; ?>"<?php if ($val->id == @$_GET['serviceperson_id']) { echo "selected"; } ?>><?php echo $val->fname.' '.$val->lname ?></option>
                                                                          <?php } ?>
                                                                          <?php } ?>
                                                                </select>
                                                            </div>
                                                        </form>

                                                    <!----- filter ends 27-12-2018--->
                                                    </div>
													
                                                </div>
                                             
                                            </div>
                                        </div>
                                      
                                         <table class="table  table-striped table-bordered table-hover table-checkable order-column"   id="location-grid">
                                            <thead>
                                                <tr>
                                                    <!-- <th>
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable checks_all_click" name="abcd" value="" />
                                                            <span></span>
                                                        </label>
                                                    </th> 
                                                     -->
                                                    <th>S.No.</th>
                                                    <th>Complaint<br>ID</th>
                                                    <th>Type<br>of<br>Complaint</th>
                                                    <th>Client<br>Name</th>
													<th>Contact<br>Person</th>
													<th>Contact<br>No.</th>
													<th>Priority</th>
                                                    <?php if ( getUserInfos()->role == "0")
                                                    { ?>
													<th>Branch<br>Manager</th>
                                                    <?php } ?>
													<th>Coord</th>
													<th>Assigned<br>Service<br>Person</th>
													<th>Status</th>
                                                    <th width = 12% > Actions </th>
                                                </tr>
                                            </thead>
                                          </table>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->					
						
						</div>
						
                            
                            
                        </div>
                    </div>
                        <!-- chart 3 -->

<style>

 </style>   
<script>

    // begin first table
    $(document).ready(function(){             
        var table = $('#location-grid');
        
        
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n     
            "bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.
            "processing": true,
            "serverSide": true, 
           "lengthMenu": [[5,50, 100, 200, -1],[10,50, 100, 200, "All"]], // change perpage values here
            // set the initial value
          
            "pageLength":'5',            
            "pagingType": "bootstrap_full_number",
            "language": {"search": "",searchPlaceholder: "Search ","lengthMenu": "  _MENU_ Records","paginate": {"previous":"Prev","next": "Next","last": "Last","first": "First"}},
            "columnDefs"      : [{ 'className': 'control', 'orderable': true, 'targets':[1]}, 
                {'orderable': false, 'targets': [0,-1,9,-2] },
                {"targets": [0],"searchable": false}
            ],
            "ajax":{
                url :"<?php echo base_url();?>complaint/list_items_ajax?<?php echo $_SERVER["QUERY_STRING"]; ?>", // json datasource
                type: "post",                              
				error: function(data){
					alert(data);
                    //console.log(data);
                }
            } ,           
            "order": [[1, "desc"]] // set first column as a default sort by desc// set first column as a default sort by desc
        });                 
       
//        $("#bulkDelete").on('click',function() { // bulk checked
//            var status = this.checked;
//            $(".deleteRow").each( function() {
//                $(this).prop("checked",status);
//            });
//        });               
    });

    /* $(".custom_filter").on("change",function(){
        submitForm();
    });
    
    function submitForm(){
        $("#search_section").submit();
    } */
      
    $(".search_filter").on("change",function(){
		$("#form_search").submit();
	});
         
    
    $(document).ready(function() {
        var table = $('#location-grid').DataTable();
        $('#location-grid tbody').on( 'click', '.delete_row', function () { 
        var id = $(this).attr("data-id");           
        jConfirm('Are you sure?', 'Confirmation Dialog', function(r) {
            
              if(r==true)
                {
                    $.ajax({
                        url:"<?php echo base_url('leadmanagement/delete'); ?>",
                        type:"POST",
                        data:{id:id},
                        success:function(){
                            //table.draw();
                            window.location.href="<?php echo base_url('leadmanagement/list_items'); ?>";
                        },
                        error:function(){
                            alert("Row was not deleted");
                        }
                    });
                } 
            
    });
                         
        });
    });		
	
	//****************************Multiple delete******************************************//		
$('#delete_btn_list').click(function(){
		var arrNumber = new Array();
    $('.checks_all').each(function(){
	     if($(this).prop("checked") == true){
		   arrNumber.push($(this).val());
	    }
  })
  
  
  var all_id=arrNumber;
 
  if(all_id.length>=1){
	jConfirm('Are you sure?', 'Confirmation Dialog', function(s) {  
	if(s==true)
                {
				//	alert(arrNumber);
             $.ajax({
	   
                    type:"POST",
                    url:"<?php echo base_url("leadmanagement/delete_multiple") ?>",
                    data:{ids:all_id},
	                success:function(data){
                           window.location.href = "<?= base_url() ?>leadmanagement/list_items";
                      }
            });
		}
	  }); 
     }
  else{
        alert("Select at least one record");
        return false;
    }
 
 
});
//********************************************************************************//	
	
	$('.checks_all_click').click(function(){
		if($(this). prop("checked")){
			$('.checks_all').attr('checked', true);
		}else{
			$('.checks_all').attr('checked', false);
		}
	 });
</script>

<style>
    .input-small {
    width: 212px!important;
}

</style>

