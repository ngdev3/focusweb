<table class="table table-striped table-bordered table-advance table-hover">
    <thead>
        <tr>
            <th>
                <input type="checkbox" id="checkAllRows" onchange="checkAllRows12()" /> 
            </th>
            <th>Role Id</th>
            <th>Name</th>            
            <th> Status </th>
            <th>Action </th>
        </tr>
    </thead>
    <tbody>
        <?php        
        
        if (isset($result['result']) && !empty($result['result'])) {
            $i = $start + 1;
            foreach ($result['result'] as $customer) {
                ?>
                <tr align="left">
                    <td width="5%"> <input type="checkbox" class="checkerDiv" name="checkRow[]" value="<?= $customer['id']; ?>" id="checkRow_<?= $i; ?>" /> </td>
                    <td width="5%"><?php echo $i; ?> </td>
                    <td width="30%"> <?php echo $customer['role_name']; ?> </td>                    
                    <td width="9%"><span class="label label-sm label-success"> <?php if ($customer['status'] == 1) {
            echo 'Active';
        } else {
            echo 'Inactive';
        } ?> </span></td>

                    <td width="12%"> 
                        <a href="<?php echo base_url(); ?>role/view/<?php echo base64_encode($customer['id']); ?>" class="btn btn-xs blue"> <i class="fa fa-search-plus"></i>  </a> 
                         <?php if(has_permission("role", "edit") || currentuserinfo()->emptype == "1" ) {  ?>	
                        <a href="<?php echo base_url(); ?>role/edit/<?php echo base64_encode($customer['id']); ?>"  class="btn btn-xs yellow"> <i class="fa fa-pencil-square-o"></i> </a> 
                               <?php } ?>
                        <?php if(has_permission("role", "delete") || currentuserinfo()->emptype == "1" ) {  ?>
                        <a href="javascript:;" onclick="delete_customer('<?php echo $customer['id']; ?>')"   class="btn btn-xs delete"> <i class="fa fa-trash-o"></i> </a> 
                               <?php } ?>
                        <?php $id = base64_encode($customer['id']);?>
                        <a href="<?php echo base_url("role/assign_permission/$id/role"); ?>" class="btn  btn-xs btn-info margin-right-10 " title="Assign Permission" ><i class="fa fa-key" aria-hidden="true"></i></a>
                    </td>
                </tr>

        <?php $i++;
    }
} else { ?>

            <tr><td colspan="7" align="center"> <strong>No Role Avilable</strong> </td></tr>
<?php } ?>
    </tbody>
</table>
<?php
$paging = custompaging($cur_page, $no_of_paginations, $previous_btn, $next_btn, $first_btn, $last_btn);
echo $paging;
?>