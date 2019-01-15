 <a  href="<?php echo base_url('pages/view/'.  ID_encode($data->id)); ?>" data-toggle="tooltip" class="tooltips" title="View"> <i class="fa fa-eye"></i> </a> &nbsp;
<a href="<?php echo base_url('pages/edit/'.  ID_encode($data->id)); ?>" data-toggle="tooltip" class="tooltips" title="Edit"> <i class="fa fa-edit"></i> </a> &nbsp; 
<!-- <a href="javascript:void(0);" data-id="<?php echo $data->id; ?>" data-toggle="tooltip" class="tooltips delete_row" title="Delete"> <i class="fa fa-trash"></i> </a>
 --><?php $id = base64_encode($data->id); ?>
<!-- <a href="<?php echo base_url("role/assign_permission/$id/user"); ?>" data-toggle="tooltip" class="tooltips" title="Assign Permission"> <i class="fa fa fa-cog"></i> </a> -->