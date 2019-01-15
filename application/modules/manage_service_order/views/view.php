

<style>
.box {
    background-color: white;
    width: 950px;
    
    border: 3px solid black;
    padding: 15px;
    margin: 0px;
}
 #line{
    
    border: 2px solid black;
    padding: 10px;
    
}
hr { 
  display: block;
  margin-top: 0.5em;
  margin-bottom: 0.5em;
  width:200px;
  margin-left: 710px;
  border-style: inset;
  border-width: 1px;
   border-top: 3px solid black;
} 

.input-icon p{margin: 0px;}
    .input-icon{padding: 8px 0px 20px 0px}
    .mt-15{margin-top: 15px;}
    .form-horizontal .control-label{text-align:left!important;font-weight:600;}
</style>



<h1 class="page-title" style="font-weight: 500"> <?php echo $page_title; ?> 
<!-- <small>Lorem Ipsum is dummy text of the printing industry.</small> -->
</h1>
<div class="row">

    <div class="portlet light bordered">
        <div class="portlet-title">


            <div class="portlet-body form add_prodcut_form">
 
            <?php @$newDate = date("d-m-Y", strtotime($res->created_date)); 
                   @$newtime = date("h:i a", strtotime($res->created_date)); 
                  // pr($newDate); ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-0 p-0 mB-0">
                                    <!--<h4 class="c-grey-900 mB-20">Simple Table</h4>-->
                        
                                    <tr>
                                              <b>  <th>Order Number : </th></b>
                                                <td ><?php echo "#".ucwords($res->dynamic_order_id);?></td>
                                            </tr>
                                            <br>

                                    <tr>
                                            <b><th>Date and Time : </th></b>
                                                <td ><?php echo (@$newDate)."&nbsp;&nbsp;&nbsp;&nbsp;".@$newtime;?></td>
                                            </tr><br><br>

                <form class="form-horizontal" role="form">
                <div class="portlet-body" style="margin: 60px;">
                <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label"><b>Service Person :</b></label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->fname." ".$res->lname); ?></p>                          
                            </div>
                        </div>
                    </div>
                    <?php if(getUserInfos()->role == "0"){ ?>
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label"><b>Branch Manager :</b></label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->m_fname." ".$res->m_lname); ?></p>                          
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if(getUserInfos()->role == "0" || getUserInfos()->role == "1"){ ?>
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label"><b>Coordinator :</b></label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->c_fname." ".$res->c_lname);; ?></p>                          
                            </div>
                        </div>
                    </div>
                    
                    
                    <?php } ?>
                     <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label"><b>Client Name :</b></label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->client_name); ?></p>                          
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-bottom:50px;" class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label"><b>Client's Location :</b></label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php echo ucwords($res->address); ?></p>                          
                            </div>
                        </div>
                    </div>
                  
                    <div class="table">                   
                    <table class="table1 table-striped table-bordered table-hover box" >
                        <thead>
                        <th id="line"  width="5%"><center> SL.No. </center></th>
                        <th id="line"> <center>Spare Parts </center></th>
                        <th id="line"> <center>HSN/SAC </center></th>
                        <th id="line"> <center> <center> Qty</center></th>
                        <th id="line"> <center>Unit</center></th>
                        <th id="line"> <center>Rate (INR) </center></th>
                        <th id="line"> <center>GST (INR) </th></center>
                        <th id="line"> <center>Total Orderd value</th></center>
                            <?php
                            foreach (@$detail as $i => $row){
                                $a=($row->total);
                                $a=$a+$a*($row->gst/100);
                                ?>
                         <tr>
                                
                                <td id="line"  scope="col"> <center><?php echo ++$i;  ?></center></td>
                               
                                <td id="line"  scope="col"> <center><?php echo $row->name; ?></center></td>

                               
                                <td id="line"  scope="col"> <center><?php echo $row->hsn_sac; ?></center></td>
                                <td id="line"  scope="col"> <center><?php echo $row->quantity; ?></center></td>
                               
                              <td id="line"  scope="col">  <center><?php echo $row->unit_id; ?></center></td>
                       
                                <td id="line"  scope="col"> <center><?php echo $row->price; ?></center></td>
                              
                                <td id="line"  scope="col"> <center><?php echo $row->gst; ?></center></td>
                                <td id="line"  scope="col"> <center><?php echo $a; ?></center></td>
                                </tr>
                            <?php } ?>

                             
					</thead> 
                     
                    </table>
                                
                 </div>
                       <?php
                        $a=0;
                        $b=0;
                       foreach (@$detail as $i => $row){
                        $a=($row->total);
                        $a=$a+$a*($row->gst/100);
                        $b=$a+$b;

                              
                      
                     }   ?> 
                     <br>
                    <b><div style="height:auto;text-align: right;margin-right:50px;"> Total :&nbsp;&nbsp;&nbsp;&nbsp; <?php echo "Rs ".$b; ?></div>
                    </b>
                    <b><div style="height:auto;text-align: right;margin-right:50px;"> Advanced Paid :&nbsp;&nbsp;&nbsp;&nbsp; <?php echo "Rs ".$res->advance_amount; ?></div>
                    </b>
                  
                 <hr>
                    <b><div style="height:auto;text-align: right;margin-right:50px;">Overdue:&nbsp;&nbsp;&nbsp;&nbsp; <?php echo "RS ".($b-$res->advance_amount); ?></div>
                    </b>
                   
                <br><br>
                   
                    
                     <!-- <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label"><b>Gender :</b></label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php if ($res->gender == 1) {
                                        echo "Male";
                                    } else if($res->gender == 2) {
                                        echo "Others";
                                    }
                                    else if($res->gender == 0) {
                                        echo "Female";
                                    }else{
                                        echo "";
                                    }
                                    ?></p>                          
                            </div>
                        </div>
                    </div> -->
                    
                    
                    
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label"><b>Mode Of Payment :</b></label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                            <p>  <?php if ($res->payment_mode == "1") {
                                        echo ucwords("Cash");                                    
                                    } else if($res->payment_mode == "2") {
                                        echo ucwords("Check"); 
                                    }
                                    else if($res->payment_mode == "3") {
                                        echo ucwords("Demand Draft"); 
                                    } else if($res->payment_mode == "4") {
                                        echo ucwords("Online"); 
                                    }else{
                                        echo "-";
                                    }
                                    ?>      </p>                    
                            </div>
                        </div>
                    </div>
                     
                     <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label"><b>Payment Description :</b></label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                                <p><?php if($res->payment_description=="0"){echo "-"; }else{ echo ucwords($res->payment_description); } ?> </p>                          
                            </div>
                        </div>
                    </div>
                    
                    
                     <div class="form-group col-md-12 col-sm-12">
                        <label for="inputEmail12" class="col-md-3 control-label"><b>Term Of Payment :</b></label>
                        <div class="col-md-9">
                            <div class="input-icon" >
                            <p><?php if($res->payment_term=="0"){echo "-"; }else{ echo ucwords($res->payment_term); } ?></p>                          
                            </div>
                        </div>
                    </div>
                    
                    
                     


                    <div class="form-group text-center col-xs-12 mt-15">
                        <div class="col-md-12">
                        
                            <a href="javascript:;" class="btn btn-success">Submit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         
                            <a href="<?php echo base_url("manage_service_order/list_items"); ?>"class="btn green">Back</a>
                        </div>
                    </div>
            </div>
			  </form>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
		</div>
    </div>
</div>
		</div>
	</div>
</div>

<!-- chart 3 -->