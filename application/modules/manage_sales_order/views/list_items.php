
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
                                                       
                                                        <!--  <button id="delete_btn_list" class="btn sbold green"> Delete
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                         -->
                                                        
                                                           <form method="get" id="form_search" >
                                                       <?php     if(getUserInfos()->role == "0"){ ?>
                                                            <div  class="col-md-3">
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

                                                                          <?php     if(getUserInfos()->role == "0"||getUserInfos()->role == "1"){ ?>
                                                                <div  class="col-md-3">
                                                                <select name="coordinator_id" class="form-control search_filter" id="" >
                                                                    <option value=""> Coordinator</option>
                                                                    <?php if (isset($coordinator) && !empty($coordinator)) { ?>
                                                                        <?php foreach ($coordinator as $key => $val) { ?>
                                                                            <option value="<?php echo $val->id; ?>"<?php if ($val->id == @$_GET['coordinator_id']) { echo "selected"; } ?>><?php echo $val->fname.' '.$val->lname ?></option>
                                                                          <?php } ?>
                                                                          <?php } ?>
                                                                </select>
                                                            </div>
                                                            <?php } ?>
                                                            <div  class="col-md-3">
                                                                <select name="client_id" class="form-control search_filter" id="" >
                                                                    <option value="">Client Name</option>
                                                                    <?php if (isset($client) && !empty($client)) { ?>
                                                                        <?php foreach ($client as $key => $val) { ?>
                                                                            <option value="<?php echo $val->id; ?>"<?php if ($val->id == @$_GET['client_id']) { echo "selected"; } ?>><?php echo $val->client_name ?></option>
                                                                          <?php } ?>
                                                                          <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div  class="col-md-3">
                                                                <select name="salesperson_id" class="form-control search_filter" id="" >
                                                                    <option value="">Sales Person</option>
                                                                    <?php if (isset($salesperson) && !empty($salesperson)) { ?>
                                                                        <?php foreach ($salesperson as $key => $val) { ?>
                                                                            <option value="<?php echo $val->id; ?>"<?php if ($val->id == @$_GET['salesperson_id']) { echo "selected"; } ?>><?php echo $val->fname.' '.$val->lname ?></option>
                                                                          <?php } ?>
                                                                          <?php } ?>
                                                                </select>
                                                            </div>
                                                        </form>
                                                      
                                                        
                                                    
                                                    </div>
													
                                                </div>
                                             
                                            </div>
                                        </div>
                                        
                                         <a href='<?php echo base_url("manage_sales_order/add"); ?>' id="sample_editable_1_new" class="btn sbold green pull-right">Create Order
                                    </a>
                                        <br><br> <br>          
                                        
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column"   id="location-grid">
                                            <thead>
                                                <tr>
                                                    <!-- <th style="width: 60px;">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable checks_all_click" name="abcd" value="" />
                                                            <span></span>
                                                        </label>
                                                    </th> -->
                                                    <th> SL.<br>No.</th>
                                                    <th> Date &<br> Time <br> of Order </th>
                                                    <th> Order <br> Number</th>
                                                    <th> Client <br> Name</th>
                                                    <?php if(getUserInfos()->role == "0"){ ?>
                                                    <th> Branch <br> Manager</th>
                                                    <th> Coordinator</th>
                                                    <?php } ?>
                                                    <?php if(getUserInfos()->role == "1"){ ?>
                                                    <th> Coordinator</th>
                                                    <?php } ?>
                                                    <th> Sales <br> Person</th>
                                                    <th> Address </th>
                                                    <th> Basic <br>Ordered <br> Value<br> (INR)</th>
                                                    <th> GST <br> (INR)</th>
                                                    <th> Total <br> Ordered <br> Value<br> (INR)</th>
                                                    <th> Advance <br> (INR)</th>
                                                    <th> Pending</th>
                                                    
                                                    <th width="14%"> Actions </th>
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
           "lengthMenu": [[5,10,50, 100, 200, -1],[5,10, 50,100, 200, "All"]], // change perpage values here
            // set the initial value
          
            "pageLength":'5',            
            "pagingType": "bootstrap_full_number",
            "language": {"search": "",searchPlaceholder: "Search ","lengthMenu": "  _MENU_ Records","paginate": {"previous":"Prev","next": "Next","last": "Last","first": "First"}},
            "columnDefs"      : [{ 'className': 'control', 'orderable': true, 'targets':[1]}, 
                {'orderable': false, 'targets': [0,-1,] },
                {"targets": [0],"searchable": false}
            ],
            "ajax":{
                url :"<?php echo base_url();?>manage_sales_order/list_items_ajax?<?php echo $_SERVER["QUERY_STRING"]; ?>", // json datasource
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

    $(".custom_filter").on("change",function(){
        submitForm();
    });
    
    function submitForm(){
        $("#search_section").submit();
    }
    

    
    
    $(document).ready(function() {
        var table = $('#location-grid').DataTable();
        $('#location-grid tbody').on( 'click', '.delete_row', function () { 
        var id = $(this).attr("data-id");           
        jConfirm('Are you sure?', 'Confirmation Dialog', function(r) {
            
              if(r==true)
                {
                    $.ajax({
                        url:"<?php echo base_url('manage_sales_order/delete'); ?>",
                        type:"POST",
                        data:{id:id},
                        success:function(){
                            //table.draw();
                            window.location.href="<?php echo base_url('manage_sales_order/list_items'); ?>";
                        },
                        error:function(){
                            alert("Row was not deleted");
                        }
                    });
                } 
            
    });
                         
        });
    });		

    $(".search_filter").on("change",function(){
		$("#form_search").submit();
	});
    </script>

<style>
    .input-small {
    width: 212px!important;
}

</style>

