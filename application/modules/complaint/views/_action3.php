<a  href="<?php echo base_url('complaint/view_app_disapp/'.  ID_encode($data->id)); ?>" data-toggle="tooltip" class="tooltips" title="View"> <i class="fa fa-eye"></i> </a> &nbsp;

<?php if($this->session->userdata['userinfo']['role']=="0"){?>

<?php if($data->is_approved=="1"){?>
<a href="<?php echo base_url('complaint/update_disapp/'.  ID_encode($data->id)); ?>" data-id="<?php echo $data->id; ?>" data-toggle="tooltip" class="tooltips disapprove_row" title="Disapprove"> <i>Disapprove</i> </a><br>

<?php }else if($data->is_approved=="2"){?>
<a href="<?php echo base_url('complaint/update_app/'.  ID_encode($data->id)); ?>" data-id="<?php echo $data->id; ?>" data-toggle="tooltip" class="tooltips approve_row" title="Approve"> <i>Approve</i> </a>&nbsp&nbsp


<?php }else if($data->is_approved=="0"){ ?>
<a href="<?php echo base_url('complaint/update_disapp/'.  ID_encode($data->id)); ?>" data-id="<?php echo $data->id; ?>" data-toggle="tooltip" class="tooltips disapprove_row" title="Disapprove"> <i>Disapprove</i> </a><br>
<a href="<?php echo base_url('complaint/update_app/'.  ID_encode($data->id)); ?>" data-id="<?php echo $data->id; ?>" data-toggle="tooltip" class="tooltips approve_row" title="Approve"> <i>Approve</i> </a>&nbsp&nbsp

 
<?php }else{} 
}?>


