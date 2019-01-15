<?php
 $alc = $this->session->flashdata('alert');
 $this->session->set_flashdata('alert',NULL);
 
if(isset($alc)){
 	if(@$alc['c']=='d'){$aClass = 'alert-danger'; $cap = "Error";}
 	elseif(@$alc['c']=='w'){$aClass = 'alert-warninlert-dangerg'; $cap = "Warning";}
 	elseif(@$alc['c']=='n'){$aClass = 'alert-info'; $cap = "Notice";}
     elseif(@$alc['c']=='s'){$aClass = 'alert-success'; $cap = "Success";}
    // elseif(@$alc['c']=='q'){$aClass = 'alert-warning alert-danger'; $cap = "Notice";}
?>
<div class="row" style="margin-top:10px;">
  <div class="col-lg-12">
        <div class="alert <?php echo @ $aClass;?> fade in" style="margin-bottom:0px!important;">
            <a href="javascript:void(0)" class="pkAlertClose close">&times;</a>
            <strong><?php echo $cap;?>!</strong> <?php echo @ $alc['m'];?>
        </div>  
    </div>
</div>


<script>
function func(el){
    el.fadeOut(1500,function(){el.remove();});
}
$(document).ready(function(){
    setTimeout(function(){ func($(".pkAlertClose").closest(".row"));},4000);
    $(".pkAlertClose").click(function(){ func($(this).closest(".row")); });
});

</script>
<?php } ?>
<script>
$(document).ready(function(){
    $(".pkAlertClose").click(function(){
        $(".alert").fadeOut();
    });
});
</script>