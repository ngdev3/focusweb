<div class="btn-group">
         <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
             <i class="fa fa-angle-down"></i>
         </button>
         <ul class="dropdown-menu pull-left" role="menu">
              <li>
                 <a href="<?php echo base_url() . ('salespersonactivity/list_items_activity/' . ID_encode($data->sales_person_id)); ?>">
                     <i class="fa fa-eye" aria-hidden="true"></i> View </a>
             </li>
         
           <!--   <li>
<a href="javascript:void(0);" data-id="<?php echo $data->id; ?>" data-toggle="tooltip" class="tooltips delete_row" title="Delete"> <i class="fa fa-trash"></i>  Delete</a>
             </li> -->

         </ul>
     </div>

