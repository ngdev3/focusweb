<div class="btn-group">
                                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu pull-left" role="menu">
                                                                 <li>
                                                                    <a href="<?php echo base_url('admin/leadershipvideo/view/'.  ID_encode($data->id)); ?>">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i> View </a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?php echo base_url('admin/leadershipvideo/edit/'.  ID_encode($data->id)); ?>">
                                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
                                                                </li>
                                                                <?php if($data->is_coach == '1' && $data->user_type !== '1'){?>
                                                                    <li>
	                                      			                <a href="javascript:void(0);" data-id="<?php echo $data->id; ?>" data-toggle="tooltip" class="tooltips assign_user" title="Delete"> <i class="fa fa-minus"></i>User</a>
                                                                </li>
                                                                <?php }else if($data->is_coach == '0' && $data->user_type !== '1'){?>
                                                                    <li>
	                                      			                <a href="javascript:void(0);" data-id="<?php echo $data->id; ?>" data-toggle="tooltip" class="tooltips assign_coach" title="Delete"> <i class="fa fa-plus"></i>Coach</a>
                                                                </li>
                                                                <?php }?>
                                                               
                                                                
                                                            </ul>
                                                        </div>

