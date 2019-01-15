
<div class="btn-group">
    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
        <i class="fa fa-angle-down"></i>
    </button>
    <ul class="dropdown-menu pull-left" role="menu">
        <li>
            <a href="<?php echo base_url('leadmanagement/view/' . ID_encode($data->id)); ?>">
                <i class="fa fa-eye" aria-hidden="true"></i> View </a>
        </li>
        <li>
            <a href="<?php echo base_url('leadmanagement/edit/' . ID_encode($data->id)); ?>">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
        </li>
        <li>
            <a href="javascript:void(0);" data-id="<?php echo $data->id; ?>" data-toggle="tooltip" class="tooltips delete_row" title="Delete"> <i class="fa fa-trash"></i>  Delete</a>
        </li>
         <li>
            <a href="<?php echo base_url('leadmanagement/assign_activity/' . ID_encode($data->id)); ?>">
              
                <?php if(check_lead_assigned($data->id)){?>
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Assign <br>Activity </a>
                <?php } else{  ?>
            
             
                         <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit <br>Activity </a>

                <?php }?>
        </li>
        
    </ul>
</div>