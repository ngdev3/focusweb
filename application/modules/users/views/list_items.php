
<div class="row ">
    <div class="col-md-12 white-box">
        <div class="portlet light">

            <div class="portlet-title">
                <div class="caption"> <i class="fa fa-list font-red-sunglo"></i> <span class="caption-subject font-red-sunglo bold uppercase"> <?php echo $page_title; ?></span>
                </div>
                <div class="actions">
                    <div class="portlet-input input-inline input-small">
<!--                        <div class="input-icon right"> <i class="icon-magnifier"></i>
                        <input type="text" class="form-control input-circle" placeholder="search...">
                      </div>-->
                        <div class="pull-right"> 
                            <a href="<?php echo base_url("users/add"); ?>"> 
                                <button type="button" class="btn btn-danger"><i class="fa fa-plus"></i> Add </button>
                            </a>
                        </div>
                    </div>
                </div>

            </div>          
            <div class="portlet-body">
                <div class="table-responsive1">
                    <table class="table table-striped table-bordered table-hover" id="employee-grid">
                        <thead>
                            <tr>
                                <th width="5%"> S.No. </th>
                                <th> User Name </th>
                                <th> Email </th>
                                <th> Role </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                        </thead>                  
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

 </style>   
<script>

    // begin first table
    $(document).ready(function(){             
        var table = $('#employee-grid');
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
                url :"users/list_items_ajax?<?php echo $_SERVER["QUERY_STRING"]; ?>", // json datasource
                type: "post",                              
				error: function(data){
					alert(data);
                    //console.log(data);
                }
            } ,           
            "order": [[0, "desc"]] // set first column as a default sort by desc// set first column as a default sort by desc
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
        var table = $('#employee-grid').DataTable();
        $('#employee-grid tbody').on( 'click', '.delete_row', function () { 
            var id = $(this).attr("data-id");           
            jConfirm('Are you sure?', 'Confirmation Dialog', function(r) {
           
           
            if(r==true)
                {
                    $.ajax({
                        url:"<?php echo base_url('users/delete'); ?>",
                        type:"POST",
                        dataType:"JSON",
                        data:{id:id},
                        success:function(res){
                            if(res.status=="true"){
                            table.draw();
                            }else{
                                alert(res.msg);
                            }
                        },
                        error:function(){
                            alert("Row was not deleted");
                        }
                    });
                }         
    });
                  
        });
    });
</script>


