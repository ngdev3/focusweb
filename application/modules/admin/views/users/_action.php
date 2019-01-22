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
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio1" value="mastery" checked name="radio1" class="md-radiobtn" required>
                                                        <label for="radio1">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>Self Mastery</label>
                                                    </div>
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio2" value="leader" name="radio1" class="md-radiobtn" required>
                                                        <label for="radio2">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>Business Leadership </label>
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
$("#reject_button1<?=$data->id?>").click(function(){   
   
   var ids = <?php echo ID_encode($data->id);?>  //$(this).attr('data');
   var balance = $("input[name='radio1']:checked").val()
//    alert(ids);
   var sendData = {
       ids:ids,
       type:balance
   }
//    return          
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



//    console.log(ids + balance);
   $.ajax({
           url: "<?php echo base_url("admin/advertiser/addBalance"); ?>",
           type: "POST",
           data: 'id='+ids+'&balance='+balance,
           success: function(result){
            if(result == 1){

                window.location="<?php echo base_url("admin/advertiser"); ?>";
            }

               var obj=JSON.parse(result);
               if(obj.validation_error.balance!=null){

                   $('#comment_error<?=$data->id?>').html(obj.validation_error.balance);
               }else{
                   $('.comment_error<?=$data->id?>').html("");
               }

               
           }
       });

});



$(document).keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        return false; 
    }
});
</script>