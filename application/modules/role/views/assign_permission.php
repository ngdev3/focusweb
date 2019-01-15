<style>
    
.role_name ul{ margin: 0; padding:0;}
.role_name ul li{ list-style: none; float: left; color: #444; font-weight:bold; font-size: 14px; padding-left: 30px;}
.role_name ul li span{ font-weight: normal;}
 .hide_column{display:none;} 
 </style>


            <div class="row margin-top-10 white-box"  style="margin-top: 40px;">
                <div class="col-md-12"> 
                    <div class="portlet light">
                      

                         <div class="portlet-title" style="margin-bottom: 20px;">
                    <div class="card-icon_headings" style="height:auto;text-align: left;">
                    <div class="caption"> <i class="fa fa-list font-red-sunglo"></i>
                      <span class="caption-subject font-red-sunglo bold uppercase mainpage-title"> 
                        <?php echo $page_title; ?> 
                      </span>
                     </div>
                   </div>
                   <div class="actions">
                       <div class="role_name"> 
                                    <ul>
                                        <?php if ($this->uri->segment('4') == 'user') { ?>
                                            <li> Name: <span> <?php echo ucwords($userData->fname . ' ' . $userData->lname); ?> </span></li>                                                                                          
                                        <?php } ?>
                                        <li> Role: <span> <?php echo $userData->role_name; ?>  </span></li>                                    
                                    </ul> 
                                </div> 
                    </div>
                      
                        
                        <div class="portlet-title hide">
                            <div class="caption"> Assign Permission 

                                <div class="role_name pull-right"> 
                                    <ul>
                                        <?php if ($this->uri->segment('4') == 'user') { ?>
                                            <li> Name: <span> <?php echo ucwords($userData->fname . ' ' . $userData->lname); ?> </span></li>                                                                                          
                                        <?php } ?>
                                        <li> Role: <span> <?php echo $userData->role_name; ?>  </span></li>                                    
                                    </ul> 
                                </div> 
                                <?php if (!empty($this->session->flashdata('alert'))) { ?>
                                    <div class="alert alert-success ">
                                        <button class="close" data-dismiss="alert"></button>
                                        <span id="danger_msg">
                                            <?php $sess = $this->session->flashdata('alert');
                                            echo $sess['m']; ?>
                                        </span>
                                    </div>
                                <?php } ?>

                            </div>                            
                        </div>

                        <?php $type = $this->uri->segment('4'); ?>
                        <?php echo form_open("", array("method" => "post", "onSubmit" => "return validiate_perm()")); ?>
                        <div class="portlet-body">
                            <div class="cleafix"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="supplier">
                                        <!--                                        <h3 class="sub-head"> Permission </h3>-->
                                        <div class="table-scrollable permission">                                           
                                            <table class="table  table-bordered table-hover ">

                                                <tbody>
                                                    <tr>
                                                        <th width="25%">
                                                            Module Name
<!--                                                                Select/Deselect All<input id="selectall" onclick="selectAll(this)" value="1" type="checkbox">-->
                                                        </th>                                                           
                                                        <th align="center"> Permission </th>
                                                        <th  align="center" class="hide_column"> Add </th>
                                                        <th  align="center" class="hide_column"> Edit </th>
                                                        <th align="center" class="hide_column"> Delete </th>
                                                    </tr>
                                                    <?php
                                                    foreach ($modules as $mod) {
                                                        $permActionIds = array();
                                                        if (!empty($permAssigned) && array_key_exists($mod->id, $permAssigned)) {
                                                            $permActionIds = $permAssigned[$mod->id];
                                                        }
                                                        ?>                                                        
                                                        <tr class="sub-heading" id="tr<?php echo $mod->id; ?>">
                                                            <td> <?php echo $mod->submodule; ?>  </td>
                                                            <td><input name="view[<?php echo $mod->id; ?>]" value="1" <?php echo in_array("1", $permActionIds) ? "checked" : ""; ?> type="checkbox" id="rv_<?php echo $mod->id; ?>" class="rv ckd_prm"></td>
                                                            <td class="hide_column"><input name="add[<?php echo $mod->id; ?>]" value="2" <?php echo in_array("2", $permActionIds) ? "checked" : ""; ?> type="checkbox" id="ra_<?php echo $mod->id; ?>" class="red ckd_prm"></td>
                                                            <td class="hide_column"><input name="edit[<?php echo $mod->id; ?>]" value="3" <?php echo in_array("3", $permActionIds) ? "checked" : ""; ?>  type="checkbox"  id="re_<?php echo $mod->id; ?>" class="red ckd_prm"></td>
                                                            <td class="hide_column"><input name="delete[<?php echo $mod->id; ?>]" value="4" <?php echo in_array("4", $permActionIds) ? "checked" : ""; ?>  type="checkbox" id="rd_<?php echo $mod->id; ?>" class="red ckd_prm" ></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>                                                        
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="">
                                    <div class="form-action top_border">
                                        <div class=" col-md-4 text-left">

                                        </div>
                                        <div class="col-md-12">
                                        <center>
                                            <button type="submit" class="btn btn-primary" name="submit" >Apply</button>                                        
                                            <?php if ($this->uri->segment('4') == 'role') { ?>
                                                <a href="<?php echo base_url("role/list_items"); ?>"><button type="button" class="btn btn-primary">Cancel</button> </a>
                                            <?php } else if ($this->uri->segment('4') == 'user') { ?>
                                                <a href="<?php echo base_url("users/list_items"); ?>"><button type="button" class="btn btn-primary"> Cancel</button> </a>
                                            <?php } ?>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
        </div>
   

<script>     
    function selectAll(theObj) { 
        if($(theObj).prop("checked")==true){
            $("input[type=checkbox]").each(function(){                
                $(this).attr("checked",true);
                $(this).parent("span").addClass("checked");
            });
        }else{
            $("input[type=checkbox]").each(function(){                
                $(this).attr("checked",false);
                $(this).parent("span").removeClass("checked");
            }); 
        }
    }    
    $(document).ready(function(){
        // $(".hide_column").hide();        
        $(".red").on("change",function(){
            var oid = $(this).attr("id");
            var d = oid.split('_')[1];
            if($(this).prop("checked")==true){
                $("#rv_"+d).attr("checked",true);                                  
                $("#rv_"+d).parent("span").addClass("checked");                                  
            }
        });
    
        $(".rv").on("change",function(){
            var oid = $(this).attr("id");
            var d = oid.split('_')[1];
            if($(this).prop("checked")==false){           
                if($("#re_"+d).prop("checked")==true  ||  $("#rd_"+d).prop("checked")==true || $("#ra_"+d).prop("checked")==true){
                    //var c = confirm("This will remove All Permissions");
                  jConfirm('This will remove All Permissions', 'This will remove All Permissions', function(r) {
                    if(r){
                        $("#re_"+d).attr("checked",false);                                  
                        $("#re_"+d).parent("span").removeClass("checked");    
                        $("#rd_"+d).attr("checked",false);                                  
                        $("#rd_"+d).parent("span").removeClass("checked");                        
                        $("#ra_"+d).attr("checked",false);                                  
                        $("#ra_"+d).parent("span").removeClass("checked");                        
                    }else{
                        $("#rv_"+d).attr("checked",true);                                  
                        $("#rv_"+d).parent("span").addClass("checked");    
                    }
                    });
                }                                      
            }
            
            //check all
             if($(this).prop("checked")==true){           
                if($("#re_"+d).prop("checked")==false  ||  $("#rd_"+d).prop("checked")==false || $("#ra_"+d).prop("checked")==false){
                    //var c = jConfirm("This will Assign All Permissions");
                  jConfirm('This will Assign All Permissions', 'This will Assign All Permissions', function(r) {
                    if(r){
                        //alert(d);
                        $("#re_"+d).attr("checked",true);                                  
                        $("#re_"+d).parent("span").addClass("checked");    
                        $("#rd_"+d).attr("checked",true);                                  
                        $("#rd_"+d).parent("span").addClass("checked");                        
                        $("#ra_"+d).attr("checked",true);                                  
                        $("#ra_"+d).parent("span").addClass("checked");                        
                    }else{
                        $("#rv_"+d).attr("checked",false);                                  
                        $("#rv_"+d).parent("span").removeClass("checked");    
                    }
                });
                }                                      
            } 
        });
    
        $('#role').change(function() {
            $('.none').hide();
            $('#' + $(this).val()).show();
        });
        
    });
    
    function validiate_perm()
{
	if($('.ckd_prm:checked').length<1)
	{
		jAlert('Please select atleast one module');
		return false;
	}
}
</script>
