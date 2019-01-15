<style>
.dropdown-menu {
    background-color: #337ab7;
    border-color: #2e6da4;
   
}
.year{
    color:white;
    font-weight:400;

}
.input-small {
    width: 212px!important;
}

.decade{
    color:white;
    font-weight:400;

}
.new{
    color:white!important;
    font-weight:400;

}
.old{
    color:white!important;
    font-weight:400;

}
.datepicker table th {
    color: white;
    font-weight: 550!important;
    background:none;
}
.datepicker-switch {
    
    background:none;
    background-color: none!important;
}
.datepicker table tr td span:hover{
    
    background-color: #4b8df8!important;
}

</style>
<div class="clearfix"></div>
  <h1 class="page-title" style="font-weight: 500"><?php echo $page_title; ?> 

</h1>
<div class="row">
<div class="portlet light bordered">
<div class="portlet-title">
 
<?php
  $QUERY_STRING = $_SERVER['QUERY_STRING'];
 
    //  pr($selected_date);   ?>         
          
          
        
               
<center><form class="form-horizontal form-material" id="form_search" method="get" novalidate="novalidate">

<input readonly name="year" id="datepicker2" value="<?php if(empty($_GET)){echo "Select Year";}else{echo set_value("Year", @$_GET['year']);} ?>" class=" custom_filter2  btn btn-primary datepicker trip_calander  required">                          
&nbsp;&nbsp;
<select id ="month" name='month' class=" custom_filter btn btn-primary trip_calander">
<option value="">Select Month</option>
             

  <option value="1" <?php echo set_select('month', '1', @$_GET['month'] == '1' && !empty(@$_GET) ? TRUE : FALSE); ?>><b>January</b></option>
  <option value="2" <?php echo set_select('month', '2', @$_GET['month'] == '2' && !empty(@$_GET) ? TRUE : FALSE); ?>>February</option>
  <option value="3" <?php echo set_select('month', '3', @$_GET['month'] == '3' && !empty(@$_GET) ? TRUE : FALSE); ?>>March</option>
  <option value="4" <?php echo set_select('month', '4', @$_GET['month'] == '4' && !empty(@$_GET) ? TRUE : FALSE); ?>>April</option>
  <option value="5" <?php echo set_select('month', '5', @$_GET['month'] == '5' && !empty(@$_GET) ? TRUE : FALSE); ?>>May</option>
  <option value="6" <?php echo set_select('month', '6', @$_GET['month'] == '6' && !empty(@$_GET) ? TRUE : FALSE); ?>>June</option>
  <option value="7" <?php echo set_select('month', '7', @$_GET['month'] == '7' && !empty(@$_GET) ? TRUE : FALSE); ?>>July</option>
  <option value="8" <?php echo set_select('month', '8', @$_GET['month'] == '8' && !empty(@$_GET) ? TRUE : FALSE); ?>>August</option>
  <option value="9" <?php echo set_select('month', '9', @$_GET['month'] == '9' && !empty(@$_GET) ? TRUE : FALSE); ?>>September</option>
  <option value="10" <?php echo set_select('month', '10', @$_GET['month'] == '10' && !empty(@$_GET) ? TRUE : FALSE); ?>>October</option>
  <option value="11" <?php echo set_select('month', '11', @$_GET['month'] == '11' && !empty(@$_GET) ? TRUE : FALSE); ?>>November</option>
  <option value="12" <?php echo set_select('month', '12', @$_GET['month'] == '12' && !empty(@$_GET) ? TRUE : FALSE); ?>>December</option>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;

<button type="submit" id="search_filter"class="btn btn-success"> <i class="fa fa-arrow-right"></i></button>
&nbsp;&nbsp;&nbsp;&nbsp;

<!-- <button type="button" style="background-color:green;" class="btn btn-warning" id="refresh">Refresh <i class="fa fa-refresh"></i></button>               -->
</center>
                         
</form>
                
                  
            <div class="portlet-body">
            <div class="table-toolbar">
                    <table class="table table-striped table-bordered table-hover" id="location-grid">
                        <thead>
                            <tr>
                            <th width="5%">S.No.</th>
                            <th>Sales<br> Person</th>
                            <?php if ( getUserInfos()->role == "0"){ ?>
                            <th>Branch<br> Manager </th>
                            <?php } ?>
                            <?php if ( getUserInfos()->role == "1" || getUserInfos()->role == "0"){ ?>
                            <th>Coordinator</th>
                            <?php } ?>
                            <th>Given Target<br> (INR)</th>
                            <th>Acheived Target<br> (INR)</th>
                            <th>Given Target <br>(No. of Products)</th>
                            <th>Acheived Target<br> (No. of Products)</th>
                            <th>Target<br> Achieved ?</th>
                               
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
        var table = $('#location-grid');
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n     
            "bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.
            "processing": true,
            "serverSide": true, 
            "lengthMenu": [[5,10,50, 100, 200, -1],[5,10,50, 100, 200, "All"]], // change perpage values here
            // set the initial value
          
            "pageLength":'5',            
            "pagingType": "bootstrap_full_number",
            "language": {"search": "",searchPlaceholder: "Search ","lengthMenu": "  _MENU_ Records","paginate": {"previous":"Prev","next": "Next","last": "Last","first": "First"}},
            "columnDefs"      : [{ 'className': 'control', 'orderable': true, 'targets':[1]}, 
                {'orderable': false, 'targets': [0,-1] },
                {"targets": [0],"searchable": false}
            ],
                    "ajax":{
                url :"<?php echo base_url()?>viewtarget/list_items_ajax/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>?<?php echo $_SERVER["QUERY_STRING"]; ?>", // json datasource
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
        var table = $('#location-grid').DataTable();
        $('#location-grid tbody').on( 'click', '.delete_row', function () { 
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

<script>
$("#datepicker2").datepicker( {
    format: " yyyy",
    viewMode: "years", 
    minViewMode: "years",
    endDate:"yyyy",
    startView:"yyyy"
});
</script>


<script>
$("#search_filter").on("click",function(){
       $("#form_search").submit();
   });
$("#refresh").on("click",function(){
    window.location.href = "<?php echo base_url(); ?>viewtarget/list_items"
   });
</script>
