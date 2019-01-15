<div class="btn-group">
                                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu pull-left" role="menu">
                                                                
                                                            <?php if(!is_send_quote("pr_sales_quote_details",$data->id)){?>
                                                               <li>
                                                               <a href="<?php echo base_url('backendteam/revised_sales_quote/'.  ID_encode($data->id)); ?>">
                                                                      <i class="fa fa-cog"></i>  Send Quote</a>
                                                                </li>
                                                                <?php }else{ ?>

                                                                    <li>
                                                                    <a href="<?php echo base_url('backendteam/view_sales_quote/'.  ID_encode($data->id)); ?>">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i> View </a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?php echo base_url('backendteam/revised_sales_quote/'.  ID_encode($data->id)); ?>">
                                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Revised </a>
                                                                </li>
                                                                    <?php } ?>
                                                            </ul>
                                                        </div>

