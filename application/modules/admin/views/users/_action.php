<div class="btn-group">
                                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu pull-left" role="menu">
                                                                 <li>
                                                                    <a href="<?php echo base_url('admin/users/view/'.  ID_encode($data->id)); ?>">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i> View </a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?php echo base_url('admin/users/edit/'.  ID_encode($data->id)); ?>">
                                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>
                                                                </li>
                                                                <?php if($data->is_coach == '1' && $data->user_type !== '1'){?>
                                                                    <li>
	                                      			                <a href="javascript:void(0);" data-id="<?php echo $data->id; ?>" data-toggle="tooltip" class="tooltips assign_user" title="Delete"> <i class="fa fa-minus"></i>User</a>
                                                                </li>
                                                                <?php }else if($data->is_coach == '0' && $data->user_type !== '1'){?>
                                                                    <li>
	                                      			                <a  data-toggle="modal" href="#small_<?php echo ($data->id); ?>" data-id="<?php echo $data->id; ?>" data-toggle="tooltip" class="tooltips" title="Delete"> <i class="fa fa-plus"></i>Coach</a>
                                                                      <!-- <a class="btn blue btn-outline sbold" data-toggle="modal" href="#small"> View Demo </a> -->
                                                                </li>
                                                               
                                                                <!-- <li>
	                                      			                <a href="javascript:void(0);" data-id="<?php echo $data->id; ?>" data-toggle="tooltip" class="tooltips delete_row" title="Delete"> <i class="fa fa-trash"></i>  Delete</a>
                                                                </li> -->
                                                                
                                                            </ul>
                                                        </div>


                                                     

 <!-- /.modal -->
 <!-- <a class="btn blue btn-outline sbold" data-toggle="modal" href="#small"> View Demo </a> -->
 <div class="modal fade bs-modal-sm" id="small_<?php echo ($data->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
 
                                           
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title">Select Category</h4>
                                                    </div>
                                                    <div class="modal-body"> 
                                                    <?php echo form_open_multipart('', array('class' => '', 'id' => 'teamForm',)); ?>
                                                    <div class="form-group form-md-radios">
                                                <!-- <label>Checkboxes</label> -->
                                                <div class="md-radio-list">
                                                    <div class="md-radio"  >
                                                        <input type="radio"  id="firstradio_<?php echo ($data->id); ?>"  value="mastery" checked name="radio1" class="md-radiobtn" required>
                                                        <label for="radio1" onClick="select_radio(<?php echo ($data->id); ?>,'firstradio_','1')">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box" ></span>Self Mastery</label>
                                                    </div>
                                                    <div class="md-radio" >
                                                        <input type="radio"   id="secondradio_<?php echo ($data->id); ?>" value="leader" name="radio1" class="md-radiobtn" required>
                                                        <label for="radio2" onClick="select_radio(<?php echo ($data->id); ?>,'secondradio_','2')">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box" ></span>Business Leadership </label>
                                                    </div>
                                                    <div class="md-radio">
                                                       <select name="sab_cat" id="sab_cat_<?php echo ($data->id); ?>" class="form-control " required>
                                                                <option value="">Select Sub Category</option>
                                                               
                                                            <?php foreach($sub as $key => $val):?>
                                                                <option value="<?php echo $val->id;?>"><?php echo $val->title;?></option>
                                                            <?php endforeach;?>
                                                       </select>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                            </form>
                                                     </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn green" id="reject_button1<?=$data->id?>" data="<?=$data->id?>">Save changes</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                                        <!-- /.modal -->
                                        <?php }?>

                                        <script>
                                        function select_radio(id, type, typeid){
                                            console.log('#'+type+id)
                                            oncallajaxhit(typeid, id);
                                            $('#'+type+id).attr('checked', 'checked');
                                            //$(type+id).checked();
                                        }
$("#reject_button1<?=$data->id?>").click(function(){   
   
   var ids = <?php echo ID_encode($data->id);?>  //$(this).attr('data');
   var balance = $("input[name='radio1']:checked").val()
  // alert($('#sab_cat_'+ <?php echo ($data->id);?>).val());
   if($('#sab_cat_'+<?php echo ($data->id);?>).val() < 1){
    jAlert('Select Sub Catgory')
    return;
   }
   var sendData = {
       ids:ids,
       type:balance,
       sub_cat:$('#sab_cat_'+<?php echo ($data->id);?>).val()
   }
  // return          
   $.ajax({
                        url:"<?php echo base_url('admin/users/becomecoach'); ?>",
                        type:"POST",
                        data:{data:sendData},
                        success:function(data){
                            //table.draw();
                            console.log()
                            if(JSON.parse(data).status){

                         window.location.href="<?php echo base_url('admin/users/listing'); ?>";
                            }else{

                            alert("Row was not deleted");
                            }
                        },
                        error:function(){
                            alert("Row was not deleted");
                        }
                    });




});

function oncallajaxhit(id, toolid){
    // alert();

    var sendData = {
       id:id,
      
   }

    $.ajax({
                        url:"<?php echo base_url('admin/users/get_cat'); ?>",
                        type:"POST",
                        data:sendData,
                        success:function(data){
                            //table.draw();
                            console.log(JSON.parse(data).length)
                            if(JSON.parse(data).length > 0){

                                var $city = $('#sab_cat_'+toolid);
                                data = JSON.parse(data)
                                
                            $city.empty();
                            for (var i = 0; i < data.length; i++) {
                               // alert(data[i].id)
                                $city.append('<option id=' + data[i].id + ' value=' + data[i].id + '>' + data[i].title + '</option>');
                            }
                            }else{

                            jAlert("No Sub Category Found");
                            }
                        },
                        error:function(){
                            alert("Row was not deleted");
                        }
                    });
}


$(document).keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        return false; 
    }
});
</script>