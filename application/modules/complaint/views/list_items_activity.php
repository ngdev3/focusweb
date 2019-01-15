<style>

    .input-icon p{margin: 0px;}
    .input-icon{padding: 0px 0 0 0}
    .mt-15{margin-top: 15px;}
    .form-horizontal .control-label{text-align:left!important;font-weight:600;}
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

                                            
                                        </div>
                                        <?php     if(getUserInfos()->role == "0"){ ?>              
                        <div class="form-group col-md-4 col-sm-12">
                        <label for="inputEmail12" class="col-md-6 control-label bold">Branch Manager :</label>
                        <div class="col-md-6">
                            <div class="input-icon" >
                                <p><?php echo  ucwords($manager->fname. ' '.$manager->lname); ?></p>                          
                            </div>
                        </div>
                    </div>
                           <?php } ?>
                           <?php     if(getUserInfos()->role == "0" || getUserInfos()->role == "1"){ ?>              
                            <div class="form-group col-md-4 col-sm-12">
                        <label for="inputEmail12" class="col-md-6 control-label bold">Coordinator :</label>
                        <div class="col-md-6">
                            <div class="input-icon" >
                                <p><?php echo  ucwords($cordinator->fname. ' '.$cordinator->lname); ?></p>                          
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="inputEmail12" class="col-md-6 control-label bold">Service person :</label>
                        <div class="col-md-6">
                            <div class="input-icon" >
                                <p><?php echo  ucwords($res->fname. ' '.$res->lname); ?></p>                          
                            </div>
                        </div>
                    </div>
                  
                    <?php } ?>
                    <?php     if(getUserInfos()->role == "4"){ ?>     
                        <div class="form-group col-md-10 col-sm-12">
                        <label for="inputEmail12" class="col-md-2 control-label bold">Service person :</label>
                        <div class="col-md-2">
                            <div class="input-icon" >
                                <p><?php echo  ucwords($res->fname. ' '.$res->lname); ?></p>                          
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                  
                                         <table class="table table-striped table-bordered table-hover table-checkable order-column"   id="location-grid">
                                            <thead>
                                                <tr>
                                                    <!-- <th>
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable checks_all_click" name="abcd" value="" />
                                                            <span></span>
                                                        </label>
                                                    </th> 
                                                     -->
                                                    <th> S No. </th>
                                                   <!--  <th> Branch<br> Manager</th>
													<th> Coordinator</th>
													<th>Assigned<br> Service <br>Person</th> -->
                                                    <th>Activity Title </th>
                                                    <th> Client<br> Name</th>
                                                    <th> Contact<br> Person</th>
                                                    <th>Address</th>
                                                    <th>Date<br> &<br>Time </th>
													<th>Status</th>
                                                    <th width = 14% > Action </th>
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
                {'orderable': false, 'targets': [0,-1,-2] },
                {"targets": [0],"searchable": false}
            ],
            "ajax":{
                url :"<?php echo base_url();?>complaint/list_items_activity_ajax/<?php echo $this->uri->segment(3);?>?<?php echo $_SERVER["QUERY_STRING"]; ?>", // json datasource
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
                        url:"<?php echo base_url('complaint/delete'); ?>",
                        type:"POST",
                        data:{id:id},
                        success:function(){
                            //table.draw();
                            window.location.href="<?php echo base_url('complaint/list_items_activity'); ?>";
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
                           window.location.href = "<?= base_url() ?>complaint/list_items_activity";
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

