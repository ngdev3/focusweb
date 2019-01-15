
<style>
    .input-small {
    width: 212px!important;
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
<center>
<form class="form-horizontal form-material" id="form_search" method="get" novalidate="novalidate">
<input readonly name="meeting_date" id="datepicker2" value="<?php if(empty($_GET)){echo "Date";}else{echo set_value("meeting_date", @$_GET['meeting_date']);} ?>" class=" custom_filter2 btn btn-primary datepicker trip_calander  required">                          
&nbsp;&nbsp;
</center>
                         
</form>
                
                
                  
                                    <div class="portlet-body">
                                        <div class="table-toolbar">

                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="btn-group btn_grp_list">
                                                  
                                                        <!--  <button id="delete_btn_list" class="btn sbold green"> Delete
                                                            <i class="fa fa-trash"></i>
                                                        </button> -->
                                                        
                                                        
                                                    </div>
													
                                                </div>
                                             
                                            </div>
                                        </div>
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column"   id="location-grid">
                                            <thead>
                                                <tr>
                                                    <th>S No.</th>
                                                    <th>Sales Person</th>
                                                    <th>Coordinator</th>
                                                    <th>Total Visits</th>
                                                    <th>No. of Enquiry Won</th>
                                                    <th>No. Enquiry Lost</th>
                                                    <th>Total Sale(INR)</th>
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
                {'orderable': false, 'targets': [0,-1,-2,-3,-4] },
                {"targets": [0],"searchable": false}
            ],
            "ajax":{
                url :"<?php echo base_url();?>salespersonactivity/list_items_ajax_sales_performance?<?php echo $_SERVER["QUERY_STRING"]; ?>", // json datasource
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
    
        $(".search_filter").on("change",function(){
		$("#form_search").submit();
	});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

<script>
$("#datepicker2").datepicker( {
    format: " dd-mm-yyyy",
    
    minViewMode: "days",
    
});
</script>



<script>
$(".custom_filter2").on("change",function(){
  
       $("#form_search").submit();
   });
</script>