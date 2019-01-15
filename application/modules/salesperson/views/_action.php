<div class="btn-group">
                                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu pull-left" role="menu">
                                                                 <li>
                                                                    <a href="<?php echo base_url('salesperson/view/'.  ID_encode($data->id)); ?>">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i> View </a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?php echo base_url('salesperson/edit/'.  ID_encode($data->id)); ?>">
                                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
                                                                </li>
                                                                <li>
	                                      			<a href="javascript:void(0);" data-id="<?php echo $data->id; ?>" data-toggle="tooltip" class="tooltips delete_row" title="Delete"> <i class="fa fa-trash"></i>  Delete</a>
                                                                </li>
								  <li>
                                                                    <a href="<?php echo base_url('salesperson/target/'.  ID_encode($data->id)); ?>">
                                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Set Target </a>
                                                                </li>
                                                            </ul>
                                                        </div>


<!--<a  href="<?php echo base_url('users/profile/'.  encode($data->id)); ?>" data-toggle="tooltip" class="tooltips" title="View"> <i class="fa fa-eye"></i> </a> &nbsp; 
<a href="<?php echo base_url('users/edit/'.  ID_encode($data->id)); ?>" data-toggle="tooltip" class="tooltips" title="Edit"> <i class="fa fa-edit"></i> </a> &nbsp; 
<a href="javascript:void(0);" data-id="<?php echo $data->id; ?>" data-toggle="tooltip" class="tooltips delete_row" title="Delete"> <i class="fa fa-trash"></i> </a>
<?php $id = base64_encode($data->id); ?>
<a href="<?php echo base_url("role/assign_permission/$id/user"); ?>" data-toggle="tooltip" class="tooltips" title="Assign Permission"> <i class="fa fa fa-cog"></i> </a>-->