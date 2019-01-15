
<div class="row">
        <div class="col-md-12 white-box"  style="margin-top: 40px;">
          <div class="portlet light">
          
          
          
          <<div class="portlet-title" style="margin-bottom: 20px;">
                    <div class="card-icon_headings" style="height:auto;text-align: left;">
                    <div class="caption"> <i class="fa fa-list font-red-sunglo"></i>
                      <span class="caption-subject font-red-sunglo bold uppercase mainpage-title"> 
                        <?php echo $page_title; ?> 
                      </span>
                     </div>
                   </div>
                  </div>


                  
            <div class="portlet-body">
                <div class="table-responsive1">
                    <table class="table table-striped table-bordered table-hover" id="log-grid">
                        <thead>
                            <tr>
                                <th width="5%"> S.No. </th>
<!--                                <th>Survey Manager No. </th>-->
                                
                                <th>Name </th>
                                 <th>Description</th>
<!--                                <th>Module Name </th>-->
<!--                                <th>Action</th>-->
                                <th> Created On</th>
                               
                            </tr>
                        </thead>                  
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    // begin first table
    $(document).ready(function(){             
        var table = $('#log-grid');
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n     
            "bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.
            "processing": true,
            "serverSide": true, 
            "lengthMenu": [[10,50, 100, 200, -1],[10,50, 100, 200, "All"]], // change perpage values here
            // set the initial value
          
            "pageLength":'10',            
            "pagingType": "bootstrap_full_number",
            "language": {"search": "Search: ","lengthMenu": "  _MENU_ Records","paginate": {"previous":"Prev","next": "Next","last": "Last","first": "First"}},
            "columnDefs"      : [{ 'className': 'control', 'orderable': true, 'targets':[1]}, 
                {'orderable': false, 'targets': [0,-1] },
                {"targets": [0],"searchable": false}
            ],
            "ajax":{
                url :"<?php echo base_url(); ?>logs/list_items_ajax?<?php echo $_SERVER["QUERY_STRING"]; ?>", // json datasource
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
        $("#search").submit();
    });

	
    
    function submitForm(){
        $("#search_section").submit();
    }
    
    
     $(document).ready(function() {
        var table = $('#log-grid').DataTable();
        $('#log-grid tbody').on( 'click', '.delete_row', function () { 
            var id = $(this).attr("data-id");           
            var r = confirm('Are you sure?', 'Confirmation Dialog');
                if(r)
                {
                    $.ajax({
                        url:"<?php echo base_url('logs/delete'); ?>",
                        type:"POST",
                        data:{id:id},
                        success:function(){
                            table.draw();
                        },
                        error:function(){
                            alert("Row was not deleted");
                        }
                    });
                }            
        });
    });
</script>
