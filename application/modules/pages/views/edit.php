<style>
.form-group span{
  color:#ff0000;  
}
</style>

<div class="col-md-12 col-xs-12">
                        <div class="white-box" style="margin-top: 40px;" >
                        <div class="portlet-title">
                    <div class="card-icon_headings " style="height:auto;text-align: left;">
                    <div class="caption"> <i class="fa fa-list font-red-sunglo "></i>
                      <span class="caption-subject font-red-sunglo bold uppercase mainpage-title "> 
                        <?php echo $page_title; ?> 
                      </span>
                     </div>
                   </div>
                   <br>
                            <form class="form-horizontal form-material" id="edit_form" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-12">Page Name<span>*</span></label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Page Name"  name="page_name"  value="<?php echo set_value("page_name", @$res->page_name); ?>" class="form-control form-control-line"> </div>
                                        <div class="text-danger" class="input-error col-md-12"><?php echo form_error("page_name"); ?></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Image<span>*</span></label>
                                    <div class="col-md-12">
                                        <input type="file" placeholder="Image" name="image" value="<?php echo set_value("image", @$res->image); ?>" class="form-control form-control-line imageOnly"> </div>
                                        <div class="text-danger" class="input-error col-md-12"><?php echo form_error("image"); ?></div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-12">Title<span>*</span></label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Title" name="title" value="<?php echo set_value("title", @$res->title); ?>" class="form-control form-control-line"> </div>
                                        <div class="text-danger" class="input-error col-md-12"><?php echo form_error("title"); ?></div>
                                </div>
                                <div class="form-groups">
                                                <label for="" class="col-md-12">Description :<span>*</span></label>
                                                <div class="col-md-12">
                                                    <?php
                                                    $name = @$res->description;
                                                    $postvalue = @$_POST['description'];
                                                    echo form_textarea(array('name' => 'description','class' => 'form-control ckeditor', 'id' => 'description', 'placeholder' => 'Description', 'value' => !empty($postvalue) ? $postvalue : $name));
                                                    ?>
                                                    <div class="text-danger" class="input-error col-md-12"><?php echo form_error('description'); ?></div>
                                                </div>
                                            </div><br><br>
                                
                                

                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Meta Title<span>*</span></label>
                                    <div class="col-md-12">
                                        <input type="text"  hidden placeholder="Meta Title" name="metatitle" value="<?php echo set_value("metatitle", @$res->metatitle); ?>" class="form-control form-control-line" > </div>
                                        <div class="text-danger" class="input-error col-md-12"><?php echo form_error("metatitle"); ?></div>
                               
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">Meta Keyword<span>*</span></label>
                                    <div class="col-md-12">
                                        <input type="text"  hidden placeholder="Meta Keyword" name="metakeyword" value="<?php echo set_value("metakeyword", @$res->metakeyword); ?>"  class="form-control form-control-line"> </div>
                                        <div class="text-danger" class="input-error col-md-12"><?php echo form_error("metakeyword"); ?></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">Meta Description<span>*</span></label>
                                    <div class="col-md-12">
                                        <input type="text"  hidden placeholder="Meta Description" name="metadescription" value="<?php echo set_value("metadescription", @$res->metadescription); ?>"  class="form-control form-control-line"> </div>
                                        <div class="text-danger" class="input-error col-md-12"><?php echo form_error("metadescription"); ?></div>
                                </div>
                               
                                <div class="form-group">
                               <label class="col-md-12">Status<span>*</span></label>
                                    
                                    <div class="col-sm-12">
                                        <select name="status" class="form-control form-control-line">
                                          <option value="">Select</option>
                                                  <option value="1"  <?php echo set_select('status', '1', @$res->status == '1' && !empty(@$res) ? TRUE : FALSE); ?>>Active</option>
                                                  <option value="0"  <?php echo set_select('status', '0', @$res->status == '0' && !empty(@$res) ? TRUE : FALSE); ?>>Inactive</option>              
                                          
                                        </select>
                                       <div class="text-danger" class="input-error col-md-12"><?php echo form_error("status"); ?></div>

                                    </div>
                                </div>
                                
                              
                                
                           
                                
                                

                            <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Update</button>
                                        <a href="<?php echo base_url("pages/list_items"); ?>"><button type="button" class="btn btn-success">Cancel</button> </a>
                                
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->



                <script>
                 $("#edit_form").validate(
            {
                errorElement: 'span', //default input error message container
                errorClass: 'text-danger', // default input error message class
                rules:
                        {
                            page_name:
                                    {
                                        required: true
                                    },
                           
                           
                            title:
                                    {
                                        required: true
                                        
                                    },
                           
                            description:
                                    {
                                        required: true
                                        
                                    },
                            
                            status:
                            
                                    {
                                        required: true
                                    },
                            
                                            
                        },
                messages:
                        {
                            page_name:
                                    {
                                        required: "The Page Name field is required."
                                    },
                           
                                    
                            title:
                                    {
                                        required: "The Title field is required."
                                        
                                    },
                            description:
                                    {
                                        required: "The Description field is required."
                                        
                                    },
                         
                            status:
                                    {
                                        required: "The Status field is required."
                                    },
                          
                        }
            });

</script>
<script src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>
<script data-sample="1">
CKEDITOR.replace('description', {
 // contentsLangDirection: 'ltr', 
});

CKEDITOR.config.extraPlugins = 'youtube';
CKEDITOR.config.height = 200; 
CKEDITOR.config.width = 700;

CKEDITOR.config.filebrowserBrowseUrl = '<?php echo base_url() ?>assets/ckfinder/ckfinder.html';
CKEDITOR.config.filebrowserImageBrowseUrl = '<?php echo base_url() ?>assets/ckfinder/ckfinder.html?type=Images';
CKEDITOR.config.filebrowserFlashBrowseUrl = '<?php echo base_url() ?>assets/ckfinder/ckfinder.html?type=Flash';
CKEDITOR.config.filebrowserUploadUrl = '<?php echo base_url() ?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
CKEDITOR.config.filebrowserImageUploadUrl = '<?php echo base_url() ?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
CKEDITOR.config.filebrowserFlashUploadUrl = '<?php echo base_url() ?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';


CKEDITOR.on('dialogDefinition', function (ev) {
	var dialogName = ev.data.name;
	var dialogDefinition = ev.data.definition;
	if (dialogName == 'image') 
	{
		var infoTab = dialogDefinition.getContents('info');
		var hspace = infoTab.get('txtHSpace');
		var vspace = infoTab.get('txtVSpace');
		var cmbAlign = infoTab.get('cmbAlign');
		hspace['default'] = '8';
		vspace['default'] = '2';
		cmbAlign['default'] = 'right';
	}
});		


$(function(){
    $('.imageOnly').change( function(e) {
      var files = e.originalEvent.target.files;
      var selected = $(this);
      $('.invalid-format').hide();
      for (var i=0, len=files.length; i<len; i++){
        var fileNameExt = files[i].name.substr(files[i].name.lastIndexOf('.') + 1);
        //console.log(files[i].name, files[i].type, files[i].size);
        if($.inArray(fileNameExt, ['jpg','jpeg', 'gif', 'png', 'JPG', 'JPEG', 'GIF', 'PNG']) == -1) {
            $(selected).after('<span class="invalid-format" style="text-decoration:none;color:red;">Please upload image file ( jpg,jpeg, gif, png) only.<span>');
          $(selected).val('');
          }
      }
         });
  });



</script> 




